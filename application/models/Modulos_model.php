<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos_model extends CI_Model {

    public function site_modulo($modulo) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('status');
        $this->db->from('mdl_site');
        $this->db->where('aplicacao', $modulo);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function listar_modulos() {
        $query = $this->db->get('mdl_site');
        return $query->result_array();
    }

    public function update_modulos($id,$dados) {
        $this->db->update('mdl_site', $dados, $id);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }

}

/* End of file Modulos_model.php */
/* Location: ./application/models/Modulos_model.php */