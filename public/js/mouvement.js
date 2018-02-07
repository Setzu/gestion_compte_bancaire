$(document).ready(function() {
    $("input[name='mensuel']").on('click', function () {
        if ($(this).prop('checked')) {
            $('#jour').fadeIn();
        } else {
            $('#jour option[value=01]').prop('selected', true);
            $('#jour').hide();
        }
    });
});