$(document).ready(function () {
    temperatura();
});
    function temperatura() {
        var displaynbk01 = $("#nobreak01");
        var displaynbk02 = $("#nobreak02");
        var flag01 = $('#nbk01.dashboard-stat');
        var flag02 = $('#nbk02.dashboard-stat');
        $.ajax({
            url: "https://producaoh.sefa.pa.gov.br/portal/dash/nobreak",
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                for (var i in data){
                    if(data[i].name == 'Nobreak 01'){
                        var nobreak01 = data[i].temperatura;
                        var fnbk01 = data[i].flag;
                    }else{
                        var nobreak02 = data[i].temperatura;
                        var fnbk02 = data[i].flag;
                    }
                }
                displaynbk01.html(nobreak01);
                displaynbk02.html(nobreak02);
                flag01.addClass(fnbk01);
                flag02.addClass(fnbk02);
            }
        });
        setTimeout('temperatura()', 30000);
    }