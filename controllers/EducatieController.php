<?php
require_once '../models/EducatieModel.php';

class EducatieController {
    public static function getDataForExport($tip) {
        $model = new EducatieModel();
        return $model->getEducatieData($tip);
    }

    public static function getComparatieDataForExport($tara) {
        $model = new EducatieModel();
        return $model->getComparatieData($tara);
    }

    // Controllerul original poate rămâne la final pentru ajax/chart
    public function getData() {
        $tip = $_GET['tip'] ?? 'Toate';
        $model = new EducatieModel();
        $data = $model->getEducatieData($tip);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'getData') {
    $controller = new EducatieController();
    $controller->getData();
}

if (isset($_GET['action']) && $_GET['action'] === 'getComparatieData' && isset($_GET['tara'])) {
    $model = new EducatieModel();
    header('Content-Type: application/json');
    echo json_encode($model->getComparatieData($_GET['tara']));
    exit;
}


?>
