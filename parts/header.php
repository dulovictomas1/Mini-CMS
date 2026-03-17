<?php require_once __DIR__ . '/../inc/config.php'; 
//session_start();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/base.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/admin.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>css/main.css">
    <title>Document</title>
</head>
<body>

<?php if(isset($_SESSION['user_id'])) { ?>
    <div class="panel">
        <span>Vitejte: <strong><?php echo $_SESSION['user_name'] ?></strong> | <a href="<?php echo $base_url ?>admin">Nástenka</a> | <a href="<?php echo $base_url ?>" target="_blank">Zobraziť stránku</a></span>
        <a href="<?php echo $base_url ?>inc/logout-u.php">Odhlásiť</a>
    </div>
<?php } ?>

