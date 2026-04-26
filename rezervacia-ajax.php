<?php

require_once('parts/header.php');

use Medoo\Medoo;

$api = trim($_GET['api']);


if (is_api($_GET['api'])  && !empty($api)) {

    $id_user_and_times = $database->select('users', ['id', 'Časy'], ['api' => $api]);

    $pocet_casov = count(explode(",", $id_user_and_times[0]['Časy']));

    $plne_dni = $database->select('booking', [
        'date',
        'total' => Medoo::raw('COUNT(*)')
    ], [
        'user_ID_book' => $id_user_and_times[0]['id'],
        'GROUP' => 'date',
        'HAVING' => Medoo::raw('COUNT(*) >= '. (int)$pocet_casov)
    ]); //SELECT date, COUNT(*) as total FROM booking GROUP BY date HAVING total >= 5

    $fullDates = [];

    foreach ($plne_dni as $row) {
        $fullDates[] = $row['date'];
    }

?>



    <main class="telo" style="padding: 10px">
        <h1>Rezervovať online</h1>
        <hr>

        <form action="inc/book-api-ajax.php" method="post" id="booking-form">
            <label for="">Vyberte si termín (rezerváciu je možné vykonať až na ďalšie dni)</label>

            <input type="date" name="date" id="date-ajax" value="<?php echo trim(date('Y-m-d', strtotime('+1 day'))); ?>"  min="<?php echo trim(date('Y-m-d', strtotime('+1 day'))) ?>">

            <button type="button" id="check-availability">Overiť dostupnosť</button>

            <br><br>
            <label for="time">Čas</label>
            <select name="time" id="casy">
                <option value="">Najprv over dostupnosť</option>
            </select>
            <input type="text" name="meno" id="meno" placeholder="Vaše meno a priezvisko" required>

            <input type="hidden" name="api" value="<?= htmlspecialchars($api) ?>">
        

            <button type="submit" id="submit-booking">Rezervovať</button>
        </form>

        <div id="loader-ajax-rez" style="display: none; position: absolute; top: 50%; transform: translate(50%, 50%); right: 50%; background-color: rgba(128, 128, 128, 0.48); padding: 30px;">Načítavam...</div>
        <div id="availability-result"></div>

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
flatpickr("#date-ajax", {
    locale: "sk",
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d.m.Y",
    allowInput: false,
    minDate: new Date().fp_incr(1),
    //disable: fullDates,
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