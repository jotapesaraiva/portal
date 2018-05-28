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
                            <span class="caption-subject font-red sbold uppercase"> Configuração Geral </span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="tabbable-line boxless margin-bottom-20">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab" aria-expanded="true"> Basic </a>
                                </li>
                                <li class="">
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="false"> Logs </a>
                                </li>
                                <li class="">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="false"> Cache </a>
                                </li>
                                <li class="">
                                    <a href="#tab_4" data-toggle="tab" aria-expanded="false"> Session </a>
                                </li>
                                <li class="">
                                    <a href="#tab_5" data-toggle="tab" aria-expanded="false"> Cookie </a>
                                </li>
                                <li class="">
                                    <a href="#tab_6" data-toggle="tab" aria-expanded="false"> Cross </a>
                                </li>
                                <li class="">
                                    <a href="#tab_7" data-toggle="tab" aria-expanded="false"> Security </a>
                                </li>
                                <li class="">
                                    <a href="#tab_8" data-toggle="tab" aria-expanded="false"> PHP </a>
                                </li>
                                <li class="">
                                    <a href="#tab_9" data-toggle="tab" aria-expanded="false"> Query Strings </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <form class="form-horizontal" id="basic" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Base Site URL: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $base_site; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Index File: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $index_file; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">URI PROTOCOL: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $uri_pro; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Default Language: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $default_language; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Default Character Set: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $charset; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Enable/Disable System Hooks: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $hook; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Class Extension Prefix: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $extension_pre; ?>"></input>
                                                </div>
                                                <label class="col-md-2 control-label">Composer auto-loading: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $compose; ?>" placeholder="Enter text">
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
                                                <label class="col-md-2 control-label">Error Logging Threshold: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $log_threshold; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Error Logging Directory Path: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $log_path; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Log File Extension: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $log_file_extension; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Log File Permissions: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $log_file_permissions; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Date Format for Logs: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $log_date_format; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Error Views Directory Path: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $error_views_path; ?>" placeholder="Enter text">
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
                                                <label class="col-md-2 control-label">Cache Directory Path: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $cache_path; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Cache Include Query String: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $cache_query_string; ?>" placeholder="Enter text">
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
                                                <label class="col-md-2 control-label">Driver: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_driver; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Cookie Name: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_cookie_name; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Expiration: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_expiration; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Save Path: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_save_path; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Match Ip: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_match_ip; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Time To Update: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_time_to_update; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Regenerate Destroy</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $sess_regenerate_destroy; ?>" placeholder="Entre com um texto.">
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
                                <div class="tab-pane" id="tab_5">
                                    <form class="form-horizontal" id="cookie" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Prefix: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $cookie_prefix; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Domain: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $cookie_domain; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Path: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo '$cookie_path'; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Secure: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $cookie_secure; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Httponly: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $cookie_httponly; ?>" placeholder="Enter text">
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
                                <div class="tab-pane" id="tab_6">
                                    <form class="form-horizontal" id="cross" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Protection: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $csrf_protection; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Token Name: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $csrf_token_name; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Cookie Name: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $csrf_cookie_name; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Expire: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $csrf_expire; ?>" placeholder="Enter text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Regenerate: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $csrf_regenerate; ?>" placeholder="Enter text">
                                                </div>
                                                <label class="col-md-2 control-label">Exclude Uris: </label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" value="<?php echo $csrf_exclude_uris; ?>" placeholder="Enter text">
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
                                <div class="tab-pane" id="tab_7">
                                </div>
                                <div class="tab-pane" id="tab_8">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /* End of file geral.php */ -->
<!-- /* Location: ./application/views/sistema/geral.php */ -->