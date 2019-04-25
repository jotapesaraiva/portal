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
          url : server+"/contato_list",//json datasource
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
            a += '<div class="form-group all" id="remove_field_'+i+'">';
                a += '<input type="hidden" value="" id=telefone name="id_telefone[]"/>';
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
        id_contato = document.getElementById('contato').value;
        delete_telefone(id_telefone,id_contato);
        e.preventDefault();
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
        id_contato = document.getElementById('contato').value;
        //console.log(id_contato);
        delete_telefone(id_telefone,id_contato);
        //delete_telefone(id);
        e.preventDefault();
        //$(this).parent().parent().parent().parent().remove();
        $('#remove_field_'+button_id+'').remove();
        celular--;
    });

 /*********************************************************************
 *********************************************************************/

    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $('.selectpicker').on('change', function () {
        //$(this).parent().parent().addClass('olha eu aqui');
        //$(this).parents("div[class=form-group]").removeClass('has-error');
        $(this).parent().parent().parent().removeClass('has-error');
        $(this).next().next().empty();
    });
});

    function add_person() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
        $("div[id*=remove_field]").remove();
        // $('input').val('');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_contato').modal('show'); // show bootstrap modal
        $('.modal-title').text('Adicionar contato'); // Set Title to Bootstrap modal title
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
            url : server+"/contato_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.contato.id_contato);
                $('[name="nome"]').val(data.contato.nome_contato);
                $('[name="email"]').val(data.contato.email_contato);
                $('[name="cargo"]').val(data.contato.cargo_contato);
                $('[name="comentario"]').val(data.contato.comentario_contato);
                $('[name="fornecedor"]').val(data.contato.id_fornecedor);
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
                      $.each(data.celular, function(i, item) {
                        if(i == 0) {
                            $('[name="celular[]"]').val(item.numero_telefone);
                            $('[name="id_celular[]"]').val(item.id_telefone);
                        } else {
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

                $('.selectpicker').selectpicker('refresh');// update in selectpicker bootstrap
                $('#modal_contato').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar contato'); // Set title to Bootstrap modal title
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
        if(save_method == 'add') {
            //url = "<?php //echo site_url('site/ajax_add')?>";
            url = server+"/contato_add";
        } else {
            url = server+"/contato_update";
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
                    $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Contato adicionado com sucesso !!!</div>');
                    $("#myAlert").fadeOut(4000);
                    $('#modal_contato').modal('hide');
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

    function delete_person(id) {
        if(confirm('Você tem certeza que quer deletar o item?')) {
            // ajax delete data to database
            $.ajax({
                url : server+"/contato_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Contato deletado com sucesso !!!</div>');
                    $("#myAlert").fadeOut(4000);
                    $('#modal_contato').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Erro ao deletar dados');
                }
            });
        }
    }

    // function delete_telefone(id_telefone,id_contato) {
    //     if(confirm('Você tem certeza que quer deletar o item?')) {
    //         // ajax delete data to database
    //         $.ajax({
    //             url : server+"/contato_telefone_delete/"+id_telefone+"/"+id_contato,
    //             type: "POST",
    //             dataType: "JSON",
    //             success: function(data) {
    //                 alert("excluido com sucesso!!!!");
    //             },
    //             error: function (jqXHR, textStatus, errorThrown) {
    //                 alert('Erro ao deletar dados');
    //             }
    //         });
    //     }
    // }

