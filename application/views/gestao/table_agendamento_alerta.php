<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <?php echo $this->breadcrumbs->show(); ?>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">
        </h3>
        <?php
            get_msg('loginOk');
            get_msg('loginErro');
        ?>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12"> <!-- Tabela Monitora antigo -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-database font-green-haze"></i>
                            <span class="caption-subject font-green bold uppercase">Alertas</span>
                            <span class="caption-helper">Agendamento</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"><i class="icon-wrench"></i></a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="table_agendamento_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="table_agendamento_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div><!-- FIM da Tabela Monitora antigo -->

        </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<!-- /* End of file alerta_agendamento.php */ -->
<!-- /* Location: ./application/views/gerencias/alerta_agendamento.php */ -->