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
          "columnDefs": [{
              // "targets": [ -1 ], //last column
              // "orderable": false, //set not orderable
          },{ "width": "2%", "targets": 0 },//#
          { "width": "12%", "targets": 1 },//localidade
          { "width": "5%", "targets": 2 },//ticket
          { "width": "8%", "targets": 3 },//abertura
          { "width": "8%", "targets": 4 },//fechamento
          { "width": "8%", "targets": 5 },//tempo ebt
          { "width": "5%", "targets": 6 }],//responsavel
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

});