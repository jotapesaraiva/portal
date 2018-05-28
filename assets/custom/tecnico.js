var save_method; //for save method string
var table;
var server = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
        "dom": "flrtip",
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : server+"/tecnico_list",//json datasource
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

    $('a[href="<?php echo current_url();?>"]').click(function (e) {
        e.preventDefault();
        $('li.nav-item').removeClass('active open');
        // $('').removeChild('<span class="selected"></span>');
        $(this).parents('li').addClass('active open');
        // $(this).append('<span class="selected"></span>');
        // alert("mudou !!!!");
    });

    // $('a[href="<?php echo current_url();?>"]').click(function (e) {
    //     e.preventDefault();
    //     $('li.nav-item').removeClass('active open');
    //     // $('').removeChild('<span class="selected"></span>');
    //     $(this).parents('li').addClass('active open');
    //     // $(this).append('<span class="selected"></span>');
    //     // alert("mudou !!!!");
    // });
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
         id_tecnico = document.getElementById('tecnico').value;
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
            id_tecnico = document.getElementById('tecnico').value;
            if(id_celular != ''){
              delete_ramal(id_celular,id_tecnico);
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
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_tecnico').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar Tecnico'); // Set Title to Bootstrap modal title
}

function edit_person(id_tecnico) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $(".selectpicker").val('').selectpicker('refresh'); //reset selectcpicker bootstrap
    // $('#multiselect').multiSelect('refresh');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : server+"/tecnico_edit/"+id_tecnico,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id_usuario);
            $('[name="nome"]').selectpicker('val', data.id_usuario);
            $('#array_antigo').val(data.id_unidade);
            $('[name="unidade[]"]').selectpicker('val', data.id_unidade);
            // $('#multiselect').multiSelect('select', data.id_unidade);
            $('#modal_tecnico').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Tecnico'); // Set title to Bootstrap modal title
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
        url = server+"/tecnico_add";
        texto = "adicionar";
    } else {
        url = server+"/tecnico_update";
        texto = "alterado";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status){ //if success close modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Técnico adicionado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_tecnico').modal('hide');
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

function delete_person(id_tecnico,id_unidade){
    if(confirm('Você tem certeza que quer deletar o item?')) {
        // ajax delete data to database
        $.ajax({
            url : server+"/tecnico_delete/"+id_tecnico+"/"+id_unidade,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success hide modal and reload ajax table
                $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Item deletado com sucesso !!!</div>');
                $("#myAlert").fadeOut(4000);
                $('#modal_tecnico').modal('hide');
                reload_table();
                // location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao deletar os dados');
            }
        });

    }
}
