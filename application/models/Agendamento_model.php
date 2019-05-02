<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendamento_model extends CI_Model {

    public function listar_agendamento($id = NULL) {
        // $default = $this->load->database('default', TRUE);
        $this->db->select('a.*, g.nome_grupo');
        $this->db->from('tbl_agendamento a');
        $this->db->join('tbl_grupos g','g.id_grupo=a.id_grupo');
        if($id != null){
            $this->db->where('a.id',$id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function save_agendamento($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_agendamento', $dados);
        return $this->db->insert_id();
    }

    public function update_agendamento($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_agendamento', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_agendamento($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id', $id);
        $this->db->delete('tbl_agendamento');
    }

    public function select_alerta() {
        // $default = $this->load->database('default',true);
        $this->db->select('a.*, g.nome_grupo');
        $this->db->from('tbl_agendamento a');
        $this->db->join('tbl_grupos g ', 'g.id_grupo= a.id_grupo');
        $this->db->where('Month(a.data_inicio_agendamento) <= Month(now() + interval 1 month)');
        $query = $this->db->get();
        return $query;
    }
}

/* End of file Agendamento_model.php */
/* Location: ./application/models/Agendamento_model.php */