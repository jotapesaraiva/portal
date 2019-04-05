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
                        <span class="caption-subject bold uppercase"> Chamados Pendentes Anual </span>
                    </div>
                   </div>
                   <div class="portlet-body">
                      <div class="row">
                        <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                          <div class="col-md-3 col-md-offset-3">
                            <label class="control-label col-md-4 bold">Data Inicio </label>
                              <div class="input-group input-medium date year-picker" >
                                  <input class="form-control" name="ano" readonly value="<?php echo $ano;?>" type="text" onchange='this.form.submit()'>
                                  <span class="input-group-btn">
                                      <button class="btn default" type="button">
                                          <i class="fa fa-calendar"></i>
                                      </button>
                                  </span>
                              </div>
                          </div>
                          <noscript><input type="submit" value="Submit"></noscript>
                        </form>
                      </div>
                      <div class="row">
                        <div id="chartdiv" style="width:100%;height:600px;" class="chart"></div>
                      </div>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

<!-- /* End of file graf_chamdos_pendentes.php */ -->
<!-- /* Location: ./application/views/mantis/graf_chamdos_pendentes.php */ -->