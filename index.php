<?php
require_once 'inc/boot.php';


$page = $_GET['page'] ?? 'domov';

$routes = [
    'home' => 'home.php',
    'admin' => 'admin.php',
    'rezervacia' => 'rezervacia.php',
    'create' => 'create.php',
    'login' => 'log-in.php',
    '404' => '404.php',
];

if (array_key_exists($page, $routes)) {
    require_once $routes[$page];
    exit;
}

$pageData = $database->get('products', '*', ['slug' => $page]);

if ($pageData) {

    if($pageData['typ'] === 'page') {

        $template = 'page-' . $pageData['slug'] . '.php';

        if (file_exists($template)) {
            require_once $template;
        } else {
            require_once 'page.php';
        }

        exit;
    }


    if($pageData['typ'] === 'product') {

        require_once 'product.php';
        exit;
    }
}

http_response_code(404);
require_once '404.php';
exit;
