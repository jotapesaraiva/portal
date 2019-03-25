<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendamento_model extends CI_Model {

    public function listar_agendamento($id = NULL) {
        $default = $this->load->database('default', TRUE);
        $default->select('a.*, g.nome_grupo');
        $default->from('tbl_agendamento a');
        $default->join('tbl_grupos g','g.id_grupo=a.id_grupo');
        if($id != null){
            $default->where('a.id',$id);
        }
        $query = $default->get();
        return $query;
    }

    public function save_agendamento($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_agendamento', $dados);
        return $portal_db->insert_id();
    }

    public function update_agendamento($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_agendamento', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_agendamento($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id', $id);
        $portal_db->delete('tbl_agendamento');
    }

    public function select_alerta() {
        $default = $this->load->database('default',true);
        $default->select('a.*, g.nome_grupo');
        $default->from('tbl_agendamento a');
        $default->join('tbl_grupos g ', 'g.id_grupo= a.id_grupo');
        $default->where('Month(a.data_inicio_agendamento) <= Month(now() + interval 1 month)');
        $query = $default->get();
        return $query;
    }
}

/* End of file Agendamento_model.php */
/* Location: ./application/models/Agendamento_model.php */