
<section id="admin-panel">
    <nav>
        <ul>
            <li><a href="<?php echo $base_url ?>admin">Nástenka</a></li>
            <?php if(is_admin()) { ?>
                <li><a href="<?php echo $base_url ?>pages/add-page.php" class="pridat-tlac">Pridať stránku</a></li>
                <li><a href="<?php echo $base_url ?>prod/add-product.php" class="pridat-tlac">Pridať produkt</a></li>
                <li><a href="<?php echo $base_url ?>pages/menu-conf.php">Menu</a></li>
                <li><a href="<?php echo $base_url ?>users.php">Užívatelia</a></li>
            <?php } ?> 
                <li><a href="<?php echo $base_url ?>datail-u.php">Detail účtu</a></li>
        </ul>
    </nav>
</section>