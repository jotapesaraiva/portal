<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_rede extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
    }

    public function index() {
        // $output = array();
        $this->load->model('mensagem_rede_model');
        $resultado = $this->mensagem_rede_model->select();
        // vd($resultado->result());
        // foreach ($resultado->result_array() as $msg) {
        //    $output = array(
        //         'id' => $msg['id'], //id
        //         'name' => $msg['post_user'], //usario que postou
        //         'msg' => $msg['msg'], //mensagem
        //         'type' => $msg['ps'], //tipo da mensagem
        //         'start' => $msg['start_date'], //inicio da mensagem
        //         'stop' => $msg['stop_date'] //fim da mensagem
        //     );
        // }
        echo json_encode($resultado->result());
    }

    public function alerta() {
        $this->load->model('mensagem_rede_model');
        $result = $this->mensagem_rede_model->consulta();
        // vd($result->result());
        echo $result->num_rows();
    }
}

/* End of file Mensagem_rede.php */
/* Location: ./application/controllers/dash/Mensagem_rede.php */