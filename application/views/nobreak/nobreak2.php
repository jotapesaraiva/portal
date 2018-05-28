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
                    <a href="<?php echo base_url(); ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Nobreak</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Nobreak
            <small>Quadro Atual dos Nobreaks - <?php echo date('d/m/Y H:i:s'); ?></small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN cards nobreaks-->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple">
                    <div class="visual">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="xxxxxxxxxx ºC" >0</span>
                        </div>
                        <div class="desc"> Nobreak Primário </div>
                    </div>
                        <a class="more" data-toggle="modal"  href="#modal_nbk1"> Detalhar Dados
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="dashboard-stat red">
                    <div class="visual">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                             <span data-counter="counterup" data-value="xxxxxxxxxx ºC" >0</span></div>
                        <div class="desc"> Nobreak Secundario</div>
                    </div>
                        <a class="more" data-toggle="modal"  href="#modal_nbk2">  Detalhar Dados
                        <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END cards nobreaks-->
        <!-- BEGIN Menu dos Gr⧩cos de Link-->
        <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption font-red">
                                <span class="caption-subject bold uppercase">Indicador de Evolução Diária da xxxxxxxxxxxx de Entrada do Nobreak </span>
                                <span class="caption-helper">(Mês Atual)</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="#"> </a>
                            </div>
                             <div class="tools">
                                <a href="" class="collapse"> </a>
                                <a href="" class="reload"> </a>
                                <a href="" class="remove"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form id="grafico" name="grafico" method="post" action="xxxxxxxxxxxxxx">
                                <div  align="center">
                                    <b>Nobreak</b>
                                    <select name="nobreak" class="select" onchange='this.form.submit()'>
                                        <option value="Primario" xxxxxxxxxx> selected >Primário</option>
                                        <option value="Secundario" xxxxxxxxxx> Secundário </option>
                                    </select>
                                    <b>Dia</b>
                                    <select name="dia" class="select" onchange='this.form.submit()'>
                                        <option  value='xxxxxxxxx'></option>

                                    </select>
                                    <b>Mês</b>
                                    <select name="mes" class="select" onchange='this.form.submit()'>
                                        <option  value='xxxxxxxxxxxxx'>Maio</option>
                                        <option  value='xxxxxxxxxxxxx'>Abril</option>
                                        <option  value='xxxxxxxxxxxxx'>Março</option>
                                    </select>
                                    <b>Variável</b>
                                    <select name="variavel" class="select" onchange='this.form.submit()'>
                                        <option  value='frequencia' xxxxxxxxxxxxx>Frequencia</option>
                                        <option  value='potencia' xxxxxxxxxxxxxxx>Potencia Ap. Tot.</option>
                                        <option  value='Tensao' xxxxxxxxxxxxxx>Tensão Entrada</option>
                                        <option  value='Corrente' xxxxxxxxxxxxx>Corrente Saida</option>
                                        <option  value='Potencia Entrada' xxxxxxxxxxxx>Potencia Entrada</option>
                                    </select>
                                    <br><br>
                                    <b>Tipo</b>
                                    <select name="tipo_graf" class="select" onchange='this.form.submit()'>
                                        <option  value='diario' xxxxxxxxxxxxx>Diário</option>
                                        <option  value='mensal'xxxxxxxxxxxxx>>Mensal</option>
                                    </select>
                                </div>
                <!-- Gr⧩co de Menu dos Gr⧩cos de Link-->
                                <input type='hidden' value='sim' name='rodou'>
                            </form>
                        </div>
                        <div id="container1" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>