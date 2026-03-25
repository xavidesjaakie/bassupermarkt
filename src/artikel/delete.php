<?php
require_once '../classes/Database.php';
require_once '../classes/Artikel.php';

$database = new Database();
$db = $database->connect();

$artikel = new Artikel($db);

$id = $_GET['id'];
$artikel->delete($id);

header("Location: read.php");
exit;
