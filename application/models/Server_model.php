<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_model extends CI_Model {

    public function select_server_fora() {
        $portal = $this->load->database('default',true);
        $portal->select('*');
        $portal->from('zbx_server_fora');
        $portal->order_by('data_alerta', 'DESC');
        $query = $portal->get();
        // echo $portal->last_query();
        return $query->result_array();
    }


    public function update_server_fora($id, $dados) {
        $portal = $this->load->database('default',true);
        $portal->update('zbx_server_fora', $dados, $id);
        // echo $portal->last_query();
        return $portal->affected_rows();
    }


}

/* End of file Server_model.php */
/* Location: ./application/models/Server_model.php */