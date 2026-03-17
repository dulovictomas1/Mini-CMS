<?php
require_once __DIR__ . '/../inc/config.php';

$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$men = trim($_POST['name']);


$new_u = $database->insert('users', ['user' => $men, 'pass' => $pass]);

//echo "Test ADD";

if($new_u) {
    header("Location:" . $base_url . "login");
    die();
}