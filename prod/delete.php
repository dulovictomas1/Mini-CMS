<?php 
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once '../parts/header.php'; 

    $id = trim($_GET['id']);

    $data = $database->get('products', ['Názov', 'Cena', 'Popis'], ['id'=>$id]);

?>

<main class="telo">
    <?php require_once __DIR__ . '/../parts/panel-admin.php'; ?>

    <section id="section-content">
    <h1 class="dash">
        Zmazať
    </h1>
    <hr>
    <form action="../inc/delete-p.php" method="post" id="delete-form">
        <input type="text" name="name" id="text" placeholder="Názov produktu" value="<?php echo $data['Názov'] ?>" disabled>

        <?php if ($_GET['type'] === 'product') : ?>
            <input type="text" name="cena" id="cena" placeholder="Cena produktu" value="<?php echo $data['Cena'] ?>" disabled>
        <?php endif ?>
        <textarea name="popis" id="popis" placeholder="Popis produktu" disabled><?php echo $data['Popis'] ?></textarea>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit">Zmazať</button>
    </form>
    </section>
</main>

<?php require_once('../parts/footer.php') ?>