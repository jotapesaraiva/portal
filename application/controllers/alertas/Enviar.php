<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enviar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
    }

    public function index() {
        $script['footerinc'] = '';
        $script['script'] = '';
        $css['headerinc'] = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Dashboard</span>', '/welcome');
        // $this->breadcrumbs->push('<span>Unidades</span>', '/localidades/unidades');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('alertas/enviar');

        $this->load->view('template/footer', $script);
    }

}

/* End of file Enviar.php */
/* Location: ./application/controllers/alertas/Enviar.php */