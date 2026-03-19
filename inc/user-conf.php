<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

$id = trim($_POST['id']);
$role = trim($_POST['role']);

$user_udpdate = $database->update('users', ['user_role' => $role], ['id' => $id]);

if($user_udpdate) {
    header("Location:" . $base_url . "users.php");
    die();
}

