<?php defined('BASEPATH') OR exit('No direct script access aloowed');?>

<!-- BEGIN HEADER -->
<div style="height: 53px;" class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?php echo base_url(); ?>dashboard/producao">
                <img src="<?php echo base_url(); ?>assets/layouts/layout/img/noc_logo.png" alt="logo" style="margin: 0 30px 0;" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN TODO DROPDOWN -->
                <?php if($this->auth_ad->level_access('producao', group_session($this->session->userdata('username')))){?>
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span id="agendamento" class="badge badge-info"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>Alerta de <span id="count_agendamento" class="bold">-1</span> agendamento</h3>
                            <a href="<?php echo base_url(); ?>gerencias/agendamento/table_agendamento_alerta">ver tudo</a>
                        </li>
                        <li id='content_agendamento'>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-envelope-open"></i>
                        <span id="mensagem_rede" class="badge badge-info"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>Você tem <span id="count_msg" class="bold">-1</span> Messagens</h3>
                            <a href="https://rede.sefa.pa.gov.br/msg/">ver tudo</a>
                        </li>
                        <li id='content_msg'>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended">
                    <a href="#" class="dropdown-toggle tooltips" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-placement="bottom" data-original-title="Ramais">
                        <i class="fa fa-phone"></i>
                    </a>
                    <ul class="dropdown-menu" style="width:0px !important;">
                        <li>
                            <a href="javascript:;" onclick="ramais_dti()">Ramais DTI</a>
                        </li>
                        <li>
                            <a href="javascript:;" onclick="ramais_sefa()">Ramais SEFA</a>
                        </li>
                    </ul>
                </li>
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended">
                    <a href="#" class="dropdown-toggle tooltips" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" data-placement="bottom" data-original-title="Sobreaviso">
                        <i class="icon-calendar"></i>
                    </a>
                    <ul class="dropdown-menu" style="width:0px !important;">
                        <li>
                            <a href="javascript:;" onclick="sobreaviso()" >Sobreaviso do dia</a>
                        </li>
                        <li>
                            <a href="https://producaoh.sefa.pa.gov.br/sobreaviso" target="_blank" >Sistema Sobreaviso</a>
                        </li>
                    </ul>
                </li>
                <!-- END INBOX DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!-- <img alt="" class="img-circle" src="<?php //echo $perfil_user; ?>" /> -->
                        <span class="username username-hide-on-mobile"> <?php echo $username; ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo base_url();?>menu/meu_perfil"><i class="icon-user"></i> Meu Perfil </a>
                        </li>
                        <li>
                            <?php echo anchor_popup('https://mantis.sefa.pa.gov.br/my_view_page.php', '<i class="icon-rocket"></i> Minhas Tarefas <span class="badge badge-success"> '.minhas_tarefas().' </span>' ); ?>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <?php echo anchor('auth/logout', '<i class="icon-key"></i> Log Out ' )?>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->