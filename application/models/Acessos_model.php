<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessos_model extends CI_Model {


    public function servidor_acesso() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->where('tipo','1');
        $query = $portal_moni->get('tab_servidor_app');
        return $query;
    }

    public function servico_acesso() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->where('tipo','0');
        $query = $portal_moni->get('tab_servidor_app');
        return $query;
    }

    public function save_acesso($dados) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->insert('tab_servidor_app', $dados);
        return $portal_moni->insert_id();
    }

    public function edit_acesso($id) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->from('tab_servidor_app');
        $portal_moni->where('id',$id);
        $query = $portal_moni->get();
        return $query->row();
    }

    public function update_acesso($where,$dados) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->update('tab_servidor_app', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_acesso($id) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->where('id',$id);
        $portal_moni->delete('tab_servidor_app');
    }

}

/* End of file Acessos_model.php */
/* Location: ./application/models/Acessos_model.php */