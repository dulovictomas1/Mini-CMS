<?php require_once('parts/header.php') ?>

<main class="login">
    <h1>Vytvorte si účet</h1>
    <div class="prihlas">
        <form action="inc/create-u.php" method="post">
            <input type="text" name="name" id="" placeholder="Vaše meno" required>
            <input type="password" name="pass" id="" placeholder="Vaše heslo" required>
            <button type="submit">Vytvoriť účet</button>
        </form>

        <div class="text">
            <span>Máte už účet? <a href="login">Prihláste sa.</a></span>
            <span>Prejsť späť <a href="<?php echo $base_url ?>">na stránku.</a></span>
        </div>

        <?php if (!empty($_GET['error'])): ?>
            <p style="color:red;">Nesprávne meno alebo heslo.</p>
        <?php endif; ?>
    </div>
</main>

<?php require_once('parts/footer.php') ?>