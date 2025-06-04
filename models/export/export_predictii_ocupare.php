<?php
require '../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$an = $_GET['an'] ?? '';  // dacă e gol => toți anii
$format = $_GET['format'] ?? 'csv';

$csvPath = '../../data/predictie_ocupari_2025_2030.csv';
if (!file_exists($csvPath)) die("Fișier lipsă.");

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

if (empty($data)) die("Nu există date pentru anul specificat.");

if ($format === 'csv') {
    header('Content-Type: text/csv');
    $filename = $an === '' ? "predictii_ocupare_toti_anii.csv" : "predictie_ocupare_$an.csv";
    header("Content-Disposition: attachment; filename=$filename");
    $f = fopen('php://output', 'w');
    fputcsv($f, array_keys($data[0]));
    foreach ($data as $row) fputcsv($f, $row);
    fclose($f);
} else {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(array_keys($data[0]), null, 'A1');

    $rowNum = 2;
    foreach ($data as $row) {
        $sheet->fromArray(array_values($row), null, 'A' . $rowNum++);
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $filename = $an === '' ? "predictii_ocupare_toti_anii.xlsx" : "predictie_ocupare_$an.xlsx";
    header("Content-Disposition: attachment; filename=$filename");
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}
exit;
?>
