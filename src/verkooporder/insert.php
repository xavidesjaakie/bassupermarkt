<?php
require_once '../classes/Database.php';
require_once '../classes/Verkooporder.php';

$database = new Database();
$db = $database->connect();

$verkooporder = new Verkooporder($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $verkooporder->insert(
        $_POST['klantId'],
        $_POST['artId'],
        date('Y-m-d'),
        $_POST['aantal']
    );

    header("Location: read.php");
    exit;
}
?>

<h2>Nieuwe Verkooporder</h2>

<form method="POST">

<label>Klant ID</label><br>
<input type="number" name="klantId" required><br><br>

<label>Artikel ID</label><br>
<input type="number" name="artId" required><br><br>

<label>Aantal</label><br>
<input type="number" name="aantal" required><br><br>

<button type="submit">Opslaan</button>

</form>

<br>
<a href="read.php">Terug</a>