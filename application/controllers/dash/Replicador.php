<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replicador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('replicador_model');
        include APPPATH . 'third_party/zabbix/date_function.php';
    }

    public function index() {
        # code...
    }

    public function replic() {
        $replic = $this->replicador_model->replicador();
        $resultado = date('Y-m-d H:i:s', intval($replic->row('DATA')));//datetime
        echo time_elapsed_string($resultado,true);
    }

    public function replic_table() {
        $replic = $this->replicador_model->replicador_full();
        $retorno = array();
        foreach ($replic->result_array() as $key) {
            $result = array(
            $key['TCR_COD_UNIDADE'],
            $key['TCR_DATA_EXEC'],
            $key['TCR_DATA_PROX'],
            $key['TCR_DATA_CENTRAL'],
            $key['TCR_QTD_DELETE'],
            $key['TCR_QTD_EXEC'],
            $key['TCR_QTD_ERROS']

            // echo $key->TCR_COD_UNIDADE;
            // echo $key->TCR_DATA_EXEC;
            // echo $key->TCR_DATA_PROX;
            // echo $key->TCR_DATA_CENTRAL;
            // echo $key->TCR_QTD_DELETE;
            // echo $key->TCR_QTD_EXEC;
            // echo $key->TCR_QTD_ERROS;
            );
            array_push($retorno,$result);
        }
        echo '{ "data":'.json_encode($retorno).'}';
        // vd($replic->result());
    }

    public function renvia() {
        $renvia = $this->replicador_model->renvia();
        $resultado = date('Y-m-d H:i:s', intval($renvia->row('TEMPO')));//datetime
        echo time_elapsed_string($resultado,true);
        // echo $renvia->row("TEMPO");
    }

    public function renvia_table() {
        $renvia = $this->replicador_model->renvia_full();
        $retorno = array();
        foreach ($renvia->result_array() as $key) {
            $result = array(
            $key['ORIGEM'],
            $key['ULTIMA'],
            $key['ULTIMA2'],
            $key['TEMPO'],
            $key['NODIA'],
            $key['NASEMANA'],
            $key['ERROS']

            // echo $key->TCR_COD_UNIDADE;
            // echo $key->TCR_DATA_EXEC;
            // echo $key->TCR_DATA_PROX;
            // echo $key->TCR_DATA_CENTRAL;
            // echo $key->TCR_QTD_DELETE;
            // echo $key->TCR_QTD_EXEC;
            // echo $key->TCR_QTD_ERROS;
            );
            array_push($retorno,$result);
        }
        echo '{ "data":'.json_encode($retorno).'}';
        // vd($renvia->result());
    }
}

/* End of file Replicador.php */
/* Location: ./application/controllers/dash/Replicador.php */