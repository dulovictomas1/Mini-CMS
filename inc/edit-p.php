<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

//$id = trim($_POST['id']);
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id === false) {
    die();
}

$ed_p = $database->update('products', ['Názov' => $_POST['name'], 'Popis' => $_POST['popis'], 'Cena' => $_POST['cena']], ['id' => $id]);

if($ed_p) {
    header("Location:" . $base_url . "admin");
    die();
}