<?php
class PredictiiController {
    public function getPredictii() {
        $path = '../data/predictii_educatie_2025_2030.csv';

        if (!file_exists($path)) return [];

        $csv = array_map('str_getcsv', file($path));
        if (count($csv) < 2) return [];

        $headers = array_map('trim', $csv[0]);
        $data = [];

        for ($i = 1; $i < count($csv); $i++) {
            $row = [];
            for ($j = 0; $j < count($headers); $j++) {
                $row[$headers[$j]] = is_numeric($csv[$i][$j]) ? (int)$csv[$i][$j] : $csv[$i][$j];
            }
            $data[] = $row;
        }

        return $data;
    }
}

// Pentru Ajax (chart)
if (isset($_GET['action']) && $_GET['action'] === 'getPredictii') {
    $controller = new PredictiiController();
    $data = $controller->getPredictii();
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
