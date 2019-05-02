<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_model extends CI_Model {

    public function historico_voucher() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('id_historico, usuario, motorista, prefixo, voucher, data, valor, observacao');
        $this->db->from('vch_historico');
        $query = $this->db->get();
        return $query;
    }

    public function save_voucher($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('vch_historico', $dados);
        return $this->db->insert_id();
    }

    public function edit_voucher($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('vch_historico');
        $this->db->where('id_historico',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_voucher($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('vch_historico', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_voucher($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_historico',$id);
        $this->db->delete('vch_historico');
    }

}

/* End of file Voucher_model.php */
/* Location: ./application/models/Voucher_model.php */