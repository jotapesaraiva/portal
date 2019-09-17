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
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Email</span>
                </li>
            </ul>
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
               <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   <div class="dashboard-stat green">
                       <div class="visual">
                           <i class="fa fa-mail-forward"></i>
                       </div>
                       <div class="details">
                           <div class="number">
                               <span ><?php echo $array_total['total_in'];?></span>
                           </div>
                           <div class="desc"> Total de E-mails Recebidos - <?php echo porcentagem($array_total['total_in'],array_sum($array_total));?>%</div>
                       </div>
                   </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   <div class="dashboard-stat blue">
                       <div class="visual">
                           <i class="fa fa-mail-reply"></i>
                       </div>
                       <div class="details">
                          <div class="number">
                               <span> <?php echo $array_total['total_out'];?></span>
                           </div>

                          <div class="desc">Total de E-mails Enviados - <?php echo porcentagem($array_total['total_out'],array_sum($array_total));?>%</div>
                       </div>
                   </div>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                   <div class="dashboard-stat red">
                       <div class="visual">
                           <i class="fa fa-dot-circle-o"></i>
                       </div>
                       <div class="details">
                          <div class="number">
                                <span><?php echo array_sum($array_total);?></span>
                          </div>
                          <div class="desc">Total de Spam - <?php echo porcentagem($array_total['total_spam'],array_sum($array_total));?>%</div>
                       </div>
                   </div>
               </div>
           </div>

              <div class="portlet light bordered">
                   <div class="portlet-title">
                      <div class="caption font-dark">
                          <i class="icon-settings font-dark"></i>
                          <span class="caption-subject bold uppercase">Indicador de Evolução Diária do Fluxo de E-mails</span>
                          <span class="caption-helper">(Mês Atual)</span>
                      </div>
                   </div>
                   <div class="portlet-body">
                      <div id="grafico"></div>
              </div>
        </div>
    </div>
</div>
<!-- End of file spam.php -->
<!-- Location: ./application/views/email/spam.php  -->