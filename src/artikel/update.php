<?php
require_once '../classes/Database.php';
require_once '../classes/Artikel.php';

$database = new Database();
$db = $database->connect();

$artikel = new Artikel($db);

$id = $_GET['id'];
$data = $artikel->readById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $artikel->update(
        $id,
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

<h2>Artikel Wijzigen</h2>

<form method="POST">

Omschrijving: <input type="text" name="omschrijving" value="<?= $data['artOmschrijving']; ?>" required><br>

Inkoopprijs: <input type="number" step="0.01" name="inkoop" value="<?= $data['artInkoop']; ?>"><br>

Verkoopprijs: <input type="number" step="0.01" name="verkoop" value="<?= $data['artVerkoop']; ?>"><br>

Voorraad: <input type="number" name="voorraad" value="<?= $data['artVoorraad']; ?>"><br>

Min voorraad: <input type="number" name="min" value="<?= $data['artMinVoorraad']; ?>"><br>

Max voorraad: <input type="number" name="max" value="<?= $data['artMaxVoorraad']; ?>"><br>

Locatie: <input type="number" name="locatie" value="<?= $data['artLocatie']; ?>"><br><br>

<button type="submit">Opslaan</button>

</form>

<a href="read.php">Terug</a>
