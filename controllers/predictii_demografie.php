<?php
$csvFile = '../data/predictii_sex_an_2025_2030.csv';
$data = [];

$sex = $_GET['sex'] ?? null;

if (($handle = fopen($csvFile, 'r')) !== false) {
    $header = fgetcsv($handle); // prima linie

    while (($row = fgetcsv($handle)) !== false) {
        $entry = array_combine($header, $row);

        if (!$sex || strtolower($entry['Sex']) === strtolower($sex)) {
            $data[] = [
                'Anul' => $entry['An'],
                'Numar' => (int) $entry['Numar_Prezis']  // conversie numerică
            ];
        }
    }

    fclose($handle);
}

header('Content-Type: application/json');
echo json_encode($data);
