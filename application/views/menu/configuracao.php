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
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Meu Perfil
            <small></small>
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div id="msgs"></div>
                <?php get_msg('loginOk'); get_msg('loginErro'); get_msg('retorno')?>
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="<?php echo base_url(); ?>assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> <?php echo $this->session->userdata('username'); ?> </div>
                            <div class="profile-usertitle-job"> <?php echo $this->session->userdata('physicaldeliveryofficename'); ?> </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li >
                                    <a href="<?php echo base_url();?>menu/meu_perfil">
                                        <i class="icon-home"></i> Overview </a>
                                </li>
                                <li class="active">
                                    <a href="<?php echo base_url();?>menu/meu_perfil/configuracao">
                                        <i class="icon-settings"></i> Configuração da Conta </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>menu/meu_perfil/ajuda">
                                        <i class="icon-info"></i> Ajuda </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                    <!-- PORTLET MAIN -->
                    <div class="portlet light ">
                        <!-- STAT -->
                        <h3 class="page-title">Mantis</h3>
                        <div class="row list-separated profile-stat">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $abertos; ?> </div>
                                <div class="uppercase profile-stat-text"> Abertos </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $impedidos; ?> </div>
                                <div class="uppercase profile-stat-text"> Impedidos </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="uppercase profile-stat-title"> <?php echo $realizados; ?> </div>
                                <div class="uppercase profile-stat-text"> Realizados </div>
                            </div>
                        </div>
                        <!-- END STAT -->
<!--                         <div>
                            <h4 class="profile-desc-title">About Marcus Doe</h4>
                            <span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-globe"></i>
                                <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-twitter"></i>
                                <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                            </div>
                            <div class="margin-top-20 profile-desc-link">
                                <i class="fa fa-facebook"></i>
                                <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                            </div>
                        </div> -->
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
                <!-- END BEGIN PROFILE SIDEBAR -->
                <!-- BEGIN PROFILE CONTENT -->
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Perfil da conta</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Info Pessoal</a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab">Mudar a Foto</a>
                                        </li>
<!--                                         <li>
                                            <a href="#tab_1_3" data-toggle="tab">Mudar a Senha</a>
                                        </li> -->
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab">Configuração de Privilegio</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                            <form role="form" action="#">
                                                <div class="form-group">
                                                    <label class="control-label">Nome</label>
                                                    <input type="text" value="<?php echo $usuario->nome_usuario;?>" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Login</label>
                                                    <input type="text" value="<?php echo $usuario->login_usuario;?>" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" value="<?php echo $usuario->email_usuario;?>"class="form-control" /> </div>
                                                <div class="form-group">
                                                    <div class="col-md-4 col-md-offset-2">
                                                        <label class="control-label">Sobreaviso</label>
                                                        <input name="sobreaviso" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Sim&nbsp;&nbsp;" data-off-text="&nbsp;Não&nbsp;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label">Status</label>
                                                        <input name="status" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Ativo&nbsp;&nbsp;" data-off-text="&nbsp;Desativado&nbsp;"> </div>
                                                    </div>
                                                <div class="form-group">
                                                    <label class="control-label">Cargo</label>
                                                    <input type="text" value="<?php echo $usuario->nome_cargo;?>" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Celula / Equipe</label>
                                                    <input type="text" value="<?php echo $usuario->nome_grupo;?>" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="text" value="<?php echo $telefone->numero;?>" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Celular</label>
                                                    <input type="text" value="<?php echo $celular->numero;?>" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Voip</label>
                                                    <input type="text" value="<?php echo $voip->numero;?>" class="form-control" /> </div>

                                                <div class="margiv-top-10">
                                                    <a href="javascript:;" class="btn green"> Save Changes </a>
                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PERSONAL INFO TAB -->
                                        <!-- CHANGE AVATAR TAB -->
                                        <div class="tab-pane" id="tab_1_2">
                                            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                                eiusmod. </p>
                                            <?php echo form_open_multipart('menu/meu_perfil/enviar');?>
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn default btn-file">
                                                                <span class="fileinput-new"> Selecionar imagem </span>
                                                                <span class="fileinput-exists"> Mudar </span>
                                                                <input type="file" name="perfil" size="20">
                                                            </span>
                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remover </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10">
                                                        <span class="label label-danger">OBS: </span>
                                                        <span>A imagem deve ser no formato img, png ou jpg no tamanho até 50MB </span>
                                                    </div>
                                                </div>
                                                <div class="margin-top-10">
                                                    <input type="submit"  class="btn green" value="upload" />
                                                    <!-- <a href="javascript:;" class="btn green"> Enviar </a> -->
                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
<!--                                         <div class="tab-pane" id="tab_1_3">
                                            <form action="#">
                                                <div class="form-group">
                                                    <label class="control-label">Current Password</label>
                                                    <input type="password" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">New Password</label>
                                                    <input type="password" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Re-type New Password</label>
                                                    <input type="password" class="form-control" /> </div>
                                                <div class="margin-top-10">
                                                    <a href="javascript:;" class="btn green"> Change Password </a>
                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div> -->
                                        <!-- END CHANGE PASSWORD TAB -->
                                        <!-- PRIVACY SETTINGS TAB -->
                                        <div class="tab-pane" id="tab_1_4">
                                            <form action="#">
                                                <table class="table table-light table-hover">
                                                    <tr>
                                                        <td> Nivel de acesso : </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <input type="radio" name="optionsRadios1" value="option1" /> Yes </label>
                                                            <label class="uniform-inline">
                                                                <input type="radio" name="optionsRadios1" value="option2" checked/> No </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Acesso as paginas : </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <input type="checkbox" value="" /> Yes </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <input type="checkbox" value="" /> Yes </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                                        <td>
                                                            <label class="uniform-inline">
                                                                <input type="checkbox" value="" /> Yes </label>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!--end profile-settings-->
                                                <div class="margin-top-10">
                                                    <a href="javascript:;" class="btn red"> Save Changes </a>
                                                    <a href="javascript:;" class="btn default"> Cancel </a>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PROFILE CONTENT -->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


<!-- /* End of file configuracao.php */ -->
<!-- /* Location: ./application/views/dashboard/configuracao.php */ -->