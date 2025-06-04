<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Parametri GET
$tara = $_GET['tara'] ?? '';         // "" = toate țările
$indicator = $_GET['indicator'] ?? ''; // "" = toți indicatorii
$format = $_GET['format'] ?? 'csv';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Construim interogarea dinamică
    $query = "
        SELECT Tara, Anul, Indicator, Numar
        FROM casatorii_comparatie
        WHERE 1=1
    ";

    $params = [];
    if ($tara !== '') {
        $query .= " AND (Tara = :tara OR Tara = 'Moldova')";
        $params[':tara'] = $tara;
    }

    if ($indicator !== '') {
        $query .= " AND Indicator = :indicator";
        $params[':indicator'] = $indicator;
    }

    $query .= " ORDER BY Tara, Anul";

    $stmt = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($rows)) {
        die("Nu s-au găsit date pentru export.");
    }

    // CSV
    if ($format === 'csv') {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=comparatie_casatorii.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys($rows[0]));
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }

    // XLSX
    if ($format === 'xlsx') {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(array_keys($rows[0]), null, 'A1');

        $rowNum = 2;
        foreach ($rows as $row) {
            $sheet->fromArray(array_values($row), null, 'A' . $rowNum++);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=comparatie_casatorii.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

} catch (Exception $e) {
    echo "Eroare la export: " . $e->getMessage();
}
