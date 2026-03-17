<?php require_once __DIR__ . '/../inc/config.php'; 
//session_start();

$farby = $database->get('styles', ['header_color', 'text_color', 'link_color', 'header_link_color']);
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/base.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/main.css">
    <title>Document</title>
    <style>
        header {
            background-color: <?php echo $farby['header_color'] ?>;            
        }

        header a {
            color: <?php echo $farby['header_link_color'] ?> !important;
        }

        body a {
            color: <?php echo $farby['link_color'] ?>;
        }

        body {
            color: <?php echo $farby['text_color'] ?> !important;
        }
    </style>
</head>
<body>

<?php if(isset($_SESSION['user_id'])) { ?>
    <div class="panel">
        <span>Vitejte: <strong><?php echo $_SESSION['user_name'] ?></strong> | <a href="<?php echo $base_url ?>admin">Nástenka</a> | <a href="<?php echo $base_url ?>" target="_blank">Zobraziť stránku</a></span>
        <a href="<?php echo $base_url ?>inc/logout-u.php">Odhlásiť</a>
    </div>
<?php } ?>

<header>
    <div class="header-inner">
        <div class="logo">
            <img src="http://localhost/webtema/wp-content/uploads/2026/01/cropped-whitelogo.png" alt="">
        </div>

        <?php require_once 'parts/menu-public.php'; ?>
    </div>
</header>