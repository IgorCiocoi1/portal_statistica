<?php
require __DIR__ . '/../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$an = $_GET['an'] ?? '';
$sex = $_GET['sex'] ?? '';
$format = $_GET['format'] ?? 'csv';
$filename = "predictii_demografie";

$csvPath = __DIR__ . '/../../data/predictii_sex_an_2025_2030.csv';
if (!file_exists($csvPath)) {
    die("Fișierul cu predicții nu a fost găsit.");
}

$data = array_map('str_getcsv', file($csvPath));
$headers = array_shift($data);
$filteredData = [];

foreach ($data as $row) {
    $assoc = array_combine($headers, $row);
    if ($sex && strtolower($assoc['Sex']) !== strtolower($sex)) continue;
    if ($an && $assoc['Anul'] !== $an) continue;
    $filteredData[] = $assoc;
}

// Dacă nu există date după filtrare
if (empty($filteredData)) {
    die("Nu există date pentru filtrul selectat.");
}

// Export CSV
if ($format === 'csv') {
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename={$filename}.csv");
    $output = fopen("php://output", 'w');
    fputcsv($output, $headers);
    foreach ($filteredData as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Export Excel
if ($format === 'xlsx') {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

// Header
foreach ($headers as $col => $header) {
    $colLetter = Coordinate::stringFromColumnIndex($col + 1);
    $sheet->setCellValue("{$colLetter}1", $header);
}

// Data
foreach ($filteredData as $rowIndex => $rowData) {
    foreach ($headers as $colIndex => $header) {
        $colLetter = Coordinate::stringFromColumnIndex($colIndex + 1);
        $sheet->setCellValue("{$colLetter}" . ($rowIndex + 2), $rowData[$header]);
    }
}


    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename={$filename}.xlsx");

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
