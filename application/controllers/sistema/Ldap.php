<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ldap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->config('auth_ad');

        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            // $data = array('error_message' => 'Efetue o login para acessar o sistema');
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/logout');
        }
    }

    public function index() {
        $hosts          = $this->config->item('hosts');
        $common_hosts   = implode(', ', $hosts);
        $port           = $this->config->item('port');
        $tls            = $this->config->item('tls');
        $base_dn        = $this->config->item('base_dn');
        $ad_domain      = $this->config->item('ad_domain');
        $start_ou       = $this->config->item('start_ou');
        $new_usr_ou     = $this->config->item('new_user_ou');
        $shared_mbox_ou = $this->config->item('shared_mbox_ou');
        $proxy_user     = $this->config->item('proxy_user');
        $proxy_pass     = $this->config->item('proxy_pass');
        $admin_group    = $this->config->item('admin_group');

        $css['headerinc']    = '';
        $script['script'] = '';
        $script['footerinc'] = '';
        $dados = array(
            'hosts'      => $common_hosts,
            'port'       => $port,
            'tls'        => $tls,
            'base_dn'    => $base_dn,
            'ad_domain'  => $ad_domain,
            'start_ou'   => $start_ou,
            'proxy_user' => $proxy_user,
            'proxy_pass' => $proxy_pass,
            'admin_group'=> $admin_group,
        );

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>LDAP</span>', '/sistema/ldap');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');
        $this->load->view('sistema/ldap',$dados);
        $this->load->view('template/footer',$script);
    }

    public function salvar() {
        $this->config->load('auth_ad', TRUE);
        $admin_group = $this->input->post('admin_group');
        $port        = $this->input->post('port');
        $base_dn     = $this->input->post('base_dn');
        $ad_domain   = $this->input->post('ad_domain');
        $start_ou    = $this->input->post('start_ou');
        // vd($this->input->post('admin_group'));
        $this->config->set_item('admin_group', $admin_group, 'auth_add');
        redirect('sistema/ldap');
    }
}

/* End of file Ldap.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp20711/var/www/html/portal/frontend/controllers/Ldap.php */