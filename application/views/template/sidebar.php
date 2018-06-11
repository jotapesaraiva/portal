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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'gerencias/tecnico') { echo 'active open'; } ?>">
                            <?php echo anchor('gerencias/tecnico', 'Tecnicos', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'gerencias/tecnico') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('fornecedores',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'gerencias/fornecedor') { echo 'active open'; } ?>">
                            <?php echo anchor('gerencias/fornecedor', 'Fornecedores', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'gerencias/fornecedor') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('contato',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'gerencias/contato') { echo 'active open'; } ?>">
                            <?php echo anchor('gerencias/contato', 'Contatos', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'gerencias/contato') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('servidores',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'gerencias/servidor') { echo 'active open'; } ?>">
                            <?php echo anchor('gerencias/servidor', 'Servidores', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'gerencias/servidor') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'ramais/sefa') { echo 'active open'; } ?>">
                            <?php echo anchor('ramais/sefa', 'SEFA', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'ramais/sefa') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('dti',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'ramais/dti') { echo 'active open'; } ?>">
                            <?php echo anchor('ramais/dti', 'DTI', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'ramais/dti') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('voip',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'ramais/voip') { echo 'active open'; } ?>">
                            <?php echo anchor('ramais/voip', 'VOIP', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'ramais/voip') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'localidades/unidade') { echo 'active open'; } ?>">
                            <?php echo anchor('localidades/unidade', 'Unidades', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'localidades/unidade') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('link',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'localidades/link') { echo 'active open'; } ?>">
                            <?php echo anchor('localidades/link', 'Links', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'localidades/link') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'backup/historico') { echo 'active open'; } ?>">
                            <?php echo anchor('backup/historico', 'Histórico', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'backup/historico') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('janela_backup',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'backup/janela_backup') { echo 'active open'; } ?>">
                            <?php echo anchor('backup/janela_backup', 'Janela de Backup', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'backup/janela_backup') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('fitas',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->segment(2) == 'fitas') { echo 'active open'; } ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Fitas</span>
                                <?php if($this->uri->segment(2) == 'fitas') { echo '<span class="selected"></span>'; } ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php if($this->uri->uri_string() == 'backup/fitas/diario') { echo 'active open'; } ?>">
                                    <?php echo anchor('backup/fitas/diario', 'Diário', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'backup/fitas/diario') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'backup/fitas/mensal') { echo 'active open'; } ?>">
                                    <?php echo anchor('backup/fitas/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'backup/fitas/mensal') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'backup/fitas/poor') { echo 'active open'; } ?>">
                                    <?php echo anchor('backup/fitas/poor', 'Poor', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'backup/fitas/poor') { echo '<span class="selected"></span>'; } ?>
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
                                        <li class="nav-item <?php if($this->uri->uri_string() == 'backup/graficos/crescimento/dia') { echo 'active open'; } ?>">
                                            <?php echo anchor('backup/graficos/crescimento/dia', 'Dia', 'class="nav-link"')?>
                                            <?php if($this->uri->uri_string() == 'backup/graficos/crescimento/dia') { echo '<span class="selected"></span>'; } ?>
                                        </li>
                                        <li class="nav-item <?php if($this->uri->uri_string() == 'backup/graficos/crescimento/mes') { echo 'active open'; } ?>">
                                            <?php echo anchor('backup/graficos/crescimento/mes', 'Mês', 'class="nav-link"')?>
                                            <?php if($this->uri->uri_string() == 'backup/graficos/crescimento/mes') { echo '<span class="selected"></span>'; } ?>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'quantidade') { echo 'active open'; } ?>">
                                    <?php echo anchor('backup/graficos/quantidade', 'Quantidade', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'backup/graficos/quantidade') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->segment(3) == 'tempo') { echo 'active open'; } ?>">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Tempo</span>
                                        <?php if($this->uri->segment(3) == 'tempo') { echo '<span class="selected"></span>'; } ?>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                    <li class="nav-item <?php if($this->uri->uri_string() == 'backup/graficos/tempo/mes') { echo 'active open'; } ?>">
                                        <?php echo anchor('backup/graficos/tempo/mes', 'Mês', 'class="nav-link"')?>
                                        <?php if($this->uri->uri_string() == 'backup/graficos/tempo/mes') { echo '<span class="selected"></span>'; } ?>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->uri_string() == 'backup/graficos/tempo/ano') { echo 'active open'; } ?>">
                                        <?php echo anchor('backup/graficos/tempo/ano', 'Ano', 'class="nav-link"')?>
                                        <?php if($this->uri->uri_string() == 'backup/graficos/tempo/ano') { echo '<span class="selected"></span>'; } ?>
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
                                    <li class="nav-item <?php if($this->uri->uri_string() == 'backup/graficos/volume/mes') { echo 'active open'; } ?>">
                                        <?php echo anchor('backup/graficos/volume/mes', 'Mês', 'class="nav-link"')?>
                                        <?php if($this->uri->uri_string() == 'backup/graficos/volume/mes') { echo '<span class="selected"></span>'; } ?>
                                    </li>
                                    <li class="nav-item <?php if($this->uri->uri_string() == 'backup/graficos/volume/ano') { echo 'active open'; } ?>">
                                        <?php echo anchor('backup/graficos/volume/ano', 'Ano', 'class="nav-link"')?>
                                        <?php if($this->uri->uri_string() == 'backup/graficos/volume/ano') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'links/historico') { echo 'active open'; } ?>">
                            <?php echo anchor('links/historico', 'Historico', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'links/historico') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('calculo_multa',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'links/calculo_multa') { echo 'active open'; } ?>">
                            <?php echo anchor('links/calculo_multa', 'Cálculo Multa', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'links/calculo_multa') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('consumo_banda',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'links/consumo_banda') { echo 'active open'; } ?>">
                            <?php echo anchor('links/consumo_banda', 'Consumo de Banda', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'links/consumo_banda') { echo '<span class="selected"></span>'; } ?>
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
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/consumo/diario') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/consumo/diario', 'Diário', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/consumo/diario') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/consumo/mensal') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/consumo/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/consumo/mensal') { echo '<span class="selected"></span>'; } ?>
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
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/localidade/mensal') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/localidade/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/localidade/mensal') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/localidade/anual') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/localidade/anual', 'Anual', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/localidade/anual') { echo '<span class="selected"></span>'; } ?>
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
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/causa/mensal') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/causa/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/causa/mensal') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/causa/anual') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/causa/anual', 'Anual', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/causa/anual') { echo '<span class="selected"></span>'; } ?>
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
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/ticket/mensal') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/ticket/mensal', 'Mensal', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/ticket/mensal') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'links/graficos/ticket/anual') { echo 'active open'; } ?>">
                                    <?php echo anchor('links/graficos/ticket/anual', 'Anual', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'links/graficos/ticket/anual') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                </ul>
                            </li>
                            </ul>
                        </li>
                        <?php } else if($this->auth_ad->level_access($this->uri->segment(2),$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'links/historico') { echo 'active open'; } ?>">
                            <?php echo anchor('links/historico', 'Historico', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'links/historico') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/geral') { echo 'active open'; } ?>">
                            <?php echo anchor('sistema/geral', 'Geral', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'sistema/geral') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('cronjob',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/cronjob') { echo 'active open'; } ?>">
                            <?php echo anchor('sistema/cronjob', 'Cron Job', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'sistema/cronjob') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('log',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/log') { echo 'active open'; } ?>">
                            <?php echo anchor('sistema/log', 'Logs', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'sistema/log') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('ldap',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/ldap') { echo 'active open'; } ?>">
                            <?php echo anchor('sistema/ldap', 'LDAP', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'sistema/ldap') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('consulta',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->segment(2) == 'consulta') { echo 'active open'; } ?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Itens da consulta</span>
                                <?php if($this->uri->segment(2) == 'consulta') { echo '<span class="selected"></span>'; } ?>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/acesso') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/acesso', 'Tipo de Acesso', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/acesso') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/velocidade') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/velocidade', 'Tipo de Velocidade', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/velocidade') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/cidade') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/cidade', 'Cidade', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/cidade') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/expediente') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/expediente', 'Expediente', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/expediente') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/contexto_voip') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/contexto_voip', 'Tipo Contexto Voip', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/contexto_voip') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/equipamento_voip') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/equipamento_voip', 'Tipo Equipamento Voip', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/equipamento_voip') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/categoria_voip') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/categoria_voip', 'Tipo Categoria Voip', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/categoria_voip') { echo '<span class="selected"></span>'; } ?>
                                </li>
                                <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/consulta/categoria_tel') { echo 'active open'; } ?>">
                                    <?php echo anchor('sistema/consulta/categoria_tel', 'Tipo Categoria Telefonia', 'class="nav-link"')?>
                                    <?php if($this->uri->uri_string() == 'sistema/consulta/categoria_tel') { echo '<span class="selected"></span>'; } ?>
                                </li>
                            </ul>
                        </li>
                        <?php } if($this->auth_ad->level_access('zabbix',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'sistema/zabbix') { echo 'active open'; } ?>">
                            <?php echo anchor('sistema/zabbix', 'Zabbix', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'sistema/zabbix') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'usuarios/lista') { echo 'active open'; } ?>">
                            <?php echo anchor('usuarios/lista', 'Lista de Usuarios', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'usuarios/lista') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('permissao',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'usuarios/permissao') { echo 'active open'; } ?>">
                            <?php echo anchor('usuarios/permissao', 'Permissão', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'usuarios/permissao') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('grupos',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'usuarios/grupos') { echo 'active open'; } ?>">
                             <?php echo anchor('usuarios/grupos', 'Grupos/Equipe', 'class="nav-link"')?>
                             <?php if($this->uri->uri_string() == 'usuarios/grupos') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('modulos',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'usuarios/modulos') { echo 'active open'; } ?>">
                             <?php echo anchor('usuarios/modulos', 'Modulos', 'class="nav-link"')?>
                             <?php if($this->uri->uri_string() == 'usuarios/modulos') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('perfil',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'usuarios/perfil') { echo 'active open'; } ?>">
                             <?php echo anchor('usuarios/perfil', 'Perfil', 'class="nav-link"')?>
                             <?php if($this->uri->uri_string() == 'usuarios/perfil') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('cargo',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'usuarios/cargo') { echo 'active open'; } ?>">
                            <?php echo anchor('usuarios/cargo', 'Cargo', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'usuarios/cargo') { echo '<span class="selected"></span>'; } ?>
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
                        <li class="nav-item <?php if($this->uri->uri_string() == 'banco_de_dados/configuracao') { echo 'active open'; } ?>">
                            <?php echo anchor('banco_de_dados/configuracao', 'Configuração', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'banco_de_dados/configuracao') { echo '<span class="selected"></span>'; } ?>
                        </li>
                        <?php } if($this->auth_ad->level_access('backup',$this->session->userdata('physicaldeliveryofficename'))){?>
                        <li class="nav-item <?php if($this->uri->uri_string() == 'banco_de_dados/backup') { echo 'active open'; } ?>">
                            <?php echo anchor('banco_de_dados/backup', 'Backup', 'class="nav-link"')?>
                            <?php if($this->uri->uri_string() == 'banco_de_dados/backup') { echo '<span class="selected"></span>'; } ?>
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