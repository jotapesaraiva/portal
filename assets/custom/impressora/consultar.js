var table;
var datai = $( '[name="data_inicio"]' ).val();
var dataf = $( '[name="data_fim"]' ).val();
var href = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
        "dom": "flrtip",
        "responsive": true,   // enable responsive
        "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : href+"/datatable_list/"+datai+"/"+dataf,//json datasource
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
          "columnDefs": [{},
            { "width": "3%", "targets": 0 },//Id
            { "width": "5%", "targets": 1 },//IP
            { "width": "20%", "targets": 2 },//LOCALIDADE
            { "width": "10%", "targets": 3 },//UNIADE
            { "width": "10%", "targets": 4 },//DATA COLETA
            { "width": "10%", "targets": 5 },//N de SERIE
            { "width": "10%", "targets": 6 },//TONER
            { "width": "15%", "targets": 7 },//KIT
            { "width": "10%", "targets": 8 }]//N de PAGINAS
          });
    // $('td.day').on('click',function() {
    //     datai = $('[name="data_inicio"]').val();
    //     dataf = $('[name="data_fim"]').val();
    //     console.log(datai);
    //     console.log(dataf);
    //     table.ajax.url( href+"/datatable_list/"+ datai+"/"+dataf ).load();
    // });
    // $('#data_inicio')
    // .datetimepicker()
    // .on('changeDate', function(ev){
    //   console.log(ev.date.valueOf());
        // if (ev.date.valueOf() < date-start-display.valueOf()){
        //     ....
        // }
    // });
    $('#data_inicio').datepicker({
        rtl: App.isRTL(),
        orientation: "right",
        autoclose: true,
        language: 'pt-BR',
        format: "dd-mm-yyyy",
        todayHighlight: true
    }).on('changeDate', function(e) {
        datai = e.format();
        dataf = $('[name="data_fim"]').val();
        table.ajax.url( href+"/datatable_list/"+ datai+"/"+dataf ).load();
        console.log(datai);
        console.log(dataf);
    });
    $('#data_fim').datepicker({
        rtl: App.isRTL(),
        orientation: "right",
        autoclose: true,
        language: 'pt-BR',
        format: "dd-mm-yyyy",
        todayHighlight: true
    }).on('changeDate', function(e) {
        datai = $('[name="data_inicio"]').val();
        dataf = e.format();
        table.ajax.url( href+"/datatable_list/"+ datai+"/"+dataf ).load();
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