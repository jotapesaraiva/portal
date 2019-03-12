<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobreaviso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sobreaviso_model');
    }

    public function index()
    {
      // Datatables Variables
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $sobreavisos = $this->sobreaviso_model->select();
      $data = array();
      foreach ($sobreavisos->result_array() as $sobreaviso) {
          $row = array();
          $row[] = $sobreaviso['celula'];
          $row[] = $sobreaviso['nome'];
          $row[] = str_replace(',','<br>',$sobreaviso['telefone']);
          $row[] = date('d/m/Y H:i', strtotime($sobreaviso['inicio']));
          $row[] = date('d/m/Y H:i', strtotime($sobreaviso['fim']));
          $data[] = $row;
      }
      $output = array(
          "draw" => $draw,
          "recordsTotal" => $sobreavisos->num_rows(),
          "recordsFiltered" => $sobreavisos->num_rows(),
          "data" => $data,
      );
      echo json_encode($output);
    }

    public function old() {
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