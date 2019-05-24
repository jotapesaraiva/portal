var save_method; //for save method string
var table;
var server = window.location.href; // https://portalh.sefa.pa.gov.br/usuarios/lista
var base_url = window.location.origin; // https://portalh.sefa.pa.gov.br
var host = window.location.host; // https://portalh.sefa.pa.gov.br
$(document).ready(function() {
    table = $('#table').DataTable({
      "dom": "flrtip",
      "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
      "ajax": {
          url : server+"/usuarios_list",//json datasource
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
      "order": [[1, 'asc']],
      //Set column definition initialisation properties.
      "columnDefs": [{
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
      },],
    });

    $("#btn-pdf").on('click', function() {
        table.button( '0-0' ).trigger();
    });
    $('#btn-csv').on('click', function() {
        table.button( '0-3' ).trigger();
    });
    $('#btn-print').on('click', function() {
        table.button( '0-2' ).trigger();
    });
    $('#btn-excel').on('click', function() {
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
          $(this).parent().parent().parent().removeClass('has-error');
          $(this).next().next().empty();
      });


    var availableTags  =  [
       "ActionScript",
       "Bootstrap",
       "C",
       "C++",
    ];
    $('#complete').autocomplete({
    source: availableTags
    // source: function( request, response ) {
    //     $.ajax({
    //         url : 'http://10.3.3.96/portal/auth/searchad',
    //         dataType: "json",
    //         data: {
    //            name_startsWith: request.term,
    //            //type: 'country'
    //         },
    //          success: function( data ) {
    //              response( $.map( data, function( item ) {
    //                 return {
    //                     label: item,
    //                     value: item
    //                 }
    //             }));
    //         }
    //     });
    // },
    // autoFocus: true,
    // minLength: 2,
    // appendTo: $('#modal_usuario')
  });
});

  //   $( "#complete" ).autocomplete({
  //     source: function( request, response ) {
  //       $.ajax({
  //         url: "http://gd.geobytes.com/AutoCompleteCity",
  //         dataType: "jsonp",
  //         data: {
  //           q: request.term
  //         },
  //         success: function( data ) {
  //           response( data );
  //         }
  //       });
  //     },
  //     minLength: 3,
  //     select: function( event, ui ) {
  //       log( ui.item ?
  //         "Selected: " + ui.item.label :
  //         "Nothing selected, input was " + this.value);
  //     },
  //     open: function() {
  //       $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
  //     },
  //     close: function() {
  //       $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
  //     }
  //   });
  // });

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
            a += '<input type="hidden" value="" id="voip_'+i+'" name="id_voip[]"/>';
            a += '<label class="control-label col-md-3">VoIP :</label>';
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
    id_voip = document.getElementById('voip').value;
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

/*********************************************************************
*********************************************************************/
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
                 a += '<label class="control-label col-md-3">Telefone :</label>';
                 a += '<div class="col-md-9">';
                     a += '<div class="input-group">';
                         a += '<input class="form-control" name="telefone[]" placeholder="Numero do telefone" data-mask="(00) 0000-0000" type="text">';
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

/*********************************************************************
*********************************************************************/
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
                    a += '<label class="control-label col-md-3">Celular :</label>';
                    a += '<div class="col-md-9">';
                        a += '<div class="input-group">';
                            a += '<input class="form-control" name="celular[]" placeholder="Numero do celular" data-mask="(00) 0000-00000" type="text">';
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
        $("#wrapper_celular_add").on("click",".remove_field", function(e){ //user click on remove text
            var button_id = $(this).attr("id");
            id_celular = document.getElementById('celular').value;
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

 /*********************************************************************
 *********************************************************************/

function add_person() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.group-input').val('');
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker
    $("div[id*=remove_field]").remove();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_usuario').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar usuario'); // Set Title to Bootstrap modal title
}

function edit_person(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.group-input').val('');
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $("div[id*=remove_field]").remove();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : server+"/usuarios_edit/" + id,
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
                $.each(data.telefone, function(index, item) {
                  if(i == 0) {
                      $('[name="telefone[]"]').val(item.numero_telefone);
                      $('[name="id_telefone[]"]').val(item.id_telefone);
                  } else {
                      var a = '';
                      a += '<div class="form-group" id="remove_field_'+index+'">';
                          a += '<input type="hidden" value="'+item.id_telefone+'" id=telefone name="id_telefone[]"/>';
                          a += '<label class="control-label col-md-3">Telefone :</label>';
                          a += '<div class="col-md-9">';
                              a += '<div class="input-group">';
                                  a += '<input class="form-control" name="telefone[]" value="'+item.numero_telefone+'" placeholder="Numero do telefone" data-mask="(00) 0000-0000" type="text">';
                                  a += '<span class="input-group-btn">';
                                      a += '<button class="btn red remove_field" id="'+index+'" type="button">';
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
                           a += '<div class="form-group" id="remove_field_'+indice+'">';
                               a += '<input type="hidden" value="'+valor.id_telefone+'" id=celular name="id_celular[]"/>';
                               // a += '<label class="control-label col-md-3">Celular :</label>';
                               a += '<div class="col-md-9 col-md-offset-3">';
                                   a += '<div class="input-group">';
                                       a += '<input class="form-control" name="celular[]" value="'+valor.numero_telefone+'" placeholder="Numero do celular" data-mask="(00) 00000-0000" type="text">';
                                       a += '<span class="input-group-btn">';
                                           a += '<button class="btn red remove_field" id="'+indice+'" type="button">';
                                               a += '<i class="fa fa-minus"></i>';
                                           a += '</button>';
                                       a += '</span>';
                                   a += '</div>';
                               a += '</div>';
                           a += '</div>';
                          $("#wrapper_celular_add").append(a);
                        }
                    });
                    }
                }

            // if(data.celular.length == 2) {
            //     //console.log(data.celular.length);
            //     $.each(data.celular, function(index, item) {
            //       //console.log(i);
            //       if(i == 0) {
            //           $('[name="celular[]"]').val(item.numero_telefone);
            //           $('[name="id_celular[]"]').val(item.id_telefone);
            //           //console.log(item.id_telefone);
            //           //console.log(item.numero_telefone);
            //       } else {
            //           //console.log(item.id_telefone);
            //           //console.log(item.numero_telefone);
            //           var a = '';
            //           a += '<div class="form-group" id="remove_field_'+index+'">';
            //               a += '<input type="hidden" value="'+item.id_telefone+'" id=celular name="id_celular[]"/>';
            //               a += '<label class="control-label col-md-3">Celular :</label>';
            //               a += '<div class="col-md-9">';
            //                   a += '<div class="input-group">';
            //                       a += '<input class="form-control" name="celular[]" value="'+item.numero_telefone+'" placeholder="Numero do celular" data-mask="(00) 00000-0000" type="text">';
            //                       a += '<span class="input-group-btn">';
            //                           a += '<button class="btn red remove_field" id="'+index+'" type="button">';
            //                               a += '<i class="fa fa-minus"></i>';
            //                           a += '</button>';
            //                       a += '</span>';
            //                   a += '</div>';
            //               a += '</div>';
            //           a += '</div>';
            //          $("#wrapper_celular_add").append(a);
            //       }
            //     });
            // } else {
            //   $.each(data.celular, function(i, item) {
            //       $('[name="celular[]"]').val(item.numero_telefone);
            //       $('[name="id_celular[]"]').val(item.id_telefone);
            //   });
            // }

            $('.selectpicker').selectpicker('refresh')// update in selectpicker bootstrap
            $('#modal_usuario').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar usuario'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax'+jqXHR.responseText);
        }
    });
}

function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}

function save(){
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = server+"/usuarios_add";
    } else {
        url = server+"/usuarios_update";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status) { //if success close modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Usuário adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_usuario').modal('hide');
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
            // console.log(jqXHR.responseText);
            alert('Erro ao adicionar / atualizar dados'+jqXHR.responseText);
            $('#btnSave').text('Salvar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function delete_person(id){
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : server+"/usuarios_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
                //if success reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Usuário deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_unidade').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Erro ao deletar os dados'+jqXHR.responseText);
            }
        });
    }
}

function delete_ramal(id_voip,id_usuario) {
  if(confirm('Você tem certeza que quer deletar o item?')) {
          // ajax delete data to database
          $.ajax({
              url : server+"/usuarios_delete_telefone/"+id_telefone+"/"+id_usuario,
              type: "POST",
              dataType: "JSON",
              success: function(data){
                  //if success reload ajax table
                  $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Usuário deletado com sucesso !!!</div>');
                  $("#myAlert").fadeOut(4000);
                  $('#modal_unidade').modal('hide');
                  reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown){
                  alert('Erro ao deletar os dados');
              }
          });
      }
}