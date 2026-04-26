<?php 
require_once __DIR__ . '/../inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once __DIR__ . '/../parts/header.php';
?>

<?php 
    $stranky = $database->select('products', ['id', 'Názov', 'in_menu', 'menu_order'], ['typ' => 'page']);
?>

<main class="telo">
    <?php require_once __DIR__ . '/../parts/panel-admin.php'; ?>

    <section id="section-content">

    <h1 class="stranky">
        Menu
    </h1>
    <hr>

    <section>
        <form action="inc/add-menu.php" method="post">
        <table class="zozonam-prod" style="margin-bottom: 20px">
            <tr>
                <td><strong>Názov:</strong></td>
                <td><strong>Položky v menu:</strong></td>
                <td>Poradie v menu:</td>
                <td></td>
                <td></td>
                </tr>
            
                <?php foreach ($stranky as $pages) { ?>
                    <tr>
                    <td><?php echo htmlspecialchars($pages['Názov']) ?></td>
                    <td><input type="checkbox" name="in_menu[<?php echo $pages['id']?>]" id="" value="1"
                    <?php if (!empty($pages['in_menu'])) {
                        echo "checked";
                    } else {

                    } ?>>
                    <td><input type="text" name="order[<?php echo $pages['id'] ?>]" id="" value="<?php echo $pages['menu_order'] ?>">
                    <input type="text" name="ids[]" id="" value="<?php echo $pages['id'] ?>" hidden>
                    </tr>
                <?php } ?>

            
        </table>
        <button type="submit">Uložiť menu</button>
        </form>       
        
    </section>
    </section>

</main>