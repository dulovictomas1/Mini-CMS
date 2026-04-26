<?php
require_once __DIR__ . '/../inc/config.php';

$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$men = trim($_POST['name']);

$apiK = bin2hex(random_bytes(16));

$new_u = $database->insert('users', ['user' => $men, 'pass' => $pass, 'api' => $apiK]);

if($new_u) {
    header("Location:" . $base_url . "login");
    die();
}