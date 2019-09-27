<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

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
                          <span class="caption-subject bold uppercase">CronJob do Servidor</span>
                      </div>
                      <div class="tools">

                      </div>
                   </div>
                  <div class="portlet-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-4by3">
                      <iframe class="embed-responsive-item" src="http://10.3.1.146/cronkeep/src/"></iframe>
                    </div>
                  </div>
                </div>
            </div>
        </div>


<!--  // End of file iframe.php -->
<!-- /* Location: ./application/views/sistema/iframe.php */ -->