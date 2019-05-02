<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidor_model extends CI_Model {

    public function listar_unidade_usuario() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_usuario us');
        $this->db->join('tbl_unidade_usuario uu', 'uu.id_usuario=us.id_usuario');
        $this->db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $this->db->where('us.id_cargo', 16);
        $query = $this->db->get();
        return $query;
    }


        public function listar_usuario() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_usuario');
        $this->db->where('id_cargo', 16);
        $this->db->order_by('nome_usuario');
        $query = $this->db->get();
        return $query;
    }

    public function listar_unidade($id_usuario) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade u');
        $this->db->join('tbl_unidade_usuario uu','uu.id_unidade=u.id_unidade');
        $this->db->where('uu.id_usuario',$id_usuario);
        $query = $this->db->get();
        return $query;
    }

    public function edit_servidor($id_servidor,$id_unidade) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario uu');
        $this->db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        $this->db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $this->db->where('uu.id_usuario',$id_servidor);
        $this->db->where('uu.id_unidade',$id_unidade);
        $query = $this->db->get();
        return $query->row();
    }

    public function exist_servidor($id_servidor, $id_unidade) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario uu');
        $this->db->where('uu.id_usuario',$id_servidor);
        $this->db->where('uu.id_unidade',$id_unidade);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }

    public function edit_unidade($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade');
        $this->db->where('id_unidade',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_unidade($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_unidade', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_servidor($id_servidor,$id_unidade){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_usuario', $id_servidor);
        $this->db->where('id_unidade', $id_unidade);
        $this->db->delete('tbl_unidade_usuario');
    }

    public function save_servidor($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_unidade_usuario', $dados);
        return $this->db->insert_id();
    }

}

/* End of file Servidor_model.php */
/* Location: ./application/models/Servidor_model.php */