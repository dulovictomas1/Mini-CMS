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
        Editovať
    </h1>
    <hr>
    <form action="../inc/edit-p.php" method="post">
        <input type="text" name="name" id="text" placeholder="Názov produktu" value="<?php echo $data['Názov'] ?>">
        
        <?php if ($_GET['type'] === 'product') : ?>
            <input type="text" name="cena" id="cena" placeholder="Cena produktu" value="<?php echo $data['Cena'] ?>">
        <?php endif ?>
        
        <textarea name="popis" id="popis" placeholder="Popis produktu"><?php echo htmlspecialchars($data['Popis']) ?></textarea>
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button type="submit">Uložiť</button>
    </form>
    </section>
</main>



<script src="http://localhost/crystal-media/js/tinymce/tinymce.min.js"></script>

    <script>
    tinymce.init({
    selector: '#popis',
    height: 400,
    license_key: 'gpl',
    language: 'sk',
    plugins: 'lists link image table code',
    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image | alignleft aligncenter alignright | table | code'
    });
    </script>

<?php require_once('../parts/footer.php') ?>