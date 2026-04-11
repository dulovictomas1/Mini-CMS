<?php
require_once __DIR__ . '/../inc/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if($_POST['date'] === '' || $_POST['time'] === '' || $_POST['meno'] === '') {
    header("Location:" . $base_url . "rezervacia-api.php?api=".$_POST['api']."&error=prazdnepole");
    die();
}

if ($_POST['date'] < date('Y-m-d')) {
    header("Location:" . $base_url . "rezervacia-api.php?api=".$_POST['api']."&error=minuly-datum");
    die('Nie je možné rezervovať minulý dátum');
}


$isAccount = $database->has("users", ["AND" => ['API' => $_POST['api']] ]);

if(isset($_POST['api']) && $isAccount) {

    $time = $_POST['time'];

    $d = DateTime::createFromFormat('H:i', $time);
    if(!$d || $d->format('H:i') !== $time) {
        header("Location:" . $base_url . "rezervacia.php?error=neplatny-cas");
        die('Zadali ste neplatný čas');
    }
    
    $acc = $database->get("users", "id", ["API" => $_POST['api']]);

    $new_time = $database->insert('booking', ['meno' => $_POST['meno'], 'date' => $_POST['date'], 'time' => $_POST['time'], 'user_ID_book' => $acc]);


    if($new_time) {
        $_SESSION['rezervacia'] = [$_POST['date'], $time];
        header( "Location:" . $base_url . "rezervacia-api.php?api=".$_POST['api']."&status=succes" );
        die();
    }
}




