/**
 * Created by david on 02/08/17.
 */
$(document).ready(function() {

    function format(d) {
        var _return = '';
        // Parcours de l'ensemble des lignes du tableau
        $.each(d, function(key, value) {
            // Contrôle la td masquée du tableau qui comporte le détail
            if(key == 5) {
                _return = value.replace('display-none', '');
            }
        });
        return _return;
    }

    var table = $('#liste-compte').dataTable({
        "order": [[ 1, "asc" ]],
        // Définir ici autant de ligne que le tableau en possèdent
        "columns": [
            {"orderable": false},
            null,
            null,
            null,
            {"orderable": false},
            {
                "orderable": false,
                "defaultContent": ''
            }
        ],
        "sDom": 'lrtip',
        "bLengthChange": false,
        "iDisplayLength": 25,
        "language": {
            "paginate": {
                "previous": 'Précédent',
                "next": 'Suivant'
            },
            "sZeroRecords": "Vous ne possédez pas de compte.",
            "sInfoEmpty": '(0)',
            "sInfoFiltered": '',
            "emptyTable": '',
            "info": 'Vous possédez _TOTAL_ compte(s)'
        }
    });

    //Add event listener for opening and closing details
    $('#liste-compte tbody').on('click', 'td.detail', function() {
        var tr = $(this).closest('tr');
        var row = table.api().row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
});