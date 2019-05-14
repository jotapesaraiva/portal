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
                        <span class="caption-subject bold uppercase"> Cálculo de tempo de Atendimento de chamados  </span>
                    </div>
                   </div>
                   <div class="portlet-body">
                    <div class="table-toolbar">
                      <div class="row">
                        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                          <div class="col-md-3 col-md-offset-3">
                            <label class="control-label col-md-4">Data Inicio </label>
                              <div class="input-group input-medium date date-picker" >
                                  <input class="form-control" readonly="" name="data1" value="<?php echo $data_inicio;?>" type="text" onchange='this.form.submit()'>
                                  <span class="input-group-btn">
                                      <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                      </button>
                                  </span>
                              </div>
                          </div>
                          <div class="col-md-3">
                            <label class="control-label col-md-4">Data Final </label>
                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy">
                                <input class="form-control" readonly="" name="data2" value="<?php echo $data_final;?>" type="text" onchange='this.form.submit()'>
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
                       <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table1">
                           <thead>
                               <tr>
                                            <th>#</th>
                                            <th>Mantis</th>
                                            <th>Localidade</th>
                                            <th>Ticket/Chamado</th>
                                            <th>Data Abertura</th>
                                            <th>Data Fechamento</th>
                                            <th>Tempo Atendimento</th>
                                            <th>Responsabilidade</th>
                               </tr>
                           </thead>
                           <tbody>
                            <?php echo $chamados;?>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

<!-- /* End of file historico.php */ -->
<!-- /* Location: ./application/views/link/historico.php */ -->