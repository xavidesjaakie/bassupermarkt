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

<label>Naam</label><br>
<input type="text" name="naam" required><br><br>

<label>Email</label><br>
<input type="email" name="email" required><br><br>

<label>Adres</label><br>
<input type="text" name="adres" required><br><br>

<label>Postcode</label><br>
<input type="text" name="postcode"><br><br>

<label>Woonplaats</label><br>
<input type="text" name="woonplaats"><br><br>

<button type="submit">Opslaan</button>

</form>

<br>
<a href="read.php">Terug</a>
