<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_model extends CI_Model {

    public function historico_voucher() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('id_historico, usuario, motorista, prefixo, voucher, data, valor, observacao');
        $portal_db->from('vch_historico');
        $query = $portal_db->get();
        return $query;
    }

    public function save_voucher($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('vch_historico', $dados);
        return $portal_db->insert_id();
    }

    public function edit_voucher($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('vch_historico');
        $portal_db->where('id_historico',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function update_voucher($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('vch_historico', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_voucher($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_historico',$id);
        $portal_db->delete('vch_historico');
    }

}

/* End of file Voucher_model.php */
/* Location: ./application/models/Voucher_model.php */