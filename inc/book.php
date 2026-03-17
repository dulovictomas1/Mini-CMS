<?php
require_once __DIR__ . '/../inc/config.php';

if($_POST['date'] === '' || $_POST['time'] === '' || $_POST['meno'] === '') {
    header("Location:" . $base_url . "rezervacia.php?error=prazdnepole");
    die();
}

if ($_POST['date'] < date('Y-m-d')) {
    header("Location:" . $base_url . "rezervacia.php?error=minuly-datum");
    die('Nie je možné rezervovať minulý dátum');
}


$new_time = $database->insert('booking', ['meno' => $_POST['meno']/*, 'email' => $_POST['email']*/, 'date' => $_POST['date'], 'time' => $_POST['time']]);


if($new_time) {
    header( "Location:" . $base_url . "rezervacia.php?status=succes" );
    die();
}