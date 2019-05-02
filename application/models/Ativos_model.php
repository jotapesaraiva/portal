<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos_model extends CI_Model {

    public function listar_ativos($id = NULL) {
        // $default = $this->load->database('default', TRUE);
        $this->db->select('a.*, ta.nome_tipo_ativo, g.nome_grupo, u.login_usuario, c.numero_contrato, f.nome_fornecedor');
        $this->db->from('tbl_ativos a');
        $this->db->join('tbl_tipo_ativo ta','a.id_tipo_ativo=ta.id_tipo_ativo');
        $this->db->join('tbl_grupos g','g.id_grupo=a.id_grupo');
        $this->db->join('tbl_usuario u','u.id_usuario=a.id_usuario');
        $this->db->join('tbl_contratos c','c.id_contrato=a.id_contrato');
        $this->db->join('tbl_fornecedor f','f.id_fornecedor=a.id_fornecedor');
        if($id != null){
            $this->db->where('a.id_ativo',$id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function save_ativo($dados) {
        // $portal_db = $this->load->database('default',true);
        $this->db->insert('tbl_ativos', $dados);
        return $this->db->insert_id();
    }

    public function update_ativo($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_ativos', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_ativo($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_ativo', $id);
        $this->db->delete('tbl_ativos');
    }

    public function listar_tipo($id = NULL) {
        // $default = $this->load->database('default', TRUE);
        if($id != null){
            $this->db->where('id_tipo_ativo',$id);
        }
        $query = $this->db->get('tbl_tipo_ativo');
        return $query;
    }
}

/* End of file Ativos_model.php */
/* Location: ./application/models/Ativos_model.php */