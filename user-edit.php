<?php 
require_once __DIR__ . '/inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once __DIR__ . '/parts/header.php';
?>

<?php 
    $id = trim($_GET['id']);
    $users = $database->get('users', ['id', 'user', 'user_role'], ['id' => $id]);
?>

<main class="telo">
    <?php require_once __DIR__ . '/parts/panel-admin.php'; ?>

    <section id="section-content">

    <h1 class="stranky">
        Detail užívateľa <i><?php echo htmlspecialchars($users['user']) ?></i>
    </h1>
    <hr>

    <?php if(is_admin()) { ?>

    <section>
        <table class="zozonam-prod" style="margin-bottom: 20px">
            <tr>
                <td><strong>Užívateľ:</strong></td>
                <td><strong>Vybete rolu pre užívateľa:</strong></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
            
                <tr>
                    <td><?php echo htmlspecialchars($users['user']) ?></td>
                    <td>
                        <form action="inc/user-conf.php" method="post">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($users['id']) ?>">
                            <select name="role" id="" class="select_users">
                                <option value="1">Administrátor</option>
                                <option value="3">Bez práv</option>
                            </select>
                            <button type="submit">Uložiť</button>
                        </form>
                    </td>    
                </tr>
                

            
        </table>
        
    </section>

    <?php } ?>

    </section>

</main>
