<?php
require_once '../models/OcupareModel.php';

$controller = new OcupareController();

if (isset($_GET['tip'])) {
    $tip = $_GET['tip'];
    $indicator = $_GET['indicator'] ?? 'Numar_angajati';

    switch ($tip) {
        case 'date':
            $controller->getDateReale($indicator);
            break;
        case 'comparatie':
            $tara = $_GET['tarea'] ?? 'Romania';
            $controller->getComparatie($tara, $indicator);
            break;
        case 'predictie':
            $controller->getPredictii($indicator);
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Tip necunoscut']);
            break;
    }
    exit;
}

class OcupareController {
    private $model;

    public function __construct() {
        $this->model = new OcupareModel();
    }

    public function getDateReale($indicator) {
        $data = $this->model->getDateReale($indicator);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getComparatie($tara, $indicator) {
        $data = $this->model->getComparatie($tara, $indicator);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getPredictii($indicator) {
    $path = '../data/predictie_ocupari_2025_2030.csv';
    $data = [];

    if (!file_exists($path)) {
        http_response_code(404);
        echo json_encode(['error' => 'Fișierul de predicții nu a fost găsit.']);
        return;
    }

    if (($handle = fopen($path, 'r')) !== false) {
        $headers = fgetcsv($handle);
        $indicatorIndex = array_search($indicator, $headers);

        if ($indicatorIndex === false) {
            http_response_code(400);
            echo json_encode(['error' => 'Indicatorul specificat nu există în fișierul CSV.']);
            fclose($handle);
            return;
        }

        while (($row = fgetcsv($handle)) !== false) {
            if (isset($row[0], $row[$indicatorIndex])) {
                $data[] = [
                    'Anul' => $row[0],
                    'Valoare' => (float) $row[$indicatorIndex]
                ];
            }
        }
        fclose($handle);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Eroare la deschiderea fișierului de predicții.']);
        return;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}

}
?>
