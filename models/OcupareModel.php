<?php
class OcupareModel {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getDateReale($indicator) {
        $allowedIndicators = ['Numar_angajati', 'Numar_someri', 'Numar_neactivi'];
        if (!in_array($indicator, $allowedIndicators)) {
            $indicator = 'Numar_angajati';
        }

        $query = "
            SELECT Anul, 'Moldova' AS Tara, SUM($indicator) AS Numar
            FROM ocupatie_moldova
            GROUP BY Anul
            ORDER BY Anul ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComparatie($tara, $indicator) {
        $allowedIndicators = ['Numar_angajati', 'Numar_someri', 'Numar_neactivi'];
        if (!in_array($indicator, $allowedIndicators)) {
            $indicator = 'Numar_angajati';
        }

        $query = "
            SELECT Tara, Anul, SUM($indicator) AS Numar
            FROM ocupare_comparatie
            WHERE Tara = :tara OR Tara = 'Moldova'
            GROUP BY Tara, Anul
            ORDER BY Anul ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tara', $tara);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
