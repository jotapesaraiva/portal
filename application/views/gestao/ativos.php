<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
        <br>
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
                         <span class="caption-subject bold uppercase"> Lista de ativos </span>
                     </div>
                    </div>
                    <div class="portlet-body">
                     <div class="table-toolbar">
                         <div class="row">
                             <div class="col-md-6">
                                <?php if(acesso_admin()): ?>
                                 <div class="btn-group">
                                    <button class="btn sbold green" onclick="add_person()"> Adicionar Novo
                                        <i class="fa fa-plus"></i>
                                    </button>
                                 </div>
                                 <?php endif; ?>
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
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="table">
                            <thead>
                                <tr>
                                    <th> Nome </th>
                                    <th> Localização </th>
                                    <th> Numero de serie </th>
                                    <th> Modelo </th>
                                    <th> Fabricante </th>
                                    <th> Tipo </th>
                                    <th> Equipe Responsável </th>
                                    <th> Patrimonio </th>
                                    <th> Contrato </th>
                                    <th> Fornecedor </th>
                                    <th> Ação </th>
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

<!-- /* End of file ativos.php */ -->
<!-- /* Location: ./application/views/gerencias/ativos.php */ -->