<?php

require_once('parts/header.php');

use Medoo\Medoo;

$api = trim($_GET['api']);


if (is_api($_GET['api'])  && !empty($api)) {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['rezervacia'] = $_SESSION['rezervacia'] ?? null;



       //Nastavenie časov podľa API kľúča

    $datum = $_GET['date'] ?? null;

    $api = trim($_GET['api']);


    $cas_api = $database->select('users', ['Časy'], ['api' => $api]);
    $id_u = $database->select('users', 'id', ['api' => $api]);


    $casy = array_map(function($time) {
        return date('H:i', strtotime(trim($time)));
    }, explode(',', $cas_api[0]['Časy']));

    //$nove_casy = explode(',', $cas_api[0]['Časy']);

    //print_r($casy);

    $pole1 = array_map('trim', $casy);
    
    $pocet_casov = count($pole1);

    


    $rez = $database->select('booking', ['time'], ['date' => $datum]);

    $rezTimes = [];

    foreach ($rez as $r) {
        $rezTimes[] = substr($r['time'], 0, 5);
    }

    $volne_casy = array_diff($pole1, $rezTimes);


    

    $plne_dni = $database->select('booking', [
        'date',
        'total' => Medoo::raw('COUNT(*)')
    ], [
        'user_ID_book' => $id_u,
        'GROUP' => 'date',
        'HAVING' => Medoo::raw('COUNT(*) >= '. (int)$pocet_casov)
    ]); //SELECT date, COUNT(*) as total FROM booking GROUP BY date HAVING total >= 5

    $fullDates = [];

    foreach ($plne_dni as $row) {
        $fullDates[] = $row['date'];
    }

    //print_r($fullDates);



 

    ?>



    <main class="telo" style="padding: 10px">
        <h1>Rezervovať online</h1>
        <hr>

        <form action="" method="get">
            <label for="">Vyberte si termín (rezerváciu je možné vykonať až na ďalšie dni)</label>
            <input type="date" name="date" id="date" 
            value="<?php 
            if (!empty($_SESSION['rezervacia'][0])){
                echo $_SESSION['rezervacia'][0];
            }else if(empty($datum)) {
                echo date('Y-m-d', strtotime('+1 day')); //echo htmlspecialchars($datum)
            } else {
                echo $datum;
            } ?>" 
            min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>">
            <input type="hidden" name="api" value="<?= htmlspecialchars($api) ?>">
        
            <button type="submit">Overiť dostupnosť</button>
            
        </form>

        <hr>

        <?php if(empty($volne_casy)) { ?>
            <p>Ľutujeme, na zvolený dátum už nie sú voľné termíny, zvoľte iný termín.</p>
        <?php } else { ?>
        <?php if(!empty($datum)) { ?>
        <form action="inc/book-api.php" method="post">
            <label for="">Vyberte čas</label>
            <input type="hidden" name="date" id="date2" value="<?php echo htmlspecialchars($datum) ?>" style="visibility: hidden">
            
            <select name="time" id="casy">

                <?php foreach( $volne_casy as $time) { ?>
                    <option value="<?php echo trim(htmlspecialchars($time)) ?>"><?php echo trim(htmlspecialchars($time)) ?></option>
                <?php } ?>    

            </select>

            <input type="text" name="meno" id="meno" placeholder="Vaše meno a priezvisko" required>
            <input type="hidden" name="api" value="<?= htmlspecialchars($api) ?>">

            <button type="submit">Rezervovať</button>
        </form>
        <?php } 
        }?>

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
        if($err == 'neplatny-cas') : ?>
            <div class="err">
                <p>Čas, ktorý ste vybrali nie je platný</p>
            </div>
        <?php endif ?>

        

        <?php
        $succes = $_GET['status'] ?? null;

        if($succes == 'succes') : 
        $datum = new DateTime($_SESSION['rezervacia'][0]); ?>
            <div class="suc">
                <p>Vaša rezervácia na dátum <?php echo $datum->format('d.m.Y') ?> v čase <?php echo $_SESSION['rezervacia'][1] ?> bola úspešne odoslaná, nezabudnite si ju poznačiť</p>
                
            </div>

        <?php 
        unset($_SESSION['rezervacia']);
        endif ?>

    </main>

<?php } else {
    echo "Vyskytol sa problém!";
}

require_once('parts/footer.php') ?>




<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/sk.js"></script>
<script>
const fullDates = <?php echo json_encode($fullDates); ?>;
</script>


<script>
flatpickr("#date", {
    locale: "sk",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d.m.Y",
    allowInput: false,
    minDate: new Date().fp_incr(1),
    disable: fullDates,
    onDayCreate: function(dObj, dStr, fp, dayElem) {
            const date = dayElem.dateObj.getFullYear() + '-' +
                String(dayElem.dateObj.getMonth() + 1).padStart(2, '0') + '-' +
                String(dayElem.dateObj.getDate()).padStart(2, '0');

            if (fullDates.includes(date)) {
                dayElem.classList.add("full-day");
            }
        }
    });


</script>