<?php
header('Content-Type: application/json');
require_once '../models/SanatateModel.php';

$model = new SanatateModel();

if (isset($_GET['tip']) && $_GET['tip'] === 'predictie') {
    $indicator = $_GET['indicator'] ?? 'Boli_cronice';
    $csv = fopen('../data/predictie_sanatate_2025_2030.csv', 'r');

    if (!$csv) {
        echo json_encode(['error' => 'Fișierul CSV nu poate fi deschis.']);
        exit;
    }

    $header = fgetcsv($csv);
    $anIndex = array_search('Anul', $header);
    $indIndex = array_search($indicator, $header);

    if ($anIndex === false || $indIndex === false) {
        echo json_encode(['error' => 'Coloane lipsă în fișier.']);
        exit;
    }

    $data = [];
    while (($row = fgetcsv($csv)) !== false) {
        $data[] = [
            'Anul' => $row[$anIndex],
            $indicator => floatval($row[$indIndex]) // cheia e numele indicatorului
        ];
    }
    fclose($csv);
    echo json_encode($data);
    exit;
}

if (isset($_GET['tip']) && $_GET['tip'] === 'comparatie') {
    $indicator = $_GET['indicator'] ?? 'Numar_cazuri_boli_cronice';
    $tara = $_GET['tara'] ?? 'Germania';
    echo json_encode($model->getSanatateComparatie($tara, $indicator));
    exit;
}

// date reale
$sex = $_GET['sex'] ?? 'Masculin';
$localitate = $_GET['localitate'] ?? 'Urban';
echo json_encode($model->getSanatateData($sex, $localitate));
exit;
