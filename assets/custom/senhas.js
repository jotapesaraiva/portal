var save_method; //for save method string
var server = window.location.href;
$(document).ready(function() {
   var table1 = $('#table1').DataTable({
        "dom": "flrtip",
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "autoWidth": false,
        // setup buttons extentension: http://datatables.net/extensions/buttons/
        "buttons": [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: [ 'pdf', 'csv', 'copy', 'excel' ]
        }],
        "order": [[2, 'desc']],
        //Set column definition initialisation properties.
        "columnDefs": [{
              "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },],
    });

    $("#btn-pdf").on('click', function() {
        table1.button( '0-0' ).trigger();
    });
    $('#btn-csv').on('click', function() {
        table1.button( '0-3' ).trigger();
    });
    $('#btn-print').on('click', function() {
        table1.button( '0-2' ).trigger();
    });
    $('#btn-excel').on('click', function() {
        table1.button( '0-1' ).trigger();
    });

   var table2 = $('#table2').DataTable({
        "dom": "flrtip",
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
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
        table2.button( '0-0' ).trigger();
    });
    $('#btn-csv').on('click', function() {
        table2.button( '0-3' ).trigger();
    });
    $('#btn-print').on('click', function() {
        table2.button( '0-2' ).trigger();
    });
    $('#btn-excel').on('click', function() {
        table2.button( '0-1' ).trigger();
    });

    $(".toggle-password").click(function() {

      $(this).children().toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

});

    function add_acesso() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_acesso').modal('show'); // show bootstrap modal
        $('.modal-title').text('Adicionar acesso'); // Set Title to Bootstrap modal title
    }

    function edit_acesso(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : server+"/acesso_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="nome"]').val(data.nome);
                $('[name="acesso"]').val(data.ip_servidor);
                $('[name="responsavel"]').val(data.responsavel);
                $('[name="usuario"]').val(data.usuario);
                $('[name="senha"]').val(b64DecodeUnicode(data.senha));
                $('[name="tipo"]').val(data.tipo);

                $('#modal_acesso').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar acesso'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao pegar os dados do ajax');
            }
        });
    }

    function b64DecodeUnicode(str) {
        // Going backwards: from bytestream, to percent-encoding, to original string.
        return decodeURIComponent(atob(str).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    }

    function b64EncodeUnicode(str) {
        // first we use encodeURIComponent to get percent-encoded UTF-8,
        // then we convert the percent encodings into raw bytes which
        // can be fed into btoa.
        return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
            function toSolidBytes(match, p1) {
                return String.fromCharCode('0x' + p1);
        }));
    }

    function reload_table() {
        // $('.table').ajax.reload(null,false); //reload datatable ajax
        // table.ajax.reload(null,false); //reload datatable ajax
        // $('.table').DataTable().ajax.reload();
        // $(".table").DataTable().fnReloadAjax();
        location.reload();
    }

    function save() {
        $('#btnSave').text('Salvando...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable
        var url;
        if(save_method == 'add') {
            //url = "<?php //echo site_url('site/ajax_add')?>";
            url = server+"/acesso_add";
        } else {
            url = server+"/acesso_update";
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
                    $('#modal_acesso').modal('hide');
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

    function delete_acesso(id) {
        if(confirm('Você tem certeza que quer deletar o item?')) {
            // ajax delete data to database
            $.ajax({
                url : server+"/acesso_delete/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Contato deletado com sucesso !!!</div>');
                    $("#myAlert").fadeOut(4000);
                    $('#modal_acesso').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Erro ao deletar dados');
                }
            });
        }
    }