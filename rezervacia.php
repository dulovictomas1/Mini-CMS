<?php require_once('parts/header.php'); ?>

<?php 

$datum = $_GET['date'] ?? null;


$times = ["9:00", "10:00", "11:00", "13:00", "14:00"];

$rez = $database->select('booking', ['time'], ['date' => $datum]);

$rezTimes = [];

foreach ($rez as $r) {
    $rezTimes[] = ltrim(substr($r['time'], 0, 5), "0");
}

$freeTimes = array_diff($times, $rezTimes);

?>

<main class="telo">
    <h1>Rezervovať online</h1>
    <hr>

    <form action="" method="get">
        <label for="">Vyberte si termín (rezerváciu je možné vykonať až na ďalšie dni)</label>
        <input type="date" name="date" id="date" value="<?php echo date('Y-m-d', strtotime('+1 day')) //echo htmlspecialchars($datum) ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>">
       
        <button type="submit">Overiť dostupnosť</button>
        
    </form>

    <hr>

    <?php if(!empty($datum)) { ?>
    <form action="inc/book.php" method="post">
        <label for="">Vyberte čas</label>
        <input type="hidden" name="date" id="date" value="<?php echo htmlspecialchars($datum) ?>">
        
        <select name="time" id="casy">

            <?php foreach( $freeTimes as $time) { ?>
                <option value="<?php echo htmlspecialchars($time) ?>"><?php echo htmlspecialchars($time) ?></option>
            <?php } ?>    

        </select>

        <input type="text" name="meno" id="meno" placeholder="Vaše meno a priezvisko" required>

        <button type="submit">Rezervovať</button>
    </form>
    <?php } ?>

    <?php
    $err = $_GET['error'] ?? null;

    if($err == 'prazdnepole') : ?>
        <div class="err">
            <p>Niektoré pole je prázdne</p>
        </div>
    <?php endif ?>


    <?php
    if($err == 'minuly-datum') : ?>
        <div class="err">
            <p>Nie je možné rezervovať minulý dátum</p>
        </div>
    <?php endif ?>

    

    <?php
    $succes = $_GET['status'] ?? null;

    if($succes == 'succes') : ?>
        <div class="suc">
            <p>Vaša rezervácia bola úspešne zapísaná</p>
        </div>
    <?php endif ?>

</main>

<?php require_once('parts/footer.php') ?>

