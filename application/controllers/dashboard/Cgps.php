<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cgps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('Auth_AD');
        $this->load->model('replicador_model');

        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }

    }
    public function index() {

        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '';
        $script['script'] = '';
        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/dashboard/server.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/dashboard/zabbix.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/dashboard/antigo_monitora.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/dashboard/replicador.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/dashboard/chamados_mantis.js" type="text/javascript"></script>
        ';

        $username = $this->session->userdata('username');
        $user = array("username" => $username);

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/cgps');
        $this->load->view('template/footer',$script);
        $this->load->view('modal/modal_mantis');
        $this->load->view('modal/modal_replicador');
        $this->load->view('modal/modal_renvia');
    }
}

/* End of file Cgps.php */
/* Location: ./application/controllers/dashboard/Cgps.php */