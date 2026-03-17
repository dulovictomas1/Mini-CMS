<?php 
require_once __DIR__ . '/inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once __DIR__ . '/parts/header.php';
?>

<?php 

    $today = date('Y-m-d');
    $tomoorow = date('Y-m-d', strtotime('+1 day'));

    $produkty = $database->select('products', ['id', 'Názov', 'Cena', 'Popis', 'slug'], ['typ' => 'product']);
    $stranky = $database->select('products', ['id', 'Názov', 'Popis', 'slug'], ['typ' => 'page']);
    $datumy = $database->select('booking', ['date', 'time', 'meno']);
    $rezervacieDnes = $database->select('booking', ['time', 'meno'], ['date' => $today]);
    $rezervacieZajtra = $database->select('booking', ['time', 'meno'], ['date' => $tomoorow, "ORDER" => ["time" => "ASC"]]);

    $farby_test = $database->get('styles', ['header_color', 'text_color', 'link_color', 'header_link_color']);

?>

<main class="admin">
    <?php require_once __DIR__ . '/parts/panel-admin.php'; ?>

    <section id="section-content">
    <h1 class="dash">
        Nástenka
    </h1>
    <hr>

    <h2 class="stranky">
        Zoznam stránok
    </h2>

    <a href="pages/add-page.php" class="pridat-tlac">Pridať stránku</a>

    <section>
        <table class="zozonam-prod">
            <tr>
                <td><strong>Názov:</strong></td>
                <td><strong>Náhľad obsahu (obsah sa tu zobrazuje so špeciálnymi znakmi):</strong></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
            <?php 

                foreach ($stranky as $key => $pages) { ?>
                    <tr class="<?php echo parity($key) ?>">
                    <td><?php echo htmlspecialchars($pages['Názov']) ?> </td>
                    <td><?php echo substr(htmlspecialchars($pages['Popis']),0,60) ?> </td>
                    <td><a href="prod/edit.php?type=page&id=<?php echo htmlspecialchars($pages['id']) ?> ">Upraviť</a></td>
                    <td><a href="prod/delete.php?type=page&id=<?php echo htmlspecialchars($pages['id']) ?>">Zmazať</a></td>
                    <td><a href="<?php echo $base_url . $pages['slug'] ?>" target="_blank">Zobraziť</a></td>
                    </tr>
                <?php } ?>


        </table>

    </section>





    <h2 class="produkty">
        Zoznam produktov
    </h2>

    <a href="prod/add-product.php" class="pridat-tlac">Pridať produkt</a>

    <section>
        <table class="zozonam-prod">
            <tr>
                <td><strong>Názov:</strong></td>
                <td><strong>Cena:</strong></td>
                <td><strong>Náhľad popisu (obsah sa tu zobrazuje so špeciálnymi znakmi):</strong></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
            <?php 

                foreach ($produkty as $key => $item) { ?>
                    <tr class="<?php echo parity($key) ?>">
                    <td><?php echo htmlspecialchars($item['Názov']) ?></td>
                    <td><?php echo htmlspecialchars($item['Cena']) ?></td>
                    <td><?php echo substr(htmlspecialchars($item['Popis']),0,60) ?></td>
                    <td><a href="prod/edit.php?type=product&id=<?php echo htmlspecialchars($item['id']) ?>">Upraviť</a></td>
                    <td><a href="prod/delete.php?type=product&id=<?php echo htmlspecialchars($item['id']) ?>">Zmazať</a></td>
                    <td><a href="<?php echo $base_url . $item['slug'] ?>" target="_blank">Zobraziť</a></td>
                    </tr>
                <?php } ?>

        </table>
    </section>

    <h2 class="stranky">
        Zoznam rezervácii
    </h2>


    <section>
        <h5>Dnešné rezervácie</h5>
             </tr>
            <?php 
            if(empty($rezervacieDnes)) {
                echo '<i>Dnes nemáte žiadne rezervácie</i>';
            } else { ?>
            <table class="zozonam-prod">
            <tr>
                <td><strong>Meno:</strong></td>                  
                <td><strong>Čas:</strong></td>                              
           
                <?php foreach ($rezervacieDnes as $dnes) { ?>

                    <tr>
                    <td><?php echo htmlspecialchars($dnes['meno']) ?></td>
                    <td><?php echo htmlspecialchars(substr($dnes['time'], 0, 5)) ?></td>
                    </tr>
            <?php }} ?>

        </table>

        <h5>Zajtrajšie rezervácie</h5>
        <table class="zozonam-prod">
            <tr>
                <td><strong>Meno:</strong></td>                  
                <td><strong>Čas:</strong></td>                              
                </tr>
            <?php 

                foreach ($rezervacieZajtra as $zajtra) {
                    //$newdat = new DateTime($dat['date']);
                    //echo '<td>' . htmlspecialchars($newdat->format('d.m.Y')) . '</td>';
                    ?>
                    <tr>
                    <td><?php echo htmlspecialchars($zajtra['meno']) ?></td>
                    <td><?php echo htmlspecialchars(substr($zajtra['time'], 0, 5)) ?></td>
                    </tr>
            <?php } ?>

        </table>

        <h2 class="stranky" id="farby">
            Nastavenie farieb
        </h2>
        <form action="<?php echo $base_url ?>inc/colors.php" method="post">
            <div class="farby-div">
                <label for="">Header background color:</label>
                <input type="color" name="farba" id="color-primary" value="<?php 
            
            if(!empty($farby_test['header_color'])) {
                echo $farby_test['header_color'];
            } else {
                echo '#000000';
            }

            ?>">
            </div>

            <div class="farby-div">
                <label for="">Text color:</label>
                <input type="color" name="farba_text" id="color-primary" value="<?php 
            
            if(!empty($farby_test['text_color'])) {
                echo $farby_test['text_color'];
            } else {
                echo '#000000';
            }

            ?>">
            </div>

            <div class="farby-div">
                <label for="">Body link color:</label>
                <input type="color" name="farba_link" id="color-primary" value="<?php 
            
            if(!empty($farby_test['link_color'])) {
                echo $farby_test['link_color'];
            } else {
                echo '#000000';
            }

            ?>">
            </div>

            <div class="farby-div">
                <label for="">Header link color:</label>
                <input type="color" name="farba_header_link" id="color-primary" value="<?php 
            
            if(!empty($farby_test['header_link_color'])) {
                echo $farby_test['header_link_color'];
            } else {
                echo '#000000';
            }

            ?>">
            </div>
            <br>
            <button type="submit">Uložiť</button>
        </form>
        <br>
        <br>




    </section>
</section>
</main>

