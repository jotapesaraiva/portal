<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- BEGIN CONTAINER -->
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
                        <?php if($this->session->userdata('physicaldeliveryofficename') == 'CGRE-Produção') : ?>
                        <li class="nav-item start active open">
                            <a href="dashboard/producao" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard Produção</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <?php elseif($this->session->userdata('physicaldeliveryofficename') == 'CGRE-Rede') : ?>
                        <li class="nav-item start">
                            <a href="dashboard/rede_infra" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard Rede / Infra</span>
                            </a>
                        </li>
                        <?php elseif($this->session->userdata('physicaldeliveryofficename') == 'CGPS') : ?>
                        <li class="nav-item start ">
                            <a href="dashboard/cgps" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard CGPS</span>
                            </a>
                        </li>
                        <?php elseif($this->session->userdata('physicaldeliveryofficename') == 'Administrativo') : ?>
                        <li class="nav-item start ">
                            <a href="dashboard/administrativo" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Dashboard Administrativo</span>
                            </a>
                        </li>
                        <?php endif;?>
                    </ul>
                </li>
                <li class="heading">
                    <h3>CONSULTA</h3>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'gerencias') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">Gerências</span>
                        <?php if($this->uri->segment(1) == 'gerencias') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('tecnicos',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('tecnico'); ?>">
                            <?php echo anchor('gerencias/tecnico', 'Tecnicos', 'class="nav-link"')?>
                            <?php echo span_class('tecnico'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('fornecedores',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('fornecedor'); ?>">
                            <?php echo anchor('gerencias/fornecedor', 'Fornecedores', 'class="nav-link"')?>
                            <?php echo span_class('fornecedor'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('contato',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('contato'); ?>">
                            <?php echo anchor('gerencias/contato', 'Contatos', 'class="nav-link"')?>
                            <?php echo span_class('contato'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('servidores',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('servidor'); ?>">
                            <?php echo anchor('gerencias/servidor', 'Servidores', 'class="nav-link"')?>
                            <?php echo span_class('servidor'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('acessos',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('servidor'); ?>">
                            <?php echo anchor('gerencias/acessos', 'Acessos', 'class="nav-link"')?>
                            <?php echo span_class('acessos'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'ramais') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Ramais</span>
                        <?php if($this->uri->segment(1) == 'ramais') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('sefa',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('sefa'); ?>">
                            <?php echo anchor('ramais/sefa', 'SEFA', 'class="nav-link"')?>
                            <?php echo span_class('sefa'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('dti',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('dti'); ?>">
                            <?php echo anchor('ramais/dti', 'DTI', 'class="nav-link"')?>
                            <?php echo span_class('dti'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('voip',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('voip'); ?>">
                            <?php echo anchor('ramais/voip', 'VOIP', 'class="nav-link"')?>
                            <?php echo span_class('voip'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'localidades') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Localidades</span>
                        <?php if($this->uri->segment(1) == 'localidades') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('unidade',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('unidade'); ?>">
                            <?php echo anchor('localidades/unidade', 'Unidades', 'class="nav-link"')?>
                            <?php echo span_class('unidade'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('link',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('link'); ?>">
                            <?php echo anchor('localidades/link', 'Links', 'class="nav-link"')?>
                            <?php echo span_class('link'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>


                <li class="heading">
                    <h3>ANALISE</h3>
                </li>
                <li class="nav-item <?php if($this->uri->segment(1) == 'backup') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Backup</span>
                        <?php if($this->uri->segment(1) == 'backup') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('historico_bkp',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('historico'); ?>">
                            <?php echo anchor('backup/historico', 'Histórico', 'class="nav-link"')?>
                            <?php echo span_class('historico'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('janela_backup',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('janela_backup'); ?>">
                            <?php echo anchor('backup/janela_backup', 'Janela de Backup', 'class="nav-link"')?>
                            <?php echo span_link('janela_backup'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('fitas',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->segment(2) == 'fitas') { echo 'active open'; } ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Fitas</span>
                                <?php if($this->uri->segment(2) == 'fitas') { echo '<span class="selected"></span>'; } ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php echo active_method('diario'); ?>">
                                    <?php echo anchor('backup/fitas/diario', 'Diário', 'class="nav-link"')?>
                                    <?php echo span_method('diario'); ?>
                                </li>
                                <li class="nav-item <?php echo active_method('mensal'); ?>">
                                    <?php echo anchor('backup/fitas/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php echo span_method('mensal'); ?>
                                </li>
                                <li class="nav-item <?php echo active_method('poor'); ?>">
                                    <?php echo anchor('backup/fitas/poor', 'Poor', 'class="nav-link"')?>
                                    <?php echo span_method('poor'); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } if($this->auth_ad->level_access('graficos_bkp',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->segment(2) == 'graficos') { echo 'active open'; } ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Gráficos</span>
                                <?php if($this->uri->segment(2) == 'grafico') { echo '<span class="selected"></span>'; } ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php if($this->uri->segment(3) == 'crescimento') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Crescimento</span>
                                        <?php if($this->uri->segment(3) == 'crescimento') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_method('dia'); ?>">
                                            <?php echo anchor('backup/graficos/crescimento/dia', 'Dia', 'class="nav-link"')?>
                                            <?php echo span_method('dia'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_method('mes'); ?>">
                                            <?php echo anchor('backup/graficos/crescimento/mes', 'Mês', 'class="nav-link"')?>
                                            <?php echo span_method('mes'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item <?php echo active_class('quantidade'); ?>">
                                    <?php echo anchor('backup/graficos/quantidade', 'Quantidade', 'class="nav-link"')?>
                                    <?php echo span_class('quantidade'); ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'tempo') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Tempo</span>
                                        <?php if($this->uri->segment(3) == 'tempo') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_method('mes'); ?>">
                                            <?php echo anchor('backup/graficos/tempo/mes', 'Mês', 'class="nav-link"')?>
                                            <?php echo span_method('mes'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_method('ano'); ?>">
                                            <?php echo anchor('backup/graficos/tempo/ano', 'Ano', 'class="nav-link"')?>
                                            <?php echo span_method('ano'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'volume') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Volume</span>
                                        <?php if($this->uri->segment(3) == 'volume') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_method('mes'); ?>">
                                            <?php echo anchor('backup/graficos/volume/mes', 'Mês', 'class="nav-link"')?>
                                            <?php echo span_method('mes'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_method('ano'); ?>">
                                            <?php echo anchor('backup/graficos/volume/ano', 'Ano', 'class="nav-link"')?>
                                            <?php echo span_method('ano'); ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'links') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-feed"></i>
                        <span class="title">Links</span>
                        <?php if($this->uri->segment(1) == 'links') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('historico_link',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('historico'); ?>">
                            <?php echo anchor('links/historico', 'Historico', 'class="nav-link"')?>
                            <?php echo span_class('historico'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('calculo_multa',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('calculo_multa'); ?>">
                            <?php echo anchor('links/calculo_multa', 'Cálculo Multa', 'class="nav-link"')?>
                            <?php echo span_class('calculo_multa'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('consumo_banda',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('consumo_banda'); ?>">
                            <?php echo anchor('links/consumo_banda', 'Consumo de Banda', 'class="nav-link"')?>
                            <?php echo span_class('consumo_banda'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('graficos_link',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->segment(2) == 'graficos') { echo 'active open'; } ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-feed"></i>
                                <span class="title">Gráficos</span>
                                <?php if($this->uri->segment(2) == 'graficos') { echo '<span class="selected"></span>'; } ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php if($this->uri->segment(3) == 'consumo') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-feed"></i>
                                        <span class="title">Consumo</span>
                                        <?php if($this->uri->segment(3) == 'consumo') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_method('diario'); ?>">
                                            <?php echo anchor('links/graficos/consumo/diario', 'Diário', 'class="nav-link"')?>
                                            <?php echo span_method('diario'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_method('mensal'); ?>">
                                            <?php echo anchor('links/graficos/consumo/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_method('mensal'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'localidade') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-feed"></i>
                                        <span class="title">Localidade</span>
                                        <?php if($this->uri->segment(3) == 'localidade') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_class('mensal'); ?>">
                                            <?php echo anchor('links/graficos/localidade/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_class('mensal'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_class('anual'); ?>">
                                            <?php echo anchor('links/graficos/localidade/anual', 'Anual', 'class="nav-link"')?>
                                            <?php echo span_class('anual'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'causa') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-feed"></i>
                                        <span class="title">Causa</span>
                                        <?php if($this->uri->segment(3) == 'causa') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_class('mensal'); ?>">
                                            <?php echo anchor('links/graficos/causa/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_class('mensal'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_class('anual'); ?>">
                                            <?php echo anchor('links/graficos/causa/anual', 'Anual', 'class="nav-link"')?>
                                            <?php echo span_class('anual'); ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'ticket') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-feed"></i>
                                        <span class="title">Ticket</span>
                                        <?php if($this->uri->segment(3) == 'ticket') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item <?php echo active_class('mensal'); ?>">
                                            <?php echo anchor('links/graficos/ticket/mensal', 'Mensal', 'class="nav-link"')?>
                                            <?php echo span_class('mensal'); ?>
                                        </li>
                                        <li class="nav-item <?php echo active_class('anual'); ?>">
                                            <?php echo anchor('links/graficos/ticket/anual', 'Anual', 'class="nav-link"')?>
                                            <?php echo span_class('anual'); ?>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?php } else if($this->auth_ad->level_access($this->uri->segment(2),$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('historico'); ?>">
                            <?php echo anchor('links/historico', 'Historico', 'class="nav-link"')?>
                            <?php echo span_class('historico'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'nobreak') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-paper-plane"></i>
                        <span class="title">Nobreak</span>
                        <?php if($this->uri->segment(1) == 'nobreak') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="layout_mega_menu_light.html" class="nav-link ">
                                <span class="title">Light Mega Menu</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_mega_menu_dark.html" class="nav-link ">
                                <span class="title">Dark Mega Menu</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_full_width.html" class="nav-link ">
                                <span class="title">Full Width Layout</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'email') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class=" icon-wrench"></i>
                        <span class="title">Email</span>
                        <?php if($this->uri->segment(1) == 'email') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php if($this->uri->uri_string() == 'email') { echo 'active open'; } ?>">
                            <?php echo anchor('email', 'Analise Email', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'email') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_full_height_portlet.html" class="nav-link ">
                                <span class="title">Full Height Portlet</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="layout_full_height_content.html" class="nav-link ">
                                <span class="title">Full Height Content</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="heading">
                    <h3>LINKS / APPS</h3>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
                        <span class="title">Backup</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://10.3.1.37/ddem/login/', 'Data Domain DD6300'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://10.3.1.39/ddem/', 'Data Domain DD2500'); ?>
                        </li>
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://libraryhp.sefa.pa.gov.br/login.ssi', 'Library HP'); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo anchor_popup('http://librarydell.sefa.pa.gov.br', 'Library Dell'); ?>
                        </li>
                    </ul>
                </li>

                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-puzzle"></i>
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
                        <i class="icon-puzzle"></i>
                        <span class="title">Monitoramento</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item ">
                            <?php echo anchor_popup('http://x-oc-cacti.sefa.pa.gov.br:8080/nagios/', 'Nagios'); ?>
                        </li>
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
                            <?php echo anchor_popup('http://observium.sefa.pa.gov.br/', 'Observium'); ?>
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
                        <i class="icon-puzzle"></i>
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
                                    <?php echo anchor_popup('http://10.3.1.13:7001/console/login/LoginForm.jsp', 'Extranet 12G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.104:7001/console/login/LoginForm.jsp', 'Intranet 11G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.213:7001/console/login/LoginForm.jsp', 'Intranet 12G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.106:7001/console/login/LoginForm.jsp', 'Processamento 11G'); ?>
                                </li>
                                <li class="nav-item ">
                                    <?php echo anchor_popup('http://10.3.1.17:7001/console/login/LoginForm.jsp', 'Processamento 12G'); ?>
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
                <li class="nav-item <?php if($this->uri->segment(1) == 'sistema') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">Sistema</span>
                        <?php if($this->uri->segment(1) == 'sistema') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('geral',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('geral'); ?>">
                            <?php echo anchor('sistema/geral', 'Geral', 'class="nav-link"')?>
                            <?php echo span_class('geral'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('cronjob',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('cronjob'); ?>">
                            <?php echo anchor('sistema/cronjob', 'Cron Job', 'class="nav-link"')?>
                            <?php echo span_class('cronjob'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('log',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('log'); ?>">
                            <?php echo anchor('sistema/log', 'Logs', 'class="nav-link"')?>
                            <?php echo span_class('log'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('ldap',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('ldap'); ?>">
                            <?php echo anchor('sistema/ldap', 'LDAP', 'class="nav-link"')?>
                            <?php echo span_class('ldap'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('consulta',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->segment(2) == 'consulta') { echo 'active open'; } ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Itens da consulta</span>
                                <?php if($this->uri->segment(2) == 'consulta') { echo '<span class="selected"></span>'; } ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php echo active_class('acesso'); ?>">
                                    <?php echo anchor('sistema/consulta/acesso', 'Tipo de Acesso', 'class="nav-link"')?>
                                    <?php echo span_class('acesso'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('velocidade'); ?>">
                                    <?php echo anchor('sistema/consulta/velocidade', 'Tipo de Velocidade', 'class="nav-link"')?>
                                    <?php echo span_class('velocidade'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('cidade'); ?>">
                                    <?php echo anchor('sistema/consulta/cidade', 'Cidade', 'class="nav-link"')?>
                                    <?php echo span_class('cidade'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('expediente'); ?>">
                                    <?php echo anchor('sistema/consulta/expediente', 'Expediente', 'class="nav-link"')?>
                                    <?php echo span_class('expediente'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('contexto_voip'); ?>">
                                    <?php echo anchor('sistema/consulta/contexto_voip', 'Tipo Contexto Voip', 'class="nav-link"')?>
                                    <?php echo span_class('contexto_voip'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('equipamento_voip'); ?>">
                                    <?php echo anchor('sistema/consulta/equipamento_voip', 'Tipo Equipamento Voip', 'class="nav-link"')?>
                                    <?php echo span_class('equipamento_voip'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('categoria_voip'); ?>">
                                    <?php echo anchor('sistema/consulta/categoria_voip', 'Tipo Categoria Voip', 'class="nav-link"')?>
                                    <?php echo span_class('categoria_voip'); ?>
                                </li>
                                <li class="nav-item <?php echo active_class('categoria_tel'); ?>">
                                    <?php echo anchor('sistema/consulta/categoria_tel', 'Tipo Categoria Telefonia', 'class="nav-link"')?>
                                    <?php echo span_class('categoria_tel'); ?>
                                </li>
                            </ul>
                        </li>
                        <?php } if($this->auth_ad->level_access('zabbix',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('zabbix'); ?>">
                            <?php echo anchor('sistema/zabbix', 'Zabbix', 'class="nav-link"')?>
                            <?php echo span_class('zabbix'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'usuarios') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class=" icon-wrench"></i>
                        <span class="title">Usuarios</span>
                        <?php if($this->uri->segment(1) == 'usuarios') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('lista',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('lista'); ?>">
                            <?php echo anchor('usuarios/lista', 'Lista de Usuarios', 'class="nav-link"')?>
                            <?php echo span_class('lista'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('permissao',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('permissao'); ?>">
                            <?php echo anchor('usuarios/permissao', 'Permissão', 'class="nav-link"')?>
                            <?php echo span_class('permissao'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('grupos',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('grupos'); ?>">
                             <?php echo anchor('usuarios/grupos', 'Grupos/Equipe', 'class="nav-link"')?>
                             <?php echo span_class('grupos'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('modulos',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('modulos'); ?>">
                             <?php echo anchor('usuarios/modulos', 'Modulos', 'class="nav-link"')?>
                             <?php echo span_class('modulos'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('perfil',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('perfil'); ?>">
                             <?php echo anchor('usuarios/perfil', 'Perfil', 'class="nav-link"')?>
                             <?php echo span_class('perfil'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('cargo',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('cargo'); ?>">
                            <?php echo anchor('usuarios/cargo', 'Cargo', 'class="nav-link"')?>
                            <?php echo span_class('cargo'); ?>
                        </li>
                        <?php }?>
                    </ul>
                </li>

                <li class="nav-item <?php if($this->uri->segment(1) == 'banco_de_dados') { echo 'active open'; } ?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class=" icon-wrench"></i>
                        <span class="title">Banco de Dados</span>
                        <?php if($this->uri->segment(1) == 'banco_de_dados') { echo '<span class="selected"></span>'; } ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <?php if($this->auth_ad->level_access('configuracao',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('configuracao'); ?>">
                            <?php echo anchor('banco_de_dados/configuracao', 'Configuração', 'class="nav-link"')?>
                            <?php echo span_class('configuracao'); ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('backup',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php echo active_class('backup'); ?>">
                            <?php echo anchor('banco_de_dados/backup', 'Backup', 'class="nav-link"')?>
                            <?php echo span_class('backup'); ?>
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