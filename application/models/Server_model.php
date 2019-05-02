<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_model extends CI_Model {

    public function select_server_fora() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('zbx_server_fora');
        $this->db->order_by('data_alerta', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }


    public function update_server_fora($id, $dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('zbx_server_fora', $dados, $id);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }


}

/* End of file Server_model.php */
/* Location: ./application/models/Server_model.php */