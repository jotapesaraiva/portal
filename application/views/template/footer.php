<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
       <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2017 &copy; DTI-CGRE Produção.</div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
                <!-- END FOOTER -->
                <!--[if lt IE 9]>
        <script src="../assets/global/plugins/respond.min.js"></script>
        <script src="../assets/global/plugins/excanvas.min.js"></script>
        <![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?php echo base_url(); ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script> -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <?php echo $footerinc; ?>
        <script src="<?php echo base_url(); ?>assets/custom/dashboard/sobreaviso.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/dashboard/ramais_sefa.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/dashboard/ramais_dti.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/dashboard/mensagem_rede.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/custom/dashboard/alerta_agendamento.js" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/global/plugins/morris/morris.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?php echo base_url(); ?>assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script> -->
        <script src="<?php echo base_url(); ?>assets/global/plugins/datatables/accent-neutralise.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/global/scripts/app.min.js" type="text/javascript"></script>

        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <?php echo $script;?>
        <script>$("#myAlert").fadeOut(4000);</script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <?php require_once(APPPATH.'views/modal/modal_sobreaviso.php') ?>
        <?php require_once(APPPATH.'views/modal/modal_ramais_sefa.php') ?>
        <?php require_once(APPPATH.'views/modal/modal_ramais_dti.php') ?>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>