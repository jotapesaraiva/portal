<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $portal_db = $this->load->database('default',true);
    }

    public function index(){

    }

    public function listar_unidade_usuario() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_usuario us');
        $portal_db->join('tbl_unidade_usuario uu', 'uu.id_usuario=us.id_usuario');
        $portal_db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $portal_db->where('us.id_cargo', 16);
        $query = $portal_db->get();
        return $query;
    }


        public function listar_usuario() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_usuario');
        $portal_db->where('id_cargo', 16);
        $portal_db->order_by('nome_usuario');
        $query = $portal_db->get();
        return $query;
    }

    public function listar_unidade($id_usuario) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade u');
        $portal_db->join('tbl_unidade_usuario uu','uu.id_unidade=u.id_unidade');
        $portal_db->where('uu.id_usuario',$id_usuario);
        $query = $portal_db->get();
        return $query;
    }

    public function edit_servidor($id_servidor,$id_unidade) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade_usuario uu');
        $portal_db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        $portal_db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $portal_db->where('uu.id_usuario',$id_servidor);
        $portal_db->where('uu.id_unidade',$id_unidade);
        $query = $portal_db->get();
        return $query->row();
    }

    public function exist_servidor($id_servidor, $id_unidade) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade_usuario uu');
        $portal_db->where('uu.id_usuario',$id_servidor);
        $portal_db->where('uu.id_unidade',$id_unidade);
        $portal_db->limit(1);
        $query = $portal_db->get();
        return $query;
    }

    public function edit_unidade($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade');
        $portal_db->where('id_unidade',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function update_unidade($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_unidade', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_servidor($id_servidor,$id_unidade){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_usuario', $id_servidor);
        $portal_db->where('id_unidade', $id_unidade);
        $portal_db->delete('tbl_unidade_usuario');
    }

    public function save_servidor($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_unidade_usuario', $dados);
        return $portal_db->insert_id();
    }

}

/* End of file Servidor_model.php */
/* Location: ./application/models/Servidor_model.php */