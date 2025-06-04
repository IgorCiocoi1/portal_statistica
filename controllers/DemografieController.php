<?php
require_once '../models/DemografieModel.php';

class DemografieController {
    public function getData() {
        $sex = $_GET['sex'] ?? 'Feminin';
        $localitate = $_GET['localitate'] ?? 'Urban';
        $model = new DemografieModel();
        $data = $model->getDemografieData($sex, $localitate);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getComparatieData() {
        $tara = $_GET['tara'] ?? 'Romania';
        $sex = $_GET['sex'] ?? 'Feminin';
        $model = new DemografieModel();
        $data = $model->getComparatieData($tara, $sex);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function exportDateReale() {
        $model = new DemografieModel();

        $an = $_POST['an'] ?? 'Toti';
        $sex = $_POST['sex'] ?? 'Toti';
        $localitate = $_POST['localitate'] ?? 'Toate';
        $varsta = $_POST['varsta'] ?? 'Toate';
        $format = $_POST['format'] ?? 'excel';

        $data = $model->exportDemografieData($an, $sex, $localitate, $varsta);

        if ($format === 'csv') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="date_reale.csv"');
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Anul', 'Varsta', 'Sex', 'Localitate', 'Numar_persoane']);
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
        } else {
            require '../vendor/autoload.php';
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Anul');
            $sheet->setCellValue('B1', 'Varsta');
            $sheet->setCellValue('C1', 'Sex');
            $sheet->setCellValue('D1', 'Localitate');
            $sheet->setCellValue('E1', 'Numar persoane');

            $rowIndex = 2;
            foreach ($data as $row) {
                $sheet->setCellValue("A$rowIndex", $row['Anul']);
                $sheet->setCellValue("B$rowIndex", $row['Varsta']);
                $sheet->setCellValue("C$rowIndex", $row['Sex']);
                $sheet->setCellValue("D$rowIndex", $row['Localitate']);
                $sheet->setCellValue("E$rowIndex", $row['Numar_persoane']);
                $rowIndex++;
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="date_reale.xlsx"');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save("php://output");
        }
        exit;
    }

    public function exportComparatie() {
        $model = new DemografieModel();

        $tara = $_POST['tara'] ?? 'Toti';
        $an = $_POST['an'] ?? 'Toti';
        $sex = $_POST['sex'] ?? 'Toti';
        $format = $_POST['format'] ?? 'excel';

        $data = $model->exportComparatieData($tara, $sex, $an);

        if ($format === 'csv') {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="comparatie.csv"');
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Tara', 'Anul', 'Sex', 'Numar_persoane']);
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
        } else {
            require '../vendor/autoload.php';
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'Tara');
            $sheet->setCellValue('B1', 'Anul');
            $sheet->setCellValue('C1', 'Sex');
            $sheet->setCellValue('D1', 'Numar persoane');

            $rowIndex = 2;
            foreach ($data as $row) {
                $sheet->setCellValue("A$rowIndex", $row['Tara']);
                $sheet->setCellValue("B$rowIndex", $row['Anul']);
                $sheet->setCellValue("C$rowIndex", $row['Sex']);
                $sheet->setCellValue("D$rowIndex", $row['Numar_persoane']);
                $rowIndex++;
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="comparatie.xlsx"');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save("php://output");
        }
        exit;
    }
}

// Rute
$controller = new DemografieController();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getData':
            $controller->getData();
            break;
        case 'getComparatieData':
            $controller->getComparatieData();
            break;
        case 'exportDateReale':
            $controller->exportDateReale();
            break;
        case 'exportComparatie':
            $controller->exportComparatie();
            break;
    }
}
