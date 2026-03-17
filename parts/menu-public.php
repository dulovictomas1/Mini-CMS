<?php 

    $menu_item = $database->select('products', ['Názov', 'slug', 'menu_order'], ['in_menu' => 1, 'ORDER' => ['menu_order' => 'ASC']]);

?>

    <nav>
        <ul>
            <?php foreach ($menu_item as $item) { ?>
                <li><a href="<?php echo $base_url . $item['slug'] ?>"><?php echo htmlspecialchars($item['Názov']) ?></a></li>
            <?php } ?>
            <li class="book-menu"><a href="#" onclick="openRezervacia()">Rezervovať</a></li>
        </ul>
    </nav>
