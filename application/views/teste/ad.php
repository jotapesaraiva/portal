<?php defined('BASEPATH') OR exit('No direct script access aloowed');?>
<html lang="en">
<head>
    <title>Codeigniter 3 - jquery ajax autocomplete search using typeahead example- ItSolutionStuff.com</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap3-typeahead.min.js" type="text/javascript"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> -->
</head>
<body>
    <div class="container">
        <h1>Codeigniter 3 - jquery ajax autocomplete search using typeahead example- ItSolutionStuff.com</h1>
        <input class="typeahead form-control" type="text">
    </div>
    <script type="text/javascript">
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get('https://producaoh.sefa.pa.gov.br/portal/auth/pesquisar', { query: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
    </script>
</body>
</html>