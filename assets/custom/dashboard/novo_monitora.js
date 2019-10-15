var origin = window.location.origin;
$(document).ready(function () {
atualiza_alertas_novomonitora();
});
    function atualiza_alertas_novomonitora() {

        $('#novomonitora_down_loading').hide();
        $('#novomonitora_down_content').show();

        var displayResources = $("#novomonitora_down_content");
        // displayResources.text("Loading data from JSON source...");

        $.ajax({
           url: origin+"/dash/novo_monitora/",
           dataType: 'json',
           success: function (data) {
            // console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>Resumo</th><th>Aplicação</th><th>Metrica</th><th>Tempo</th><th>Mantis</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr "+data[i].flag+"><td>" +
                        data[i].resumo +
                        "</td><td>" +
                        data[i].aplicacao +
                        "</td><td>" +
                        data[i].metrica +
                        "</td><td>" +
                        data[i].duration +
                        "</td><td>" +
                        data[i].mantis +
                        "</td><tr>";
                    }
                    output += "</tbody></table>";
            displayResources.html(output);
           }
        });
            setTimeout('atualiza_alertas_novomonitora()', 30000);//30segundos
    }