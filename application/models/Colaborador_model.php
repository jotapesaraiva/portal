<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador_model extends CI_Model {

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

    public function edit_unidade_colaborador($id_colaborador){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario');
        $this->db->where('id_usuario', $id_colaborador);
        // $this->db->order_by('nome_usuario');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function exist_colaborador($id_servidor, $id_unidade) {
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

    public function delete_colaborador($id_colaborador,$id_unidade){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_usuario', $id_colaborador);
        $this->db->where('id_unidade', $id_unidade);
        $this->db->delete('tbl_unidade_usuario');
    }

    public function save_colaborador($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_unidade_usuario', $dados);
        return $this->db->insert_id();
    }

}

/* End of file Colaborador_model.php */
/* Location: ./application/models/Colaborador_model.php */