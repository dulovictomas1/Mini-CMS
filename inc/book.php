<?php
require_once __DIR__ . '/../inc/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if($_POST['date'] === '' || $_POST['time'] === '' || $_POST['meno'] === '') {
    header("Location:" . $base_url . "rezervacia.php?error=prazdnepole");
    die();
}

if ($_POST['date'] < date('Y-m-d')) {
    header("Location:" . $base_url . "rezervacia.php?error=minuly-datum");
    die('Nie je možné rezervovať minulý dátum');
}

$time = $_POST['time'];
$d = DateTime::createFromFormat('H:i', $time);
if(!$d || $d->format('H:i') !== $time) {
    header("Location:" . $base_url . "rezervacia.php?error=neplatny-cas");
    die('Zadali ste neplatný čas');
}

$new_time = $database->insert('booking', ['meno' => $_POST['meno']/*, 'email' => $_POST['email']*/, 'date' => $_POST['date'], 'time' => $_POST['time']]);


if($new_time) {
    $_SESSION['rezervacia'] = [$_POST['date'], $time];
    header( "Location:" . $base_url . "rezervacia.php?status=succes" );
    die();
}