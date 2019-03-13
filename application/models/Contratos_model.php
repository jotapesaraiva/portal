<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos_model extends CI_Model {

    public function listar_contratos($id = NULL)
    {
        $default = $this->load->database('default', TRUE);
        $default->select('c.*, tc.nome_tipo_contrato, f.nome_fornecedor');
        $default->from('tbl_contratos c');
        $default->join('tbl_fornecedor f','f.id_fornecedor=c.id_fornecedor');
        $default->join('tbl_tipo_contrato tc','tc.id_tipo_contrato=c.id_tipo_contrato');
        if($id != null){
            $default->where('c.id_contrato',$id);
        }
        $query = $default->get();
        return $query;
    }

    public function save_contrato($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_contratos', $dados);
        return $portal_db->insert_id();
    }

    public function update_contrato($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_contratos', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_contrato($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_contratos', $id);
        $portal_db->delete('tbl_contratos');
    }

    public function listar_tipo($id = NULL) {
        $default = $this->load->database('default', TRUE);
        if($id != null){
            $default->where('id_tipo_contrato',$id);
        }
        $query = $default->get('tbl_tipo_contrato');
        return $query;
    }

}

/* End of file Contratos_model.php */
/* Location: ./application/models/Contratos_model.php */