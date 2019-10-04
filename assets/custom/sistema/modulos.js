var href = window.location.href;
$(document).ready(function() {

    $.ajax({
        url: href+"/sistema/modulos/listar",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $.each(data, function(index, value){
                $('#'+value+'').bootstrapSwitch('state', true);
                $('#'+value+'').bootstrapSwitch('disabled', true);
            });
        }
    });

});

// function save(){
//     $('#btnSave').text('Salvando...'); //change button text
//     $('#btnSave').attr('disabled',true); //set button disable
//     var url;
//         url = href+"/modulos_update";

//     // ajax adding data to database
//     $.ajax({
//         url : url,
//         type: "POST",
//         data: $('#form').serialize(),
//         dataType: "JSON",
//         success: function(data) {
//                 $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Modulo alterado com sucesso !!!</div>');
//                 $("#myAlert").fadeOut(4000);
//                 $('#modal_form').modal('hide');

//             $('#btnSave').text('Alterar'); //change button text
//             $('#btnSave').attr('disabled',false); //set button enable
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             alert('Erro ao adicionar / editar dados');
//             $('#btnSave').text('Alterar'); //change button text
//             $('#btnSave').attr('disabled',false); //set button enable
//         }
//     });
// }


$(function() {
  var switchSelector = 'input[type="checkbox"].make-switch';

  // Convert all checkboxes with className `bs-switch` to switches.
  $(switchSelector).bootstrapSwitch();

  // Attach `switchChange` event to all switches.
  $(switchSelector).on('switchChange.bootstrapSwitch', function(event, state) {
    console.log(this);  // DOM element
    console.log(event.target.attributes.id.value); // jQuery event
    console.log(event); // jQuery event
    console.log(state); // true | false


    $.ajax({
        url: href+"/update/"+event.target.attributes.id.value+"/"+state,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            // alert("update com sucesso!!!");
            $('#msgs').html('<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Modulo alterado com sucesso !!!</div>');
            $("#myAlert").fadeOut(4000);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Erro ao adicionar / editar dados');
        }
    });
    // Get the information for the switch.
    // var info = {
    //   state : state,
    //   value : $(this).data(state ? 'onText' : 'offText'),
    //   data : $(this).attr('data')
    // }

    // Show bootstrap info alert.
    // if ($('div.alert').length === 0) {
    //   $('body').append($('<div>').addClass('alert alert-info'));
    // }
    // $('div.alert').text(JSON.stringify(info, undefined, '  '));
  });
});