<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

$ids = $_POST['ids'] ?? [];
$menuOrders = $_POST['order'] ?? [];
$inMenu = $_POST['in_menu'] ?? [];

foreach ($ids as $id) {
    $id = (int) $id;

    $isInMenu = isset($inMenu[$id]) ? 1 : null;
    $menuOrder = isset($menuOrders[$id]) && $menuOrders[$id] !== ''
        ? (int) $menuOrders[$id]
        : null;

    $database->update('products', [
        'in_menu' => $isInMenu,
        'menu_order' => $menuOrder
    ], [
        'id' => $id,
        'typ' => 'page'
    ]);
}

header("Location:" . $base_url . "menu.php");
die();

print_r($ids).'<br>';
print_r($menuOrders).'<br>';
print_r($inMenu).'<br>';