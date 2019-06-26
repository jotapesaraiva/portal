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
                        <span class="caption-subject bold uppercase"> Modulos do sistema </span>
                    </div>
                   </div>
                   <div class="portlet-body form">
                    <form class="form-horizontal form-bordered" id="form" action="#">

                    <div id="modulos"></div>

                    <?php echo $modulo; ?>

                      <div class="form-actions">
                          <div class="row">
                              <div class="col-md-offset-3 col-md-9">
                                  <a href="javascript:;" id="btnSave" onclick="save()" class="btn green">
                                      <i class="fa fa-check"></i> Alterar</a>
                                  <a href="javascript:;" class="btn btn-outline grey-salsa">Cancelar</a>
                              </div>
                          </div>
                      </div>

                    </form>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>

<!-- /* End of file acesso.php */ -->
<!-- /* Location: ./application/views/sistema/itens_consulta/acesso.php */ -->