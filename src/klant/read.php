<?php
require_once '../classes/Database.php';
require_once '../classes/Klant.php';

$database = new Database();
$db = $database->connect();

$klant = new Klant($db);
$klanten = $klant->readAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Klanten Overzicht</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>Klanten Overzicht</h2>

<a class="btn" href="insert.php">Nieuwe klant</a>

<table>

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
<a class="edit" href="update.php?id=<?= $row['klantId']; ?>">Wijzig</a>
<a class="delete" href="delete.php?id=<?= $row['klantId']; ?>">Verwijder</a>
</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
