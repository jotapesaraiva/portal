var href = window.location.href;

    /*********************************************************************
    *********************************************************************/
var link = 0;
var max_fields = 3; //maximum input boxes allowed
var i = 1;
//Adiciona dinamicamente link não voips da unidade
$("#add_link").click(function(e){ //on add input button click
    e.preventDefault();
    i++;
    if(link < max_fields){ //max input box allowed
    link++; //text box increment
    var a = '';
    a += '<div class="form-group" id="remove_field_'+i+'">';
        a += '<input type="hidden" id=link value="" name="id_link[]"/>';
        a += '<label class="control-label col-md-3">Link :</label>';
            a += '<div class="col-md-9">';
                a += '<div class="input-group">';
                    a +='<div class="input-icon">';
                        a += '<select class="selectpicker form-control" id="link_'+i+'" name="link[]" >';
                        a += '<option value="">------Selecione um Link-----</option>';
                        $.ajax({
                            url : href+"/listar_link/",
                            type: "GET",
                            dataType: "JSON",
                            success: function(data) {
                                $.each(data, function(index,item) {
                                    $("#link_" + i).append('<option value="' + item.id_link + '">' + item.nome_link + '</option>').selectpicker("refresh");
                                });
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $("#link_" + i).html('<option id="-1">none available</option>');
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
    $("#wrapper_link_add").append(a);
    }
    $(".selectpicker").selectpicker('refresh'); //reset selectcpicker bootstrap
});

$("#wrapper_link_add").on("click",".remove_field", function(e){ //user click on remove text
    var button_id = $(this).attr("id");
    var id_link = $('link'+button_id).val();
    var id_unidade = $('unidade'+button_id).val();
    //console.log(id_contato);
    // if (id_unidade !=''){
    // delete_telefone(id_telefone,id_contato);
    // }
    e.preventDefault();
    //$(this).parent().parent().parent().parent().remove();
    $('#remove_field_'+button_id+'').remove();
    link--;
});