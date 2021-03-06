var save_method; //for save method string
var table;
var href = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
      "processing": true, //Feature control the processing indicator.
      // "serverSide": true, //Feature control DataTables' server-side processing mode.
      "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
          url : href+"/perfil_list",//json datasource
          type : 'GET', //type of method  , by default would be get
          error: function(){ // error handling code
            $("#employee_grid_processing").css("display","none");
          },
      },
      // setup buttons extentension: http://datatables.net/extensions/buttons/
      "buttons": [{
                  extend: 'collection',
                  text: 'Export',
                  buttons: [ 'pdf', 'csv', 'copy', 'excel' ]
      }],
      "order": [[1, 'asc']],
      //Set column definition initialisation properties.
      "columnDefs": [{
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
      },],
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
    //set input/textarea/select event when change value, remove class error and remove text help block
});

    $('#membro').multiSelect({
       afterSelect: function(values) {
         url = href+"/membro_update";
         var form = {
            id_grupo: document.getElementById('grupo_membro').value,
            membro  : values
         };
         $.ajax({
             url : url,
             type: "POST",
             data: form,
             dataType: "JSON",
             success: function(data) {
                 if(data.status){ //if success close modal and reload ajax table
                     $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>perfil adicionado com sucesso !!!</div>');
                     $("#myAlert").fadeOut(4000);
                 } else if(data.nada) {
                    console.log('OK');
                 } else {
                     for (var i = 0; i < data.inputerror.length; i++) {
                         $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     }
                 }
                 $('#btnSave').text('Salvar'); //change button text
                 $('#btnSave').attr('disabled',false); //set button enable
             },
             error: function (jqXHR, textStatus, errorThrown) {
                 alert('Erro ao adicionar / editar dados');
                 $('#btnSave').text('Salvo'); //change button text
                 $('#btnSave').attr('disabled',false); //set button enable
             }
         });

       },
       afterDeselect: function(values) {
         url = href+"/membro_update";
         var form = {
            id_grupo: 11,
            membro  : values
         };
         $.ajax({
             url : url,
             type: "POST",
             data: form,
             dataType: "JSON",
             success: function(data) {
                 if(data.status){ //if success close modal and reload ajax table
                     $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>perfil adicionado com sucesso !!!</div>');
                     $("#myAlert").fadeOut(4000);
                 } else if(data.nada) {
                    console.log('OK');
                 }
                 else {
                     for (var i = 0; i < data.inputerror.length; i++) {
                         $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                     }
                 }
                 $('#btnSave').text('Salvar'); //change button text
                 $('#btnSave').attr('disabled',false); //set button enable
             },
             error: function (jqXHR, textStatus, errorThrown) {
                 alert('Erro ao adicionar / editar dados');
                 $('#btnSave').text('Salvo'); //change button text
                 $('#btnSave').attr('disabled',false); //set button enable
             }
         });
       }
    });

    $('#modulo').multiSelect();

    // function add_dynamic_input_field(count) {
    //     var button = '';
    //     if(count > 1) {
    //         button =    '<button class="btn red remove" id="'+$count+'" type="button">';
    //         button +=       '<i class="fa fa-times"></i>';
    //         button +=   '</button>';
    //     } else {
    //         button =    '<button class="btn red remove" id="'+$count+'" type="button">';
    //         button +=       '<i class="fa fa-times"></i>';
    //         button +=   '</button>';
    //     }
    //     output = '';
    //     output += '';

    //     $('#dynamic_field').append(output);
    // }

    // $(document).on('click', '#add_more', function(){
    //     count = count + 1;
    //     add_dynamic_input_field(count);
    // });

    // $(document).on('click', '.remove', function(){
    //     var row_id = $(this).attr("id");
    //     $('#row'+row_id).remove();
    // });

    function membro_group(id){
        save_method = 'membro';
        $('#form_membro')[0].reset(); // reset form on modals
        $('#membro').multiSelect('deselect_all');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        //Ajax Load data from ajax
            $.ajax({
            url : href+"/perfil_membro/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                    $('#grupo_membro').val(data.id_grupo);
                    $('#membro').multiSelect('select',data.id_usuario);

                    $('#modal_membros').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Lista de membros do grupo'); // Set title to Bootstrap modal title
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Erro ao pegar os dados do ajax');
                }
            });
    }

    function modulo_group(id){
        save_method = 'modulo';
        $('#form_modulo')[0].reset(); // reset form on modals
        $('#modulo').multiSelect('deselect_all');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        //Ajax Load data from ajax
        $.ajax({
            url : href+"/perfil_modulo/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                // console.log(data.id_modulo);
                $('#grupo').val(data.id_grupo);
                $('#modulo').multiSelect('select',data.id_modulo);

                $('#modal_modulos').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Lista de modulos do grupo'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao pegar os dados do ajax');
            }
        });
    }
    function reload_table() {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function save() {
        $('#btnSave').text('Salvando...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;
        if(save_method == 'membro') {
            $('#modal_membros').modal('hide');
        } else {
            url = href+"/modulo_update";
            form = $('#form_modulo').serialize();
            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: form,
                dataType: "JSON",
                success: function(data) {
                    if(data.status){ //if success close modal and reload ajax table
                        $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>perfil adicionado com sucesso !!!</div>');
                        $("#myAlert").fadeOut(4000);
                        $('#modal_modulos').modal('hide');
                        reload_table();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('Salvar'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Erro ao adicionar / editar dados');
                    $('#btnSave').text('Salvo'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }
    }

    function delete_person(id){
        if(confirm('Você tem certeza que quer deletar o item?')) {
            // ajax delete data to database
            $.ajax({
                url : href+"/perfil_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    //if success reload ajax table
                    $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>perfil deletado com sucesso !!!</div>');
                    $("#myAlert").fadeOut(4000);
                    $('#modal_perfil').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Erro ao deletar dados');
                }
            });

        }
    }
