<?php

require_once __DIR__ . '/../inc/boot.php';
//require_login(); // toto musí byť pred HTML




$api = trim($_POST['api']) ?? null;
$datum = trim($_POST['date']) ?? null;

$cas_api = $database->select('users', ['Časy', 'id'], ['api' => $api]);

$casy = array_map(function($time) {
        return date('H:i', strtotime(trim($time)));
    }, explode(',', $cas_api[0]['Časy']));


//print_r($casy);
//print_r($cas_api[0]['id']);


$rezervacie = $database->select('booking', ['time'], ['date' => $datum]);

//$pole1 = array_map('trim', $casy);

$rezTimes = [];

foreach ($rezervacie as $r) {
    $rezTimes[] = substr($r['time'], 0, 5);
}

$volne_casy = array_values(array_diff($casy, $rezTimes));

//print_r($volne_casy);




$test = [$_POST['date'], $_POST['api']];

header('Content-Type: application/json; charset=utf-8');
//die(json_encode($test));
die(
    json_encode([
        'success' => true,
        'date' => $volne_casy
    ])
);