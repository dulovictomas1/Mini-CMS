<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML


$cas = trim($_POST['casy']);
$id = trim($_SESSION['user_id']);

//print_r($cas[] = explode(',', $_POST['casy']));

$new_cas = $database->update('users', ['Časy' => $cas], ['id' => $id]);

if($new_cas) {
    header( "Location:" . $base_url . "datail-u.php" );
    die();
}