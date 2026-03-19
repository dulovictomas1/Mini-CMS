<?php 
require_once __DIR__ . '/inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once __DIR__ . '/parts/header.php';
?>

<?php 
    $users = $database->select('users', ['id', 'user', 'user_role']);
?>

<main class="telo">
    <?php require_once __DIR__ . '/parts/panel-admin.php'; ?>

    <section id="section-content">

    <h1 class="stranky">
        Užívatelia
    </h1>
    <hr>

    <section>
        <table class="zozonam-prod" style="margin-bottom: 20px">
            <tr>
                <td><strong>Užívateľ:</strong></td>
                <td><strong>Rola:</strong></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
            
                <?php foreach($users as $u) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['user']) ?></td>
                        <?php if($u['user_role'] === 1) { ?>
                            <td>Administrátor</td>
                        <?php } ?>
                        <?php if($u['user_role'] === 3) { ?>
                            <td>Užívateľ s náhľadom</td>
                        <?php } ?>
                        <?php if(is_admin()) { ?>
                            <td><a href="user-edit.php?id=<?php echo $u['id'] ?>">Upraviť rolu užívateľa</a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>

            
        </table>
        
    </section>
    </section>

</main>