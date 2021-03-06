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
        <br>
<!--         <h3 class="page-title"> Robôs
            <small>Dell e HP</small>
        </h3> -->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">

            <div class="col-md-12">
                <div id="msgs"></div>
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet light bordered">
                   <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold"> Dados Copiados  da session: <?php echo $session_id ?> do backup: <?php echo $specification ?></span>
                    </div>
                   </div>
                   <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Ferramentas
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                      <li>
                                          <a href="#" id="btn-print">
                                              <i class="fa fa-print"></i> Imprimir </a>
                                      </li>
                                      <li>
                                          <a href="#" id="btn-pdf">
                                              <i class="fa fa-file-pdf-o"></i> Salvar em PDF </a>
                                      </li>
                                      <li>
                                          <a href="#" id="btn-excel">
                                              <i class="fa fa-file-excel-o"></i> Exportar para Excel </a>
                                      </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table1">
                           <thead>
                               <tr>
                                      <th>Type</th>
                                      <th>Client</th>
                                      <th>Mountpoint</th>
                                      <th>Description</th>
                                      <th>Object Name</th>
                                      <th>Status</th>
                                      <th>Mode</th>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Duration</th>
                                      <th>Size</th>
                                      <th>Files</th>
                                      <th>Performance</th>
                                      <th>Protection</th>
                                      <th>Errors</th>
                                      <th>Warnings</th>
                                      <th>Device</th>
                               </tr>
                           </thead>
                           <tbody>
                                <?php echo $dataCopy; ?>
                           </tbody>
                       </table>
                   </div>
               </div>
            </div>

        </div>
    </div>
</div>
<!-- /* End of file dados_copiados.php */ -->
<!-- /* Location: ./application/views/backup/dados_copiados.php */ -->