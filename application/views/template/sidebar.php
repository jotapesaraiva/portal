<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- BEGIN CONTAINER -->
<!-- TODO: OK Fazer if em que - Se um usuario não tiver acesso a nem um modulo não exibir o nivel mais alto do menu.  -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <li class="nav-item start <?php if($this->uri->segment(1) == 'welcome') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('producao', group_session($this->session->userdata('username')))){?>
                        <li class="nav-item start <?php echo active_segment(2,'producao'); ?>">
                            <?php echo anchor('dashboard/producao', '<i class="icon-bar-chart"></i>Dashboard Produção', 'class="nav-link"')?>
                            <?php echo span_segment(2,'producao'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('rede', group_session($this->session->userdata('username')))){?>
                        <li class="nav-item start <?php echo active_segment(2,'rede'); ?>">
                            <?php echo anchor('dashboard/rede', '<i class="icon-bar-chart"></i>Dashboard Rede', 'class="nav-link"')?>
                            <?php echo span_segment(2,'rede'); ?>
                        </li>
                        <?php } if( $this->auth_ad->level_access('cgps', group_session($this->session->userdata('username')))){?>
                        <li class="nav-item start <?php echo active_segment(2,'cgps'); ?>">
                            <?php echo anchor('dashboard/cgps', '<i class="icon-bar-chart"></i>Dashboard CGPS', 'class="nav-link"')?>
                            <?php echo span_segment(2,'cgps'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('admin', group_session($this->session->userdata('username')))){?>
                        <li class="nav-item start <?php echo active_segment(2,'admin'); ?>">
                            <?php echo anchor('dashboard/admin', '<i class="icon-bar-chart"></i>Dashboard Admin', 'class="nav-link"')?>
                            <?php echo span_segment(2,'admin'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <li class="heading">
                    <h3>CONSULTA</h3>
                </li>
                <!--############# ABA GERENCIA ############-->
                <li class="nav-item <?php echo active_segment(1,'gerencias'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-briefcase"></i>
                        <span class="title">Gerências</span>
                        <?php echo span_segment(1,'gerencias'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--############# ABA GERENCIA > Tecnicos ############-->
                        <?php if($this->auth_ad->level_access('tecnico', group_session($this->session->userdata('username'))) ){?>
                        <li class="nav-item <?php echo active_segment(2,'tecnico'); ?>">
                            <?php echo anchor('gerencias/tecnico', '<i class=" icon-wrench"></i> Tecnicos', 'class="nav-link"')?>
                            <?php echo span_segment(2,'tecnico'); ?>
                        </li>
                        <!--############# ABA GERENCIA > Fornecedores ############-->
                        <?php } if($this->auth_ad->level_access('fornecedor',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'fornecedor'); ?>">
                            <?php echo anchor('gerencias/fornecedor', '<i class="fa fa-industry"></i> Fornecedores', 'class="nav-link"')?>
                            <?php echo span_segment(2,'fornecedor'); ?>
                        </li>
                        <!--############# ABA GERENCIA > Contatos ############-->
                        <?php } if($this->auth_ad->level_access('contato',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'contato'); ?>">
                            <?php echo anchor('gerencias/contato', '<i class="fa fa-phone"></i> Contatos', 'class="nav-link"')?>
                            <?php echo span_segment(2,'contato'); ?>
                        </li>
                        <!--############# ABA GERENCIA > Servidores ############-->
                        <?php } if($this->auth_ad->level_access('servidor',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'servidor'); ?>">
                            <?php echo anchor('gerencias/servidor', '<i class="fa fa-institution"></i> Servidores', 'class="nav-link"')?>
                            <?php echo span_segment(2,'servidor'); ?>
                        </li>
                        <!--############# ABA GERENCIA > Acessos ############-->
                        <?php } if($this->auth_ad->level_access('acessos',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'acessos'); ?>">
                            <?php echo anchor('gerencias/acessos', '<i class="fa fa-user-secret"></i> Acessos', 'class="nav-link"')?>
                            <?php echo span_segment(2,'acessos'); ?>
                        </li>
                        <!--############# ABA GERENCIA > Voucher ############-->
                        <?php } if($this->auth_ad->level_access('voucher',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'voucher'); ?>">
                            <?php echo anchor('gerencias/voucher', '<i class="fa fa-cab"></i> Voucher', 'class="nav-link"')?>
                            <?php echo span_segment(2,'voucher'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <!--############# ABA RAMAIS ############-->
                <li class="nav-item <?php echo active_segment(1,'ramais'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-phone"></i>
                        <span class="title">Ramais</span>
                        <?php echo span_segment(1,'ramais'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--############# ABA RAMAIS > Sefa ############-->
                        <?php if($this->auth_ad->level_access('sefa',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'sefa'); ?>">
                            <?php echo anchor('ramais/sefa', 'SEFA', 'class="nav-link"')?>
                            <?php echo span_segment(2,'sefa'); ?>
                        </li>
                        <!--############# ABA RAMAIS > DTI ############-->
                        <?php } if($this->auth_ad->level_access('dti',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'dti'); ?>">
                            <?php echo anchor('ramais/dti', 'DTI', 'class="nav-link"')?>
                            <?php echo span_segment(2,'dti'); ?>
                        </li>
                        <!--############# ABA RAMAIS > Voi´p ############-->
                        <?php } if($this->auth_ad->level_access('voip',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'voip'); ?>">
                            <?php echo anchor('ramais/voip', '<i class="glyphicon glyphicon-phone-alt"></i> VOIP', 'class="nav-link"')?>
                            <?php echo span_segment(2,'voip'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <!--############# ABA LOCALIDADES ############-->
                <li class="nav-item <?php echo active_segment(1,'localidades'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-map"></i>
                        <span class="title">Localidades</span>
                        <?php echo span_segment(1,'localidades'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--############# ABA LOCALIDADES > Unidades ############-->
                        <?php if($this->auth_ad->level_access('unidade',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'unidade'); ?>">
                            <?php echo anchor('localidades/unidade', '<i class="fa fa-map-marker"></i> Unidades', 'class="nav-link"')?>
                            <?php echo span_segment(2,'unidade'); ?>
                        </li>
                        <!--############# ABA LOCALIDADES > Links ############-->
                        <?php } if($this->auth_ad->level_access('link',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'link'); ?>">
                            <?php echo anchor('localidades/link', '<i class="fa fa-link"></i> Links', 'class="nav-link"')?>
                            <?php echo span_segment(2,'link'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="heading">
                    <h3>ANALISE</h3>
                </li>
                <!--############# ABA BACKUPS ############-->
                <li class="nav-item <?php echo active_segment(1,'backup'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Backup</span>
                        <?php echo span_segment(1,'backup'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--############# ABA BACKUPS > Historico de backups ############-->
                        <?php if($this->auth_ad->level_access('historico_bkp',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'historico'); ?>">
                            <?php echo anchor('backup/historico_bkp', '<i class="fa fa-history"></i> Histórico', 'class="nav-link"')?>
                            <?php echo span_segment(2,'historico'); ?>
                        </li>
                        <!--############# ABA BACKUPS > Janela de bakcups ############-->
                        <?php } if($this->auth_ad->level_access('janela_bkp',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'janela_backup'); ?>">
                            <?php echo anchor('backup/janela_bkp', 'Janela de Backup', 'class="nav-link"')?>
                            <?php echo span_segment(2,'janela_bkp'); ?>
                        </li>
                        <!--############# ABA BACKUPS > fitas ############-->
                        <?php } if($this->auth_ad->level_access('fitas',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'fitas'); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-hdd-o"></i>
                                <span class="title">Fitas</span>
                                <?php echo span_segment(2,'fitas'); ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <!--############# ABA BACKUPS > fitas > diario ############-->
                                <li class="nav-item <?php echo active_segment(3,'diario'); ?>">
                                    <?php echo anchor('backup/fitas/diario', 'Diário', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'diario'); ?>
                                </li>
                                <!--############# ABA BACKUPS > fitas > mensal ############-->
                                <li class="nav-item <?php echo active_segment(3,'mensal'); ?>">
                                    <?php echo anchor('backup/fitas/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'mensal'); ?>
                                </li>
                                <!--############# ABA BACKUPS > fitas > poor ############-->
                                <li class="nav-item <?php echo active_segment(3,'poor'); ?>">
                                    <?php echo anchor('backup/fitas/poor', 'Poor', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'poor'); ?>
                                </li>
                            </ul>
                        </li>
                        <!--############# ABA BACKUPS > graficos ############-->
                        <?php } if($this->auth_ad->level_access('graficos_bkp',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'graficos_bkp'); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Gráficos</span>
                                <?php echo span_segment(2,'graficos_bkp'); ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <!--############# ABA BACKUPS > Graficos > Crescimento############-->
                                <li class="nav-item <?php echo active_segment(3,'crescimento'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-line-chart"></i>
                                        <span class="title">Crescimento</span>
                                        <?php echo span_segment(3,'crescimento'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA BACKUPS > Graficos > Crescimento > dia ############-->
                                        <li class="nav-item <?php echo active_segment(4,'dia'); ?>">
                                            <?php echo anchor('backup/graficos_bkp/crescimento/dia', 'Dia', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'dia'); ?>
                                        </li>
                                        <!--############# ABA BACKUPS > graficos > Crescimento > Mes ############-->
                                        <li class="nav-item <?php echo active_segment(4,'mes'); ?>">
                                            <?php echo anchor('backup/graficos_bkp/crescimento/mes', 'Mês', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mes'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <!--############# ABA BACKUPS > graficos > Quantidade ############-->
                                <li class="nav-item <?php echo active_segment(3,'quantidade'); ?>">
                                    <?php echo anchor('backup/graficos_bkp/quantidade', '<i class="fa fa-area-chart"></i> Quantidade', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'quantidade'); ?>
                                </li>
                                <!--############# ABA BACKUPS > graficos > Tempo ############-->
                                <li class="nav-item <?php echo active_segment(3,'tempo'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-clock-o"></i>
                                        <span class="title">Tempo</span>
                                        <?php echo span_segment(3,'tempo'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA BACKUPS > graficos > Tempo > mes ############-->
                                        <li class="nav-item <?php echo active_segment(4,'mes'); ?>">
                                            <?php echo anchor('backup/graficos_bkp/tempo/mes', 'Mês', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mes'); ?>
                                        </li>
                                        <!--############# ABA BACKUPS > graficos > Tempo > ano ############-->
                                        <li class="nav-item <?php echo active_segment(4,'ano'); ?>">
                                            <?php echo anchor('backup/graficos_bkp/tempo/ano', 'Ano', 'class="nav-link"')?>
                                           <?php echo span_segment(4,'ano'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <!--############# ABA BACKUPS > graficos > Volume ############-->
                                <li class="nav-item <?php echo active_segment(3,'volume'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-bar-chart"></i>
                                        <span class="title">Volume</span>
                                        <?php echo span_segment(3,'volume'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA BACKUPS > graficos > Volume > mes ############-->
                                        <li class="nav-item <?php echo active_segment(4,'mes'); ?>">
                                            <?php echo anchor('backup/graficos_bkp/volume/mes', 'Mês', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mes'); ?>
                                        </li>
                                        <!--############# ABA BACKUPS > graficos > Volume > ano ############-->
                                        <li class="nav-item <?php echo active_segment(4,'ano'); ?>">
                                            <?php echo anchor('backup/graficos_bkp/volume/ano', 'Ano', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'ano'); ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?php }?>
                    </ul>
                </li>
                <!--############# ABA LINKS ############-->
                <li class="nav-item <?php echo active_segment(1,'links'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-link"></i>
                        <span class="title">Links</span>
                        <?php echo span_segment(1,'links'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--############# ABA LINKS > Historico ############-->
                        <?php if($this->auth_ad->level_access('historico_link',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'historico'); ?>">
                            <?php echo anchor('links/historico_link', '<i class="fa fa-history"></i> Historico', 'class="nav-link"')?>
                            <?php echo span_segment(2,'historico'); ?>
                        </li>
                        <!--############# ABA LINKS > Calculo de multa ############-->
                        <?php } if($this->auth_ad->level_access('calculo_multa',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'calculo_multa'); ?>">
                            <?php echo anchor('links/calculo_multa', '<i class="fa fa-calculator"></i> Cálculo Multa', 'class="nav-link"')?>
                            <?php echo span_segment(2,'calculo_multa'); ?>
                        </li>
                        <!--############# ABA LINKS > Consumo de banda ############-->
                        <?php } if($this->auth_ad->level_access('consumo_banda',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'consumo_banda'); ?>">
                            <?php echo anchor('links/consumo_banda', '<i class="fa fa-bar-chart"></i> Consumo de Banda', 'class="nav-link"')?>
                            <?php echo span_segment(2,'consumo_banda'); ?>
                        </li>
                        <!--############# ABA LINKS > Chamados de Links ############-->
                        <?php } if($this->auth_ad->level_access('chamado_links',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'chamado_links'); ?>">
                            <?php echo anchor('links/chamado_links', '<i class="fa fa-table"></i> Chamados Links', 'class="nav-link"')?>
                            <?php echo span_segment(2,'chamado_links'); ?>
                        </li>
                        <!--############# ABA LINKS > Graficos ############-->
                        <?php } if($this->auth_ad->level_access('graficos_link',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'graficos_link'); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Gráficos</span>
                                <?php echo span_segment(2,'graficos_link'); ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <!--############# ABA LINKS > Graficos > consumo ############-->
<!--                                 <li class="nav-item <?php echo active_segment(3,'consumo'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-feed"></i>
                                        <span class="title">Consumo</span>
                                        <?php echo span_segment(3,'consumo'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        ############# ABA LINKS > Graficos > consumo > diario ############
                                        <li class="nav-item <?php echo active_segment(4,'diario'); ?>">
                                            <?php echo anchor('links/graficos_link/consumo/diario', 'Diário', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'diario'); ?>
                                        </li>
                                        ############# ABA LINKS > Graficos > mensal ############
                                        <li class="nav-item <?php echo active_segment(4,'mensal'); ?>">
                                            <?php echo anchor('links/graficos_link/consumo/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mensal'); ?>
                                        </li>
                                    </ul>
                                </li> -->
                                <!--############# ABA LINKS > Graficos > Localidade ############-->
                                <li class="nav-item <?php echo active_segment(3,'localidade'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-map"></i>
                                        <span class="title">Localidade</span>
                                        <?php echo span_segment(3,'localidade'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA LINKS > Graficos > Localidade > mensal ############-->
                                        <li class="nav-item <?php echo active_segment(4,'mensal'); ?>">
                                            <?php echo anchor('links/graficos_link/localidade/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mensal'); ?>
                                        </li>
                                        <!--############# ABA LINKS > Graficos > Localidade > anual ############-->
                                        <li class="nav-item <?php echo active_segment(4,'anual'); ?>">
                                            <?php echo anchor('links/graficos_link/localidade/anual', 'Anual', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'anual'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <!--############# ABA LINKS > Graficos > Causa ############-->
                                <li class="nav-item <?php echo active_segment(3,'causa'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        <span class="title">Causa</span>
                                        <?php echo span_segment(3,'causa'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA LINKS > Graficos > Causa > mensal############-->
                                        <li class="nav-item <?php echo active_segment(4,'mensal'); ?>">
                                            <?php echo anchor('links/graficos_link/causa/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mensal'); ?>
                                        </li>
                                        <!--############# ABA LINKS > Graficos > Causa > anual ############-->
                                        <li class="nav-item <?php echo active_segment(4,'anual'); ?>">
                                            <?php echo anchor('links/graficos_link/causa/anual', 'Anual', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'anual'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <!--############# ABA LINKS > Graficos > Ticket ############-->
                                <li class="nav-item <?php echo active_segment(3,'ticket'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-ticket"></i>
                                        <span class="title">Ticket</span>
                                        <?php echo span_segment(3,'ticket'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA LINKS > Graficos > Ticket > mensal ############-->
                                        <li class="nav-item <?php echo active_segment(4,'mensal'); ?>">
                                            <?php echo anchor('links/graficos_link/ticket/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'mensal'); ?>
                                        </li>
                                        <!--############# ABA LINKS > Graficos > Ticket > anual ############-->
                                        <li class="nav-item <?php echo active_segment(4,'anual'); ?>">
                                            <?php echo anchor('links/graficos_link/ticket/anual', 'Anual', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'anual'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <!--############# ABA LINKS > Graficos > Tempo ############-->
                                <li class="nav-item <?php echo active_segment(3,'tempo'); ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="fa fa-clock-o"></i>
                                        <span class="title">Tempo</span>
                                        <?php echo span_segment(3,'tempo'); ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <!--############# ABA LINKS > Graficos > Ticket > mensal ############-->
                                        <li class="nav-item <?php echo active_segment(4,'embratel'); ?>">
                                            <?php echo anchor('links/graficos_link/tempo/embratel', 'Embratel', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'embratel'); ?>
                                        </li>
                                        <!--############# ABA LINKS > Graficos > Ticket > anual ############-->
                                        <li class="nav-item <?php echo active_segment(4,'zabbix'); ?>">
                                            <?php echo anchor('links/graficos_link/tempo/zabbix', 'Zabbix', 'class="nav-link"')?>
                                            <?php echo span_segment(4,'zabbix'); ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </li>
                        <?php }?>
                    </ul>
                </li>

                <!--############# ABA MANTIS ############-->
                <li class="nav-item <?php echo active_segment(1,'mantis'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-bug"></i>
                        <span class="title">Mantis</span>
                        <?php echo span_segment(1,'mantis'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <!--############# ABA MANTIS > Sustentacao ############-->
                        <?php if($this->auth_ad->level_access('sustentacao',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'sustentacao'); ?>">
                            <?php echo anchor('mantis/sustentacao', '<i class="fa fa-history"></i> Sustentação', 'class="nav-link"')?>
                            <?php echo span_segment(2,'sustentacao'); ?>
                        </li>
                        <!--############# ABA MANTIS > Evolutiva ############-->
                        <?php } if($this->auth_ad->level_access('evolutiva',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'evolutiva'); ?>">
                            <?php echo anchor('mantis/evolutiva', '<i class="fa fa-calculator"></i> Evolutiva', 'class="nav-link"')?>
                            <?php echo span_segment(2,'evolutiva  '); ?>
                        </li>
                        <!--############# ABA MANTIS > Projetos ############-->
                        <?php } if($this->auth_ad->level_access('projetos',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'projetos'); ?>">
                            <?php echo anchor('mantis/projetos', '<i class="fa fa-bar-chart"></i> Projeto/Manu. Assistida', 'class="nav-link"')?>
                            <?php echo span_segment(2,'projetos'); ?>
                        </li>
                        <?php }?>
                    </ul>

                <li class="heading">
                    <h3>LINKS / APPS</h3>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-copy"></i>
                        <span class="title">Backup</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://10.3.1.37/ddem/login/', 'Data Domain DD6300'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://10.2.13.14/ddem/', 'Data Domain DD2500'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://libraryhp.sefa.pa.gov.br/login.ssi', 'Library HP'); ?>
                        </li>
                        <!--<li class="nav-item">
                            <?php //echo anchor_popup('http://librarydell.sefa.pa.gov.br', 'Library Dell'); ?>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-desktop"></i>
                        <span class="title">Vmware</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://10.3.1.37/ddem/login/', 'Vsphere Web Client'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('https://10.3.1.196:9443/vsphere-client/?csp', 'Vsphere Web Client 6.5.0'); ?>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-globe"></i>
                        <span class="title">Monitoramento</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://x-oc-zabbix.sefa.pa.ipa/zabbix/', 'Zabbix'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('https://webebt04.embratel.com.br/PORTALGRCTST/portal/index.php?vcontacle=44S3nLstBc67pclngtz0F0NhQOg8bp3FVmKq+pI5ecspg=hm3OHlUJoRdMZ/ZMbzFn&vlogin=44eEeIsydqbD8u3QhNE/73tWjLpl6eUPv91F3iVuBAJsM=mHZ6V+cEuow=', 'Embratel'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('https://www.sistemas.pa.gov.br/zabbix/', 'Prodepa'); ?>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Aplicações</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://ares.sefa.pa.gov.br/app/admin', 'Ares'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://nobreak.sefa.pa.gov.br:8080/ScadaBR/login.htm', 'Nobreak SEFA'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('https://mantis.sefa.pa.gov.br/', 'Mantis'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('https://email.sefa.pa.gov.br:8443/', 'Email'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('https://rede.sefa.pa.gov.br/hextra/', 'Hora Extras'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://producao.sefa.pa.gov.br/msg/login.php', 'Mensagem de rede'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://wiki.sefa.pa.gov.br/dokuwiki/doku.php', 'Wiki'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://redmine.sefa.pa.gov.br/', 'Redmine'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://rede.sefa.pa.gov.br/portalrede/index.html', 'Portal Rede'); ?>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-server"></i>
                        <span class="title">WebLogic</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Produção</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.102:7001/console/login/LoginForm.jsp', 'Extranet 11G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.13:7001/console/login/LoginForm.jsp', 'Extranet 12C'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.104:7001/console/login/LoginForm.jsp', 'Intranet 11G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.213:7001/console/login/LoginForm.jsp', 'Intranet 12C'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.106:7001/console/login/LoginForm.jsp', 'Processamento 11G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.17:7001/console/login/LoginForm.jsp', 'Processamento 12C'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.190:7001/console/login/LoginForm.jsp', 'SiatWeb'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.163:7001/console/login/LoginForm.jsp', 'Portal NFC'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.2.3.181:7001/console/login/LoginForm.jsp', 'DAE PRODEPA'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.172:7001/console/login/LoginForm.jsp', 'DAE SEFA'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.161:7001/console/login/LoginForm.jsp', 'SEFA NET'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.57:7001/console', 'BO'); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Homologação</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">

                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Desenvolvimento</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">

                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-puzzle"></i>
                                <span class="title">Transição</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">

                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="heading">
                    <h3>CONFIGURAÇÕES</h3>
                </li>

                <li class="nav-item <?php echo active_segment(1,'sistema'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Sistema</span>
                        <?php echo span_segment(1,'sistema'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('geral',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'geral'); ?>">
                            <?php echo anchor('sistema/geral', '<i class="icon-social-dribbble"></i> Geral', 'class="nav-link"')?>
                            <?php echo span_segment(2,'geral'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('cronjob',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'cronjob'); ?>">
                            <?php echo anchor('sistema/cronjob', '<i class="fa fa-tasks"></i> Cron Job', 'class="nav-link"')?>
                            <?php echo span_segment(2,'cronjob'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('log',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'log'); ?>">
                            <?php echo anchor('sistema/log', '<i class="fa fa-code"></i> Logs', 'class="nav-link"')?>
                            <?php echo span_segment(2,'log'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('ldap',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'ldap'); ?>">
                            <?php echo anchor('sistema/ldap', '<i class="fa fa-windows"></i> LDAP', 'class="nav-link"')?>
                            <?php echo span_segment(2,'ldap'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('consulta',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'consulta'); ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-gears"></i>
                                <span class="title">Itens da consulta</span>
                                <?php echo span_segment(2,'consulta'); ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php echo active_segment(3,'acesso'); ?>">
                                    <?php echo anchor('sistema/consulta/acesso', 'Tipo de Acesso', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'acesso'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'velocidade'); ?>">
                                    <?php echo anchor('sistema/consulta/velocidade', 'Tipo de Velocidade', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'velocidade'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'cidade'); ?>">
                                    <?php echo anchor('sistema/consulta/cidade', 'Cidade', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'cidade'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'expediente'); ?>">
                                    <?php echo anchor('sistema/consulta/expediente', 'Expediente', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'expediente'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'contexto_voip'); ?>">
                                    <?php echo anchor('sistema/consulta/contexto_voip', 'Tipo Contexto Voip', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'contexto_voip'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'equipamento_voip'); ?>">
                                    <?php echo anchor('sistema/consulta/equipamento_voip', 'Tipo Equipamento Voip', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'equipamento_voip'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'categoria_voip'); ?>">
                                    <?php echo anchor('sistema/consulta/categoria_voip', 'Tipo Categoria Voip', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'categoria_voip'); ?>
                                </li>
                                <li class="nav-item <?php echo active_segment(3,'categoria_tel'); ?>">
                                    <?php echo anchor('sistema/consulta/categoria_tel', 'Tipo Categoria Telefonia', 'class="nav-link"')?>
                                    <?php echo span_segment(3,'categoria_tel'); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } if($this->auth_ad->level_access('zabbix',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'zabbix'); ?>">
                            <?php echo anchor('sistema/zabbix', 'Zabbix', 'class="nav-link"')?>
                            <?php echo span_segment(2,'zabbix'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php echo active_segment(1,'usuarios'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-group"></i>
                        <span class="title">Usuarios</span>
                        <?php echo span_segment(1,'usuarios'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('lista',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'lista'); ?>">
                            <?php echo anchor('usuarios/lista', '<i class="fa fa-list-ul"></i> Lista de Usuarios', 'class="nav-link"')?>
                            <?php echo span_segment(2,'lista'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('permissao',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'permissao'); ?>">
                            <?php echo anchor('usuarios/permissao', '<i class="fa fa-unlock-alt"></i> Permissão', 'class="nav-link"')?>
                            <?php echo span_segment(2,'permissao'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('grupos',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'grupos'); ?>">
                             <?php echo anchor('usuarios/grupos', '<i class="fa fa-object-group"></i> Grupos/Equipe', 'class="nav-link"')?>
                             <?php echo span_segment(2,'grupos'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('modulos',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'modulos'); ?>">
                             <?php echo anchor('usuarios/modulos', '<i class="fa fa-plug"></i> Modulos', 'class="nav-link"')?>
                             <?php echo span_segment(2,'modulos'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('perfil',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'perfil'); ?>">
                             <?php echo anchor('usuarios/perfil', '<i class="fa fa-list"></i> Perfil', 'class="nav-link"')?>
                             <?php echo span_segment(2,'perfil'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('cargo',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'cargo'); ?>">
                            <?php echo anchor('usuarios/cargo', '<i class="fa fa-certificate"></i> Cargo', 'class="nav-link"')?>
                            <?php echo span_segment(2,'cargo'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php echo active_segment(1,'banco_de_dados'); ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-database"></i>
                        <span class="title">Banco de Dados</span>
                        <?php echo span_segment(1,'banco_de_dados'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('configuracao',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'configuracao'); ?>">
                            <?php echo anchor('banco_de_dados/configuracao', '<i class="icon-settings"></i> Configuração', 'class="nav-link"')?>
                            <?php echo span_segment(2,'configuracao'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('backup',group_session($this->session->userdata('username')))){?>
                        <li class="nav-item <?php echo active_segment(2,'backup'); ?>">
                            <?php echo anchor('banco_de_dados/backup', '<i class="fa fa-copy"></i> Backup', 'class="nav-link"')?>
                            <?php echo span_segment(2,'backup'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->