<?php defined('BASEPATH') OR exit('No direct script access aloowed');
/*if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $email = ($this->session->userdata['logged_in']['email']);
} else {
    redirect('painel/login');
    //header("location: painel/login");
}*/
/*if($this->auth_ad->is_authenticated()){
    $username = $this->session->userdata('username');
} else {
    redirect('auth/login');
}*/

?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js" data-ng-app="MetronicApp"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js" data-ng-app="MetronicApp"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->

    <!-- BEGIN HEAD -->
    <head>
            <meta charset="utf-8" />
            <title>Metronic | Dashboard</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport" />
            <meta content="" name="description" />
            <meta content="" name="author" />
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="<?php echo base_url(); ?>assets/googlefonts.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
            <!-- END GLOBAL MANDATORY STYLES -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <?php echo $headerinc; ?>
            <!-- <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" /> -->
            <link href="<?php echo base_url(); ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL STYLES -->
            <link href="<?php echo base_url(); ?>assets/global/css/components.css" rel="stylesheet" id="style_components" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
            <!-- END THEME GLOBAL STYLES -->
            <!-- BEGIN THEME LAYOUT STYLES -->
            <link href="<?php echo base_url(); ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
            <link href="<?php echo base_url(); ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
            <link href="<?php echo base_url(); ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
            <!-- END THEME LAYOUT STYLES -->
            <link rel="shortcut icon" href="favicon.ico" />
    </head>
        <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">