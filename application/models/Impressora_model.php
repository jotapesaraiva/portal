<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impressora_model extends CI_Model {

    public function select_printer()
    {
        $this->db->select('i.*, u.nome_unidade');
        $this->db->from('tbl_impressora i');
        $this->db->join('tbl_unidade u', 'u.id_unidade=i.id_unidade');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query;
    }

    public function select_id($ip)
    {
        $this->db->select('i.*, u.nome_unidade');
        $this->db->from('tbl_impressora i');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query;
    }

    public function list_printer($datai,$dataf)
    {
        $this->db->select('i.id_impressora, i.location as nome, u.nome_unidade, i.ip, ic.date, ic.location, ic.serial_number, ic.toner, ic.drum_level, ic.count_page');
        $this->db->from('tbl_impressora i');
        $this->db->join('tbl_impressora_contador ic', 'i.id_impressora=ic.id_impressora');
        $this->db->join('tbl_unidade u', 'u.id_unidade=i.id_unidade');
        $this->db->where('ic.date between "'.$datai.'" and "'.$dataf.'"');
        $query = $this->db->get();
        return $query;
        // SELECT *
        // FROM tbl_impressora i
        // JOIN tbl_impressora_contador ic On  i.id_impressora=ic.id_impressora
        // where date between '2019-09-14 12:00:00' and  '2019-09-14 12:30:00'
    }

    public function insert_printer($dados){
        // $this->db = ->load->database('default',true);
        $this->db->insert('tbl_impressora_contador', $dados);
        return $this->db->insert_id();
    }

    public function edit_printer($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_impressora');
        $this->db->where('id_impressora',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_printer($where,$dados) {
        // $this->load->database('default',true);
        $this->db->update('tbl_impressora', $dados, $where);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function delete_printer($id){
        // $this->load->database('default',true);
        $this->db->where('id_impressora', $id);
        $this->db->delete('tbl_impressora');
    }

}

/* End of file Impressora_model.php */
/* Location: ./application/models/Impressora_model.php */