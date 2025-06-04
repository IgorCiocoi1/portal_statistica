<?php
class DemografieModel {
    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=localhost;dbname=portal_statistica", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // === Date Reale (cu Sex și Localitate)
    public function getDemografieData($sex, $localitate) {
        $query = "SELECT Anul, SUM(Numar_persoane) as Numar
                  FROM demografie_moldova
                  WHERE TRIM(LOWER(Sex)) = TRIM(LOWER(:sex)) 
                  AND TRIM(LOWER(Localitate)) = TRIM(LOWER(:localitate))
                  GROUP BY Anul ORDER BY Anul";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':localitate', $localitate);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // === Comparație (Tara + Sex)
    public function getComparatieData($tara, $sex) {
        $stmt = $this->conn->prepare("
            SELECT Tara, Anul, Sex, SUM(Numar_persoane) AS Numar
            FROM demografie_comparatie
            WHERE (Tara = :tara OR Tara = 'Moldova')
              AND Sex = :sex
            GROUP BY Tara, Anul
            ORDER BY Anul
        ");
        $stmt->bindParam(':tara', $tara);
        $stmt->bindParam(':sex', $sex);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // === Export date reale (cu opțiuni avansate)
    public function exportDemografieData($an, $sex, $localitate, $varsta) {
        $sql = "SELECT * FROM demografie_moldova WHERE 1=1";
        $params = [];

        if (!empty($an)) {
            $sql .= " AND Anul = ?";
            $params[] = $an;
        }
        if (!empty($sex)) {
            $sql .= " AND Sex = ?";
            $params[] = $sex;
        }
        if (!empty($localitate)) {
            $sql .= " AND Localitate = ?";
            $params[] = $localitate;
        }
        if (!empty($varsta)) {
            $sql .= " AND Varsta = ?";
            $params[] = $varsta;
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // === Export comparatie simplu (pt CSV/Excel)
    public function exportComparatieData($tara, $sex, $an = null) {
        $sql = "SELECT Tara, Anul, Sex, SUM(Numar_persoane) AS Numar
                FROM demografie_comparatie
                WHERE (Tara = :tara OR Tara = 'Moldova') AND Sex = :sex";

        if (!empty($an) && strtolower($an) !== 'toti') {
            $sql .= " AND Anul = :an";
        }

        $sql .= " GROUP BY Tara, Anul ORDER BY Anul";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':tara', $tara);
        $stmt->bindParam(':sex', $sex);
        if (!empty($an) && strtolower($an) !== 'toti') {
            $stmt->bindParam(':an', $an);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
