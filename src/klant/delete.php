<?php
require_once '../classes/Database.php';
require_once '../classes/Klant.php';

$database = new Database();
$db = $database->connect();

$klant = new Klant($db);

$id = $_GET['id'];
$klant->delete($id);

header("Location: read.php");
exit;
