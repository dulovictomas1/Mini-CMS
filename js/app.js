(function($) {

    $('#delete-form').on('submit', function(event) {
        return confirm("Určite chcete položku zmazať?");
    });


    var form = $('#datum-other');
    //input.focus();
    $('#vysledok').hide();

    form.on('submit', function(event){
        event.preventDefault();

        var req = $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            beforeSend: function() {
                $('#loader').show();
            }
        });     

        req.done(function(data) {
            console.log(data);

            $('#vysledok').show();
            let html = '';

            if (data.length === 0) {
                html = '<p>Žiadne rezervácie</p>'
            } else {
                data.forEach(function(item){
                    html += '<p>' + item.time + ' - ' + item.meno + '</p>';
                });
            }

            $('#vysledok').html(html);

        });
        
        req.always(function() {
            $('#loader').hide();
        });
    });







    const formrez = $('#booking-form');
    const loader = $('#loader-ajax-rez');
    const resultBox = $('#availability-result');
    const timeSelect = $('#casy');
    const name = $('#meno');
    const dateInput = $('#date-ajax');

    function loadAvailability() {

        //const date = $('#date-ajax').val();
        const date = dateInput.val();
        const api = formrez.find('input[name="api"]').val();

        if (!date) {
            resultBox.html('<p>Najprv vyber dátum.</p>');
            return;
        }

        loader.show();
        resultBox.html('');
        timeSelect.html('<option value="">Načítavam časy...</option>');

        $.ajax({
            url: 'inc/check-availability.php',
            type: 'POST',
            dataType: 'json',
            data: {
                date: date,
                api: api
            }
        })

        .done(function (data) {
           console.log(data);

           if (!data || data.date.length === 0) {
                timeSelect.html('<option value="">Žiadne voľné termíny</option>');
                html = '<p>Na zvolený dátum nie sú voľné termíny.</p>';
            } 
            else {
            timeSelect.empty();
           
           //timeSelect.append('<option value="">Vyberte si čas</option>');
        
           data.date.forEach(function(item){
                    timeSelect.append(
                        $('<option>', {
                            value: item,
                            text: item
                        })
                    );
                });
            }
           
        })

        .fail(function (xhr, status, error) {
            console.log('AJAX chyba:', status, error);
            console.log(xhr.responseText);
            resultBox.html('<p>Nastala chyba pri načítaní.</p>');
        })

        .always(function () {
            loader.hide();
        });

    };



dateInput.on('change', function () {
    loadAvailability();
});

$('#check-availability').on('click', function () {
    loadAvailability();
});




//Odoslanie rezervácie
formrez.on('submit', function (event) {
        event.preventDefault();

        loader.show();
        resultBox.html('');

        $.ajax({
            url: formrez.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: formrez.serialize()
        })
        .done(function (response) {
            if (response.success == true) {
                resultBox.html('<p>' + response.message + '</p>');
                //formrez[0].reset();
                timeSelect.html('<option value="">Najprv over dostupnosť</option>');
                name.val('');
            } else {
                resultBox.html('<p>' + response.message + '</p>');
            }
           console.log(response.message);
        })
        .fail(function (xhr, status, error) {
            console.log('AJAX chyba:', status, error);
            console.log(xhr.responseText);
            resultBox.html('<p>Nastala chyba pri načítaní.</p>');
        })
        .always(function () {
            loader.hide();
        });
    });





}(jQuery));