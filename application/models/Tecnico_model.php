<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnico_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $portal_db = $this->load->database('default',true);
    }

    public function index() {

    }

    public function listar_unidade_usuario() {
        $portal_db = $this->load->database('default',true);
        // $portal_db->select('us.id_usuario, us.nome_usuario');
        // $portal_db->select('DISTINCT us.id_usuario, us.nome_usuario');
        $portal_db->distinct();
        $portal_db->from('tbl_usuario us');
        $portal_db->join('tbl_unidade_usuario uu', 'uu.id_usuario=us.id_usuario');
        $portal_db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $portal_db->where('us.id_cargo', 6);
        $portal_db->group_by('us.id_usuario');
        $query = $portal_db->get();
        return $query;
    }

/*    public function listar_unidade_usuario(){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('DISTINCT(uu.id_usuario), us.nome_usuario');
        $portal_db->from('tbl_unidade_usuario uu');
        $portal_db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        $portal_db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $query = $portal_db->get();
        return $query;
    }*/

        public function listar_usuario() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_usuario');
        $portal_db->where('id_cargo', 6);
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

    public function edit_tecnico($id_tecnico,$id_unidade) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade_usuario uu');
        $portal_db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        $portal_db->join('tbl_unidade un', 'uu.id_unidade=un.id_unidade');
        $portal_db->where('uu.id_usuario',$id_tecnico);
        $portal_db->where('uu.id_unidade',$id_unidade);
        $query = $portal_db->get();
        return $query->row();
    }

    public function edit_unidade_tecnico($id_tecnico){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('id_unidade');
        $portal_db->from('tbl_unidade_usuario');
        $portal_db->where('id_usuario', $id_tecnico);
        $query = $portal_db->get();
        return $query->result_array();
    }

    public function exist_tecnico($id_tecnico, $id_unidade) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade_usuario uu');
        $portal_db->where('uu.id_usuario',$id_tecnico);
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

    public function update_tecnico($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_unidade_usuario', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_tecnico($id_tecnico,$id_unidade){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_usuario', $id_tecnico);
        $portal_db->where('id_unidade', $id_unidade);
        $portal_db->delete('tbl_unidade_usuario');
    }

    public function save_tecnico($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_unidade_usuario', $dados);
        return $portal_db->insert_id();
    }

}

/* End of file tecnico_model.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp26831/var/www/html/portal/frontend/models/tecnico_model.php */