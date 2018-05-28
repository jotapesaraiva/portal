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
                               <span><?= $array_total['total_in'] ?></span>
                           </div>
                           <div class="desc"> Total de E-mails Recebidos - <?= $email_recebido?>%</div>
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
                               <span ><?=$array_total['total_out']?></span>
                          </div>
                          <div class="desc">Total de E-mails Enviados  - <?= $email_enviado?>%</div>
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
                                <span><?=$array_total['total_spam']?></span>
                          </div>
                          <div class="desc">Total de Spam - <?= $spam?>%</div>
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
                      <div class="tools">
                        <a href="" class="collapse"> </a>
                        <a href="" class="reload"> </a>
                        <a href="" class="remove"> </a>
                      </div>
                   </div>
                   <div class="portlet-body">
                      <form id="grafico" name="grafico" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                            <div  align="center">
                                <b>Mês</b>
                                <select name="mes" class="select" onchange='this.form.submit()'>
                                  <option value='03'>Anterior</option>
                                  <option value='04'>Atual</option>
                                </select>
                            </div>
                          <!-- Gr⧩co de Menu dos Gr⧩cos de Link-->
                          <input type='hidden' value='sim' name='rodou'>
                      </form>
                      <div id="hc_chart_1"></div>
              </div>
        </div>
    </div>
</div>
<!-- End of file email.php -->
<!-- Location: ./application/views/email/email.php  -->