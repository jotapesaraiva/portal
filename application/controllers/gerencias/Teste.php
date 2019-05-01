<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function index()
    {
        echo $this->router->directory;
        echo " ";
        echo $this->router->class;
        echo " ";
        echo $this->router->method;
                echo " ";
        echo $this->uri->segment(2);
    }

    public function auditoria() {
        $this->load->model('usuario_model');
        $this->usuario_model->listar_modulos(212);
        $login = $this->session->userdata('username');
        echo $this->usuario_model->permissao($login)->row()->login_usuario;
        auditoria('teste','teste usando db default');
    }

}

/* End of file Teste.php */
/* Location: ./application/controllers/gerencias/Teste.php */