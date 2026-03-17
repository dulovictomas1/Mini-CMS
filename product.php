<?php require_once 'parts/header-public.php'; ?>

<main class="telo">
    <h1><?php echo htmlspecialchars($pageData['Názov']); ?></h1>
    <hr>

    <div>
        <?php echo $pageData['Popis'];?>
        Toto je podstránka produktu
    </div>
</main>

<?php require_once 'parts/footer.php'; ?>