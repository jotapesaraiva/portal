var href = window.location.href;

/*********************************************************************
*********************************************************************/
var voips = 0;
var max_fields = 3; //maximum input boxes allowed
var i = 100;
//Adiciona dinamicamente telefones não voips da unidade
$("#add_voip").click(function(e) { //on add input button click
    e.preventDefault();
    i++;
    if(voips < max_fields) { //max input box allowed
        voips++; //text box increment
        var a = '';
        a += '<div class="form-group" id="remove_field_'+i+'">';
            a += '<input type="hidden" id="voip_'+i+'" value="" name="id_voip[]"/>';
            a += '<label class="control-label col-md-3">VoIP :</label>';
                a += '<div class="col-md-9">';
                    a += '<div class="input-group">';
                        a +='<div class="input-icon">';
                            a += '<select class="selectpicker form-control" id="voip_'+i+'" name="voip[]" >';
                                a += '<option value="">------Selecione um VoIP-----</option>';
                                console.log(href+"/listar_voip/");
                                $.ajax({
                                    url : href+"/listar_voip/",
                                    type: "GET",
                                    dataType: "JSON",
                                    success: function(data) {
                                        $.each(data, function(index,item) {
                                            $("#voip_" + i).append('<option value="' + item.id_telefone + '">' + item.numero_telefone + '</option>').selectpicker("refresh");
                                        });
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        $("#voip_" + i).html('<option id="-1">none available</option>');
                                        alert('Erro ao pegar os dados do ajax'+jqXHR.responseText);
                                    }
                                });
                            a += '</select>';
                        a +='</div>';
                        a += '<span class="input-group-btn">';
                            a += '<button class="btn red remove_field" id="'+i+'" type="button">';
                                a += '<i class="fa fa-minus"></i>';
                            a += '</button>';
                        a += '</span>';
                    a += '</div>';
                a += '</div>';
        a += '</div>';

    $("#wrapper_voip_add").append(a);
    }
   $(".selectpicker").selectpicker('refresh'); //reset selectcpicker bootstrap
});
$("#wrapper_voip_add").on("click",".remove_field", function(e){ //user click on remove text
    var button_id = $(this).attr("id");
    var id_voip = $('#voip_'+button_id).val();
    if(id_voip != '') {
        var result = delete_telefone(id_voip,'voip');
        if(result) {
            e.preventDefault();
            $('#remove_field_'+button_id+'').remove();
            voips--;
        }
    } else {
        e.preventDefault();
        $('#remove_field_'+button_id+'').remove();
        voips--;
    }
});

   function delete_telefone(id_telefone,tipo) {
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : href+"/unidade_telefone_delete/"+id_telefone+"/"+tipo,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                //$('#modal_contato').modal('hide');
                //reload_table();
                alert("excluido com sucesso!!!!");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar dados'+jqXHR.responseText);
            }
        });
    }
}