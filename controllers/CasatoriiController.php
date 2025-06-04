<?php
require_once '../models/CasatoriiModel.php';

class CasatoriiController {
    private $model;

    public function __construct() {
        $this->model = new CasatoriiModel();
    }

    // Returnează datele reale agregate pe an (Moldova)
    public function getDateReale() {
        $indicator = $_GET['indicator'] ?? 'Numar_casatorii';
        $data = $this->model->getDateReale($indicator);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    // Returnează datele de comparație între Moldova și o țară selectată
    public function getComparatie() {
        $tara = $_GET['tarea'] ?? 'Romania';
        $indicator = $_GET['indicator'] ?? 'Numar_casatorii';
        $data = $this->model->getComparatie($tara, $indicator);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    // Returnează datele de predicție dintr-un CSV
    public function getPredictie() {
        $indicator = $_GET['indicator'] ?? 'Numar_casatorii';
        $file = "../data/predictie_casatorii_2025_2030.csv";

        if (!file_exists($file)) {
            header('HTTP/1.1 404 Not Found');
            echo json_encode(["error" => "Fișier predicții inexistent"]);
            exit;
        }

        $rows = [];
        if (($handle = fopen($file, "r")) !== FALSE) {
            $header = fgetcsv($handle);
            while (($data = fgetcsv($handle)) !== FALSE) {
                $row = array_combine($header, $data);
                if (isset($row[$indicator])) {
                    $rows[] = [
                        "Anul" => (int)$row["Anul"],
                        "Numar" => (int)$row[$indicator]
                    ];
                }
            }
            fclose($handle);
        }

        header('Content-Type: application/json');
        echo json_encode($rows);
    }
}

// Rutează cererile AJAX după parametrul 'tip'
if (isset($_GET['tip'])) {
    $controller = new CasatoriiController();

    switch ($_GET['tip']) {
        case 'date':
            $controller->getDateReale();
            break;
        case 'comparatie':
            if (isset($_GET['tarea'])) {
                $controller->getComparatie();
            } else {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(["error" => "Parametrul 'tarea' lipsește"]);
            }
            break;
        case 'predictie':
            $controller->getPredictie();
            break;
        default:
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["error" => "Tip necunoscut"]);
            break;
    }
    exit;
}
?>
