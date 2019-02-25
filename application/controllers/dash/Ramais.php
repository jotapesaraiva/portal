<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ramais extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('voip_model');
        //Do your magic here
    }

    public function index() {

    }

    public function dti() {
        $retorno = array();
        $ramais = $this->voip_model->select('dti');
        // vd($ramais->result());
        $count = 1;
        foreach($ramais->result_array() as $ramal){
            $result = array(
               $count++,
               $ramal['nome_unidade'],
               $ramal['setor_telefone_voip'],
               $ramal['numero_telefone']
            );
            array_push($retorno,$result);
        }
        echo '{ "data":'.json_encode($retorno).'}';
    }

    public function sefa() {
        $retorno = array();
        $ramais = $this->voip_model->select('sefa');
        // vd($ramais);
        $count = 1;
        foreach($ramais->result_array() as $ramal){
            $result = array(
                $count++,
                $ramal['nome_unidade'],
                $ramal['setor_telefone_voip'],
                $ramal['numero_telefone']
            );
            array_push($retorno,$result);
        }
        echo '{ "data":'.json_encode($retorno).'}';
    }

}

/* End of file Ramais.php */
/* Location: ./application/controllers/dash/Ramais.php */