var server = window.location.href; // https://portalh.sefa.pa.gov.br/usuarios/lista
$(document).ready(function() {
        //Ajax Load data from ajax
        $.ajax({
            url : "https:producaoh.sefa.pa.gov.br/menu/meu_perfil/listar_usuarios",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_usuario"]').val(data.usuario.id_usuario);
                $('[name="nome"]').val(data.usuario.nome_usuario);
                $('[name="senha"]').val(data.usuario.senha_usuario);
                $('[name="login"]').val(data.usuario.login_usuario);
                $('[name="email"]').val(data.usuario.email_usuario);
                if(data.usuario.sobreaviso_usuario == '1') {
                    $('[name="sobreaviso"]').bootstrapSwitch('state', true);
                } else {
                    $('[name="sobreaviso"]').bootstrapSwitch('state', false);
                }
                if(data.usuario.status_usuario == '1') {
                    $('[name="status"]').bootstrapSwitch('state', true);
                } else {
                    $('[name="status"]').bootstrapSwitch('state', false);
                }
                $('[name="permissao"]').val(data.usuario.id_permissao);
                $('[name="cargo"]').val(data.usuario.id_cargo);
                $('[name="grupo"]').val(data.usuario.id_grupo);
                              if(data.telefone.length == 2) {
                                  $.each(data.telefone, function(i, item) {
                                    if(i == 0) {
                                        $('[name="telefone[]"]').val(item.numero_telefone);
                                        $('[name="id_telefone[]"]').val(item.id_telefone);
                                    } else {
                                        var a = '';
                                        a += '<div class="form-group" id="remove_field_'+i+'">';
                                            a += '<input type="hidden" value="'+item.id_telefone+'" id=telefone name="id_telefone[]"/>';
                                            a += '<label class="control-label col-md-3">Telefone :</label>';
                                            a += '<div class="col-md-9">';
                                                a += '<div class="input-group">';
                                                    a += '<input class="form-control" name="telefone[]" value="'+item.numero_telefone+'" placeholder="Numero do telefone" data-mask="(00) 0000-0000" type="text">';
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
                              } else {
                                $.each(data.telefone, function(i, item) {
                                    $('[name="telefone[]"]').val(item.numero_telefone);
                                    $('[name="id_telefone[]"]').val(item.id_telefone);
                                });
                              }
                //************************************************CELULAR**********************************************************************
                              if(data.celular.length == 2) {
                                  //console.log(data.celular.length);
                                  $.each(data.celular, function(i, item) {
                                    //console.log(i);
                                    if(i == 0) {
                                        $('[name="celular[]"]').val(item.numero_telefone);
                                        $('[name="id_celular[]"]').val(item.id_telefone);
                                        //console.log(item.id_telefone);
                                        //console.log(item.numero_telefone);
                                    } else {
                                        //console.log(item.id_telefone);
                                        //console.log(item.numero_telefone);
                                        var a = '';
                                        a += '<div class="form-group" id="remove_field_'+i+'">';
                                            a += '<input type="hidden" value="'+item.id_telefone+'" id=celular name="id_celular[]"/>';
                                            a += '<label class="control-label col-md-3">Celular :</label>';
                                            a += '<div class="col-md-9">';
                                                a += '<div class="input-group">';
                                                    a += '<input class="form-control" name="celular[]" value="'+item.numero_telefone+'" placeholder="Numero do celular" data-mask="(00) 00000-0000" type="text">';
                                                    a += '<span class="input-group-btn">';
                                                        a += '<button class="btn red remove_field" id="'+i+'" type="button">';
                                                            a += '<i class="fa fa-minus"></i>';
                                                        a += '</button>';
                                                    a += '</span>';
                                                a += '</div>';
                                            a += '</div>';
                                        a += '</div>';
                                       $("#wrapper_celular_add").append(a);
                                    }
                                  });
                              } else {
                                $.each(data.celular, function(i, item) {
                                    $('[name="celular[]"]').val(item.numero_telefone);
                                    $('[name="id_celular[]"]').val(item.id_telefone);
                                });
                              }

                $('.selectpicker').selectpicker('refresh')// update in selectpicker bootstrap
                $('#modal_usuario').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar usuario'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao pegar os dados do ajax');
            }
        });
 });