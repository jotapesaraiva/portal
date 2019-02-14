<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamados_mantis extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('mantis_model');
        $this->load->helper('color_mantis');
    }

    public function index() {
        $result = '';
        $retorno = array();
        $qtds = $this->mantis_model->widget_mantis('quantidade');
        foreach ($qtds as $qtd) {
          foreach ($qtd as $key => $value) {
          if($key == 'QTD_MANTIS'){
            if($value == '0'){
              $result = array(
                'QTD_MANTIS' => $value,
                'flag' => 'green'
              );
            } else {
              $result = array(
                'QTD_MANTIS' => $value,
                'flag' => 'red'
              );
            }
          }
          array_push($retorno,$result);
          }
        }
        // echo $quantidade;
        echo json_encode($retorno);
    }

    public function mantis_producao() {
        $retorno = array();
        $chamados = $this->mantis_model->widget_mantis('chamados');
        // vd($chamados);
        foreach($chamados as $producao){
            $ID =  '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$producao['ID'].'" class="label label-'.color_mantis($producao['STATUS']).'" target="_blank">'.$producao['ID'].'</a>';
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