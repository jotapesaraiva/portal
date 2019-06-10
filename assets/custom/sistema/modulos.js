$(document).ready(function() {
    $.ajax({
        url: origin+"/portal/sistema/modulos/listar";
        type: "GET";
        dataType: "JSON";
        success: function(data) {
            $.each(data, function(index, value){
                $('#'+value+'').bootstrapSwitch('state', true);
                $('#'+value+'').bootstrapSwitch('disabled', true);
            });
        }
    });

});