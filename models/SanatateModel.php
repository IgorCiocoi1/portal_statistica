<?php
class SanatateModel {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getSanatateData($sex, $localitate) {
        $stmt = $this->conn->prepare("  
            SELECT Anul,
                   COALESCE(AVG(Numar_cazuri_boli_cronice), 0) AS Numar_cazuri_boli_cronice,
                   COALESCE(AVG(Numar_cazuri_boli_respiratorii), 0) AS Numar_cazuri_boli_respiratorii,
                   COALESCE(AVG(Numar_spitalizari), 0) AS Numar_spitalizari,
                   COALESCE(AVG(Sport_de_performanta), 0) AS Sport_de_performanta,
                   COALESCE(AVG(Sport_ca_hobby), 0) AS Sport_ca_hobby
            FROM sanatate_moldova
            WHERE Sex = :sex AND Localitate = :localitate
            GROUP BY Anul
            ORDER BY Anul
        ");
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':localitate', $localitate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSanatateComparatie($tara, $indicator) {
        $stmt = $this->conn->prepare("  
            SELECT Anul, Tara, COALESCE($indicator, 0) AS Valoare
            FROM sanatate_comparatie
            WHERE Tara = :tara OR Tara = 'Moldova'
            ORDER BY Anul, Tara
        ");
        $stmt->bindParam(':tara', $tara);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>