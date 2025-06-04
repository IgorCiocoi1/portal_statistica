<?php
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$an = $_GET['an'] ?? '';
$format = $_GET['format'] ?? 'csv';

// Calea către fișierul CSV cu predicții
$csvPath = '../../data/predictii_educatie_2025_2030.csv';
if (!file_exists($csvPath)) die("Fișierul de predicții nu există.");

// Citește fișierul
$data = [];
$handle = fopen($csvPath, 'r');
$headers = fgetcsv($handle);

while (($row = fgetcsv($handle)) !== false) {
    $assoc = array_combine($headers, $row);
    if ($an === '' || $assoc['Anul'] == $an) {
        $data[] = $assoc;
    }
}
fclose($handle);

if (empty($data)) die("Nu există date pentru anul selectat.");

// Export CSV sau Excel
if ($format === 'xlsx') {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(array_keys($data[0]), null, 'A1');

    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->fromArray(array_values($row), null, 'A' . $rowIndex++);
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=predictii_educatie_" . ($an ?: 'totali') . ".xlsx");
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
} else {
    header('Content-Type: text/csv');
    header("Content-Disposition: attachment; filename=predictii_educatie_" . ($an ?: 'totali') . ".csv");
    $f = fopen('php://output', 'w');
    fputcsv($f, array_keys($data[0]));
    foreach ($data as $row) fputcsv($f, $row);
    fclose($f);
}
exit;
