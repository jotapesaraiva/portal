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
        <h3 class="page-title"> Meu Perfil
            <small></small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div id="msgs"></div>
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="<?php echo $perfil_user; ?>" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> <?php echo $this->session->userdata('username'); ?> </div>
                            <div class="profile-usertitle-job"> <?php echo $this->session->userdata('physicaldeliveryofficename'); ?> </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="active">
                                    <a href="<?php echo base_url();?>menu/meu_perfil">
                                        <i class="icon-home"></i> Overview </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>menu/meu_perfil/configuracao">
                                        <i class="icon-settings"></i> Configuração da Conta </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>menu/meu_perfil/ajuda">
                                        <i class="icon-info"></i> Ajuda </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <!-- STAT -->
                        <h3 class="page-title">Score Mantis</h3>
                        <div class="row list-separated profile-stat">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $abertos; ?> </div>
                                <div class="uppercase profile-stat-text"> Abertos </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $impedidos; ?> </div>
                                <div class="uppercase profile-stat-text"> Impedidos </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $realizados; ?> </div>
                                <div class="uppercase profile-stat-text"> Realizados </div>
                            </div>
                        </div>
                        <!-- END STAT -->
<!--                         <div>
                            <h4 class="profile-desc-title">About Marcus Doe</h4>
                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-twitter"></i>
                                <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-facebook"></i>
                                <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                            </div>
                        </div> -->
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold">Resolvidos por Prioridade</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartdiv" style="width:100%;height:400px;" class="chart"></div>
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold ">Top 10 por </span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Serviço </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> Categoria </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Abertos </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <ul class="feeds">
                                                    <?php foreach ($servicos as $value) { ?>
                                                    <li>
                                                        <div class="col1">
                                                            <div class="cont">
                                                                <div class="cont-col1">
                                                                    <div class="label label-sm label-success">
                                                                        <?php echo $value['ROWNUM']; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="cont-col2">
                                                                    <div class="desc"> <?php echo $value['SERVICO']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col2">
                                                            <div class="date"> <?php echo $value['QTD_MANTIS']; ?> </div>
                                                        </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_2">
                                            <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <ul class="feeds">
                                                    <?php foreach ($categoria as $value) { ?>
                                                    <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-warning">
                                                                            <?php echo $value['ROWNUM']; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> <?php echo $value['CATEGORIA']; ?> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> <?php echo $value['QTD_MANTIS']; ?> </div>
                                                            </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_1_3">
                                            <div class="scroller" style="height: 337px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <ul class="feeds">
                                                    <?php foreach ($chamados as $value) { ?>
                                                    <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-info">
                                                                            <?php echo $value['ROWNUM']; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc"> <?php echo $value['CATEGORIA']; ?> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"> <?php echo $value['QTD_MANTIS']; ?> </div>
                                                            </div>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold ">Mantis por Status </span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    grafico de rosca
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                        <div class="col-md-6">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light  tasks-widget">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <span class="caption-subject font-blue-madison bold ">Mantis Atribuídos a mim</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="task-content">
                                        <div class="table-scrollable">
                                           <table class="table table-bordered table-hover">
                                               <thead>
                                                   <tr>
                                                       <th> Num.</th>
                                                       <th> Mantis </th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                <?php foreach ($atribuidos as $value) { ?>
                                                   <tr class="<?php echo color_mantis($value['STATUS']); ?>">
                                                       <td style="font-size: 12px;"> <?php
                                                       echo anchor_popup('https://mantis.sefa.pa.gov.br/view.php?id='.$value['ID'].'', $value["ID"]) .' '.
                                                       $value['NUMERO']; ?> </td>
                                                       <td style="font-size: 12px;">
                                                           <span > <?php echo $value['MANTIS']; ?> </span>
                                                       </td>
                                                   </tr>
                                                <?php } ?>
                                               </tbody>
                                           </table>
                                       </div>
                                    </div>
                                    <div class="task-footer">
                                        <div class="btn-arrow-link pull-right">
                                            <a href="https://mantis.sefa.pa.gov.br/my_view_page.php">Ver todos os mantis</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET -->
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<!-- /* End of file meu_perfil.php */ -->
<!-- /* Location: ./application/views/dashboard/meu_perfil.php */ -->