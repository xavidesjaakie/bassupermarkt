<?php

class Artikel {

    private $conn;
    private $table = "artikel";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($omschrijving, $inkoop, $verkoop, $voorraad, $min, $max, $locatie) {

        $sql = "INSERT INTO $this->table
        (artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie)
        VALUES (:omschrijving, :inkoop, :verkoop, :voorraad, :min, :max, :locatie)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':omschrijving' => $omschrijving,
            ':inkoop' => $inkoop,
            ':verkoop' => $verkoop,
            ':voorraad' => $voorraad,
            ':min' => $min,
            ':max' => $max,
            ':locatie' => $locatie
        ]);
    }

    public function readAll() {
        $sql = "SELECT * FROM $this->table ORDER BY artOmschrijving";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {
        $sql = "SELECT * FROM $this->table WHERE artId = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $omschrijving, $inkoop, $verkoop, $voorraad, $min, $max, $locatie) {

        $sql = "UPDATE $this->table SET
            artOmschrijving = :omschrijving,
            artInkoop = :inkoop,
            artVerkoop = :verkoop,
            artVoorraad = :voorraad,
            artMinVoorraad = :min,
            artMaxVoorraad = :max,
            artLocatie = :locatie
            WHERE artId = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':omschrijving' => $omschrijving,
            ':inkoop' => $inkoop,
            ':verkoop' => $verkoop,
            ':voorraad' => $voorraad,
            ':min' => $min,
            ':max' => $max,
            ':locatie' => $locatie
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE artId = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // 🔍 + 📍 ZOEK + FILTER
    public function searchWithFilter($zoek, $stelling) {

        $sql = "SELECT * FROM $this->table WHERE 1=1";

        if ($zoek != '') {
            $sql .= " AND (
                artOmschrijving LIKE :zoek
                OR artId LIKE :zoek
            )";
        }

        if ($stelling != '') {
            $sql .= " AND artLocatie = :stelling";
        }

        $sql .= " ORDER BY artOmschrijving";

        $stmt = $this->conn->prepare($sql);

        if ($zoek != '') {
            $zoek = "%" . $zoek . "%";
            $stmt->bindParam(':zoek', $zoek);
        }

        if ($stelling != '') {
            $stmt->bindParam(':stelling', $stelling);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}