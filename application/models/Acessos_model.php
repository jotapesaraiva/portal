<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessos_model extends CI_Model {


    public function servidor_acesso() {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('tipo','1');
        $query = $portal_db->get('tbl_senha_acesso');
        return $query;
    }

    public function servico_acesso() {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('tipo','0');
        $query = $portal_db->get('tbl_senha_acesso');
        return $query;
    }

    public function save_acesso($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_senha_acesso', $dados);
        return $portal_db->insert_id();
    }

    public function edit_acesso($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_senha_acesso');
        $portal_db->where('id',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function update_acesso($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_senha_acesso', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_acesso($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id',$id);
        $portal_db->delete('tbl_senha_acesso');
    }

}

/* End of file Acessos_model.php */
/* Location: ./application/models/Acessos_model.php */