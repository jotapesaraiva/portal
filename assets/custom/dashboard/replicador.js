var origin = window.location.origin;
    //Ajax Load data from ajax
$(document).ready(function () {

    replicador();
    var table_replicador = $('#tbl_modal_replicador').DataTable({
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": origin+"/portal/dash/replicador/replic_table"
        // "order": [[2, 'desc']],
    });

    renvia();
    var table_replicador = $('#tbl_modal_renvia').DataTable({
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": origin+"/portal/dash/replicador/renvia_table"
        // "order": [[2, 'desc']],
    });

});

    function replicador() {
        $.ajax({
            url : origin+"/portal/dash/replicador/replic/",
            type: "GET",
            dataType: "text",
            success: function(data) {
                $('#replicador').text(data); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao pegar os dados do ajax');
            }
        });
        setTimeout('replicador()', 30000);
    }

    function replicador_full() {
        $('#modal_replicador').modal('show'); // show bootstrap modal when complete loaded
    }

    function renvia() {
        $.ajax({
            url : origin+"/portal/dash/replicador/renvia",
            type: "GET",
            dataType: "text",
            success: function(data) {
                $('#renvia').text(data); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao pegar os dados do ajax');
            }
        });
        setTimeout('renvia()', 30000);
    }

    function renvia_full() {
        $('#modal_renvia').modal('show'); // show bootstrap modal when complete loaded
    }

