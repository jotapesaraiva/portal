$(document).ready(function () {
    var table = $('#table1').DataTable( {
        "dom": "flrtip",
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        // "ajax": "https://producaoh.sefa.pa.gov.br/portal/links/chamado_links/teste/",
        "autoWidth": false,
        // setup buttons extentension: http://datatables.net/extensions/buttons/
        "buttons": [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [ 'pdf', 'csv', 'copy', 'excel' ]
        }],
        // "order": [[2, 'desc']],
        //Set column definition initialisation properties.
        "columnDefs": [{
              "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },],
    });

    $("#btn-pdf").on('click', function() {
        table1.button( '0-0' ).trigger();
    });
    $('#btn-csv').on('click', function() {
        table1.button( '0-3' ).trigger();
    });
    $('#btn-print').on('click', function() {
        table1.button( '0-2' ).trigger();
    });
    $('#btn-excel').on('click', function() {
        table1.button( '0-1' ).trigger();
    });

});