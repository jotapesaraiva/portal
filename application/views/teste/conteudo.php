
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
            <small>dashboard & statistics</small>
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
                <div class="dashboard-stat blue">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="1349">22</span>°C
                        </div>
                        <div class="desc"> Nobreak Primário </div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="12,5">21</span>°C
                        </div>
                        <div class="desc"> Nobreak Secundário </div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="549">18</span>°C
                        </div>
                        <div class="desc"> Data Center </div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number"> +
                            <span data-counter="counterup" data-value="89"></span>% </div>
                        <div class="desc"> Brand Popularity </div>
                    </div>
                    <a class="more" href="javascript:;"> View more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-6 col-sm-6"> <!-- Tabela Monitora -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Monitora</span>
                            <span class="caption-helper">Alertas</span>
                        </div>
                        <div class="actions">
                            <!-- <div class="btn-group">
                                <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> All Project </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> AirAsia </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Cruise </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> HSBC </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Pending
                                            <span class="badge badge-danger"> 4 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Completed
                                            <span class="badge badge-success"> 12 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Overdue
                                            <span class="badge badge-warning"> 9 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
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
            </div><!-- FIM da Tabela Monitora -->
            <div class="col-md-6 col-sm-6"> <!-- Tabela link indisponivel -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Links</span>
                            <span class="caption-helper">Indisponíveis</span>
                        </div>
                        <div class="actions">
                            <!-- <div class="btn-group">
                                <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> All Project </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> AirAsia </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Cruise </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> HSBC </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Pending
                                            <span class="badge badge-danger"> 4 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Completed
                                            <span class="badge badge-success"> 12 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Overdue
                                            <span class="badge badge-warning"> 9 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
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
            <div class="col-md-6 col-sm-6"> <!-- Tabela Servidores -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Servidores</span>
                            <span class="caption-helper">SEFA/PRODEPA</span>
                        </div>
                        <div class="actions">
                            <!-- <div class="btn-group">
                                <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> All Project </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> AirAsia </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Cruise </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> HSBC </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Pending
                                            <span class="badge badge-danger"> 4 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Completed
                                            <span class="badge badge-success"> 12 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Overdue
                                            <span class="badge badge-warning"> 9 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
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
            <div class="col-md-6 col-sm-6"> <!-- Tabela Backupsl -->
                <div class="portlet light tasks-widget bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-green-haze hide"></i>
                            <span class="caption-subject font-green bold uppercase">Backups</span>
                            <span class="caption-helper">Falhos</span>
                        </div>
                        <div class="actions">
                            <!-- <div class="btn-group">
                                <a class="btn green btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> More
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> All Project </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> AirAsia </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Cruise </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> HSBC </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Pending
                                            <span class="badge badge-danger"> 4 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Completed
                                            <span class="badge badge-success"> 12 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Overdue
                                            <span class="badge badge-warning"> 9 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
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
    <!-- <pre>
    </pre> -->
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->