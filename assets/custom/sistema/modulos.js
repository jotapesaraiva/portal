var href = window.location.href;
$(document).ready(function() {

    $.ajax({
        url: href+"/portal/sistema/modulos/listar",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $.each(data, function(index, value){
                $('#'+value+'').bootstrapSwitch('state', true);
                $('#'+value+'').bootstrapSwitch('disabled', true);
            });
        }
    });

});

function save(){
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
        url = href+"/modulos_update";

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Modulo alterado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_form').modal('hide');

            $('#btnSave').text('Alterar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao adicionar / editar dados');
            $('#btnSave').text('Alterar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}