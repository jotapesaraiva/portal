<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamados_mantis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('mantis_model');
    }

    public function index() {
        $quantidade = $this->mantis_model->widget_mantis('outro');
        vd($quantidade);
    }

    public function mantis_producao() {
        # code...
    }

}

/* End of file Chamados_mantis.php */
/* Location: ./application/controllers/dash/Chamados_mantis.php */