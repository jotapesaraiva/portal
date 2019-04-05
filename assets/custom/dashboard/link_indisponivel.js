var server = window.location.href;
$(document).ready(function () {
atualiza_alertas_zabbix_link();
});
    function atualiza_alertas_zabbix_link() {

        $('#links_down_loading').hide();
        $('#links_down_content').show();

        var displayResources = $("#links_down_content");
        // displayResources.text("Loading data from JSON source...");

        $.ajax({
           url: "https://producaoh.sefa.pa.gov.br/portal/dash/link_indisponivel/",
           dataType: 'json',
           success: function (data) {
            console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>TICKET</th><th>NOME</th><th>FORNECEDOR</th><th>IP</th><th>TEMPO</th><th>MANTIS</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr "+data[i].flag+"><td>" +
                        "<a href='http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket="+data[i].ticket+"' target='_blank'>"+data[i].ticket+"</a>"+
                        "</td><td>" +
                        data[i].servidor +
                        "</td><td>" +
                        data[i].vendor +
                        "</td><td>" +
                        "<a href='https://x-oc-zabbix.sefa.pa.gov.br/zabbix/latest.php?filter_set=1&hostids[]="+data[i].hostid+"' target='_blank'>"+data[i].ip+"</a>"+
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
            setTimeout('atualiza_alertas_zabbix_link()', 30000);
    }