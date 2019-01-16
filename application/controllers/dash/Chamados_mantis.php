<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamados_mantis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('mantis_model');
    }

    public function index() {
        $quantidade = $this->mantis_model->widget_mantis('quantidade');
        echo json_encode($quantidade);
    }

    public function mantis_producao() {
        $chamados = $this->mantis_model->widget_mantis('chamados');
        // vd($chamados);
        // foreach ($chamados as $chamado) {

        // }
        echo '{ "data":'.json_encode($chamados).'}';
    }

}

/* End of file Chamados_mantis.php */
/* Location: ./application/controllers/dash/Chamados_mantis.php */