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
    /*tinymce.init({
    selector: '#popis',
    height: 400,
    license_key: 'gpl',
    language: 'sk',
    plugins: 'lists link image table code',
    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image | alignleft aligncenter alignright | table | code',
    relative_urls: false,
    remove_script_host: false,
    document_base_url: 'http://localhost/crystal-media/'
    });*/

tinymce.init({
    selector: '#popis',
    height: 500,
    license_key: 'gpl',
    language: 'sk',

    plugins: [
        'lists', 'link', 'image', 'table', 'code', 'autolink', 'charmap',
        'fullscreen', 'preview', 'searchreplace', 'visualblocks', 'wordcount'
    ],

    toolbar: [

        'undo redo | blocks | bold italic underline strikethrough | forecolor backcolor |',
        'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |',
        'link unlink image table | blockquote hr | removeformat | code preview fullscreen'

    ].join(' '),

    menubar: 'file edit view insert format table tools help',

    // URL správanie
    relative_urls: false,
    remove_script_host: false,
    document_base_url: 'http://localhost/crystal-media/',

    // Čistejší obsah
    forced_root_block: 'p',
    branding: false,
    promotion: false,

    // Obrázky
    image_title: true,
    automatic_uploads: true,
    image_caption: true,

    // Odkazy
    link_default_target: '_blank',
    link_assume_external_targets: true,

    // Obsah editora
    content_style: `
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin: 1rem;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        figure {
            max-width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        pre {
            background: #f5f5f5;
            padding: 12px;
            overflow: auto;
        }
    `,

    // Voliteľne: obmedzenie HTML
    valid_elements: 'p,br,strong/b,em/i,u,ul,ol,li,a[href|target|rel|title],img[src|alt|title|width|height|style|class],table[border|cellpadding|cellspacing|width],thead,tbody,tr,td[colspan|rowspan|width],th[colspan|rowspan|width],blockquote,hr,h1,h2,h3,h4,h5,h6,pre,code,figure,figcaption',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});


    </script>

<?php require_once('../parts/footer.php') ?>