<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

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
                          <span class="caption-subject bold uppercase">Janela de Backups</span>
                      </div>
                      <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="" class="reload"> </a>
                        <!-- <a href="" class="remove"> </a> -->
                      </div>
                   </div>
                  <div class="portlet-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-4by3">
                      <iframe class="embed-responsive-item" src="https://producaoh.sefa.pa.gov.br/portal/backup/janela_bkp/janela"></iframe>
                    </div>
                  </div>
                </div>
            </div>
        </div>

<!-- /* End of file janela_bkp.php */ -->
<!-- /* Location: ./application/views/backup/janela_bkp.php */ -->