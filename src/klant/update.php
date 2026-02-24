<?php
require_once '../classes/Database.php';
require_once '../classes/Klant.php';

$database = new Database();
$db = $database->connect();

$klant = new Klant($db);

$id = $_GET['id'];
$data = $klant->readById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $klant->update(
        $id,
        $_POST['naam'],
        $_POST['email'],
        $_POST['adres'],
        $_POST['postcode'],
        $_POST['woonplaats']
    );

    header("Location: read.php");
    exit;
}
?>

<h2>Klant Wijzigen</h2>

<form method="POST">
    Naam: <input type="text" name="naam" value="<?= $data['klantNaam']; ?>" required><br>
    Email: <input type="email" name="email" value="<?= $data['klantEmail']; ?>" required><br>
    Adres: <input type="text" name="adres" value="<?= $data['klantAdres']; ?>" required><br>
    Postcode: <input type="text" name="postcode" value="<?= $data['klantPostcode']; ?>"><br>
    Woonplaats: <input type="text" name="woonplaats" value="<?= $data['klantWoonplaats']; ?>"><br><br>
    <button type="submit">Opslaan</button>
</form>

<a href="read.php">Terug</a>
