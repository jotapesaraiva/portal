<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
        <h3 class="page-title"> Dashboard
            <small>Produção</small>
        </h3>
        <?php
            get_msg('loginOk');
            get_msg('loginErro');
        ?>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="nbk01" class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-battery-full"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span id="nobreak01" data-counter="counterup" data-value="0">0</span>°C
                        </div>
                        <div class="desc"> Nobreak Primário </div>
                    </div>
                    <a class="more" href="https://x-oc-zabbix.sefa.pa.gov.br/zabbix/latest.php?filter_set=1&hostids[]=10567" target="_blank"> Mais info
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="nbk02" class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-battery-full"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span id="nobreak02" data-counter="counterup" data-value="0">0</span>°C
                        </div>
                        <div class="desc"> Nobreak Secundário </div>
                    </div>
                    <a class="more" href="https://x-oc-zabbix.sefa.pa.gov.br/zabbix/latest.php?filter_set=1&hostids[]=10595" target="_blank"> Mais info
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="dcenter" class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-building-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span id="datacenter" data-counter="counterup" data-value="0">0</span>°C
                        </div>
                        <div class="desc"> Data Center </div>
                    </div>
                    <a class="more" href="https://x-oc-zabbix.sefa.pa.gov.br/zabbix/latest.php?filter_set=1&hostids[]=10595" target="_blank"> Mais Info
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div id="num_mantis" class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-ticket"></i>
                    </div>
                    <div class="details">
                        <div id="quantidade" class="number">
                            <span data-counter="counterup" data-value="89"></span>0
                        </div>
                        <div class="desc"> Mantis </div>
                    </div>
                    <a class="more" href="javascript:void(0)" title="Info" onclick="chamados_mantis()"> Tabela mantis
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">

            <div class="col-lg-7 col-md-6 col-sm-6"> <!-- Tabela Monitora antigo -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-database font-green-haze"></i>
                            <span class="caption-subject font-green bold uppercase">Monitora</span>
                            <span class="caption-helper">Alertas</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"><i class="icon-wrench"></i></a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="monitora_down_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="monitora_down_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div><!-- FIM da Tabela Monitora antigo -->

            <div class="col-lg-5 col-md-6 col-sm-6"> <!-- Tabela link indisponivel -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-globe font-green-haze"></i>
                            <span class="caption-subject font-green bold uppercase">Links</span>
                            <span class="caption-helper">Indisponíveis</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="<?php echo base_url(); ?>/links/gmaps" target="_blank" data-original-title="" title=""><i class="fa fa-link"></i></a>
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"><i class="icon-wrench"></i></a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="links_down_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="links_down_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div><!-- FIM da Tabela link indisponivel -->

        </div>
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-6"> <!-- Tabela Servidores -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-server font-green-haze"></i>
                            <span class="caption-subject font-green bold uppercase">Servidores</span>
                            <span class="caption-helper">SEFA/PRODEPA</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;"><i class="icon-wrench"></i></a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="server_down_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="server_down_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div><!-- FIM da Tabela Servidores -->
            <div class="col-lg-5 col-md-6 col-sm-6"> <!-- Tabela Backupsl -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-copy font-green-haze"></i>
                            <span class="caption-subject font-green bold uppercase">Backups</span>
                            <span class="caption-helper">Falhos</span>
                        </div>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;" data-original-title="" title=""><i class="icon-wrench"></i></a>
                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="backups_down_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="backups_down_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div><!-- FIM da Tabela Backupsl -->
        </div>
        <div class="row">

<!--             <div class="col-md-6 col-sm-6">
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-desktop font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Zabbix</span>
                            <span class="caption-helper">Alertas</span>
                        </div>
                        <div class="actions">

                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="zabbix_down_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="zabbix_down_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div> -->

<!--             <div class="col-md-6 col-sm-6">
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Mantis</span>
                            <span class="caption-helper">Alertas</span>
                        </div>
                        <div class="actions">

                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="zabbix_down_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" />
                        </div>
                        <div id="mantis_down_content" class="table-scrollable table-scrollable-borderless"></div>
                    </div>
                </div>
            </div>
 -->
<!--         </div>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Mapa</span>
                            <span class="caption-helper">Links</span>
                        </div>
                        <div class="actions">

                            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="mapa"></div>
                    </div>
                </div>
            </div>
        </div> -->
    <!-- <pre>
    </pre> -->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

<!-- /* End of file admin.php */ -->
<!-- /* Location: ./application/views/dashboard/admin.php */ -->