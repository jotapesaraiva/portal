var save_method; //for save method string
var table;
var href = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
      "dom": "flrtip",
      "responsive": true,   // enable responsive
      "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
          url : href+"/datatable_list",//json datasource
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
      { "width": "3%", "targets": 0 },//Id
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

});

function add_printer() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker
    // $("div[id*=remove_field]").remove();
    // $('input').val('');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_impressora').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar impressora'); // Set Title to Bootstrap modal title
}

function edit_printer(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    // $("div[id*=remove_field]").remove();
    // $('input').val('');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : href+"/printer_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id_impressora"]').val(data.id_impressora);
            $('[name="ip"]').val(data.ip);
            $('[name="location"]').val(data.location);
            $('[name="sn"]').val(data.serial_number);
            $('[name="model"]').val(data.model);
            $('[name="type"]').val(data.type);
            $('[name="unidade"]').val(data.id_unidade);

            $('.selectpicker').selectpicker('refresh')// update in selectpicker bootstrap
            $('#modal_impressora').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar impressora'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax'+jqXHR.responseText);
        }
    });
}

function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}

function save() {
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        //url = "<?php //echo site_url('site/ajax_add')?>";
        url = href+"/printer_add";
    } else {
        url = href+"/printer_update";
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
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Link adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_impressora').modal('hide');
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
            alert('Erro ao adicionar / editar dados'+jqXHR.responseText);
            $('#btnSave').text('Salvar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

function delete_printer(id) {
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : href+"/printer_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Link deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_link').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Erro ao deletar os dados'+jqXHR.responseText);
            }
        });

    }
}