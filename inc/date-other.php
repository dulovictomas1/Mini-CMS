<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

$data = $database->select("booking", ["time", "meno"], ["date" => $_POST['datum-other'], "user_ID_book" => $_POST['id-uzi']]);

header('Content-Type: application/json; charset=utf-8');
die(json_encode($data));