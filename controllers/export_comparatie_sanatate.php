<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$tara = $_GET['tara'] ?? '';        // "" înseamnă toate
$indicator = $_GET['indicator'] ?? '';
$format = $_GET['format'] ?? 'csv';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Construire query dinamic
    $query = "SELECT Tara, Anul";
    $fields = [
        "Numar_cazuri_boli_cronice",
        "Numar_cazuri_boli_respiratorii",
        "Numar_spitalizari",
        "Sport_de_performanta",
        "Sport_ca_hobby"
    ];

    if ($indicator && in_array($indicator, $fields)) {
        $query .= ", $indicator";
    } else {
        foreach ($fields as $field) {
            $query .= ", $field";
        }
    }

    $query .= " FROM sanatate_comparatie";
    $conditions = [];
    if ($tara !== '') {
        $conditions[] = "(Tara = :tara OR Tara = 'Moldova')";
    }

    if ($conditions) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $query .= " ORDER BY Tara, Anul";

    $stmt = $pdo->prepare($query);
    if ($tara !== '') {
        $stmt->bindParam(':tara', $tara);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        die("Nu s-au găsit date pentru export.");
    }

    if ($format === 'csv') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=comparatie_sanatate.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array_keys($rows[0]));
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
        exit;
    }

    if ($format === 'xlsx') {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray(array_keys($rows[0]), null, 'A1');

        $rowNum = 2;
        foreach ($rows as $row) {
            $sheet->fromArray(array_values($row), null, 'A' . $rowNum++);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=comparatie_sanatate.xlsx');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

} catch (Exception $e) {
    echo "Eroare la export: " . $e->getMessage();
}

