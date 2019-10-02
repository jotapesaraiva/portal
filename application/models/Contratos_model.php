<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos_model extends CI_Model {

    public function listar_contratos($id = NULL)
    {
        // $default = $this->load->database('default', TRUE);
        $this->db->select('c.*, tc.nome_tipo_contrato, f.nome_fornecedor');
        $this->db->from('tbl_contratos c');
        $this->db->join('tbl_fornecedor f','f.id_fornecedor=c.id_fornecedor');
        $this->db->join('tbl_tipo_contrato tc','tc.id_tipo_contrato=c.id_tipo_contrato');
        if($id != null){
            $this->db->where('c.id_contrato',$id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_contrato($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_contratos', $dados);
        return $this->db->insert_id();
    }

    public function update_contrato($where,$dados) {
        $this->db->update('tbl_contratos', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_contrato($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_contrato', $id);
        $this->db->delete('tbl_contratos');
    }

    public function listar_tipo($id = NULL) {
        // $default = $this->load->database('default', TRUE);
        if($id != null){
            $this->db->where('id_tipo_contrato',$id);
        }
        $query = $this->db->get('tbl_tipo_contrato');
        return $query;
    }

}

/* End of file Contratos_model.php */
/* Location: ./application/models/Contratos_model.php */