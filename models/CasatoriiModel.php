<?php
class CasatoriiModel {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Date reale: agregare sumă per an, doar Moldova (tabel casatorii_moldova)
    public function getDateReale($indicator) {
        $allowedIndicators = ['Numar_casatorii', 'Numar_divorturi'];
        if (!in_array($indicator, $allowedIndicators)) {
            $indicator = 'Numar_casatorii';
        }

        $query = "
            SELECT Anul, 'Moldova' AS Tara, SUM($indicator) AS Numar
            FROM casatorii_moldova
            GROUP BY Anul
            ORDER BY Anul ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Comparatie: date pentru Moldova și o țară selectată (tabel casatorii_comparatie)
    public function getComparatie($tara, $indicator) {
        $allowedIndicators = ['Numar_casatorii', 'Numar_divorturi'];
        if (!in_array($indicator, $allowedIndicators)) {
            $indicator = 'Numar_casatorii';
        }

        $query = "
            SELECT Tara, Anul, SUM(Numar) AS Numar
            FROM casatorii_comparatie
            WHERE (Tara = :tara OR Tara = 'Moldova') AND Indicator = :indicator
            GROUP BY Tara, Anul
            ORDER BY Anul ASC
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tara', $tara);
        $stmt->bindParam(':indicator', $indicator);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
