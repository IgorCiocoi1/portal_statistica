<?php
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=export.csv");

require_once 'EducatieController.php';

$sectiune = $_GET['sectiune'] ?? '';
$mode = $_GET['mode'] ?? '';
$param = $_GET['param'] ?? '';

$data = [];

if ($sectiune === 'educatie') {
    if ($mode === 'data') {
        $data = EducatieController::getDataForExport($param);
    } elseif ($mode === 'comparatie') {
        $data = EducatieController::getComparatieDataForExport($param);
    } elseif ($mode === 'predictie') {
require_once 'PredictiiController.php';
$controller = new PredictiiController();
$data = $controller->getPredictii();

    }
}

// Output CSV dacă există date
$output = fopen("php://output", "w");
if (!empty($data)) {
    fputcsv($output, array_keys($data[0])); // Header
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
} else {
    fputcsv($output, ['Nu există date pentru export.']);
}
fclose($output);
exit;
