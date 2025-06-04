<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$pdo = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Preluare filtre
$tara = $_GET['tara'] ?? '';
$indicator = $_GET['indicator'] ?? '';
$format = $_GET['format'] ?? 'csv';

// Bază interogare
$query = "SELECT * FROM ocupare_comparatie WHERE 1=1";
$params = [];

if (!empty($tara)) {
    $query .= " AND Tara = :tara";
    $params[':tara'] = $tara;
}
if (!empty($indicator)) {
    $query .= " AND Indicator = :indicator";
    $params[':indicator'] = $indicator;
}

// Executare
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($rows)) {
    die("Nu s-au găsit date.");
}

// Export
if ($format === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=ocupare_comparatie.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array_keys($rows[0]));
    foreach ($rows as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(array_keys($rows[0]), null, 'A1');
    $sheet->fromArray($rows, null, 'A2');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename=ocupare_comparatie.xlsx');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
?>
