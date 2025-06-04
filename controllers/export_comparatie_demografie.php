<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$tara = $_GET['tara'] ?? '';
$sex = $_GET['sex'] ?? '';
$format = $_GET['format'] ?? 'csv';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "
        SELECT Tara, Anul, Sex, SUM(Numar_persoane) as Numar
        FROM demografie_comparatie
        WHERE 1=1
    ";
    $params = [];

    if ($tara !== '') {
        $query .= " AND Tara = :tara";
        $params[':tara'] = $tara;
    }

    if ($sex !== '') {
        $query .= " AND Sex = :sex";
        $params[':sex'] = $sex;
    }

    $query .= " GROUP BY Tara, Anul, Sex ORDER BY Tara, Anul";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        die("Nu există date pentru criteriile selectate.");
    }

    if ($format === 'xlsx') {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(array_keys($rows[0]), null, 'A1');

        $rowIndex = 2;
        foreach ($rows as $row) {
            $sheet->fromArray(array_values($row), null, 'A' . $rowIndex++);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=comparatie_demografie.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    } else {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=comparatie_demografie.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys($rows[0]));
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }

    exit;

} catch (Exception $e) {
    echo "Eroare la export: " . $e->getMessage();
}
