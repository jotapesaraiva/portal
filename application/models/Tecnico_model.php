<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnico_model extends CI_Model{

    public function listar_unidade_usuario() {
        // $this->db = $this->load->database('default',true);
        // $this->db->select('us.id_usuario, us.nome_usuario');
        // $this->db->select('DISTINCT us.id_usuario, us.nome_usuario');
        $this->db->distinct();
        $this->db->from('tbl_usuario us');
        $this->db->join('tbl_unidade_usuario uu', 'uu.id_usuario=us.id_usuario');
        $this->db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $this->db->where('us.id_cargo', 6);
        $this->db->group_by('us.id_usuario');
        $query = $this->db->get();
        return $query;
    }

    // public function listar_unidade_usuario(){
    //     $this->db = $this->load->database('default',true);
    //     $this->db->select('DISTINCT(uu.id_usuario), us.nome_usuario');
    //     $this->db->from('tbl_unidade_usuario uu');
    //     $this->db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
    //     $this->db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
    //     $query = $this->db->get();
    //     return $query;
    // }

        public function listar_usuario() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_usuario');
        $this->db->where('id_cargo', 6);
        $this->db->order_by('nome_usuario');
        $query = $this->db->get();
        return $query;
    }

    public function listar_unidade($id_usuario=null) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade u');
        $this->db->join('tbl_unidade_usuario uu','uu.id_unidade=u.id_unidade');
        if($id_usuario != null) {
            $this->db->where('uu.id_usuario',$id_usuario);
        }
        $query = $this->db->get();
        return $query;
    }

    public function edit_tecnico($id_tecnico,$id_unidade) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario uu');
        $this->db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        $this->db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $this->db->where('uu.id_usuario',$id_tecnico);
        $this->db->where('uu.id_unidade',$id_unidade);
        $query = $this->db->get();
        return $query->row();
    }

    public function edit_unidade_tecnico($id_tecnico){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario');
        $this->db->where('id_usuario', $id_tecnico);
        // $this->db->order_by('nome_usuario');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function exist_tecnico($id_tecnico, $id_unidade) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario uu');
        $this->db->where('uu.id_usuario',$id_tecnico);
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

    public function update_tecnico($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_unidade_usuario', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_tecnico($id_tecnico,$id_unidade) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_usuario', $id_tecnico);
        $this->db->where('id_unidade', $id_unidade);
        $this->db->delete('tbl_unidade_usuario');
    }

    public function delete_all($id_tecnico) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_usuario', $id_tecnico);
        $this->db->delete('tbl_unidade_usuario');
    }

    public function save_tecnico($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_unidade_usuario', $dados);
        return $this->db->insert_id();
    }

}

/* End of file tecnico_model.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp26831/var/www/html/portal/frontend/models/tecnico_model.php */