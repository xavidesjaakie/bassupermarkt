<?php
require_once '../classes/Database.php';
require_once '../classes/Verkooporder.php';
require_once '../classes/Artikel.php';

$database = new Database();
$db = $database->connect();

// 🔹 Verkooporders ophalen
$verkooporder = new Verkooporder($db);
$orders = $verkooporder->readAll();

// 🔹 Artikelen ophalen (voor rechter lijst)
$artikelObj = new Artikel($db);
$artikelen = $artikelObj->readAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Verkooporders Overzicht</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>Verkooporders Overzicht</h2>

<a class="btn" href="../index.html">Menu</a>
<a class="btn" href="insert.php">Nieuwe order</a>

<br><br>

<div style="display: flex; gap: 40px;">

    <!-- 🔹 LINKERKANT: VERKOOPORDERS -->
    <div style="flex: 3;">

        <table>

        <tr>
            <th>ID</th>
            <th>Klant</th>
            <th>Artikel</th>
            <th>Aantal</th>
            <th>Datum</th>
            <th>Status</th>
            <th>Acties</th>
        </tr>

        <?php foreach ($orders as $row): ?>
        <tr>
            <td><?= $row['verkOrdId']; ?></td>
            <td><?= $row['klantNaam']; ?></td>
            <td><?= $row['artOmschrijving']; ?></td>
            <td><?= $row['verkOrdBestAantal']; ?></td>
            <td><?= $row['verkOrdDatum']; ?></td>

            <td>
                <?php
                switch ($row['verkOrdStatus']) {
                    case 1: echo "Nieuw"; break;
                    case 2: echo "Picking"; break;
                    case 3: echo "Onderweg"; break;
                    case 4: echo "Bezorgd"; break;
                }
                ?>
            </td>

            <td>
                <a class="edit" href="update.php?id=<?= $row['verkOrdId']; ?>">Wijzig</a>

                <a class="delete"
                   href="delete.php?id=<?= $row['verkOrdId']; ?>"
                   onclick="return confirm('Weet je het zeker?')">
                   Verwijder
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

        </table>

    </div>

    <!-- 🔥 RECHTERKANT: ARTIKELEN -->
    <div style="flex: 1; background: #f4f4f4; padding: 15px; border-radius: 8px;">

        <h3>Artikelen</h3>

        <table style="font-size: 14px;">
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Prijs</th>
            </tr>

            <?php foreach ($artikelen as $art): ?>
            <tr>
                <td><?= $art['artId']; ?></td>
                <td><?= $art['artOmschrijving']; ?></td>
                <td>€<?= $art['artVerkoop']; ?></td>
            </tr>
            <?php endforeach; ?>

        </table>

    </div>

</div>

</body>
</html>