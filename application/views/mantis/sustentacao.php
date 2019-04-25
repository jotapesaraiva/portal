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
        <!-- <h3 class="page-title"> Link
            <small>Tipo de acesso</small>
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
                        <span class="caption-subject bold uppercase"> Mantis Sustentação Pendentes / Resolvidas </span>
                    </div>
                   </div>
                   <div class="portlet-body">
                    <div class="table-toolbar">
                      <div class="row">
                        <form method="post">
                          <div class="col-md-offset-4 col-md-1">
                              <label class="bold">Status:</label>
                          </div>
                          <div class="col-md-3">
                              <select name="myselect" class="selectpicker selector" id="selector">
                                  <option value="Pendentes">Pendentes</option>
                                  <option value="Resolvidas">Resolvidas</option>
                              </select>
                          </div>
                        </form>
                          <div class="col-md-4">
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
                                    <th>#</th>
                                    <th>Número</th>
                                    <th>Data Abertura</th>
                                    <th>Status</th>
                                    <th>Criticidade</th>
                                    <th>Descrição</th>
                                    <th>Categoria</th>
                                    <th>Atribuido</th>
                                    <th>Solicitante</th>
                                    <th>Planejado</th>
                                    <th>Priorizado (Coord.DTI)</th>
                               </tr>
                           </thead>
                           <tbody>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

<!-- /* End of file sustentacao.php */ -->
<!-- /* Location: ./application/views/mantis/sustentacao.php */ -->