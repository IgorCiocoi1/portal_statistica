<?php
require __DIR__ . '/../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Setări parametri
$an = $_GET['an'] ?? '';
$indicator = $_GET['indicator'] ?? 'Numar_casatorii';
$format = $_GET['format'] ?? 'csv';

$filename = "predictii_casatorii_export";
$csvPath = __DIR__ . '/../../data/predictie_casatorii_2025_2030.csv';

if (!file_exists($csvPath)) {
    die("Fișierul CSV nu a fost găsit.");
}

$data = array_map('str_getcsv', file($csvPath));
$headers = array_shift($data); // prima linie e header

$filtered = [];
foreach ($data as $row) {
    $assoc = array_combine($headers, $row);
    if ($an && $assoc['Anul'] != $an) continue;
    $filtered[] = [
        'Anul' => $assoc['Anul'],
        'Indicator' => $indicator,
        'Numar' => $assoc[$indicator] ?? 0
    ];
}

// Export CSV
if ($format === 'csv') {
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename={$filename}.csv");
    $out = fopen('php://output', 'w');
    fputcsv($out, ['Anul', 'Indicator', 'Numar']);
    foreach ($filtered as $row) {
        fputcsv($out, $row);
    }
    fclose($out);
    exit;
}

// Export Excel
if ($format === 'xlsx') {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(['Anul', 'Indicator', 'Numar'], null, 'A1');
    $rowNum = 2;
    foreach ($filtered as $r) {
        $sheet->setCellValue("A$rowNum", $r['Anul']);
        $sheet->setCellValue("B$rowNum", $r['Indicator']);
        $sheet->setCellValue("C$rowNum", $r['Numar']);
        $rowNum++;
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename={$filename}.xlsx");
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
