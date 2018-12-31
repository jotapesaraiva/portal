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
        <?php
          get_msg('loginOk');
          get_msg('msgOK');
        ?>
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
                            <span class="caption-subject font-red sbold uppercase"> Configuração Banco de dados </span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="tabbable-line boxless margin-bottom-20">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Local </a>
                                </li>
                                <li class="">
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="false"> Monitora </a>
                                </li>
                                <li class="">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="false"> Portalmoni </a>
                                </li>
                                <li class="">
                                    <a href="#tab_4" data-toggle="tab" aria-expanded="false"> Mantis </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form class="form-horizontal" id="basic" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Hostname: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $default_hostname; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Database: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $default_database; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $default_username; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Password: </label>
                                                <div class="col-md-3">
                                                    <input type="password" class="form-control" value="<?php echo $default_password; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Dbdriver: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $default_dbdriver; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Salvar</button>
                                                    <button type="button" class="btn default">Limpar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_2">
                                    <form class="form-horizontal" id="log" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Hostname: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $monitora_hostname; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Database: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $monitora_database; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $monitora_username; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Password: </label>
                                                <div class="col-md-3">
                                                    <input type="password" class="form-control" value="<?php echo $monitora_password; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Dbdriver: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $monitora_dbdriver; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Salvar</button>
                                                    <button type="button" class="btn default">Limpar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_3">
                                    <form class="form-horizontal" id="cache" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Hostname: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $portalmoni_hostname; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Database: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $portalmoni_database; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $portalmoni_username; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Password: </label>
                                                <div class="col-md-3">
                                                    <input type="password" class="form-control" value="<?php echo $portalmoni_password; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Dbdriver: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $portalmoni_dbdriver; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Salvar</button>
                                                    <button type="button" class="btn default">Limpar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_4">
                                    <form class="form-horizontal" id="session" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Hostname: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $mantis_hostname; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Database: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $mantis_database; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Username: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $mantis_username; ?>">
                                                </div>
                                                <label class="col-md-2 control-label">Password: </label>
                                                <div class="col-md-3">
                                                    <input type="password" class="form-control" value="<?php echo $mantis_password; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Dbdriver: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $mantis_dbdriver; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Salvar</button>
                                                    <button type="button" class="btn default">Limpar</button>
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
        </div>
    </div>
</div>

<!-- /* End of file database.php */ -->
<!-- /* Location: ./application/views/banco_de_dados/database.php */ -->