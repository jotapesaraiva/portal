var table;
var value = $( "select.selector" ).val();
var href = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
        "dom": "flrtip",
        "responsive": true,   // enable responsive
        "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : href+"/datatable_list/"+ value,//json datasource
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
          },{ "width": "2%", "targets": 0 },//numero
          { "width": "2%", "targets": 1 },//atualizacao
          { "width": "4%", "targets": 2 },//status
          { "width": "2%", "targets": 3 },//prioridade
          { "width": "16%", "targets": 4 },//descricao
          { "width": "8%", "targets": 5 },//categoria
          { "width": "11%", "targets": 6 },//atribuido
          { "width": "11%", "targets": 7 }],//solicitante
    });

    $('select#selector').change(function() {
        value = $(this).val();
        console.log(value);
        table.ajax.url( href+"/datatable_list/"+ value ).load();
    });
});