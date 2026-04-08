<?php

class Verkooporder {

    private $conn;
    private $table = "verkooporder";

    public function __construct($db) {
        $this->conn = $db;
    }

    // 🔹 INSERT
    public function insert($klantId, $artId, $datum, $aantal, $status = 1) {

        $sql = "INSERT INTO $this->table
                (klantId, artId, verkOrdDatum, verkOrdBestAantal, verkOrdStatus)
                VALUES (:klantId, :artId, :datum, :aantal, :status)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':klantId' => $klantId,
            ':artId' => $artId,
            ':datum' => $datum,
            ':aantal' => $aantal,
            ':status' => $status
        ]);
    }

    // 🔹 SELECT ALLES
    public function readAll() {

        $sql = "SELECT v.*, k.klantNaam, a.artOmschrijving
                FROM $this->table v
                JOIN klant k ON v.klantId = k.klantId
                JOIN artikel a ON v.artId = a.artId
                ORDER BY v.verkOrdId DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 SELECT OP ID
    public function readById($id) {

        $sql = "SELECT * FROM $this->table WHERE verkOrdId = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 UPDATE
    public function update($id, $klantId, $artId, $aantal, $status) {

        $sql = "UPDATE $this->table SET
                klantId = :klantId,
                artId = :artId,
                verkOrdBestAantal = :aantal,
                verkOrdStatus = :status
                WHERE verkOrdId = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':klantId' => $klantId,
            ':artId' => $artId,
            ':aantal' => $aantal,
            ':status' => $status
        ]);
    }

    // 🔹 DELETE
    public function delete($id) {

        $sql = "DELETE FROM $this->table WHERE verkOrdId = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}