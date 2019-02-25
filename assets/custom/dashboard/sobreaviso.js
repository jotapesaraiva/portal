$(document).ready(function () {
    var table = $('#tbl_sobreaviso').DataTable( {
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": "https://producaoh.sefa.pa.gov.br/portal/dash/sobreaviso/",
        "paging":   false,
        "searching": false,
        "ordering": false,
        "info":     false
        // "order": [[2, 'desc']],
    });
    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 30000 );
});
    function sobreaviso() {
        $('#sobreaviso').modal('show'); // show bootstrap modal when complete loaded
    }