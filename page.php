<?php require_once 'parts/header-public.php'; ?>

<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $slug = $_GET['page'] ?? 'domov';

    if( !isset($_SESSION['view_page'][$slug])) {
    
        $page_views = $database->update('products', ['views[+]' => 1], ['slug' => $slug]);

        $_SESSION['view_page'][$slug] = true;
    
    }

    $page_views2 = $database->select('products', ['views', 'Názov'], ['typ' => 'page', 'ORDER' => ['views' => 'DESC']]);

    //print_r($_SESSION['view_page']);
?>

<main class="telo">
    <h1><?php echo htmlspecialchars($pageData['Názov']); ?></h1>
    <hr>

    <div>
        <?php echo $pageData['Popis'];?>
        Toto je podstránka PAGE

        <div class="zoznam" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1em;">
            <?php foreach($page_views2 as $p) { ?>
                <div class="list" style="padding: 10px; border: 1px solid">
                    <p><?php echo htmlspecialchars($p['Názov']) ?></p>
                    <small>Zobrazení <?php echo htmlspecialchars($p['views']) ?></small>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php require_once 'parts/footer.php'; ?>