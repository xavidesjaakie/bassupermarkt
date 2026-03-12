<?php

class Klant {

    private $conn;
    private $table = "klant";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($naam, $email, $adres, $postcode, $woonplaats) {

        $sql = "INSERT INTO $this->table
                (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats)
                VALUES (:naam, :email, :adres, :postcode, :woonplaats)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':naam' => $naam,
            ':email' => $email,
            ':adres' => $adres,
            ':postcode' => $postcode,
            ':woonplaats' => $woonplaats
        ]);
    }

    public function readAll() {

        $sql = "SELECT * FROM $this->table ORDER BY klantNaam";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($id) {

        $sql = "SELECT * FROM $this->table WHERE klantId = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $naam, $email, $adres, $postcode, $woonplaats) {

        $sql = "UPDATE $this->table
                SET klantNaam = :naam,
                    klantEmail = :email,
                    klantAdres = :adres,
                    klantPostcode = :postcode,
                    klantWoonplaats = :woonplaats
                WHERE klantId = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':naam' => $naam,
            ':email' => $email,
            ':adres' => $adres,
            ':postcode' => $postcode,
            ':woonplaats' => $woonplaats
        ]);
    }

    public function delete($id) {

        $sql = "DELETE FROM $this->table WHERE klantId = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }
}
