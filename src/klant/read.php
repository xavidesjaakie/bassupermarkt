<?php
require_once '../classes/Database.php';
require_once '../classes/Klant.php';

$database = new Database();
$db = $database->connect();

$klant = new Klant($db);
$klanten = $klant->readAll();
?>

<h2>Klanten Overzicht</h2>

<a href="insert.php">Nieuwe klant</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Naam</th>
    <th>Email</th>
    <th>Acties</th>
</tr>

<?php foreach ($klanten as $row): ?>
<tr>
    <td><?= $row['klantId']; ?></td>
    <td><?= $row['klantNaam']; ?></td>
    <td><?= $row['klantEmail']; ?></td>
    <td>
        <a href="update.php?id=<?= $row['klantId']; ?>">Wijzig</a>
        <a href="delete.php?id=<?= $row['klantId']; ?>">Verwijder</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
