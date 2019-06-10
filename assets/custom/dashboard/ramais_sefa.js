var origin = window.location.origin;
$(document).ready(function () {
    var table = $('#tbl_ramais_sefa').DataTable( {
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": origin+"/portal/dash/ramais/sefa"
        // "order": [[2, 'desc']],
    });
});
    function ramais_sefa() {
        $('#ramais_sefa').modal('show'); // show bootstrap modal when complete loaded
    }