<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_rede extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index() {
        $this->load->model('mensagem_rede_model');
        $result = $this->mensagem_rede_model->consulta();
        // vd($result->result());
        echo $result->num_rows();
    }

}

/* End of file Mensagem_rede.php */
/* Location: ./application/controllers/script/Mensagem_rede.php */