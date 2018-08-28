<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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

		$this->output->enable_profiler(TRUE);
		$css['headerinc'] = '';
		$script['script'] = '<script>$("#myAlert").fadeOut(4000);</script>';
		$script['footerinc'] = '';

		$username = $this->session->userdata('username');
		$dados = array("username" => $username);
		// $this->session->set_flashdata("loginOk","Logando com sucesso no sistema!!!.");
		// set_msg('loginOk','Logado com sucesso no sistema !!!','sucesso');

		$this->load->view('template/header',$css);
		$this->load->view('template/navbar',$dados);
		$this->load->view('template/sidebar');
		$this->load->view('teste/conteudo');
		$this->load->view('template/footer',$script);
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
