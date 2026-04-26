<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML


function remove_diacritics($text)
{
    $search = ['á','ä','č','ď','é','ě','í','ľ','ĺ','ň','ó','ô','ŕ','š','ť','ú','ý','ž'];
    $replace = ['a','a','c','d','e','e','i','l','l','n','o','o','r','s','t','u','y','z'];

    return str_replace($search, $replace, $text);
}

$slug = remove_diacritics(strtolower(str_replace(' ', '-',  $_POST['name'])));
$type = trim($_POST['type']);

$new_p = $database->insert('products', ['Názov' => $_POST['name'], 'Popis' => $_POST['popis'], 'Cena' => $_POST['cena'], 'slug' => $slug, 'typ' => $type]);

if($new_p) {
    header( "Location:" . $base_url . "admin" );
    die();
}