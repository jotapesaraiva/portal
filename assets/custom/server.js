var server = window.location.href;
$(document).ready(function () {
atualiza_alertas_servidor();
});
    function atualiza_alertas_servidor() {

        $('#server_down_loading').hide();
        $('#server_down_content').show();

        var displayResources = $("#server_down_content");
        // displayResources.text("Loading data from JSON source...");

        $.ajax({
           url: "https://producaoh.sefa.pa.gov.br/portal/dash/server/",
           dataType: 'json',
           success: function (data) {
            // console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>Servidor</th><th>Serviço</th><th>IP</th><th>Tempo</th><th>Mantis</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr><td>" +
                        data[i].description+
                        "</td><td>" +
                        data[i].name +
                        "</td><td>" +
                        "<a href='https://x-oc-zabbix.sefa.pa.gov.br/zabbix/latest.php?filter_set=1&hostids[]="+data[i].id+"' target='_blank'>"+data[i].ip+"</a>"+
                        "</td><td>" +
                        data[i].duration +
                        "</td><td>" +
                        "<a href='http://intranet2.sefa.pa.gov.br/mantis/view.php?id="+data[i].id+"' target='_blank'>"+data[i].type+"</a>"+
                        "</td><tr>";
                    }
                    output += "</tbody></table>";
            displayResources.html(output);
           }
        });
            setTimeout('atualiza_alertas_servidor()', 30000);
    }