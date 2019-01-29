<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobreaviso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sobreaviso_model');
    }

    public function index() {
        $retorno = array();
        $sobreavisos = $this->sobreaviso_model->select();
        // vd($sobreavisos);
        foreach($sobreavisos as $sobreaviso){
            $result = array(
               $sobreaviso['celula'],
               $sobreaviso['nome'],
               str_replace(',','<br>',$sobreaviso['telefone']),
               date('d/m/Y H:i', strtotime($sobreaviso['inicio'])),
               date('d/m/Y H:i', strtotime($sobreaviso['fim']))
            );
            array_push($retorno,$result);
        }
        echo '{ "data":'.json_encode($retorno).'}';

    }

}

/* End of file Sobreaviso.php */
/* Location: ./application/controllers/dash/Sobreaviso.php */