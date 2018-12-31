<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
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

        $dados['monitora_hostname'] = $db['monitora']['hostname'];
        $dados['monitora_database'] = $db['monitora']['database'];
        $dados['monitora_username'] = $db['monitora']['username'];
        $dados['monitora_password'] = $db['monitora']['password'];
        $dados['monitora_dbdriver'] = $db['monitora']['dbdriver'];

        $dados['portalmoni_hostname'] = $db['portalmoni']['hostname'];
        $dados['portalmoni_database'] = $db['portalmoni']['database'];
        $dados['portalmoni_username'] = $db['portalmoni']['username'];
        $dados['portalmoni_password'] = $db['portalmoni']['password'];
        $dados['portalmoni_dbdriver'] = $db['portalmoni']['dbdriver'];

        $dados['mantis_hostname'] = $db['mantis']['hostname'];
        $dados['mantis_database'] = $db['mantis']['database'];
        $dados['mantis_username'] = $db['mantis']['username'];
        $dados['mantis_password'] = $db['mantis']['password'];
        $dados['mantis_dbdriver'] = $db['mantis']['dbdriver'];


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