var save_method; //for save method string
var table;
var server = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
      "dom": "flrtip",
      "responsive": true,   // enable responsive
      "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
      },
      "ajax": {
          url : server+"/contratos_list",//json datasource
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
});

function add_contrato() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_contratos').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar Contrato'); // Set Title to Bootstrap modal title
}

function edit_contrato(id) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : server+"/contratos_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data[0].id_contratos);
            $('[name="nome"]').val(data[0].nome_contrato);
            $('[name="tipo"]').selectpicker('val', data[0].id_tipo_contrato);
            $('[name="numero"]').val(data[0].numero_contrato);
            $('[name="data"]').val(data[0].data_inicio_contrato);
            $('[name="duracao"]').val(data[0].duracao_contrato);
            if(data[0].renovacao_contrato == '1') {
                $('[name="renovacao"]').bootstrapSwitch('state', true);
            } else {
                $('[name="renovacao"]').bootstrapSwitch('state', false);
            }
            $('[name="aviso"]').val(data[0].aviso_contrato);
            $('[name="fornecedor"]').selectpicker('val', data[0].id_fornecedor);


            //
            $('#modal_contratos').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Contrato'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax');
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
        //url = "<?php //echo site_url('site/ajax_add')?>";
        url = server+"/contratos_add";
    } else {
        url = server+"/contratos_update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status){ //if success close modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Categoria adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_contratos').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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

function delete_contrato(id){
    if(confirm('Você tem certeza que quer deletar o Contrato ?')) {
        // ajax delete data to database
        $.ajax({
            url : server+"/contrato_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Categoria deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_contratos').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Erro ao deletar dados');
            }
        });

    }
}
