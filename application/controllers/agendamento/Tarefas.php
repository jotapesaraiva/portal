<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
    }

    public function index(){
        $this->output->enable_profiler(FALSE);
                $css['headerinc'] = '';
                $script['footerinc'] = '';
                $script['script'] = '';

                $session['username'] = $this->session->userdata('username');
                $grupos = $this->usuario_model->listar_grupo();

                $modal = array( 'grupos' => $grupos,);

                $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
                $this->breadcrumbs->push('<span>Agendamento</span>', '/agendamento');
                $this->breadcrumbs->push('<span>Tarefas</span>', '/agendamento/tarefas');

                $this->load->view('template/header', $css);
                $this->load->view('template/navbar', $session);
                $this->load->view('template/sidebar');

                $this->load->view('agendamento/tarefas');


                $this->load->view('template/footer', $script);

    }

}

/* End of file Tarefas.php */
/* Location: ./application/controllers/agendamento/Tarefas.php */