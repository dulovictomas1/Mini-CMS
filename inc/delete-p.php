<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

$id = trim($_POST['id']);

$del_p = $database->delete('products', ['id' => $id]);

if($del_p) {
    header("Location:" . $base_url . "admin");
    die();
}