<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producao extends CI_Controller {

        public function __construct() {
            parent::__construct();
            // Load form validation library
            esta_logado();
        }
        public function index() {

            $this->output->enable_profiler(FALSE);
            $css['headerinc'] = '';
            $script['script'] = '';
            $script['footerinc'] = '
                <script src="' . base_url() . 'assets/custom/dashboard/link_indisponivel.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/dashboard/server.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/dashboard/backups_falhos.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/dashboard/zabbix.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/dashboard/antigo_monitora.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/dashboard/chamados_mantis.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/dashboard/temperatura_nobreak.js" type="text/javascript"></script>';

            $username = $this->session->userdata('username');
            $user = array("username" => $username);

            $this->load->view('template/header',$css);
            $this->load->view('template/navbar',$user);
            $this->load->view('template/sidebar');
            $this->load->view('dashboard/producao');
            $this->load->view('template/footer',$script);
            $this->load->view('modal/modal_mantis');
        }

}

/* End of file Producao.php */
/* Location: ./application/controllers/dashboard/Producao.php */