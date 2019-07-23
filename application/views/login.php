<?php defined('BASEPATH') OR exit('No direct script access aloowed');
/*if (isset($this->session->userdata['logged_in'])) {
//header("location: http://10.3.3.96/portal/index.php/user_authentication/user_login_process");
redirect('painel/login');
}*/
?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>NOC</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url(); ?>assets/googlefonts.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url(); ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url(); ?>assets/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <div class="menu-toggler sidebar-toggler"></div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="#">
                <img style="text-shadow: 0px 0px 5px black;" src="<?php echo base_url(); ?>/assets/pages/img/logo.png" alt="" width="10%" /> </a>
                <h2 style="color: white;text-shadow: 3px 3px 5px #404040;"><b>NOC<b></h2>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <!-- <form class="login-form" action="index.html" method="post">   'painel/login'-->
            <?php echo form_open('auth/login','class="login-form"');
            // echo validation_errors('<div class="error">', '</div>');
            ?>
                <h3 class="form-title font-green">Login de Usuário</h3>
                <?php
/*                if (isset($error_message)) {
                    echo '<div class="alert alert-danger display-hide" style="display: block;">
                        <button class="close" data-close="alert"></button>
                        <span>';
                    echo $error_message;
                    echo "</span></div>";
                }*/
                get_msg('loginErro');
                // echo validation_errors('<div class="error">', '</div>');
                ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <label class="control-label visible-ie8 visible-ie9">Usuário</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" id="name" autocomplete="off" placeholder="Usuário" name="username" />
                        <?php echo form_error('username','<span class="help-block">','</span>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <label class="control-label visible-ie8 visible-ie9">Senha</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" id="password" autocomplete="off" placeholder="Senha" name="password" />
                        <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                    </div>
                </div>
                <div class="form-actions">
                    <!-- <button type="submit" value=" Login " name="submit" class="btn green uppercase">Login</button> -->
                    <input type="submit" value=" Login " name="submit" class="btn green uppercase"/>
                </div>
            <!-- </form> -->
            <?php echo form_close(); ?>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> 2018 © CGRE-Produção. Network Operation Center. </div>
        <!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url(); ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script>$("#myAlert").fadeOut(4000);</script>
        <!-- <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script> -->
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- <script src="<?php echo base_url(); ?>assets/pages/scripts/login.js" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>