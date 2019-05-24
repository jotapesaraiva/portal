<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefas_model extends CI_Model {

    public function listar_tarefas($id = NULL) {
        // $default = $this->load->database('default', TRUE);
        $this->db->select('a.*, g.nome_grupo');
        $this->db->from('tbl_tarefas a');
        $this->db->join('tbl_grupos g','g.id_grupo=a.id_grupo');
        if($id != null){
            $this->db->where('a.id',$id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_tarefas($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_tarefas', $dados);
        return $this->db->insert_id();
    }

    public function update_tarefas($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_tarefas', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_tarefas($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id', $id);
        $this->db->delete('tbl_tarefas');
    }

    public function select_alerta() {
        // $default = $this->load->database('default',true);
        $this->db->select('a.*, g.nome_grupo');
        $this->db->from('tbl_tarefas a');
        $this->db->join('tbl_grupos g', 'g.id_grupo= a.id_grupo');
        // $this->db->where('Month(a.data_inicio_tarefas) <= Month(now() + interval 1 month)');
        $this->db->where('STR_TO_DATE(a.data_inicio_tarefas, "%Y-%m-%d %T" ) <= NOW()');
        $this->db->where('STR_TO_DATE(a.data_fim_tarefas, "%Y-%m-%d %T" ) >= NOW()');
        $query = $this->db->get();
        return $query;
    }
}

/* End of file Agendamento_model.php */
/* Location: ./application/models/Agendamento_model.php */