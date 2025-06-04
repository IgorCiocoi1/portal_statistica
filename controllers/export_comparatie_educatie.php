<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$tara = $_GET['tara'] ?? '';
$nivel = $_GET['nivel_de_studii'] ?? '';
$an = $_GET['an'] ?? '';
$format = $_GET['format'] ?? 'csv';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Construim interogarea SQL
    $query = "
        SELECT Tara, Anul, Nivel_de_studii, SUM(Numar) AS Numar
        FROM educatie_comparatie
        WHERE 1=1
    ";
    $params = [];

    if ($tara !== '') {
        $query .= " AND (Tara = :tara OR Tara = 'Moldova')";
        $params[':tara'] = $tara;
    }

    if ($nivel !== '') {
        $query .= " AND Nivel_de_studii = :nivel";
        $params[':nivel'] = $nivel;
    }

    if ($an !== '') {
        $query .= " AND Anul = :an";
        $params[':an'] = $an;
    }

    $query .= " GROUP BY Tara, Anul, Nivel_de_studii ORDER BY Tara, Anul";

    $stmt = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($format === 'xlsx') {
        // Export Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if (!empty($rows)) {
            $sheet->fromArray(array_keys($rows[0]), null, 'A1');
            $rowIndex = 2;
            foreach ($rows as $row) {
                $sheet->fromArray(array_values($row), null, 'A' . $rowIndex++);
            }
        } else {
            $sheet->setCellValue('A1', 'Mesaj');
            $sheet->setCellValue('A2', 'Nu există date pentru criteriile selectate.');
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="comparatie_educatie.xlsx"');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } else {
        // Export CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="comparatie_educatie.csv"');
        $output = fopen('php://output', 'w');
        if (!empty($rows)) {
            fputcsv($output, array_keys($rows[0]));
            foreach ($rows as $row) {
                fputcsv($output, $row);
            }
        } else {
            fputcsv($output, ['Mesaj']);
            fputcsv($output, ['Nu există date pentru criteriile selectate.']);
        }
        fclose($output);
        exit;
    }
} catch (Exception $e) {
    echo "Eroare la export: " . $e->getMessage();
}
