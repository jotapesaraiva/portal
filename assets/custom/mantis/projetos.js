var table;
var value = $( "select.selector" ).val();
var server = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
        "dom": "flrtip",
        "responsive": true,   // enable responsive
        "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : server+"/datatable_list/"+ value,//json datasource
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
          { "width": "2%", "targets": 1 },//numero
          { "width": "2%", "targets": 2 },//atualizacao
          { "width": "4%", "targets": 3 },//status
          { "width": "2%", "targets": 4 },//prioridade
          { "width": "16%", "targets": 5 },//descricao
          { "width": "8%", "targets": 6 },//categoria
          { "width": "11%", "targets": 7 },//atribuido
          { "width": "11%", "targets": 8 }],//solicitante
    });

    $('select#selector').change(function() {
        value = $(this).val();
        table.ajax.url( server+"/datatable_list/"+ value ).load();
    });
});