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
                                            <form role="form" action="#" id="info">
                                                <div class="hide" name="id_usuario" id="usuario"></div>
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
                                                        <input name="status" type="checkbox" class="make-switch" checked data-on-text="&nbsp;Ativo&nbsp;&nbsp;" data-off-text="&nbsp;Desativado&nbsp;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Permissão : </label>
                                                    <div class="input-icon">
                                                        <select class="selectpicker form-control" name="permissao" data-live-search="true">
                                                            <option value="">------Selecione uma permissão-----</option>
                                                            <?php foreach($permissaos->result() as $permissao) :?>
                                                              <option value="<?=$permissao->id_permissao?>"><?=$permissao->nome_permissao?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Cargo</label>
                                                    <div class="input-icon">
                                                        <select class="selectpicker form-control" name="cargo" data-live-search="true">
                                                            <option value="">------Selecione um cargo-----</option>
                                                            <?php foreach($cargos->result() as $cargo) :?>
                                                              <option value="<?=$cargo->id_cargo?>"><?=$cargo->nome_cargo?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Celula / Equipe</label>
                                                    <div class="input-icon">
                                                        <select class="selectpicker form-control" name="grupo" data-live-search="true">
                                                            <option value="">------Selecione um grupo-----</option>
                                                            <?php foreach($grupos->result() as $grupo) :?>
                                                              <option value="<?=$grupo->id_grupo?>"><?=$grupo->nome_grupo?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div id="wrapper_telefone_add">
                                                    <div class="form-group">
                                                        <input type="hidden" class="group-input" name="id_telefone[]"/>
                                                        <label class="control-label">Telefone</label>
                                                        <div class="input-group">
                                                            <div class="input-icon">
                                                                <input style="padding: 6px 12px !important;" class="form-control" name="telefone[]" id="phone_with_ddd" placeholder="Numero do telefone" type="text">
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button class="btn blue" id="add_telefone" type="button" tabindex="-1">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="wrapper_celular_add">
                                                    <div class="form-group">
                                                        <input type="hidden" class="group-input" name="id_celular[]"/>
                                                        <label class="control-label">Celular</label>
                                                        <div class="input-group">
                                                            <div class="input-icon">
                                                                <input style="padding: 6px 12px !important;" class="form-control" name="celular[]" id="cell" placeholder="Numero do celular" type="text">
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button class="btn blue" id="add_celular" type="button" tabindex="-1">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="wrapper_voip_add">
                                                    <div class="form-group">
                                                        <input type="hidden" class="group-input" name="id_voip[]"/>
                                                        <label class="control-label">Voip</label>
                                                        <div class="input-group">
                                                            <div class="input-icon">
                                                                <select class="selectpicker form-control" name="voip[]" data-live-search="true">
                                                                    <option value="">------Selecione um VoIP-----</option>
                                                                    <?php foreach($voips->result() as $voip) : ?>
                                                                    <option value="<?=$voip->id_telefone?>"><?=$voip->numero_telefone?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                            <span class="input-group-btn">
                                                                <button class="btn blue" id="add_voip" type="button">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="margiv-top-10">
                                                    <a href="javascript:;" id="btnSave" onclick="save_info()" class="btn green"> Editar </a>
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
                                                                <input type="file" name="file" size="20">
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
                                                    <!-- permissão removida -->
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
                                                                <input type="checkbox" id="tecnico" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="admin">Fornecedor :</label>
                                                                <input type="checkbox" id="fornecedor" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Contato :</label>
                                                                <input type="checkbox" id="contato" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Servidores :</label>
                                                                <input type="checkbox" id="servidor" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Acessos :</label>
                                                                <input type="checkbox" id="acessos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Voucher :</label>
                                                                <input type="checkbox" id="voucher" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Agendamento :</label>
                                                                <input type="checkbox" id="agendamento" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Ativos :</label>
                                                                <input type="checkbox" id="ativos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Contratos :</label>
                                                                <input type="checkbox" id="contratos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Ramais </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Voip :</label>
                                                                <input type="checkbox" id="voip" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Localidades </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Links :</label>
                                                                <input type="checkbox" id="link" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Unidades :</label>
                                                                <input type="checkbox" id="unidade" class="make-switch" checked data-size="small"  >
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
                                                                <input type="checkbox" id="historico_bkp" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Janela de Backup :</label>
                                                                <input type="checkbox" id="janela_bkp" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Fitas :</label>
                                                                <input type="checkbox" id="fitas" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Gráficos :</label>
                                                                <input type="checkbox" id="graficos_bkp" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Links </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Historico :</label>
                                                                <input type="checkbox" id="historico_link" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Calculo multa :</label>
                                                                <input type="checkbox" id="calculo_multa" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Consumo de banda :</label>
                                                                <input type="checkbox" id="consumo_banda" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Chamados links :</label>
                                                                <input type="checkbox" id="chamado_links" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Gráficos :</label>
                                                                <input type="checkbox" id="graficos_link" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr >
                                                        <td> Mantis </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">CGAQ :</label>
                                                                <input type="checkbox" id="cgaq" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">CGPS :</label>
                                                                <input type="checkbox" id="cgps" class="make-switch" checked data-size="small"  >
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
                                                                <input type="checkbox" id="geral" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Logs :</label>
                                                                <input type="checkbox" id="log" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">LDAP :</label>
                                                                <input type="checkbox" id="ldap" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Itens configuração :</label>
                                                                <input type="checkbox" id="consulta" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Usuários </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Lista usuários :</label>
                                                                <input type="checkbox" id="lista" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Permissão :</label>
                                                                <input type="checkbox" id="permissao" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Grupos/Equipe :</label>
                                                                <input type="checkbox" id="grupos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Modulos :</label>
                                                                <input type="checkbox" id="modulos" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Perfil :</label>
                                                                <input type="checkbox" id="perfil" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Cargo :</label>
                                                                <input type="checkbox" id="cargo" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Banco de dados </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Configuração :</label>
                                                                <input type="checkbox" id="configuracao" class="make-switch" checked data-size="small"  >
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="margin-bottom-10">
                                                                <label for="super">Backup :</label>
                                                                <input type="checkbox" id="backup" class="make-switch" checked data-size="small"  >
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