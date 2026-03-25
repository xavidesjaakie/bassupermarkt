<?php
require_once '../classes/Database.php';
require_once '../classes/Artikel.php';

$database = new Database();
$db = $database->connect();

$artikel = new Artikel($db);

// 🔍 + 📍 Zoek & filter
$zoek = isset($_GET['zoek']) ? $_GET['zoek'] : '';
$stelling = isset($_GET['stelling']) ? $_GET['stelling'] : '';

if ($zoek != '' || $stelling != '') {
    $artikelen = $artikel->searchWithFilter($zoek, $stelling);
} else {
    $artikelen = $artikel->readAll();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Artikelen Overzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>Artikelen Overzicht</h2>

<a class="btn" href="../index.html">Menu</a>
<a class="btn" href="../klant/read.php">Klanten</a>
<br>
<a class="btn" href="insert.php">Nieuw artikel</a>

<!-- 🔍 + 📍 Zoek & filter formulier -->
<form method="GET">

    <input type="text" name="zoek" placeholder="Zoek op artikel"
    value="<?= isset($_GET['zoek']) ? $_GET['zoek'] : '' ?>">

    <select name="stelling">
        <option value="">Alle stellingen</option>

        <option value="1" <?= (isset($_GET['stelling']) && $_GET['stelling'] == '1') ? 'selected' : '' ?>>
            Stelling 1
        </option>

        <option value="2" <?= (isset($_GET['stelling']) && $_GET['stelling'] == '2') ? 'selected' : '' ?>>
            Stelling 2
        </option>

        <option value="3" <?= (isset($_GET['stelling']) && $_GET['stelling'] == '3') ? 'selected' : '' ?>>
            Stelling 3
        </option>
    </select>

    <button type="submit">Filter</button>
</form>

<br>

<table>

<tr>
    <th>ID</th>
    <th>Omschrijving</th>
    <th>Voorraad</th>
    <th>Stelling</th>
    <th>Acties</th>
</tr>

<?php foreach ($artikelen as $row): ?>

<tr>
    <td><?= $row['artId']; ?></td>
    <td><?= $row['artOmschrijving']; ?></td>
    <td><?= $row['artVoorraad']; ?></td>
    <td><?= $row['artLocatie']; ?></td>

    <td>
        <a class="edit" href="update.php?id=<?= $row['artId']; ?>">Wijzig</a>

        <a class="delete"
           href="delete.php?id=<?= $row['artId']; ?>"
           onclick="return confirm('Weet je het zeker?')">
           Verwijder
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>

</body>
</html>