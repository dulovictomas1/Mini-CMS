(function($) {

    $('#delete-form').on('submit', function(event) {
        return confirm("Určite chcete položku zmazať?");
    })

}(jQuery));