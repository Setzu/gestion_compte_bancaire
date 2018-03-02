/**
 * Created by david b. on 02/08/17.
 */

$(function() {

    $('span.span-tabs > div.div-tabs').attr('id', this.id + '1');
    $('div.tabs').tabs();

    var compte = $('#liste-compte').dataTable({
        "order": [[ 1, "desc" ]],
        // Définir ici autant de lignes que le nombre de <th> du tableau
        "columns": [
            null,
            null,
            null,
            {"orderable": false},
            {"orderable": false},
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
            "sZeroRecords": 'Vous ne possédez pas de compte.',
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

    function format(d) {
        var _return = '';
        // Parcours de l'ensemble des lignes du tableau
        $.each(d, function(key, value) {
            // Contrôle la <td> masquée du tableau qui comporte le détail (à modifier en cas d'ajout/suppression de <th> dans le tableau)
            // La clé commence à 0
            if(key == 7) {
                _return = value.replace('display-none', 'test');
            }
        });

        return _return;
    }
});