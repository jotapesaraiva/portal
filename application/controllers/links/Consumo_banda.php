<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumo_banda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('consumo_model');
        $this->load->library('Auth_AD');
        $this->load->library('breadcrumbs');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            // $data = array('error_message' => 'Efetue o login para acessar o sistema');
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }
    }

    public function index() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/historico.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

          $session['username'] = $this->session->userdata('username');

          $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
          $this->breadcrumbs->push('<span>Link</span>','/link');
          $this->breadcrumbs->push('<span>Consumo de Banda</span>','link/consumo_banda');

          $data['historico'] = $this->table_history();

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/consumo_banda',$data);

          $this->load->view('template/footer',$script);
    }

    public function table_history() {

    }

    public function teste() {
       $consumo_atual =  $this->consumo_model->consumo_atual();
       vd($consumo_atual->result());
    }

}

/* End of file consumo_banda.php */
/* Location: ./application/controllers/links/consumo_banda.php */