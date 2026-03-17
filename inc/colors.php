<?php
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

$farby_test = $database->get('styles', ['header_color', 'text_color', 'link_color', 'header_link_color']);

if(isset($_POST['farba']) || isset($_POST['farba_text']) || isset($_POST['farba_link']) || isset($_POST['farba_header_link'])) {
     
    $color = trim($_POST['farba']);
    $color_text = trim($_POST['farba_text']);
    $color_link = trim($_POST['farba_link']);
    $color_header_link = trim($_POST['farba_header_link']);

    if(!empty($farby_test['header_color'])) {
        $new_color = $database->update('styles', ['header_color' => $color, 'text_color' => $color_text, 'link_color' => $color_link, 'header_link_color' => $color_header_link]);
        header('Location:' . $base_url . 'admin#farby');
        die();
    } else {
        $new_color = $database->insert('styles', ['header_color' => $color, 'text_color' => $color_text, 'link_color' => $color_link, 'header_link_color' => $color_header_link]);
        header('Location:' . $base_url . 'admin#farby');
        die();
    }

}
