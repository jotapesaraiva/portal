var save_method; //for save method string
var table;
var server = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
      // "dom": 'T<"clear">lfrtip', //initialize tableTools
      "dom": "flrtip",
      // "dom": "Rlfrtip",
      // "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
      "responsive": true,   // enable responsive
      // "processing": true, //Feature control the processing indicator.
      // "serverSide": true, //Feature control DataTables' server-side processing mode.
      "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
      "ajax": {
          url : server+"/fornecedor_list",//json datasource
          type : 'GET', //type of method  , by default would be get
          error: function(){ // error handling code
            $("#employee_grid_processing").css("display","none");
          },
      },
      "autoWidth": false,

      // setup buttons extentension: http://datatables.net/extensions/buttons/
      "buttons": [{
                  extend: 'collection',
                  text: 'Export',
                  buttons: [ 'pdf', 'csv', 'print', 'excel' ]
      }],
      "order": [[0, 'asc']],
      //Set column definition initialisation properties.
      "columnDefs": [{
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
      ],
    });

    $("#btn-pdf").on('click', function(){
        table.button( '0-0' ).trigger();
    });
    $('#btn-csv').on('click', function(){
        table.button( '0-3' ).trigger();
    });
    $('#btn-print').on('click', function(){
        table.button( '0-2' ).trigger();
    });
    $('#btn-excel').on('click', function(){
        table.button( '0-1' ).trigger();
    });
    $.jMaskGlobals.watchDataMask = true;

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $('.selectpicker').on('change', function () {
        //$(this).parent().parent().addClass('olha eu aqui');
        //$(this).parents("div[class=form-group]").removeClass('has-error');
        $(this).parent().parent().parent().removeClass('has-error');
        $(this).next().next().empty();
    });
    $('a[href="<?php echo current_url();?>"]').click(function (e) {
        e.preventDefault();
        $('li.nav-item').removeClass('active open');
        // $('').removeChild('<span class="selected"></span>');
        $(this).parents('li').addClass('active open');
        // $(this).append('<span class="selected"></span>');
        // alert("mudou !!!!");
    });
});
/*********************************************************************
*********************************************************************/
var telefones = 0;
var max_fields = 3; //maximum input boxes allowed
var i=1;
//Adiciona dinamicamente telefones não voips da unidade
$("#add_telefone").click(function(e) { //on add input button click
    e.preventDefault();
    i++;
    if(telefones < max_fields) { //max input box allowed
        telefones++; //text box increment
        var a = '';
        a += '<div class="form-group" id="remove_field_'+i+'">';
            a += '<input type="hidden" value="" id=telefone name="id_telefone[]"/>';
            a += '<label class="control-label col-md-3">Telefone :</label>';
            a += '<div class="col-md-9">';
                a += '<div class="input-group">';
                    a += '<div class="input-icon">';
                        a += '<input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" data-mask="(00) 0000-0000" placeholder="Numero do telefone" type="text">';
                    a += '</div>';
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
$("#wrapper_telefone_add").on("click",".remove_field", function(e) { //user click on remove text
    var button_id = $(this).attr("id");
    id_telefone = document.getElementById('telefone').value;
    id_fornecedor = document.getElementById('fornecedor').value;
    //console.log(id_fornecedor);
    if(id_fornecedor != '') {
        delete_telefone(id_telefone,id_fornecedor);
    }
    e.preventDefault();
    //$(this).parent().parent().parent().parent().remove();
    $('#remove_field_'+button_id+'').remove();
    telefones--;
});

/*********************************************************************
*********************************************************************/
var celular = 0;
var max_fields = 3; //maximum input boxes allowed
var i=1;
//Adiciona dinamicamente celular não voips da unidade
$("#add_celular").click(function(e) { //on add input button click
    e.preventDefault();
    i++;
    if(celular < max_fields) { //max input box allowed
        celular++; //text box increment
        var a = '';
        a += '<div class="form-group all" id="remove_field_'+i+'">';
            a += '<input type="hidden" value="" id=celular name="id_celular[]"/>';
            a += '<label class="control-label col-md-3">Celular :</label>';
            a += '<div class="col-md-9">';
                a += '<div class="input-group">';
                    a += '<div class="input-icon">';
                        a += '<input style="padding: 6px 12px !important;" class="form-control" name="celular[]" data-mask="(00) 00000-0000" placeholder="Numero do celular" type="text">';
                    a += '</div>';
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
$("#wrapper_celular_add").on("click",".remove_field", function(e) { //user click on remove text
    var button_id = $(this).attr("id");
    id_telefone = document.getElementById('celular').value;
    id_fornecedor = document.getElementById('fornecedor').value;
    //console.log(id_fornecedor);
    if(id_fornecedor != '') {
        delete_telefone(id_telefone,id_fornecedor);
    }
    //delete_telefone(id);
    e.preventDefault();
    //$(this).parent().parent().parent().parent().remove();
    $('#remove_field_'+button_id+'').remove();
    celular--;
});

 /*********************************************************************
 *********************************************************************/

function add_person() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $("div[id*=remove_field]").remove();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_fornecedor').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar fornecedor'); // Set Title to Bootstrap modal title
}

function edit_person(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $("div[id*=remove_field]").remove();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : server+"/fornecedor_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.fornecedor.id_fornecedor);
            $('[name="nome_fornecedor"]').val(data.fornecedor.nome_fornecedor);
            $('[name="website"]').val(data.fornecedor.website_fornecedor);
            $('[name="email"]').val(data.fornecedor.email_fornecedor);
            $('[name="endereco"]').val(data.fornecedor.endereco_fornecedor);
            $('[name="servico"]').val(data.fornecedor.id_servico);
            $('[name="comentario"]').val(data.fornecedor.comentario_fornecedor);
            if(data.fornecedor.status_fornecedor == '1') {
                $('[name="status"]').bootstrapSwitch('state', true);
            } else {
                $('[name="status"]').bootstrapSwitch('state', false);
            }
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
            $('#modal_fornecedor').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar fornecedor'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax');
        }
    });
}

//==================================================================================
//==================================================================================
//==================================================================================

function view_person(id) {
    $('#form_1')[0].reset(); // reset form on modals
    $('#form_2')[0].reset(); // reset form on modals

    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $("div[id*=field_contato]").remove();
    // $('#remove_field_'+button_id+'').remove();
    $("div[id*=field_telefone]").remove();
    $("div[id*=field_celular]").remove();
    // $("#field_telefone_1").remove();
    // $("#field_telefone_2").remove();
    // $("#field_telefone_3").remove();
    // $("#field_telefone_4").remove();
    // $("#field_celular_1").remove();
    // $("#field_celular_2").remove();
    // $("#field_celular_3").remove();
    // $("#field_celular_4").remove();

    // $('.form-group').removeClass('has-error'); // clear error class
    // $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : server+"/fornecedor_view/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            // $('[name="id"]').val(data.fornecedor.id_fornecedor);
            $('[name="nome_fornecedor"]').val(data.fornecedor.nome_fornecedor);
            $('[name="website"]').val(data.fornecedor.website_fornecedor);
            $('[name="email"]').val(data.fornecedor.email_fornecedor);
            $('[name="endereco"]').val(data.fornecedor.endereco_fornecedor);
            $('[name="servico"]').val(data.fornecedor.id_servico);
            $('[name="comentario"]').val(data.fornecedor.comentario_fornecedor);
            if(data.fornecedor.status_fornecedor == '1') {
                $('[name="status"]').bootstrapSwitch('state', true);
            } else {
                $('[name="status"]').bootstrapSwitch('state', false);
            }
            // $('name="fornecedor"').selectpicker('val', data.contato.id_fornecedor.);
//************************************************TELEFONE**********************************************************************
       if(data.telefone == null) {
           $('[name="telefone[]"]').val('');
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
                         a += '<div class="form-group" id="field_telefone_'+indice+'">';
                             a += '<input type="hidden" value="'+valor.id_telefone+'" id=telefone name="id_telefone[]"/>';
                             a += '<label class="control-label col-md-2">Telefone :</label>';
                             a += '<div class="col-md-6">';
                                     a += '<input class="form-control" name="telefone[]" value="'+valor.numero_telefone+'" disabled="" data-mask="(00) 0000-0000" type="text">';
                             a += '</div>';
                         a += '</div>';
                        $("#view_telefone_add").append(a);
                   }
               });
               }
           }

        //************************************************CELULAR**********************************************************************
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
                     // console.log(indice);
                     if(indice == 0){
                         $('[name="celular[]"]').val(valor.numero_telefone);
                         $('[name="id_celular[]"]').val(valor.id_telefone);
                     } else {
                        var a = '';
                        a += '<div class="form-group" id="field_celular_'+indice+'">';
                            a += '<input type="hidden" value="'+item.id_telefone+'" id=celular name="id_celular[]"/>';
                            a += '<label class="control-label col-md-2">Celular :</label>';
                            a += '<div class="col-md-6">';
                                    a += '<input class="form-control" name="celular[]" value="'+item.numero_telefone+'" disabled="" data-mask="(00) 00000-0000" type="text">';
                            a += '</div>';
                        a += '</div>';
                       $("#view_celular_add").append(a);
                     }
                 });
                 }
             }

        //************************************************CONTATO**********************************************************************

        if(data.contato == null) {
          $('nome_contato').val('');
          $('email_contato').val('');
          $('telefone_contato').val('');
          $('celular_contato').val('');
        } else {
            $.each(data.contato, function(indice,valor) {
                if(indice == 0) {
                    $('[name="nome_contato"]').val(valor.nome_contato);
                    $('[name="email_contato"]').val(valor.email_contato);
                    $('[name="telefone_contato[]"]').val(valor.telefone_contato);
                    $('[name="celular_contato[]"]').val(valor.celular_contato);
                } else {
                // console.log(valor.nome_contato);
                  var a = '';
                  a += '<div  id="field_contato'+indice+'">';
                  a += '<hr>';
                  a += '<div class="form-group">';
                  a += '    <input type="hidden" name="id_contato" value="'+valor.id_contato+'"/>';
                  a += '    <label class="col-md-1 control-label">Nome: </label>';
                  a += '    <div class="col-md-5">';
                  a += '        <input type="text" name="nome_contato" value="'+valor.nome_contato+'" class="form-control" disabled="" >';
                  a += '    </div>';
                  a += '    <label class="col-md-2 control-label">Email: </label>';
                  a += '    <div class="col-md-4">';
                  a += '        <input type="text" name="email_contato" value="'+valor.email_contato+'" class="form-control" disabled="" >';
                  a += '    </div>';
                  a += '</div>';
                  a += '<div class="form-group">';
                  a += '    <label class="col-md-1 control-label">Telefone: </label>';
                  a += '    <div class="col-md-5">';
                  a += '        <input type="text" name="telefone_contato" value="'+valor.telefone_contato+'" class="form-control" disabled="" >';
                  a += '    </div>';
                  a += '    <label class="col-md-2 control-label">Celular: </label>';
                  a += '    <div class="col-md-4">';
                  a += '        <input type="text" name="celular_contato" value="'+valor.celular_contato+'" class="form-control" disabled="" >';
                  a += '    </div>';
                  a += '</div>';
                  a += '</div>';
                  $("#view_contato_add").append(a);
                }
            });
        }

            $('#modal_fornecedor_view').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Informação da Empresa'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax');
        }
    });
}

//==================================================================================
//==================================================================================
//==================================================================================



function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}

function save(){
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        //url = "<?php //echo site_url('site/ajax_add')?>";
        url = server+"/fornecedor_add";
    } else {
        url = server+"/fornecedor_update";
    }
    //console.log($('#form').serialize());
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status){ //if success close modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Fornecedor adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_fornecedor').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parents("div[class=form-group]").addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').siblings(".help-block").text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Salvo'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao adicionar / editar dados');
            $('#btnSave').text('Salvar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function delete_person(id){
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : server+"/fornecedor_delete"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Fornecedor deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_fornecedor').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar dados');
            }
        });

    }
}

function delete_telefone(id_telefone,id_fornecedor) {
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : server+"/fornecedor_telefone_delete/"+id_telefone+"/"+id_fornecedor,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                //$('#modal_fornecedor').modal('hide');
                //reload_table();
                alert("excluido com sucesso!!!!");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar dados');
            }
        });
    }
}
