var server = window.location.href;
$(document).ready(function () {
atualiza_alertas_monitora();
});
    function atualiza_alertas_monitora() {

        $('#monitora_down_loading').hide();
        $('#monitora_down_content').show();

        var displayResources = $("#monitora_down_content");
        // displayResources.text("Loading data from JSON source...");

        $.ajax({
           url: "https://producaoh.sefa.pa.gov.br/portal/dash/antigo_monitora/",
           dataType: 'json',
           success: function (data) {
            // console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>Serviço</th><th>Servidor</th><th>Alerta</th><th>Tempo</th><th>Mantis</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr "+data[i].flag+"><td>" +
                        data[i].descricao +
                        "</td><td>" +
                        data[i].origem +
                        "</td><td>" +
                        data[i].metrica +
                        "</td><td>" +
                        data[i].data_completa +
                        "</td><td>" +
                        data[i].mantis +
                        "</td><tr>";
                    }
                    output += "</tbody></table>";
            displayResources.html(output);
           }
        });
            setTimeout('atualiza_alertas_monitora()', 30000);
    }