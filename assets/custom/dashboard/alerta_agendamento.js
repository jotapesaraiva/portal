$(document).ready(function () {
    alerta_agendamento();
    content_agendamento();
    table_agendamento();
});
function alerta_agendamento() {
    $.ajax({
        url : "https://producaoh.sefa.pa.gov.br/portal/gerencias/agendamento/alerta",
        type: "GET",
        dataType: "text",
        success: function(data) {
            if(data != 0){
                $('#alerta_agendamento').removeClass("badge-info").addClass('badge-danger');
                $('#alerta_agendamento').text(data); // Set title to Bootstrap modal title
                $('#count_agendamento').text(data); // Set title to Bootstrap modal title
            }else{
                $('#alerta_agendamento').removeClass("badge-info");
                $('#count_agendamento').text('0'); // Set title to Bootstrap modal title
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax agendamento');
        }
    });
    setTimeout('alerta_agendamento()', 300000); // 5 minutos
}


function content_agendamento() {
    $.ajax({
        url : "https://producaoh.sefa.pa.gov.br/portal/gerencias/agendamento/conteudo",
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
             // setting a timeout
            var html = ' ';
            $("#content_agendamento").html(html);
         },
        success: function(data) {
            var html = '';
            if(data.length != 0) {
                html += '<ul class="dropdown-menu-list scroller"  data-handle-color="#637283">';
                    $.each(data, function(indice,valor) {
                        html +=     '<li>';
                        html +=         '<a href="https://producaoh.sefa.pa.gov.br/portal/gerencias/agendamento/" target="_blank">';
                        // html +=             '<span class="photo">';
                        // html +=                 '<img src="assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>';
                        html +=             '<span class="subject">';
                        html +=                 '<span class="from">'+valor.post_user+'</span>';
                        html +=                 '<span class="time">'+valor.stop_dc+'</span>';
                        html +=            '</span>';
                        html +=             '<span class="message">'+valor.msg+'</span>';
                        html +=         '</a>';
                        html +=     '</li>';
                    });
                html += '</ul>';
                $("#content_agendamento").html(html);
            } else {
                var html = 'Sem agendamento de tarefa :)';
                $("#content_agendamento").html(html);
            }
        },
        // error: function (jqXHR, textStatus, errorThrown) {
        //     // alert('Erro ao pegar os dados do ajax agendamento 2'+textStatus +' '+ errorThrown);
        //     alert('<p>status code: '+jqXHR.status+'</p><p>errorThrown: ' + errorThrown + '</p><p>jqXHR.responseText:</p><div>'+jqXHR.responseText + '</div>');
        // }
    });
    setTimeout('content_agendamento()', 300000); // 5 minutos
}

function table_agendamento() {
    $('#table_agendamento_loading').hide();
    $('#table_agendamento_content').show();
    var displayResources = $("#table_agendamento_content");
    // displayResources.text("Loading data from JSON source...");
    $.ajax({
       url: "https://producaoh.sefa.pa.gov.br/portal/gerencias/agendamento/conteudo",
       dataType: 'json',
       success: function (data) {
        // console.log(data);
        var output ='<table class="table table-hover"><thead><tr class="uppercase"><th>id</th><th>Nome</th><th>mensagem</th><th>responsavel</th><th>Inicio</th><th>Fim</th><th>mantis</th></thead><tbody>';
                for (var i in data) {
                  output +=
                    "<tr "+data[i].flag+"><td>" +
                    data[i].id +
                    "</td><td>" +
                    data[i].title +
                    "</td><td>" +
                    data[i].msg +
                    "</td><td>" +
                    data[i].post_user +
                    "</td><td>" +
                    data[i].start_dc +
                    "</td><td>" +
                    data[i].stop_dc +
                    "</td><td>" +
                    data[i].mantis +
                    "</td><tr>";
                }
                output += "</tbody></table>";
        displayResources.html(output);
       }
    });
        setTimeout('table_agendamento()', 300000 );//300000 - 5 minutos  30000 - 30 segundos 1800000 - 30 minutos
}