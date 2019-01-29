$(document).ready(function () {
    temperatura();
});
    function temperatura() {
        var displaynbk01 = $("#nobreak01");
        var displaynbk02 = $("#nobreak02");
        var displaydcenter = $("#datacenter");
        var flag01 = $('#nbk01.dashboard-stat');
        var flag02 = $('#nbk02.dashboard-stat');
        var flag03 = $('#dcenter.dashboard-stat');
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
                    if(data[i].name =='DataCenter'){
                        var dcenter = data[i].temperatura;
                        var fdcenter = data[i].flag;
                    }
                }
                displaynbk01.html(nobreak01);
                displaynbk02.html(nobreak02);
                displaydcenter.html(dcenter);
                flag01.removeClass('red green').addClass(fnbk01);
                flag02.removeClass('red green').addClass(fnbk02);
                flag03.removeClass('red green').addClass(fdcenter);
            }
        });
        setTimeout('temperatura()', 30000);
    }