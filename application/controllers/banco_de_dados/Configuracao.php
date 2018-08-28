<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/logout');
        }
    }

    public function index() {
        $CI = &get_instance();
        $CI->load->database();

        $db = array();
        $active_group = '';
        include(APPPATH.'config/database.php');

        $script['footerinc'] = '';
        $script['script']    = '';
        $css['headerinc']    = '';
        $session['username'] = $this->session->userdata('username');

        $dados['default_hostname'] = $db['default']['hostname'];
        $dados['default_database'] = $db['default']['database'];
        $dados['default_username'] = $db['default']['username'];
        $dados['default_password'] = $db['default']['password'];
        $dados['default_dbdriver'] = $db['default']['dbdriver'];

        $dados['portalm_hostname'] = $db['portalm']['hostname'];
        $dados['portalm_database'] = $db['portalm']['database'];
        $dados['portalm_username'] = $db['portalm']['username'];
        $dados['portalm_password'] = $db['portalm']['password'];
        $dados['portalm_dbdriver'] = $db['portalm']['dbdriver'];

        $dados['portalmoni_hostname'] = $db['portalmoni']['hostname'];
        $dados['portalmoni_database'] = $db['portalmoni']['database'];
        $dados['portalmoni_username'] = $db['portalmoni']['username'];
        $dados['portalmoni_password'] = $db['portalmoni']['password'];
        $dados['portalmoni_dbdriver'] = $db['portalmoni']['dbdriver'];

        // $dados['oracle_hostname'] = $db['oracle']['hostname'];
        // $dados['oracle_database'] = $db['oracle']['database'];
        // $dados['oracle_username'] = $db['oracle']['username'];
        // $dados['oracle_password'] = $db['oracle']['password'];
        // $dados['oracle_dbdriver'] = $db['oracle']['dbdriver'];

        $dados['oracle_hostname'] = '';
        $dados['oracle_database'] = '';
        $dados['oracle_username'] = '';
        $dados['oracle_password'] = '';
        $dados['oracle_dbdriver'] = '';

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Banco de Dados</span>', 'banco_de_dados;');
        $this->breadcrumbs->push('<span>Configuração</span>', '/banco_de_dados/configuracao');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('banco_de_dados/configuracao', $dados);

        $this->load->view('template/footer',$script);

    }

}

/* End of file Configuracao.php */
/* Location: ./application/controllers/banco_de_dados/Configuracao.php */