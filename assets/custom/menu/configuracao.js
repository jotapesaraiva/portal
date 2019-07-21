var origin = window.location.origin; // https://portalh.sefa.pa.gov.br/usuarios/lista
$(document).ready(function() {
        //Ajax Load data from ajax
        $.ajax({
            url : origin+"/menu/meu_perfil/listar_usuarios",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_usuario"]').val(data.usuario.id_usuario);
                $('[name="nome"]').val(data.usuario.nome_usuario);
                $('[name="login"]').val(data.usuario.login_usuario);
                $('[name="email"]').val(data.usuario.email_usuario);
                $('[name="permissao"]').val(data.usuario.id_permissao);
                $('[name="cargo"]').val(data.usuario.id_cargo);
                $('[name="grupo"]').val(data.usuario.id_grupo);
                if(data.usuario.sobreaviso_usuario == '1') {
                    $('[name="sobreaviso"]').bootstrapSwitch('state', true);
                } else {
                    $('[name="sobreaviso"]').bootstrapSwitch('state', false);
                }
                $('[name="sobreaviso"]').bootstrapSwitch('disabled', true);

                if(data.usuario.status_usuario == '1') {
                    $('[name="status"]').bootstrapSwitch('state', true);
                } else {
                    $('[name="status"]').bootstrapSwitch('state', false);
                }
                $('[name="status"]').bootstrapSwitch('disabled', true);



                $.each(data.modulo, function(indice,valor) {
                    $.each(valor, function(index, value){
                        $('#'+value+'').bootstrapSwitch('state', true);
                        $('#'+value+'').bootstrapSwitch('disabled', true);
                    });
                });


                if(data.telefone == null) {
                    $('[name="telefone"]').val('');
                } else {
                    if(data.telefone.length == 1) {
                        $.each(data.telefone, function(indice,valor) {
                            $('[name="telefone[]"]').val(valor.numero_telefone);
                            $('[name="id_telefone[]"]').val(valor.id_telefone);
                        });
                    } else {
                        $.each(data.telefone, function(indice,valor) {
                            // console.log(indice);
                            if(indice == 0) {
                                $('[name="telefone[]"]').val(valor.numero_telefone);
                                $('[name="id_telefone[]"]').val(valor.id_telefone);
                            } else {
                                var a = '';
                                  a += '<div class="form-group" id="remove_field_'+i+'">';
                                      a += '<input type="hidden" value="'+valor.id_telefone+'" id=telefone name="id_telefone[]"/>';
                                      a += '<div class="col-md-9">';
                                          a += '<div class="input-group">';
                                              a += '<input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" value="'+valor.numero_telefone+'" placeholder="Numero do telefone" id="phone_with_ddd" type="text">';
                                              a += '<span class="input-group-btn">';
                                                  a += '<button class="btn red remove_field" id="'+i+'" type="button">';
                                                      a += '<i class="fa fa-minus"></i>';
                                                  a += '</button>';
                                              a += '</span>';
                                          a += '</div>';
                                      a += '</div>';
                                  a += '</div>';
                                 $("#wrapper_telefone_add").append(a);
                            }
                        });
                        }
                    }

                    if(data.celular == null) {
                        $('[name="celular[]"]').val('');
                    } else {
                        if(data.celular.length == 1){
                            $.each(data.celular, function(indice,valor) {
                                $('[name="celular[]"]').val(valor.numero_telefone);
                                $('[name="id_celular[]"]').val(valor.id_telefone);
                            });
                        }else{
                            $.each(data.celular, function(indice,valor) {
                                if(indice == 0){
                                    $('[name="celular[]"]').val(valor.numero_telefone);
                                    $('[name="id_celular[]"]').val(valor.id_telefone);
                                } else {
                                   var a = '';
                                   a += '<div class="form-group" id="remove_field_'+indice+'">';
                                       a += '<input type="hidden" value="'+valor.id_telefone+'" id="celular_'+indice+'" name="id_celular[]"/>';
                                           a += '<div class="input-group">';
                                               a += '<div class="input-icon">';
                                                    a += '<input style="padding: 6px 12px !important;" class="form-control" name="celular[]" value="'+valor.numero_telefone+'" id="cell" placeholder="Numero do celular" type="text">';
                                               a += '</div>';
                                               a += '<span class="input-group-btn">';
                                                   a += '<button class="btn red remove_field" id="'+indice+'" type="button">';
                                                       a += '<i class="fa fa-minus"></i>';
                                                   a += '</button>';
                                               a += '</span>';
                                           a += '</div>';
                                   a += '</div>';
                                  $("#wrapper_celular_add").append(a);
                                }
                            });
                            }
                        }


                        if(data.voip == null) {
                            $('[name="voip[]"]').selectpicker('val', '');
                        } else {
                            if(data.voip.length == 1){
                                $.each(data.voip, function(indice,valor) {
                                    $('[name="voip[]"]').selectpicker('val', valor.id_telefone);
                                });
                            }else{
                                $.each(data.voip, function(indice,valor) {
                                    // console.log(indice);
                                    if(indice == 0){
                                        $('[name="voip[]"]').selectpicker('val',valor.id_telefone);
                                    } else {
                                            var a = '';
                                            a += '<div class="form-group" id="remove_field_'+indice+'">';
                                                a += '<input type="hidden" value="'+valor.id_telefone+'" name="id_voip[]"/>';
                                                a += '<label class="control-label col-md-3">VoIP :</label>';
                                                    a += '<div class="col-md-9">';
                                                        a += '<div class="input-group">';
                                                            a +='<div class="input-icon">';
                                                                a += '<select class="selectpicker form-control" id="voip_'+indice+'" name="voip[]" >';
                                                                    a += '<option value="">------Selecione um VoIP-----</option>';
                                                                    $.ajax({
                                                                        url : origin+"/listar_voip/",
                                                                        type: "GET",
                                                                        dataType: "JSON",
                                                                        success: function(data) {
                                                                            $.each(data, function(index,item) {
                                                                                $("#voip_" + indice).append('<option value="' + item.id_telefone + '">' + item.numero_telefone + '</option>').selectpicker('val', valor.id_telefone);//.selectpicker("refresh");
                                                                            });
                                                                        },
                                                                        error: function (jqXHR, textStatus, errorThrown) {
                                                                            $("#voip_" + i).html('<option id="-1">none available</option>');
                                                                            alert('Erro ao pegar os dados do ajax');
                                                                        }
                                                                    });
                                                                a += '</select>';
                                                            a +='</div>';
                                                            a += '<span class="input-group-btn">';
                                                                a += '<button class="btn red remove_field" id="'+indice+'" type="button">';
                                                                    a += '<i class="fa fa-minus"></i>';
                                                                a += '</button>';
                                                            a += '</span>';
                                                        a += '</div>';
                                                    a += '</div>';
                                            a += '</div>';
                                        $("#wrapper_voip_add").append(a);
                                        //$('[id="voip_'+indice+'"]').selectpicker('val', valor.id_telefone);
                                    }
                                });
                            }
                        }


                $('.selectpicker').selectpicker('refresh')// update in selectpicker bootstrap
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao pegar os dados do ajax');
            }
        });

 });






















    var telefones = 0;
    var max_fields = 3; //maximum input boxes allowed
    var i=100;
    //Adiciona dinamicamente telefones não voips da unidade
    $("#add_telefone").click(function(e) { //on add input button click
        e.preventDefault();
        i++;
        if(telefones < max_fields) { //max input box allowed
            telefones++; //text box increment
            var a = '';
            a += '<div class="form-group all" id="remove_field_'+i+'">';
                a += '<input type="hidden" value="" id="telefone_'+i+'" name="id_telefone[]"/>';

                    a += '<div class="input-group">';
                        a += '<div class="input-icon">';
                            a += '<input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" placeholder="Numero do telefone" did="phone_with_ddd" type="text">';
                        a += '</div>';
                        a += '<span class="input-group-btn">';
                            a += '<button class="btn red remove_field" id="'+i+'" type="button">';
                                a += '<i class="fa fa-minus"></i>';
                            a += '</button>';
                        a += '</span>';
                    a += '</div>';
            a += '</div>';
            $("#wrapper_telefone_add").append(a);
        }
    });
    $("#wrapper_telefone_add").on("click",".remove_field", function(e) { //user click on remove text
        var button_id = $(this).attr("id");
        id_telefone = document.getElementById('telefone_'+button_id).value;
        if(id_telefone != '') {
            var result = delete_telefone(id_telefone,'telefone');
            if(result) {
                e.preventDefault();
                $('#remove_field_'+button_id+'').remove();
                telefones--;
            }
        } else {
            e.preventDefault();
            $('#remove_field_'+button_id+'').remove();
            telefones--;
        }

    });

    var celular = 0;
    var max_fields = 3; //maximum input boxes allowed
    var i=100;
    //Adiciona dinamicamente celular não voips da unidade
    $("#add_celular").click(function(e){ //on add input button click
        e.preventDefault();
        i++;
        if(celular < max_fields){ //max input box allowed
            celular++; //text box increment
            var a = '';
            a += '<div class="form-group all" id="remove_field_'+i+'">';
                a += '<input type="hidden" value="" id="celular_'+i+'" name="id_celular[]"/>';
                    a += '<div class="input-group">';
                        a += '<div class="input-icon">';
                            a += '<input style="padding: 6px 12px !important;" class="form-control" name="celular[]" placeholder="Numero do celular" did="cell" type="text">';
                        a += '</div>';
                        a += '<span class="input-group-btn">';
                            a += '<button class="btn red remove_field" id="'+i+'" type="button">';
                                a += '<i class="fa fa-minus"></i>';
                            a += '</button>';
                        a += '</span>';
                    a += '</div>';
            a += '</div>';
            $("#wrapper_celular_add").append(a);
        }
    });
    $("#wrapper_celular_add").on("click",".remove_field", function(e){ //user click on remove text
        var button_id = $(this).attr("id");
        id_celular = document.getElementById('celular_'+button_id).value;
        if(id_celular != '') {
            var result = delete_telefone(id_celular,'celular');
            if(result) {
                e.preventDefault();
                $('#remove_field_'+button_id+'').remove();
                celular--;
            }
        } else {
            e.preventDefault();
            $('#remove_field_'+button_id+'').remove();
            celular--;
        }

    });

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
                a += '<input type="hidden" value="" id="voip_'+i+'" name="id_voip[]"/>';

                    a += '<div class="col-md-9">';
                        a += '<div class="input-group">';
                            a +='<div class="input-icon">';
                                a += '<select class="selectpicker form-control" id="voip_'+i+'" name="voip[]" >';
                                    a += '<option value="">------Selecione um VoIP-----</option>';
                                    $.ajax({
                                        url : "/portal/localidades/unidade/listar_voip/",
                                        type: "GET",
                                        dataType: "JSON",
                                        success: function(data) {
                                            $.each(data, function(index,item) {
                                                $("#voip_" + i).append('<option value="' + item.id_telefone + '">' + item.numero_telefone + '</option>').selectpicker("refresh");
                                            });
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            $("#voip_" + i).html('<option id="-1">none available</option>');
                                            alert('Erro ao pegar os dados do ajax');
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
        id_voip = document.getElementById('voip_'+button_id).value;
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

function save_info(){
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url = origin+"/usuarios/lista/usuarios_update/";
    $.ajax({
        url: url,
        type: "POST",
        data: $('#info').serialize(),
        dataType: "JSON",
        success: function(data){
            if(data.status){
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Unidade adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                location.reload();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parents('div.form-group').addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').parents('div.form-group').find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        }
    //     error: function (jqXHR, textStatus, errorThrown) {
    //         alert('Erro ao adicionar / atualizar dados');
    //         $('#btnSave').text('Editar'); //change button text
    //         $('#btnSave').attr('disabled',false); //set button enable
    //     }
    });
}

function delete_telefone(id_telefone,tipo) {
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : origin+"/usuario_telefone_delete/"+id_telefone+"/"+tipo,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                //$('#modal_contato').modal('hide');
                //reload_table();
                alert("excluido com sucesso!!!!");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar dados');
            }
        });
        return true;
    } else {
        return false;
    }
}