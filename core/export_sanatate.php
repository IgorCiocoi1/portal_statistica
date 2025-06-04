<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$conn = new mysqli("localhost", "root", "", "portal_statistica");
$conn->set_charset("utf8");

// Preluare filtre
$an = $_GET['an'] ?? '';
$sex = $_GET['sex'] ?? '';
$localitate = $_GET['localitate'] ?? '';
$varsta = $_GET['varsta'] ?? '';
$format = $_GET['format'] ?? 'xlsx';

// Construire query
$query = "SELECT * FROM sanatate_moldova WHERE 1=1";
$params = [];
$types = "";

if ($an !== '') { $query .= " AND Anul = ?"; $params[] = $an; $types .= "i"; }
if ($sex !== '') { $query .= " AND Sex = ?"; $params[] = $sex; $types .= "s"; }
if ($localitate !== '') { $query .= " AND Localitate = ?"; $params[] = $localitate; $types .= "s"; }
if ($varsta !== '') { $query .= " AND Varsta = ?"; $params[] = $varsta; $types .= "i"; }

$stmt = $conn->prepare($query);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Pregătire export
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray([
    'ID', 'Anul', 'Varsta', 'Sex', 'Localitate',
    'Boli cronice', 'Boli respiratorii', 'Spitalizări',
    'Sport de performanță', 'Sport ca hobby'
], null, 'A1');

$row = 2;
while ($data = $result->fetch_assoc()) {
    $sheet->fromArray([
        $data['id'], $data['Anul'], $data['Varsta'], $data['Sex'], $data['Localitate'],
        $data['Numar_cazuri_boli_cronice'], $data['Numar_cazuri_boli_respiratorii'], $data['Numar_spitalizari'],
        $data['Sport_de_performanta'], $data['Sport_ca_hobby']
    ], null, 'A' . $row++);
}

// Export
$filename = "sanatate_date_reale." . ($format === 'csv' ? 'csv' : 'xlsx');
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Cache-Control: max-age=0");

if ($format === 'csv') {
    header('Content-Type: text/csv');
    $writer = new Csv($spreadsheet);
    $writer->setDelimiter(';');
} else {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $writer = new Xlsx($spreadsheet);
}

$writer->save('php://output');
exit;
