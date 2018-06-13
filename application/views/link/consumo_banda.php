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
                        <span class="caption-subject bold uppercase"> Consumo de Banda de Link </span>
                    </div>
                   </div>
                   <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">

                                <form method="post" name="myform" action="<?php $_SERVER['PHP_SELF']?>">
                                  <b>Pesquisar por Periodo:</b>
                                  <select name="periodo_consumo" name="myselect" class="select" onchange='this.form.submit()'>
                                    <option value="" <?php echo set_select('myselect', '', ($periodo_consumo == "") ? TRUE : FALSE ); ?>>Consumo Atual</option>
                                    <option value="1 HOUR" <?php echo set_select('myselect', '1 HOUR', ($periodo_consumo == "1 HOUR") ? TRUE : FALSE ); ?>>1 Hora</option>
                                    <option value="6 HOUR" <?php echo set_select('myselect', '6 HOUR', ($periodo_consumo == "6 HOUR") ? TRUE : FALSE ); ?>>6 Horas</option>
                                    <option value="24 HOUR" <?php echo set_select('myselect', '24 HOUR', ($periodo_consumo == "4 HOUR") ? TRUE : FALSE ); ?>>24 Horas</option>
                                    <option value="7 DAY" <?php echo set_select('myselect', '7 DAY', ($periodo_consumo == "7 DAY") ? TRUE : FALSE ); ?>>7 Dias</option>
                                    <option value="30 DAY" <?php echo set_select('myselect', '30 DAY', ($periodo_consumo == "30 DAY") ? TRUE : FALSE ); ?>>30 Dias</option>
                                  </select>
                                </form>
                              <noscript><input type="submit" value="Submit"></noscript>
                            </div>
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
                                    <th>ID</th>
                                    <th>Localidade</th>
                                    <th>Consumo de Banda</th>
                                    <th>Horário Verificação</th>
                                    <th>Link</th>
                                    <th>Entrada Média</th>
                                    <th>Entrada Máxima</th>
                                    <th>Saída Média</th>
                                    <th>Saída Máxima</th>
                               </tr>
                           </thead>
                           <tbody>
                            <?php echo $consumo;?>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

<!-- /* End of file consumo_banda.php */ -->
<!-- /* Location: ./application/views/link/consumo_banda.php */ -->