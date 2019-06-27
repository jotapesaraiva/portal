var href = window.location.href;
$(document).ready(function() {

    $.getJSON( href+'/active', function(data) {
        var items = '';

        $.each(data, function(key, val) {
            var n = val.split(' ');

            items += '<tr>';

            $.each(n, function(x, y) {
                items += '<td>' + y + '</td>';
            });
            items += '<td><a class="btn btn-warning remove_' + key + '" onclick="onDeleteJobClick(' + key + ')">Remove</a></td>';
            items += '</tr>';
        });

        $('.active-job-list').html(items);
    });

    $('#save-btn').bind('click', onSaveButtonClick);
    $('.delete-all-btn').bind('click', onDeleteAllJobsClick);

});

function onDeleteAllJobsClick(event) {
    $.ajax({url:"lib/deleteall.php"}).done(function(data) {
        location.reload();
    });
}

function onDeleteJobClick(jobID) {
    $.post("lib/deletejob.php", { "jobid":jobID },
        function(data){
            location.reload();
        }
    );
}

function onSaveButtonClick(event) {
    var minute = $('.add-minute').val();
    var hour = $('.add-hour').val();
    var dayweek = $('.add-dayweek').val();
    var daymonth = $('.add-daymonth').val();
    var month = $('.add-month').val();
    var name = $('.add-name').val();
    var command = $('.add-command').val();

    $.post("lib/add.php", { "minute":minute, "hour":hour, "dayweek":dayweek, "daymonth":daymonth, "month":month, "name":name, "command":command },
        function(data){
            console.log(data);
            changePage('active');
        }
    );
}


  function add_person() {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#modal_cronjob').modal('show'); // show bootstrap modal
      $('.modal-title').text('Adicionar nova tarefa'); // Set Title to Bootstrap modal title
  }