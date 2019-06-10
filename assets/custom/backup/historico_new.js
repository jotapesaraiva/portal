var origin = window.location.origin;
$(document).ready(function() {
    var table1 = $('#table1').DataTable({
        "dom": "flrtip",
        "responsive": true,   // enable responsive
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : origin+"/datatable_list/",//json datasource
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
          { "width": "2%", "targets": 1 },//data
          { "width": "4%", "targets": 2 },//status
          { "width": "4%", "targets": 3 },//backup
          { "width": "2%", "targets": 4 },//prioridade
          { "width": "4%", "targets": 5 },//modo
          { "width": "4%", "targets": 6 },//tipo
          { "width": "4%", "targets": 7 },//inicio
          { "width": "4%", "targets": 8 },//duracao
          { "width": "4%", "targets": 9 },//arquivo
          { "width": "4%", "targets": 10 },//velocidade
          { "width": "4%", "targets": 11},//tamanho
          { "width": "4%", "targets": 12 }],//mantis
    });
    $("#btn-pdf").on('click', function(){
        table.button( '0-0' ).trigger();
    });
    $('#btn-csv').on('click', function(){
        table.button( '0-3' ).trigger();
    });
    $('#btn-print').on('click', function(){
        table.button( '0-2' ).trigger();
    });
    $('#btn-excel').on('click', function(){
        table.button( '0-1' ).trigger();
    });
});