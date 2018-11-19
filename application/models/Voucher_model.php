<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher_model extends CI_Model {

    public function historico_voucher($mes,$ano,$funcionario) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('v.id_historico, v.usuario_id, v.motorista_id, u.nome_usuario, m.nome as motorista, v.valor, date_format(v.data, "%d/%m/%Y") as data, v.voucher, v.observacao');
        $portal_db->from('vch_historico v');
        $portal_db->join('tbl_usuario u', 'v.usuario_id=u.id_usuario');
        $portal_db->join('vch_motoristas m', 'v.motorista_id=m.id_motorista');
        $portal_db->where('month(v.data)',$mes);
        $portal_db->where('year(v.data)',$ano);
        if($funcionario > 0){
            $portal_db->where('v.usuario_id',$funcionario);
        }
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
        $portal_db->update('voucher', $dados, $where);
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