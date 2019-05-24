<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao_model extends CI_Model {

    public function listar_manutencao($id = NULL) {
        // $default = $this->load->database('default', TRUE);
        $this->db->select('a.*, g.nome_grupo');
        $this->db->from('tbl_manutencao a');
        $this->db->join('tbl_grupos g','g.id_grupo=a.id_grupo');
        if($id != null){
            $this->db->where('a.id',$id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_manutencao($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_manutencao', $dados);
        return $this->db->insert_id();
    }

    public function update_manutencao($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_manutencao', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_manutencao($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id', $id);
        $this->db->delete('tbl_manutencao');
    }

}

/* End of file Manutencao_model.php */
/* Location: ./application/models/Manutencao_model.php */