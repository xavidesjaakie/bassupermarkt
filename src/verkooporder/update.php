<?php
require_once '../classes/Database.php';
require_once '../classes/Verkooporder.php';

$database = new Database();
$db = $database->connect();

$verkooporder = new Verkooporder($db);

$id = $_GET['id'];
$data = $verkooporder->readById($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $verkooporder->update(
        $id,
        $_POST['klantId'],
        $_POST['artId'],
        $_POST['aantal'],
        $_POST['status']
    );

    header("Location: read.php");
    exit;
}
?>

<h2>Verkooporder Wijzigen</h2>

<form method="POST">

<label>Klant ID</label><br>
<input type="number" name="klantId" value="<?= $data['klantId']; ?>" required><br><br>

<label>Artikel ID</label><br>
<input type="number" name="artId" value="<?= $data['artId']; ?>" required><br><br>

<label>Aantal</label><br>
<input type="number" name="aantal" value="<?= $data['verkOrdBestAantal']; ?>" required><br><br>

<label>Status</label><br>
<select name="status">
    <option value="1" <?= $data['verkOrdStatus'] == 1 ? 'selected' : '' ?>>Nieuw</option>
    <option value="2" <?= $data['verkOrdStatus'] == 2 ? 'selected' : '' ?>>Picking</option>
    <option value="3" <?= $data['verkOrdStatus'] == 3 ? 'selected' : '' ?>>Onderweg</option>
    <option value="4" <?= $data['verkOrdStatus'] == 4 ? 'selected' : '' ?>>Bezorgd</option>
</select>

<br><br>
<button type="submit">Opslaan</button>

</form>

<a href="read.php">Terug</a>