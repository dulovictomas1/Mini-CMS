<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// sem si daj načítanie configu + medoo
require_once __DIR__ . '/config.php';     // tvoje DB údaje
//require_once __DIR__ . '/database.php';   // kde vytváraš $database (Medoo instance)

// Voliteľné helpery
function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function require_login(): void {
    global $base_url;

    if (!is_logged_in()) {
        header("Location:" . $base_url . "login");
        exit;
    }
}