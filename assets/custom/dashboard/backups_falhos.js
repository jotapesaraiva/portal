var origin = window.location.origin;
$(document).ready(function () {
atualiza_alertas_backups();
});
    function atualiza_alertas_backups() {

        $('#backups_down_loading').hide();
        $('#backups_down_content').show();

        var displayResources = $("#backups_down_content");
        // displayResources.text("Loading data from JSON source...");

        $.ajax({
           url: origin+"/dash/backups_falhos/",
           dataType: 'json',
           success: function (data) {
            // console.log(data);
            var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>Sessão</th><th>Inicio</th><th>Status</th><th>Backup</th><th>Mantis</th></thead><tbody>';
                    for (var i in data) {
                      output +=
                        "<tr "+data[i].flag+"><td>" +
                        data[i].data+
                        "</td><td>" +
                        data[i].inicio +
                        "</td><td>" +
                        data[i].status +
                        "</td><td>" +
                        data[i].backup +
                        "</td><td>" +
                        data[i].mantis+
                        "</td><tr>";
                    }
                    output += "</tbody></table>";
            displayResources.html(output);
           }
        });
            setTimeout('atualiza_alertas_backups()', 30000);
    }