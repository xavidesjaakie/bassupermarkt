<?php
require_once '../classes/Database.php';
require_once '../classes/Klant.php';

$database = new Database();
$db = $database->connect();

$klant = new Klant($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $klant->insert(
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

<h2>Nieuwe Klant</h2>

<form method="POST">
    Naam: <input type="text" name="naam" required><br>
    Email: <input type="email" name="email" required><br>
    Adres: <input type="text" name="adres" required><br>
    Postcode: <input type="text" name="postcode"><br>
    Woonplaats: <input type="text" name="woonplaats"><br><br>
    <button type="submit">Opslaan</button>
</form>

<a href="read.php">Terug</a>
