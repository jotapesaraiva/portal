var origin = window.location.origin;
$(document).ready(function() {
    $.ajax({
        url : origin+"/dash/nobreak",
        type : "GET",
        dataType : "JSON",
        success : function(data) {
            for (var i in data){
                switch(data[i].name) {
                    case 'Nobreak 01':
                        var temperatura01 = data[i].temperatura;
                        var umidade01 = data[i].umidade;
                        var bateria01 = data[i].carga;
                        break;
                    case 'Nobreak 02':
                        var temperatura02 = data[i].temperatura;
                        var umidade02 = data[i].umidade;
                        var bateria02 = data[i].carga;
                        break;
                    case 'DataCenter':
                        var tcenter = data[i].temperatura;
                        var ucenter = data[i].umidade;
                        break;
                }
            }
            $('[name="temperatura_cpd"]').val(tcenter);
            $('[name="umidade_cpd"]').val(ucenter);
            $('[name="temperatura_nobreak01"]').val(temperatura01);
            $('[name="umidade_nobreak01"]').val(umidade01);
            $('[name="bateria01"]').val(bateria01);
            $('[name="temperatura_nobreak02"]').val(temperatura02);
            $('[name="umidade_nobreak02"]').val(umidade02);
            $('[name="bateria02"]').val(bateria02);
        }
    })
});