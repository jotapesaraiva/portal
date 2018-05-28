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
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">  CodeIgniter Log Viewer </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-toolbar">
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="btn-group">
                                        <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown"> Ação
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right">
                                        <?php if($currentFile): ?>
                                            <li>
                                                <a href="?dl=<?= base64_encode($currentFile); ?>">
                                                    <i class="glyphicon glyphicon-download-alt"></i> Download </a>
                                            </li>
                                            <li>
                                                <a href="?del=<?= base64_encode($currentFile); ?>" id="delete-log">
                                                    <i class="glyphicon glyphicon-trash"></i> Excluir atual </a>
                                            </li>
                                                <?php if(count($files) > 1): ?>
                                            <li>
                                                <a href="?del=<?= base64_encode("all"); ?>" id="delete-all-log">
                                                    <i class="glyphicon glyphicon-trash"></i> Excluir todos </a>
                                            </li>
                                                <?php endif; ?>
                                        <?php endif; ?>
                                        </ul>
                                     </div>
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
                        <div class="row">
                            <div class="col-md-2">
                                <h3><span>Lista de arquivos</span></h3>
                                <div class="list-group">
                                    <?php if(empty($files)): ?>
                                        <a class="list-group-item active">No Log Files Found</a>
                                    <?php else: ?>
                                        <?php foreach($files as $file): ?>
                                            <a href="?f=<?= base64_encode($file); ?>"
                                               class="list-group-item <?= ($currentFile == $file) ? "active" : "" ?>">
                                                <?= $file; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <table id="table-log" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Date</th>
                                        <th>Content</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($logs as $key => $log): ?>
                                        <tr data-display="stack<?= $key; ?>">
                                            <td class="text-<?= $log['class']; ?>">
                                                <span class="<?= $log['icon']; ?>" aria-hidden="true"></span>
                                                &nbsp;<?= $log['level']; ?>
                                            </td>
                                            <td class="date"><?= $log['date']; ?></td>
                                            <td class="text">
                                                <?php if (array_key_exists("extra", $log)): ?>
                                                    <a class="pull-right expand btn btn-default btn-xs"
                                                       data-display="stack<?= $key; ?>">
                                                        <span class="glyphicon glyphicon-search"></span>
                                                    </a>
                                                <?php endif; ?>
                                                <?= $log['content']; ?>
                                                <?php if (array_key_exists("extra", $log)): ?>
                                                    <div class="stack" id="stack<?= $key; ?>"
                                                         style="display: none; white-space: pre-wrap;">
                                                        <?= $log['extra'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- /* End of file log.php */ -->
<!-- /* Location: ./application/views/sistema/log.php */ -->