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

?>

<main class="telo">
    <h1><?php echo htmlspecialchars($pageData['Názov']); ?></h1>
    <hr>

    <div>
        <?php echo $pageData['Popis'];?>
        Toto je podstránka produktu
    </div>
</main>

<?php require_once 'parts/footer.php'; ?>