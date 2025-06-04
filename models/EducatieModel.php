<?php
class EducatieModel {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getEducatieData($tip) {
        $query = "SELECT Anul, Nivel_de_studii, SUM(Numar) as Numar FROM educatie_moldova";
        if ($tip !== 'Toate') {
            $query .= " WHERE Nivel_de_studii = :tip";
        }
        $query .= " GROUP BY Anul, Nivel_de_studii ORDER BY Anul";

        $stmt = $this->conn->prepare($query);
        if ($tip !== 'Toate') {
            $stmt->bindParam(':tip', $tip);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComparatieData($tara) {
        $stmt = $this->conn->prepare("
            SELECT Tara, Anul, Nivel_de_studii, SUM(Numar) as Numar
            FROM educatie_comparatie
            WHERE Tara = :tara OR Tara = 'Moldova'
            GROUP BY Tara, Anul, Nivel_de_studii
            ORDER BY Anul ASC
        ");
        $stmt->bindParam(':tara', $tara);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
