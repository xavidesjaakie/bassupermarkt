<?php
require_once '../classes/Database.php';
require_once '../classes/Artikel.php';

$database = new Database();
$db = $database->connect();

$artikel = new Artikel($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $artikel->insert(
        $_POST['omschrijving'],
        $_POST['inkoop'],
        $_POST['verkoop'],
        $_POST['voorraad'],
        $_POST['min'],
        $_POST['max'],
        $_POST['locatie']
    );

    header("Location: read.php");
    exit;
}
?>

<h2>Nieuw Artikel</h2>

<form method="POST">

<label>Omschrijving</label><br>
<input type="text" name="omschrijving" required><br><br>

<label>Inkoopprijs</label><br>
<input type="number" step="0.01" name="inkoop"><br><br>

<label>Verkoopprijs</label><br>
<input type="number" step="0.01" name="verkoop"><br><br>

<label>Voorraad</label><br>
<input type="number" name="voorraad" required><br><br>

<label>Min voorraad</label><br>
<input type="number" name="min" required><br><br>

<label>Max voorraad</label><br>
<input type="number" name="max" required><br><br>

<label>Locatie</label><br>
<input type="number" name="locatie"><br><br>

<button type="submit">Opslaan</button>

</form>

<br>
<a href="read.php">Terug</a>
