var save_method; //for save method string
var table;
var href = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
        "dom": "flrtip",
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : href+"/colaborador_list",//json datasource
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
                    buttons: [ 'pdf', 'csv', 'copy', 'excel' ]
        }],
        "order": [[0, 'asc']],
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

});

    $('.multi-select').multiSelect();
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
         id_colaborador = document.getElementById('colaborador').value;
         if(id_telefone != ''){
           delete_ramal(id_telefone,id_usuario);
         }
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
        $("#add_celular").click(function(e){ //on add input button click
            e.preventDefault();
            i++;
            if(celular < max_fields){ //max input box allowed
                celular++; //text box increment
                var a = '';
                a += '<div class="form-group all" id="remove_field_'+i+'">';
                    a += '<input type="hidden" value="" id=celular name="id_celular[]"/>';
                    a += '<label class="control-label col-md-3">Celular :</label>';
                    a += '<div class="col-md-9">';
                        a += '<div class="input-group">';
                            a += '<input class="form-control" name="celular[]" placeholder="Numero do celular" data-mask="(00) 0000-0000" type="text">';
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
            id_colaborador = document.getElementById('colaborador').value;
            if(id_celular != ''){
              delete_ramal(id_celular,id_colaborador);
            }
            e.preventDefault();
            $('#remove_field_'+button_id+'').remove();
            celular--;
        });

 /*********************************************************************
 *********************************************************************/

function add_person() {
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.multi-select').multiSelect('refresh'); //reset selectcpicker bootstrap
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_colaborador').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar colaborador'); // Set Title to Bootstrap modal title
}

function edit_person(id_colaborador) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.multi-select').multiSelect('refresh'); //reset selectcpicker bootstrap
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : href+"/colaborador_edit/"+id_colaborador,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="nome"]').multiSelect('select',data.id_usuario);
            $('[name="unidade[]"]').multiSelect('select',data.id_unidade);

            $('#modal_colaborador').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar colaborador'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao pegar os dados do ajax');
        }
    });
}

function reload_table() {
    table.ajax.reload(null,false); //reload datatable ajax
}

function save(){
    $('#btnSave').text('Salvando...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = href+"/colaborador_add";
    } else {
        url = href+"/colaborador_update";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status){ //if success close modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>colaborador adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_colaborador').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parents("div[class=form-group]").addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').siblings(".help-block").text(data.error_string[i]); //select span help-block class set text error string
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

function delete_person(id_colaborador,id_unidade){
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : href+"/colaborador_delete/"+id_colaborador,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Item deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_colaborador').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar os dados');
            }
        });

    }
}
