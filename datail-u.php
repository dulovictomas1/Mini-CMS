<?php 
require_once __DIR__ . '/inc/boot.php';
require_login(); // toto musí byť pred HTML

require_once __DIR__ . '/parts/header.php';
?>

<?php 
    $detail = $database->get('users', ['user', 'API', 'Časy'], ['id' => $_SESSION['user_id']]);
?>

<main class="telo">
    <?php require_once __DIR__ . '/parts/panel-admin.php'; ?>

    <section id="section-content">

    <h1 class="stranky">
        Detail účtu
    </h1>
    <hr>

    <section>
        <strong>Meno užívateľa:</strong> <?php echo $detail['user'] ?><br>
        <strong>API kľúč:</strong> <?php echo $detail['API'] ?>
    <br>
    <br>
        <form action="inc/save-rezervation.php" method="post">
            <label for="">Zadajte časy rezervácii</label>
            <input type="text" name="casy" id="" placeholder="Tu zadajte časi pre vaše rezervácie vo forme napr. 09:00, 10:00, 10:30">
            <button type="submit">
                Uložiť
            </button>
        </form>
        <br>
        Zadané časy rezervácii: <?php echo $detail['Časy'] ?>
    </section>

</main>