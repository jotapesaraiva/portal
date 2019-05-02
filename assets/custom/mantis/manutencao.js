var table;
var datai = $( '[name="data_inicio"]' ).val();
var dataf = $( '[name="data_fim"]' ).val();
var server = window.location.href;
$(document).ready(function() {
    table = $('#table').DataTable({
        "dom": "flrtip",
        "responsive": true,   // enable responsive
        "language": {
                  "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        },
        "ajax": {
             url : server+"/datatable_list/"+datai+"/"+dataf,//json datasource
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

    // $('td.day').on('click',function() {
    //     datai = $('[name="data_inicio"]').val();
    //     dataf = $('[name="data_fim"]').val();
    //     console.log(datai);
    //     console.log(dataf);
    //     table.ajax.url( server+"/datatable_list/"+ datai+"/"+dataf ).load();
    // });
    $('#data_inicio')
    .datetimepicker()
    .on('changeDate', function(ev){
      console.log(ev.date.valueOf());
        // if (ev.date.valueOf() < date-start-display.valueOf()){
        //     ....
        // }
    });
});