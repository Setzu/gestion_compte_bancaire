/**
 * Created by david b. on 02/08/17.
 */

$(function() {

    $('.tabs').tabs();

    function format(d) {
        var _return = '';
        // Parcours de l'ensemble des lignes du tableau
        $.each(d, function(key, value) {
            // Contrôle la td masquée du tableau qui comporte le détail (à modifier en cas d'ajout / suppression
            // de lignes dans le tableau
            if(key == 5) {
                _return = value.replace('display-none', '');
            }
        });
        return _return;
    }

    var compte = $('#liste-compte').dataTable({
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
        "iDisplayLength": 10,
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
        var row = compte.api().row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('.mouvement').dataTable({
        "order": [[ 4, "desc" ]],
        "sDom": 'lrtip',
        "bLengthChange": false,
        "iDisplayLength": 10,
        "language": {
            "paginate": {
                "previous": 'Précédent',
                "next": 'Suivant'
            },
            "sZeroRecords": "Aucun mouvement pour ce compte. Vous pouvez en ajouter en cliquant sur le <span class='glyphicon glyphicon-plus></span>",
            "sInfoEmpty": '(0)',
            "sInfoFiltered": '',
            "emptyTable": '',
            "info": '_TOTAL_ mouvement(s) au total pour ce compte'
        }
    });
});