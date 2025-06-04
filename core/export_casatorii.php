<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

// Conexiune DB
$mysqli = new mysqli("localhost", "root", "", "portal_statistica");
$mysqli->set_charset("utf8");

if ($mysqli->connect_error) {
    die("Eroare conexiune DB: " . $mysqli->connect_error);
}

// Preluare parametri
$an = $_GET['an'] ?? '';
$sex = $_GET['sex'] ?? '';
$localitate = $_GET['localitate'] ?? '';
$indicator = $_GET['indicator'] ?? ''; // gol => toți
$format = $_GET['format'] ?? 'csv';

$validIndicators = ['Numar_casatorii', 'Numar_divorturi'];
$isAllIndicators = ($indicator === '');

if (!$isAllIndicators && !in_array($indicator, $validIndicators)) {
    die("Indicator invalid.");
}

// Construire query
$query = "SELECT Anul, Varsta, Sex, Localitate, Numar_casatorii, Numar_divorturi FROM casatorii_moldova WHERE 1=1";
$params = [];
$types = "";

if ($an !== '') {
    $query .= " AND Anul = ?";
    $params[] = $an;
    $types .= "i";
}
if ($sex !== '') {
    $query .= " AND Sex = ?";
    $params[] = $sex;
    $types .= "s";
}
if ($localitate !== '') {
    $query .= " AND Localitate = ?";
    $params[] = $localitate;
    $types .= "s";
}

$query .= " ORDER BY Anul, Varsta";

// Executare
$stmt = $mysqli->prepare($query);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Antet coloane
$headers = ['Anul', 'Varsta', 'Sex', 'Localitate'];
if ($isAllIndicators) {
    $headers[] = 'Numar_casatorii';
    $headers[] = 'Numar_divorturi';
} else {
    $headers[] = $indicator;
}

// Date
$data = [];
while ($row = $result->fetch_assoc()) {
    if ($isAllIndicators) {
        $data[] = [
            $row['Anul'],
            $row['Varsta'],
            $row['Sex'],
            $row['Localitate'],
            $row['Numar_casatorii'],
            $row['Numar_divorturi'],
        ];
    } else {
        $data[] = [
            $row['Anul'],
            $row['Varsta'],
            $row['Sex'],
            $row['Localitate'],
            $row[$indicator] ?? 0,
        ];
    }
}

if (empty($data)) {
    die("Nu există date pentru export.");
}

// Export CSV sau Excel
$filename = "export_casatorii_" . date("Ymd_His") . "." . ($format === 'xlsx' ? 'xlsx' : 'csv');

if ($format === 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header("Content-Disposition: attachment; filename=$filename");
    $output = fopen('php://output', 'w');
    fputcsv($output, $headers);
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

if ($format === 'xlsx') {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray($headers, null, 'A1');
    $sheet->fromArray($data, null, 'A2');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$filename");
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
