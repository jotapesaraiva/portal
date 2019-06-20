var save_method; //for save method string
var table;
var href = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
      "dom": "flrtip",
      // "dom": 'T<"clear">lfrtip', //initialize tableTools
      // "processing": true, //Feature control the processing indicator.
      "responsive": true,   // enable responsive
      // "serverSide": true, //Feature control DataTables' server-side processing mode.
      "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
          },
      "ajax": {
          url : href+"/unidades_list",//json datasource
          type : 'GET', //type of method  , by default would be get
          error: function(){ // error handling code
            $("#employee_grid_processing").css("display","none");
          },
      },
      // "search": {
      //   "caseInsensitive": false
      // },
      "autoWidth": false,
      // setup buttons extentension: http://datatables.net/extensions/buttons/
      "buttons": [{
                  extend: 'collection',
                  text: 'Export',
                  buttons: [ 'pdf', 'csv', 'print', 'excel' ]
      }],
      // "fixedColumns": true,
      "order": [[0, 'asc']],
      //Set column definition initialisation properties.
      "columnDefs": [{
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
      },{ "width": "15%", "targets": 0 },//id
      { "width": "9%", "targets": 1 },//telefone
      { "width": "4%", "targets": 2 },//voip
      { "width": "7%", "targets": 3 },//ip
      { "width": "7%", "targets": 4 },//designacao
      { "width": "14%", "targets": 5 },//tecnico
      { "width": "14%", "targets": 6 },//servidor
      { "width": "5%", "targets": 7 },//status
      { "width": "11%", "targets": 8 }],//acao
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
        $(this).parents('div.form-group').removeClass('has-error');
        $(this).parents('div.form-group').find('.help-block').empty();
    });
    $("textarea").change(function(){
        $(this).parents('div.form-group').removeClass('has-error');
        $(this).parents('div.form-group').empty();
    });
    $("select").change(function(){
        $(this).parents('div.form-group').removeClass('has-error');
        $(this).parents('div.form-group').find('.help-block').empty();
    });
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
            a += '<input type="hidden" id="telefone_'+i+'" name="id_telefone[]"/>';
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
   $("#add_celular").click(function(e) { //on add input button click
       e.preventDefault();
       i++;
       if(celular < max_fields) { //max input box allowed
           celular++; //text box increment
           var a = '';
           a += '<div class="form-group all" id="remove_field_'+i+'">';
               a += '<input type="hidden" id="celular_'+i+'" name="id_celular[]"/>';
               a += '<label class="control-label col-md-3">Celular :</label>';
               a += '<div class="col-md-9">';
                   a += '<div class="input-group">';
                       a += '<input class="form-control" name="celular[]" placeholder="Numero do celular" data-mask="(00) 00000-0000" type="text">';
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
            a += '<input type="hidden" id="voip_'+i+'" name="id_voip[]"/>';
            a += '<label class="control-label col-md-3">VoIP :</label>';
                a += '<div class="col-md-9">';
                    a += '<div class="input-group">';
                        a +='<div class="input-icon">';
                            a += '<select class="selectpicker form-control" id="voip_'+i+'" name="voip[]" >';
                                a += '<option value="">------Selecione um VoIP-----</option>';
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
    id_telefone = document.getElementById('voip').value;
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
        a += '<input type="hidden" id=link name="id_link[]"/>';
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
    id_link = document.getElementById('link').value;
    id_unidade = document.getElementById('unidade').value;
    //console.log(id_contato);
    // if (id_unidade !=''){
    // delete_telefone(id_telefone,id_contato);
    // }
    e.preventDefault();
    //$(this).parent().parent().parent().parent().remove();
    $('#remove_field_'+button_id+'').remove();
    link--;
});

//==================================================================================
//==================================================================================
//==================================================================================

function add_person() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker
    $("div[id*=remove_field]").remove();
    // $('input').val('');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_unidade').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar unidade'); // Set Title to Bootstrap modal title
}

//==================================================================================
//==================================================================================
//==================================================================================

function edit_person(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $("div[id*=remove_field]").remove();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : href+"/unidades_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id_unidade"]').val(data.unidade.id_unidade);
            $('[name="nome"]').val(data.unidade.nome_unidade);
            $('[name="endereco"]').val(data.unidade.endereco_unidade);
            $('[name="unidade"]').selectpicker('val', data.unidade.id_unidade_responsavel);
            if(data.unidade.status_unidade == '1') {
                $('[name="status"]').bootstrapSwitch('state', true);
            } else {
                $('[name="status"]').bootstrapSwitch('state', false);
            }
            $('[name="cidade"]').selectpicker('val', data.unidade.id_cidade);
            $('[name="expediente"]').selectpicker('val', data.unidade.id_expediente);
            $('[name="comentario"]').val(data.unidade.comentario_unidade);
            if(data.voip == null) {
                $('[name="voip[]"]').selectpicker('val', '');
            } else {
                if(data.voip.length == 1){
                    $.each(data.voip, function(indice,valor) {
                        $('[name="id_voip[]"]').val(valor.id_telefone);
                        $('[name="voip[]"]').selectpicker('val', valor.id_telefone);
                    });
                }else{
                    $.each(data.voip, function(indice,valor) {
                        // console.log(indice);
                        if(indice == 0){
                            $('[name="id_voip[]"]').val(valor.id_telefone);
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
                                                            url : href+"/listar_voip/",
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

/***************************************************************LINK*******************************************************************/
            if (data.link == null) {
                $('[name="link[]"]').selectpicker('val', '');
            } else {
                if(data.link.length == 1){
                    $.each(data.link, function(indice,valor) {
                        $('[name="link[]"]').selectpicker('val', valor.id_link);
                    });
                } else {
                    $.each(data.link, function(indice,valor) {
                        if(indice == 0) {
                            $('[name="link[]"]').selectpicker('val',valor.id_link);
                        } else {
                            var a = '';
                            a += '<div class="form-group" id="remove_field_'+indice+'">';
                                a += '<input type="hidden" value="'+indice+'" id=voip name="id_voip[]"/>';
                                a += '<label class="control-label col-md-3">Link :</label>';
                                    a += '<div class="col-md-9">';
                                        a += '<div class="input-group">';
                                            a +='<div class="input-icon">';
                                                a += '<select class="selectpicker form-control" id="link_'+indice+'" name="link[]" >';
                                                a += '<option value="">------Selecione um Link-----</option>';
                                                $.ajax({
                                                    url : href+"/listar_link/",
                                                    type: "GET",
                                                    dataType: "JSON",
                                                    success: function(data) {
                                                        $.each(data, function(index,item) {
                                                            $("#link_" + indice).append('<option value="' + item.id_link + '">' + item.nome_link + '</option>').selectpicker('val', valor.id_link);
                                                        });
                                                    },
                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                        $("#link_" + indice).html('<option id="-1">none available</option>');
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
                            $("#wrapper_link_add").append(a);
                        }
                    });
                }
            }

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
                  a += '<div class="form-group" id="remove_field_'+indice+'">';
                      a += '<input type="hidden" value="'+valor.id_telefone+'" id=telefone name="id_telefone[]"/>';
                      a += '<label class="control-label col-md-3">Telefone :</label>';
                      a += '<div class="col-md-9">';
                          a += '<div class="input-group">';
                              a += '<input class="form-control" name="telefone[]" value="'+valor.numero_telefone+'" placeholder="Numero do telefone" data-mask="(00) 0000-0000" type="text">';
                              a += '<span class="input-group-btn">';
                                  a += '<button class="btn red remove_field" id="'+indice+'" type="button">';
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
                       a += '<label class="control-label col-md-3">Celular :</label>';
                       a += '<div class="col-md-9">';
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

            $('#modal_unidade').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar unidade'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax'+jqXHR.responseText);
        }
    });
}

//==================================================================================
//==================================================================================
//==================================================================================

function view_person(id) {
    $('#form_1')[0].reset(); // reset form on modals
    $('#form_2')[0].reset(); // reset form on modals
    $('#form_3')[0].reset(); // reset form on modals
    $('#form_4')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $("div[id*=field_tecnico]").remove();
    $("div[id*=field_servidor]").remove();
    $("div[id*=field_voip]").remove();
    $("div[id*=field_link]").remove();
    $("div[id*=field_telefone]").remove();
    $("div[id*=field_celular]").remove();
    // $('#remove_field_'+button_id+'').remove();
    // $("#field_voip_1").remove();
    // $("#field_voip_2").remove();
    // $("#field_voip_3").remove();
    // $("#field_voip_4").remove();
    // $("#field_link_1").remove();
    // $("#field_link_2").remove();
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
        url : href+"/unidade_view/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id_unidade"]').val(data.unidade.id_unidade);
            $('[name="nome"]').val(data.unidade.nome_unidade);
            $('[name="endereco"]').val(data.unidade.endereco_unidade);
            $('[name="unidade"]').selectpicker('val', data.unidade.id_unidade_responsavel);
            if(data.unidade.status_unidade == '1') {
                $('[name="status"]').bootstrapSwitch('state', true);
            } else {
                $('[name="status"]').bootstrapSwitch('state', false);
            }
            $('[name="cidade"]').selectpicker('val', data.unidade.id_cidade);
            $('[name="expediente"]').selectpicker('val', data.unidade.id_expediente);
            $('[name="comentario"]').val(data.unidade.comentario_unidade);
            /******************************************************VOIP*****************************************************************************/
            if(data.voip == null) {
                $('[name="voip[]"]').selectpicker('val', '');
            } else {
                if(data.voip.length == 1){
                    $.each(data.voip, function(indice,valor) {
                        $('[name="voip[]"]').selectpicker('val', valor.id_telefone);
                    });
                }else{
                    $.each(data.voip, function(indice,valor) {
                        if(indice == 0){
                            $('[name="voip[]"]').selectpicker('val',valor.id_telefone);
                        } else {
                                var a = '';
                                a += '<div class="form-group" id="field_voip_'+indice+'">';
                                    a += '<input type="hidden" value="'+valor.id_telefone+'" name="id_voip[]"/>';
                                    a += '<label class="control-label col-md-2">VoIP :</label>';
                                        a += '<div class="col-md-6">';
                                                    a += '<select class="selectpicker form-control" id="voip_'+indice+'" name="voip[]" disabled>';
                                                        $.ajax({
                                                            url : href+"/listar_voip/",
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
                                        a += '</div>';
                                a += '</div>';
                            $("#view_voip_add").append(a);
                        }
                    });
                }
            }

            /******************************************************LINK*****************************************************************************/

            if (data.link == null) {
                $('[name="link[]"]').selectpicker('val', '');
                $('[name="designacao"]').val('');
                $('[name="lan"]').val('');
                $('[name="wan"]').val('');
                $('[name="acesso"]').selectpicker('val','');
                $('[name="fornecedor"]').selectpicker('val','');
            } else {
                if(data.link.length == 1){
                    $.each(data.link, function(indice,valor) {
                        $('[name="link[]"]').selectpicker('val', valor.id_link);
                        $('[name="designacao"]').val(valor.designacao_link);
                        $('[name="lan"]').val(valor.ip_lan_link);
                        $('[name="wan"]').val(valor.ip_wan_link);
                        $('[name="acesso"]').selectpicker('val',valor.id_tipo_acesso);
                        $('[name="fornecedor"]').selectpicker('val',valor.id_fornecedor);
                    });
                } else {
                    $.each(data.link, function(indice,valor) {
                        if(indice == 0) {
                            $('[name="link[]"]').selectpicker('val',valor.id_link);
                            $('[name="designacao"]').val(valor.designacao_link);
                            $('[name="lan"]').val(valor.ip_lan_link);
                            $('[name="wan"]').val(valor.ip_wan_link);
                            $('[name="acesso"]').selectpicker('val',valor.id_tipo_acesso);
                            $('[name="fornecedor"]').selectpicker('val',valor.id_fornecedor);
                        } else {
                            var a = '';
                            a += '<div id="field_link_'+indice+'">';
                            a += '<hr>';
                            a += '<div class="form-group">';
                                a += '<input type="hidden" value="'+indice+'"/>';
                                    a += '<label class="control-label col-md-2">Nome :</label>';
                                    a += '<div class="col-md-3">';
                                                a += '<select class="selectpicker form-control" id="link_'+indice+'" name="link[]" disabled>';
                                                $.ajax({
                                                    url : href+"/listar_link/",
                                                    type: "GET",
                                                    dataType: "JSON",
                                                    success: function(data) {
                                                        $.each(data, function(index,item) {
                                                            $("#link_" + indice).append('<option value="' + item.id_link + '">' + item.nome_link + '</option>').selectpicker('val', valor.id_link);
                                                        });
                                                    },
                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                        $("#link_" + indice).html('<option id="-1">none available</option>');
                                                        alert('Erro ao pegar os dados do ajax');
                                                    }
                                                });
                                                a += '</select>';
                                    a += '</div>';
                                    a += '<label class="control-label col-md-2">Designação :</label>';
                                    a += '<div class="col-md-3">';
                                      a +='   <input name="designacao" type="text" class="form-control" disabled="" value="'+ valor.designacao_link +'">'
                                    a += '</div>';
                            a += '</div>';

                                  a +=   '<div class="form-group">';
                               a +=          '<label class="col-md-2 control-label">IP Lan: </label>';
                                  a +=       '<div class="col-md-3">';
                                   a +=          '<input name="lan" type="text" class="form-control" disabled="" value="'+ valor.ip_lan_link +'">';
                                 a +=        '</div>';
                                  a +=       '<label class="col-md-2 control-label">IP Wan: </label>';
                                   a +=      '<div class="col-md-3">';
                                   a +=          '<input name="wan" type="text" class="form-control" disabled="" value="'+ valor.ip_wan_link +'">';
                                   a +=      '</div>';
                                   a +=  '</div>';

                                   a += '<div class="form-group">';
                                   a +=     '<label class="col-md-2 control-label">Tipo de Acesso: </label>';
                                   a +=     '<div class="col-md-3">';
                                   a +=           '<select class="selectpicker form-control" id="acesso_'+indice+'" name="acesso" disabled>';
                                                       $.ajax({
                                                           url : href+"/listar_acesso",
                                                           type: "GET",
                                                           dataType: "JSON",
                                                           success: function(data) {
                                                               $.each(data, function(index,item) {
                                                                   $("#acesso_" + indice).append('<option value="' + item.id_tipo_acesso + '">' + item.nome_tipo_acesso + '</option>').selectpicker('val', valor.id_tipo_acesso);
                                                               });
                                                           },
                                                           error: function (jqXHR, textStatus, errorThrown) {
                                                               $("#acesso_" + indice).html('<option id="-1">none available</option>');
                                                               alert('Erro ao pegar os dados do ajax');
                                                           }
                                                       });
                                   a +=           '</select>';
                                   a +=     '</div>';
                                   a +=     '<label class="col-md-2 control-label">Fornecedor: </label>';
                                   a +=     '<div class="col-md-3">';
                                   a +=         '<select class="selectpicker form-control" id="fornecedor_'+indice+'" name="fornecedor" disabled>';
                                                     $.ajax({
                                                         url : href+"/listar_fornecedor/",
                                                         type: "GET",
                                                         dataType: "JSON",
                                                         success: function(data) {
                                                             $.each(data, function(index,item) {
                                                                 $("#fornecedor_" + indice).append('<option value="' + item.id_fornecedor + '">' + item.nome_fornecedor + '</option>').selectpicker('val', valor.id_fornecedor);
                                                             });
                                                         },
                                                         error: function (jqXHR, textStatus, errorThrown) {
                                                             $("#fornecedor_" + indice).html('<option id="-1">none available</option>');
                                                             alert('Erro ao pegar os dados do ajax');
                                                         }
                                                     });
                                   a +=         '</select>';
                                   a +=     '</div>';
                                   a += '</div>';
                                a += '</div>';
                            a += '</div>';
                            $("#view_link_add").append(a);
                        }
                    });
                }
            }

      //************************************************TELEFONE**********************************************************************//
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
                                     a += '<input class="form-control" name="telefone[]" value="'+valor.numero_telefone+'" disabled="" type="text">';
                             a += '</div>';
                         a += '</div>';
                        $("#view_telefone_add").append(a);
                   }
               });
               }
           }

        //************************************************CELULAR**********************************************************************//

         if(data.celular == null) {
             $('[name="celular[]"]').val('');
         } else {
             if(data.celular.length == 1){
                 $.each(data.celular, function(indice,valor) {
                     $('[name="celular[]"]').val(valor.numero_telefone);
                     $('[name="id_celular[]"]').val(valor.id_telefone);
                 });
             } else {
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
                                    a += '<input class="form-control" name="celular[]" value="'+item.numero_telefone+'" disabled="" type="text">';
                            a += '</div>';
                        a += '</div>';
                       $("#view_celular_add").append(a);
                     }
                 });
                 }
             }

          //************************************************TECNICO**********************************************************************//
          if(data.tecnico == null) {
            $('[name="nome_tecnico"]').val('');
            $('[name="telefone_tecnico"]').val('');
            $('[name="celular_tecnico"]').val('');
            $('[name="voip_tecnico"]').val('');
          } else {
              $.each(data.tecnico, function(indice,valor) {
                  if(indice == 0) {
                    $('[name="id_tecnico"]').val(valor.id_tecnico);
                    $('[name="nome_tecnico"]').val(valor.nome_tecnico);
                    $('[name="telefone_tecnico"]').val(valor.telefone_tecnico);
                    $('[name="celular_tecnico"]').val(valor.celular_tecnico);
                    $('[name="voip_tecnico"]').val(valor.voip_tecnico);
                  } else {

                    var a = '';
                    a += '<div id=id="field_tecnico_'+indice+'">'
                    a += '<hr>';
                    a += '<div class="form-group">';
                    a += '    <input type="hidden" name="id_tecnico" value="'+valor.id_tecnico+'"/>';
                    a += '    <label class="col-md-1 control-label">Nome: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="nome_tecnico" value="'+valor.nome_tecnico+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '    <label class="col-md-1 control-label">Telefone: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="telefone_tecnico" value="'+valor.telefone_tecnico+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '</div>';
                    a += '<div class="form-group">';
                    a += '    <label class="col-md-1 control-label">Celular: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="celular_tecnico" value="'+valor.celular_tecnico+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '    <label class="col-md-1 control-label">VoIP: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="voip_tecnico" value="'+valor.voip_tecnico+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '</div>';
                    a += '</div>';
                    $("#view_tecnico_add").append(a);
                  }
              });
          }

          //************************************************SERVIDORES Pub**********************************************************************//

           if(data.servidor == null) {
             $('[name="nome_servidor"]').val('');
             $('[name="telefone_servidor"]').val('');
             $('[name="celular_servidor"]').val('');
             $('[name="voip_servidor"]').val('');
           } else {
               $.each(data.servidor, function(indice,valor) {
                   if(indice == 0) {
                     $('[name="id_servidor"]').val(valor.id_servidor);
                     $('[name="nome_servidor"]').val(valor.nome_servidor);
                     $('[name="telefone_servidor"]').val(valor.telefone_servidor);
                     $('[name="celular_servidor"]').val(valor.celular_servidor);
                     $('[name="voip_servidor"]').val(valor.voip_servidor);
                   } else {
                  // console.log(valor.nome_servidor);
                    var a = '';
                    a += '<div id="field_servidor'+indice+'">';
                    a += '<hr>';
                    a += '<div class="form-group">';
                    a += '    <input type="hidden" name="id_servidor" value="'+valor.id_servidor+'"/>';
                    a += '    <label class="col-md-1 control-label">Nome: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="nome_servidor" value="'+valor.nome_servidor+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '    <label class="col-md-1 control-label">Telefone: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="telefone_servidor" value="'+valor.telefone_servidor+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '</div>';
                    a += '<div class="form-group">';
                    a += '    <label class="col-md-1 control-label">Celular: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="celular_servidor" value="'+valor.celular_servidor+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '    <label class="col-md-1 control-label">VoIP: </label>';
                    a += '    <div class="col-md-5">';
                    a += '        <input type="text" name="voip_servidor" value="'+valor.voip_servidor+'" class="form-control" disabled="" >';
                    a += '    </div>';
                    a += '</div>';
                    a += '</div>';
                    $("#view_servidor_add").append(a);
                  }
              });
          }

            $('#modal_unidade_view').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar unidade'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax'+jqXHR.responseText);
        }
    });
}

//==================================================================================
//==================================================================================
//==================================================================================

function reload_table() {
    table.ajax.reload(null,false); //reload datatable ajax
}

function save() {
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = href+"/unidades_add";
    } else {
        url = href+"/unidades_update";
    }
    // console.log($('#form').serialize());
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status) { //if success close modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Unidade adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_unidade').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').parents('div.form-group').addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').parents('div.form-group').find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Salvo'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao adicionar / atualizar dados'+jqXHR.responseText);
            $('#btnSave').text('Salvar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function delete_person(id) {
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : href+"/unidades_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Unidade deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_unidade').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar os dados'+jqXHR.responseText);
            }
        });

    }
}

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
