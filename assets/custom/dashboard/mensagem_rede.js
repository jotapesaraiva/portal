$(document).ready(function () {
    alerta_msg();
    content_msg();
});

function alerta_msg() {
    $.ajax({
        url : "https://producaoh.sefa.pa.gov.br/portal/dash/mensagem_rede/alerta",
        type: "GET",
        dataType: "text",
        success: function(data) {
            if(data != 0){
                $('#mensagem_rede').removeClass("badge-info").addClass('badge-danger');
                $('#mensagem_rede').text(data); // Set title to Bootstrap modal title
                $('#count_msg').text(data); // Set title to Bootstrap modal title
            }else{
                $('#mensagem_rede').removeClass("badge-info");
                $('#count_msg').text('0'); // Set title to Bootstrap modal title
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax');
        }
    });
    setTimeout('alerta_msg()', 30000);
}


function content_msg() {
    $.ajax({
        url : "https://producaoh.sefa.pa.gov.br/portal/dash/mensagem_rede",
        type: "GET",
        dataType: "JSON",
        beforeSend: function() {
             // setting a timeout
            var html = ' ';
            $("#content_msg").html(html);
         },
        success: function(data) {
            var html = '';
            if(data.length != 0) {
                html += '<ul class="dropdown-menu-list scroller"  data-handle-color="#637283">';
                    $.each(data, function(indice,valor) {
                        html +=     '<li>';
                        html +=         '<a href="https://rede.sefa.pa.gov.br/msg/showmsg.php?id='+valor.id+'" target="_blank">';
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
                $("#content_msg").html(html);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax');
        }
    });
    setTimeout('content_msg()', 30000);
}