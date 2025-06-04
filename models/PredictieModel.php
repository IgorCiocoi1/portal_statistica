<?php

class PredictieModel {
    private $filePath;

    public function __construct() {
        // Calea către fișierul CSV de predicții
        $this->filePath = '../datasets/predictii_demografie_2025_2030.csv';
    }

    public function getPredictiiData($sex) {
        $data = [];

        if (!file_exists($this->filePath)) {
            return $data;
        }

        if (($handle = fopen($this->filePath, "r")) !== false) {
            $headers = fgetcsv($handle); // citim prima linie cu headerele

            while (($row = fgetcsv($handle)) !== false) {
                $rowData = array_combine($headers, $row);
                if (strtolower(trim($rowData['Sex'])) == strtolower(trim($sex))) {
                    $data[] = [
                        'Anul' => $rowData['Anul'],
                        'Sex' => $rowData['Sex'],
                        'Numar' => $rowData['Numar_persoane']
                    ];
                }
            }

            fclose($handle);
        }

        return $data;
    }
}
