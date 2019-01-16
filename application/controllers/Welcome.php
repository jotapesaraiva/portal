<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// Load form validation library
		$this->load->library('Auth_AD');

		if($this->auth_ad->is_authenticated()){
		    $username = $this->session->userdata('username');
		} else {
		    set_msg('loginErro','Efetue o login para acessar o sistema','erro');
		    redirect('auth/login');
		}
	}
	public function index()	{

		$this->output->enable_profiler(FALSE);
		$css['headerinc'] = '
		<link href="'. base_url() .'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
		<link href="'. base_url() .'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
		';
		$script['script'] = '<script>$("#myAlert").fadeOut(4000);</script>';
		$script['footerinc'] = '
		<script src="'. base_url() .'assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="'. base_url() .'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
		<script src="'. base_url() .'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/link_indisponivel.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/custom/server.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/custom/backups_falhos.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/custom/zabbix.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/custom/antigo_monitora.js" type="text/javascript"></script>
		<script src="' . base_url() . 'assets/custom/chamados_mantis.js" type="text/javascript"></script>';

		$username = $this->session->userdata('username');
		$user = array("username" => $username);
		// $dados = $this->load->controller('dash/server');
		// $this->session->set_flashdata("loginOk","Logando com sucesso no sistema!!!.");
		// set_msg('loginOk','Logado com sucesso no sistema !!!','sucesso');
		$this->load->view('template/header',$css);
		$this->load->view('template/navbar',$user);
		$this->load->view('template/sidebar');
		$this->load->view('teste/conteudo');
		$this->load->view('template/footer',$script);
		$this->load->view('modal/modal_mantis');
/*
		set_tema('title','Titulo'); //$tema['title'] = 'titulo';
		set_tema('navbar', load_modulo('menu_topo', 'painel', 'tpl'));// $tema['header'] = 'cabeçalho';
		set_tema('sidebar', load_modulo('menu_lateral', 'painel', 'tpl'));
		set_tema('headerinc', '');
		//set_tema('headerinc',load_css(array(''),'')); //$tema['headerinc'] = 'css';
		set_tema('content',load_modulo('conteudo', 'painel', 'teste')); //$tema['content'] = 'conteudo';
		set_tema('footer', load_modulo('rodape', 'painel', 'tpl')); //$tema['footer'] = 'rodape';
		set_tema('footerinc', '');
		//set_tema('footerinc', load_js(array(''), ''));//$tema['footerinc'] = 'js';
		set_tema('template', 'modelo');
		load_template();// $this->load->view('welcome_message', $tema);*/
	}
}
