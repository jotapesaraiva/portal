<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos_model extends CI_Model {

    public function listar_ativos($id = NULL) {
        $default = $this->load->database('default', TRUE);
        $default->select('a.*, ta.nome_tipo_ativo, g.nome_grupo, u.login_usuario, c.numero_contrato, f.nome_fornecedor');
        $default->from('tbl_ativos a');
        $default->join('tbl_tipo_ativo ta','a.id_tipo_ativo=ta.id_tipo_ativo');
        $default->join('tbl_grupos g','g.id_grupo=a.id_grupo');
        $default->join('tbl_usuario u','u.id_usuario=a.id_usuario');
        $default->join('tbl_contratos c','c.id_contrato=a.id_contrato');
        $default->join('tbl_fornecedor f','f.id_fornecedor=a.id_fornecedor');
        if($id != null){
            $default->where('a.id_ativo',$id);
        }
        $query = $default->get();
        return $query;
    }

    public function listar_tipo($id = NULL) {
        $default = $this->load->database('default', TRUE);
        if($id != null){
            $default->where('id_tipo_ativo',$id);
        }
        $query = $default->get('tbl_tipo_ativo');
        return $query;
    }

    public function save_ativo($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_ativos', $dados);
        return $portal_db->insert_id();
    }

    public function update_ativo($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_ativos', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_ativo($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_ativo', $id);
        $portal_db->delete('tbl_ativos');
    }

}

/* End of file Ativos_model.php */
/* Location: ./application/models/Ativos_model.php */