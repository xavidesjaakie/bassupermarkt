<?php
require_once '../classes/Database.php';
require_once '../classes/Klant.php';

$database = new Database();
$db = $database->connect();

$klant = new Klant($db);

// 🔍 Zoek functionaliteit
if (isset($_GET['zoek']) && $_GET['zoek'] != '') {
    $klanten = $klant->searchByName($_GET['zoek']);
} else {
    $klanten = $klant->readAll();
}
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

<!-- 🔍 Zoek formulier -->
<form method="GET">
    <input type="text" name="zoek" placeholder="Zoek op naam">
    <button type="submit">Zoeken</button>
</form>

<br>

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

<a class="delete" 
   href="delete.php?id=<?= $row['klantId']; ?>" 
   onclick="return confirm('Weet je het zeker?')">
   Verwijder
</a>
</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
