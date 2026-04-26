<?php
require_once __DIR__ . '/../inc/config.php';

/*if (session_status() === PHP_SESSION_NONE) {
    session_start();
}*/

//if($_POST['date'] === '' || $_POST['time'] === '' || $_POST['meno'] === '') {
if($_POST['date'] === '' || $_POST['time'] === ''|| $_POST['meno'] === '') {
    //header("Location:" . $base_url . "rezervacia-api.php?api=".$_POST['api']."&error=prazdnepole");
    //die();

    header('Content-Type: application/json; charset=utf-8');
    die(
        json_encode([
            'success' => false,
            'message' => "Niektore pole je prázdne"
        ])
    );
}

if ($_POST['date'] < date('Y-m-d')) {
    //header("Location:" . $base_url . "rezervacia-api.php?api=".$_POST['api']."&error=minuly-datum");
    //die('Nie je možné rezervovať minulý dátum');

    header('Content-Type: application/json; charset=utf-8');
    die(
        json_encode([
            'success' => false,
            'message' => "Nie je možné rezervovať minulý čas"
        ])
    );
}


$isAccount = $database->has("users", ["AND" => ['API' => $_POST['api']] ]);

if(isset($_POST['api']) && $isAccount) {

    $time = $_POST['time'];

    $d = DateTime::createFromFormat('H:i', $time);
    if(!$d || $d->format('H:i') !== $time) {
        //header("Location:" . $base_url . "rezervacia.php?error=neplatny-cas");
        //die('Zadali ste neplatný čas');

        header('Content-Type: application/json; charset=utf-8');
        die(
            json_encode([
                'success' => false,
                'message' => "Zadali ste neplatný čas"
            ])
        );
    }
    
    $acc = $database->get("users", "id", ["API" => $_POST['api']]);

    $new_time = $database->insert('booking', ['meno' => $_POST['meno'], 'date' => $_POST['date'], 'time' => $_POST['time'], 'user_ID_book' => $acc]);

    $datum = new DateTime($_POST['date']);


    if($new_time) {
        //$_SESSION['rezervacia'] = [$_POST['date'], $time];
        //header( "Location:" . $base_url . "rezervacia-api.php?api=".$_POST['api']."&status=succes" );
        //die();

        header('Content-Type: application/json; charset=utf-8');
        die(
            json_encode([
                'success' => true,
                'message' => "<hr> Vaša rezervácia bola úspešne odoslaná. <br><br> Detail rezervácie: <br> Meno: " . $_POST['meno'] . ", čas: " .$_POST['time'] . ", dátum: " . $datum->format('d.m.Y')
            ])
        );
    }
}


/*$test = [$_POST['date'], $_POST['api']];
$test2 = array_values($test);

header('Content-Type: application/json; charset=utf-8');

die(
    json_encode([
        'success' => true,
        'AS' => $test2
    ])
);*/