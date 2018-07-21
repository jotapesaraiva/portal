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
        <br>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12">
                <div id="msgs"></div>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold ">LDAP Configurações</span>
                            <?php echo $this->uri->segment(2); ?>
                        </div>
                        <div class="actions">
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" action="salvar" method="post" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Admin Group: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="admin_group" class="form-control" value="<?php echo $admin_group; ?>" placeholder="Enter text">
                                    </div>
                                    <label class="col-md-2 control-label">Port: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="port" class="form-control" value="<?php echo $port; ?>" placeholder="Enter text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Base DN: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="base_dn" class="form-control" value="<?php echo $base_dn; ?>" placeholder="Enter text">
                                    </div>
                                    <label class="col-md-2 control-label">AD Domain: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="ad_domain" class="form-control" value="<?php echo $ad_domain; ?>" placeholder="Enter text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Start OU: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="start_ou" class="form-control" value="<?php echo $start_ou; ?>" placeholder="Enter text">
                                    </div>
                                    <label class="col-md-2 control-label">Proxy User: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="proxy_user" class="form-control" value="<?php echo $proxy_user; ?>" placeholder="Enter text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Hosts: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="hosts" class="form-control" value="<?php echo $hosts; ?>"></input>
                                    </div>
                                    <label class="col-md-2 control-label">Proxy Password: </label>
                                    <div class="col-md-3">
                                        <input type="text" name="proxy_pass" class="form-control" value="<?php echo $proxy_pass; ?>" placeholder="Enter text">
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

<!-- /* End of file ldap.php */ -->
<!-- /* Location: ./application/views/sistema/ldap.php */ -->