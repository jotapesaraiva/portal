$(document).ready(function () {
    alerta_agendamento();
    content_agendamento();
});
function alerta_agendamento() {
    $.ajax({
        url : "https://producaoh.sefa.pa.gov.br/portal/gerencias/agendamento/alerta",
        type: "GET",
        dataType: "text",
        success: function(data) {
            if(data != 0){
                $('#agendamento').removeClass("badge-info").addClass('badge-danger');
                $('#agendamento').text(data); // Set title to Bootstrap modal title
                $('#count_agendamento').text(data); // Set title to Bootstrap modal title
            }else{
                $('#agendamento').removeClass("badge-info");
                $('#count_agendamento').text('0'); // Set title to Bootstrap modal title
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax agendamento');
        }
    });
    setTimeout('alerta_agendamento()', 30000);
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
                        html +=         '<a href="'+valor.id+'" target="_blank">';
                        html +=             '<span class="photo">';
                        html +=                 '<img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>';
                        html +=             '<span class="subject">';
                        html +=                 '<span class="from">'+valor.post_user+'</span>';
                        html +=                 '<span class="time">'+valor.start_date+' '+valor.stop_date+'</span>';
                        html +=            '</span>';
                        html +=             '<span class="message">'+valor.msg+'</span>';
                        html +=         '</a>';
                        html +=     '</li>';
                    });
                html += '</ul>';
                $("#content_msg").html(html);
            } else {
                var html = 'Sem mensagens :)';
                $("#content_agendamento").html(html);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax agendamento 2');
        }
    });
    setTimeout('content_agendamento()', 30000);
}