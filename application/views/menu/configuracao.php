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
                            <img src="<?php echo $perfil_user; ?>" class="img-responsive" alt=""> </div>
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
                                                    <input type="text" value="" name="nome" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Login</label>
                                                    <input type="text" value="" name="login" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="text" value="" name="email" class="form-control" /> </div>
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
                                                    <input type="text" value="" name="cargo" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Celula / Equipe</label>
                                                    <input type="text" value="" name="equipe" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Telefone</label>
                                                    <input type="text" value="" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Celular</label>
                                                    <input type="text" value="" class="form-control" /> </div>
                                                <div class="form-group">
                                                    <label class="control-label">Voip</label>
                                                    <input type="text" value="" class="form-control" /> </div>

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
                                                            <img src="<?php echo $perfil_user; ?>" alt="" /> </div>
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
                                                        <td> Nivel de acesso </td>
                                                        <td class="text-right">
                                                            <div class="col-md-9">
                                                                <div class="margin-bottom-10">
                                                                    <label for="user">Usuário Comum :</label>
                                                                    <input id="user" type="radio" name="radio1" data-size="small" class="make-switch switch-radio1">
                                                                </div>
                                                                <div class="margin-bottom-10">
                                                                    <label for="admin">Administrador :</label>
                                                                    <input id="admin" type="radio" name="radio1" data-size="small" class="make-switch switch-radio2">
                                                                </div>
                                                                <div class="margin-bottom-10">
                                                                    <label for="super">Super Admin :</label>
                                                                    <input id="super" type="radio" name="radio1" data-size="small" class="make-switch switch-radio3">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Acesso as paginas : </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"  class="bold text-center">### CONSULTA ###</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gerência</td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="user">Tecnico :</label>
                                                                <input type="checkbox" name="tecnico" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="admin">Fornecedor :</label>
                                                                <input type="checkbox" name="fornecedor" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Contato :</label>
                                                                <input type="checkbox" name="contato" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Servidores :</label>
                                                                <input type="checkbox" name="servidor" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Acessos :</label>
                                                                <input type="checkbox" name="acessos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Voucher :</label>
                                                                <input type="checkbox" name="voucher" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Agendamento :</label>
                                                                <input type="checkbox" name="agendamento" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Ativos :</label>
                                                                <input type="checkbox" name="ativos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Contratos :</label>
                                                                <input type="checkbox" name="contratos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Ramais </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Voip :</label>
                                                                <input type="checkbox" name="voip" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Localidades </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Links :</label>
                                                                <input type="checkbox" name="link" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Unidades :</label>
                                                                <input type="checkbox" name="unidade" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"  class="bold text-center">#### ANALISE ###</td>
                                                    </tr>
                                                    <tr>
                                                        <td> Backup </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Historico :</label>
                                                                <input type="checkbox" name="historico_bkp" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Janela de Backup :</label>
                                                                <input type="checkbox" name="janela_bkp" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Fitas :</label>
                                                                <input type="checkbox" name="fitas" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Gráficos :</label>
                                                                <input type="checkbox" name="graficos_bkp" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Links </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Historico :</label>
                                                                <input type="checkbox" name="historico_link" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Calculo multa :</label>
                                                                <input type="checkbox" name="calculo_multa" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Consumo de banda :</label>
                                                                <input type="checkbox" name="consumo_banda" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Chamados links :</label>
                                                                <input type="checkbox" name="chamado_links" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Gráficos :</label>
                                                                <input type="checkbox" name="graficos_link" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td> Mantis </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">CGAQ :</label>
                                                                <input type="checkbox" name="cgaq" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">CGPS :</label>
                                                                <input type="checkbox" name="cgps" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4"  class="bold text-center">### CONFIGURAÇÕES ###</td>
                                                    </tr>
                                                    <tr >
                                                        <td> Sistema </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Geral :</label>
                                                                <input type="checkbox" name="geral" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Logs :</label>
                                                                <input type="checkbox" name="log" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">LDAP :</label>
                                                                <input type="checkbox" name="ldap" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Itens configuração :</label>
                                                                <input type="checkbox" name="consulta" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Usuários </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Lista usuários :</label>
                                                                <input type="checkbox" name="lista" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Permissão :</label>
                                                                <input type="checkbox" name="permissao" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Grupos/Equipe :</label>
                                                                <input type="checkbox" name="grupos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Modulos :</label>
                                                                <input type="checkbox" name="modulos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Perfil :</label>
                                                                <input type="checkbox" name="perfil" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Cargo :</label>
                                                                <input type="checkbox" name="cargo" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Banco de dados </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Configuração :</label>
                                                                <input type="checkbox" name="configuracao" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Backup :</label>
                                                                <input type="checkbox" name="backup" class="make-switch" checked data-size="small"  >
                                                            </div>
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