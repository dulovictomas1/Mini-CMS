<?php
require_once __DIR__ . '/boot.php';

$name = trim($_POST['name'] ?? '');
$pass = (string)($_POST['pass'] ?? '');

if ($name === '' || $pass === '') {
    header('Location:' . $base_url . 'log-in.php?error=1');
    exit;
}

// vytiahni usera z DB (prispôsob názov tabuľky/stĺpcov!)
$user = $database->get('users', ['id', 'user', 'pass'], [
    'user' => $name
]);


if (!$user) {
    header('Location:' . $base_url . 'log-in.php?error=1');
    exit;
}

// over heslo (v DB musí byť hash cez password_hash)
if (!password_verify($pass, $user['pass'])) {
    header('Location:' . $base_url . 'log-in.php?error=1');
    exit;
}

// OK - prihlásenie
session_regenerate_id(true);
$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['user_name'] = $user['user'];

header('Location:' . $base_url . 'admin');
exit;