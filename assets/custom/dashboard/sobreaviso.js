var origin = window.location.origin;
$(document).ready(function () {
    sobreaviso_new()
});
    function sobreaviso() {
        $('#sobreaviso').modal('show'); // show bootstrap modal when complete loaded
    }

    function sobreaviso_new() {
        $('#sobreaviso_table_loading').hide();
        $('#sobreaviso_table_content').show();
        var displayResources = $("#sobreaviso_table_content");
        // displayResources.text("Loading data from JSON source...");
        $.ajax({
           url: origin+"/dash/sobreaviso",
           dataType: 'json',
           success: function (data) {
            // console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>Equipe</th><th>Sobreaviso</th><th>Contato</th><th>Inicio</th><th>Fim</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr><td>" +
                        data[i].celula +
                        "</td><td>" +
                        data[i].nome +
                        "</td><td>" +
                        data[i].telefone +
                        "</td><td>" +
                        data[i].inicio +
                        "</td><td>" +
                        data[i].fim +
                        "</td><tr>";
                    }
                    output += "</tbody></table>";
            displayResources.html(output);
           }
        });
            setTimeout('sobreaviso_new()', 1800000 );//300000 - 5 minutos  30000 - 30 segundos 1800000 - 30 minutos
    }