<?php require_once('parts/header.php');

if(isset($_SESSION['user_id'])) {
    header("Location:" . $base_url . "admin");
    die();
}

?>



<main class="login">
    <h1>Prihlásiť sa</h1>
    <div class="prihlas">
        <form action="inc/login-u.php" method="post">
            <input type="text" name="name" id="" placeholder="Meno" required>
            <input type="password" name="pass" id="" placeholder="Heslo" required>
            <button type="submit">Prihlásiť</button>
        </form>

        <div class="text">
            <span>Nemáte účet? <a href="create">Vytvorte si ho.</a></span>
            <span>Prejsť späť <a href="<?php echo $base_url ?>">na stránku.</a></span>
        </div>

        <?php if (!empty($_GET['error'])): ?>
            <p style="color:red;">Nesprávne meno alebo heslo.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once('parts/footer.php') ?>