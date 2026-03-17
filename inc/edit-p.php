<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

$id = trim($_POST['id']);

$ed_p = $database->update('products', ['Názov' => $_POST['name'], 'Popis' => $_POST['popis'], 'Cena' => $_POST['cena']], ['id' => $id]);

//echo "Test ADD";

if($ed_p) {
    header("Location:" . $base_url . "admin");
    die();
}