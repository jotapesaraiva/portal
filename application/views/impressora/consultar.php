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
                        <span class="caption-subject bold uppercase"> Consulta Impressoras  </span>
                    </div>
                   </div>
                   <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                          <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                            <div class="col-md-3 col-md-offset-3">
                              <label class="control-label col-md-4">Data Inicio </label>
                                <div class="input-group input-medium date date-picker" id='data_inicio'>
                                    <input class="form-control" readonly="" name="data_inicio" value="<?php echo $data_inicio;?>" type="text">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                              <label class="control-label col-md-4">Data Final </label>
                              <div class="input-group input-medium date date-picker" id='data_fim'>
                                  <input class="form-control" readonly="" name="data_fim" value="<?php echo $data_fim;?>" type="text">
                                  <span class="input-group-btn">
                                      <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                      </button>
                                  </span>
                              </div>
                            </div>
                            <noscript><input type="submit" value="Submit"></noscript>
                          </form>
                            <div class="col-md-3">
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
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
                           <thead>
                               <tr>
                                      <th>ID</th>
                                      <th>IP</th>
                                      <th>Local</th>
                                      <th>Unidade</th>
                                      <th>Data coleta</th>
                                      <th>Nº de Serie</th>
                                      <th>Toner</th>
                                      <th>Kit</th>
                                      <th>Nº de paginas</th>
                                      <!-- <th>Ação</th> -->
                               </tr>
                           </thead>
                           <tbody>
                                <?php //echo $historico; ?>
                           </tbody>
                       </table>
                   </div>
               </div>
            </div>

        </div>
    </div>
</div>
<!-- /* End of file consulta.php */ -->
<!-- /* Location: ./application/views/impressora/consulta.php */ -->