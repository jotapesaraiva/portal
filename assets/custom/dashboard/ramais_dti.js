$(document).ready(function () {
    var table = $('#tbl_ramais_dti').DataTable( {
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": "https://producaoh.sefa.pa.gov.br/portal/dash/ramais/dti"
        // "order": [[2, 'desc']],
    });
});
    function ramais_dti() {
        $('#ramais_dti').modal('show'); // show bootstrap modal when complete loaded
    }