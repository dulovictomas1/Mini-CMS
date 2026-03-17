<?php 
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once '../parts/header.php'; 
?>

<main class="telo">
    <?php require_once __DIR__ . '/../parts/panel-admin.php'; ?>

    <section id="section-content">
    <h1 class="dash">
        Pridať produkt
    </h1>
    <hr>
    <form action="../inc/add-p.php" method="post">
        <input type="text" name="name" id="text" placeholder="Názov produktu">
        <input type="text" name="cena" id="cena" placeholder="Cena produktu">
        <textarea name="popis" id="popis" placeholder="Popis produktu"></textarea>
        <input type="hidden" name="type" value="product">
        <button type="submit">Pridať</button>
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
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
    });
    </script>

<?php require_once('../parts/footer.php') ?>