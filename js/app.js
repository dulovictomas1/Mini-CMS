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

}(jQuery));