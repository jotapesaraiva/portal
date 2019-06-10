var origin = window.location.origin;
$(document).ready(function () {
atualiza_alertas_servidor();
});
    function atualiza_alertas_servidor() {

        $('#server_down_loading').hide();
        $('#server_down_content').show();

        var displayResources = $("#server_down_content");
        // displayResources.text("Loading data from JSON source...");

        $.ajax({
           url: origin+"/portal/dash/server/",
           dataType: 'json',
           success: function (data) {
            // console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>Serviço</th><th>Servidor</th><th>IP</th><th>Tempo</th><th>Mantis</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr "+data[i].flag+"><td>" +
                        data[i].servico+
                        "</td><td>" +
                        data[i].servidor +
                        "</td><td>" +
                        "<a href='http://zabbix.sefa.pa.gov.br/zabbix/search.php?search="+data[i].servidor+"' target='_blank'>"+data[i].ip+"</a>"+
                        "</td><td>" +
                        data[i].duration +
                        "</td><td>" +
                         data[i].mantis+
                        "</td><tr>";
                    }
                    output += "</tbody></table>";
            displayResources.html(output);
           }
        });
            setTimeout('atualiza_alertas_servidor()', 30000);
    }