<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessos_model extends CI_Model {


    public function servidor_acesso() {
        // $this->db = $this->load->database('default',true);
        $this->db->where('tipo','1');
        $query = $this->db->get('tbl_senha_acesso');
        return $query;
    }

    public function servico_acesso() {
        // $this->db = $this->load->database('default',true);
        $this->db->where('tipo','0');
        $query = $this->db->get('tbl_senha_acesso');
        return $query;
    }

    public function save_acesso($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_senha_acesso', $dados);
        return $this->db->insert_id();
    }

    public function edit_acesso($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_senha_acesso');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_acesso($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_senha_acesso', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_acesso($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id',$id);
        $this->db->delete('tbl_senha_acesso');
    }

}

/* End of file Acessos_model.php */
/* Location: ./application/models/Acessos_model.php */