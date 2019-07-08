var origin = window.location.origin;
$(document).ready(function () {
    quantidade_mantis();
    var table = $('#example').DataTable({
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": origin+"/dash/chamados_mantis/mantis_producao/",
        "order": [[4, 'desc']],
    });
    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 30000 );
});
    function chamados_mantis() {
        $('#chamados').modal('show'); // show bootstrap modal when complete loaded
    }

    function quantidade_mantis() {
        var num_mantis = $("#num_mantis");
        var ident = $("#quantidade");
        $.ajax({
            url: origin+"/dash/chamados_mantis/",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                for (var i in data) {
                    var nmantis = data[i].flag;
                    var output = data[i].QTD_MANTIS;
                }
                num_mantis.removeClass('red green').addClass(nmantis);
                ident.html(output);
            }
        });
        setTimeout('quantidade_mantis()', 30000);
    }