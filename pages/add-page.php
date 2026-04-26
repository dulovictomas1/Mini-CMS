<?php 
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once '../parts/header.php'; 
?>

<main class="telo">
    <?php require_once __DIR__ . '/../parts/panel-admin.php'; ?>

    <section id="section-content">
    <h1 class="dash">
        Pridať stránku
    </h1>
    <hr>
    <form action="../inc/add-pag.php" method="post">
        <input type="text" name="name" id="text" placeholder="Názov stránky">
        <textarea name="obsah" id="obsah" placeholder="Obsah stránky"></textarea>
        <input type="hidden" name="type" value="page">
        <button type="submit">Pridať</button>
    </form>
    </section>
</main>


<script src="http://localhost/crystal-media/js/tinymce/tinymce.min.js"></script>

    <script>
    tinymce.init({
    selector: '#obsah',
    height: 400,
    license_key: 'gpl',
    language: 'sk',
    plugins: 'lists link image table code',
    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code',
    automatic_uploads: true,
    images_upload_url: '/inc/upload-image.php',
    file_picker_types: 'image'
    });
    </script>

<?php require_once('../parts/footer.php') ?>