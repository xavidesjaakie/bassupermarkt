<?php
require_once '../classes/Database.php';
require_once '../classes/Verkooporder.php';

$database = new Database();
$db = $database->connect();

$verkooporder = new Verkooporder($db);

$id = $_GET['id'];
$verkooporder->delete($id);

header("Location: read.php");
exit;