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
        $retorno = array();
        $chamados = $this->mantis_model->widget_mantis('chamados');
        $array_color = array(50 => "primary", 10 => "danger", 20 => "retorno", 40 => "autorizado", 30 => "impedido", 80 => "warning", 90 => "", 60 => "");
        // vd($chamados);
        foreach($chamados as $producao){
            $ID =  '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$producao['ID'].'" class="label label-'.$array_color[$producao['STATUS']].'" target="_blank">'.$producao['ID'].'</a>';
            $result = array(
               $ID,
               $producao['RELATOR'],
               $producao['ATRIBUIDO'],
               $producao['SUMMARY'],
               $producao['DATE_SUBMITTED'],
               $producao['ULTIMA_ATUALIZACAO']
            );
            array_push($retorno,$result);
        }
        echo '{ "data":'.json_encode($retorno).'}';
    }

}

/* End of file Chamados_mantis.php */
/* Location: ./application/controllers/dash/Chamados_mantis.php */