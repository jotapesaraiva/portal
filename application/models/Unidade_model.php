<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidade_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $portal_db = $this->load->database('default',true);
    }

    public function listar_unidade($id=null) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade u');
        $portal_db->join('tbl_cidade c','c.id_cidade=u.id_cidade');
        $portal_db->join('tbl_expediente e','e.id_expediente=u.id_expediente');
        if($id != null){
            $portal_db->where('u.id_unidade', $id);
        }
        $query = $portal_db->get();
        return $query;
    }
//1-celular;2-fixo;3-ramal;4-voip
    public function listar_unidade_telefone($id=null,$categoria) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_unidade_telefone ut','ut.id_telefone=t.id_telefone');
        if($id!=null){
        $portal_db->where('ut.id_unidade', $id);
        }
        $portal_db->where('t.id_tipo_categoria_telefone', $categoria);
        $query = $portal_db->get();
        return $query;
    }

    public function listar_unidade_usuario($id_unidade,$id_cargo){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_unidade_usuario uu');
        $portal_db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        // $portal_db->join('tbl_usuario_telefone ut', 'ut.id_usuario=uu.id_usuario');
        // $portal_db->join('tbl_telefone t', 't.id_telefone=ut.id_telefone');
        $portal_db->where('us.id_cargo', $id_cargo);
        $portal_db->where('uu.id_unidade', $id_unidade);
        $query = $portal_db->get();
        return $query;
    }

    public function listar_link($id=null) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_link l');
        if($id != null){
            $portal_db->where('l.id_unidade', $id);
        }
        $query = $portal_db->get();
        return $query;
    }
    public function editar_link($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_link l');
        $portal_db->where('l.id_unidade',$id);
        $query = $portal_db->get();
/*        if (!empty($query)) {
            return $query->row();
        } else {
            return false;
        }*/
        return $query;
    }

    public function edit_unidade_telefone($id_unidade,$categoria){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_unidade_telefone ut', 't.id_telefone=ut.id_telefone');
        $portal_db->join('tbl_unidade u', 'ut.id_unidade=u.id_unidade');
        $portal_db->where('t.id_tipo_categoria_telefone ', $categoria);
        $portal_db->where('u.id_unidade', $id_unidade);
        $query = $portal_db->get();
        return $query;
    }

    public function update_unidade($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_unidade', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_unidade($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_unidade', $id);
        $portal_db->delete('tbl_unidade');
    }

    public function delete_unidade_telefone($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_unidade', $id);
        $portal_db->delete('tbl_unidade_telefone');
    }

    public function save_unidade($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_unidade', $dados);
        return $portal_db->insert_id();
    }

    public function salvar_unidade_telefone($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_unidade_telefone', $dados);
        return $portal_db->insert_id();
    }

    public function update_unidade_telefone($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_unidade_telefone', $dados, $where);
        return $portal_db->affected_rows();
    }
    //
    //=============================================================================================================================================================
    //

    public function listar_expediente(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_expediente');

    }

    public function update_expediente($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_expediente', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_expediente($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_expediente');
        $portal_db->where('id_expediente',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_expediente($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_expediente', $id);
        $portal_db->delete('tbl_expediente');
    }

    public function save_expediente($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_expediente', $dados);
        return $portal_db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //
    public function listar_cidade(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_cidade');
    }

    public function update_cidade($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_cidade', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_cidade($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_cidade');
        $portal_db->where('id_cidade',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_cidade($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_cidade', $id);
        $portal_db->delete('tbl_cidade');
    }

    public function save_cidade($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_cidade', $dados);
        return $portal_db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //

    public function listar_links() {
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_link');
    }

    public function update_link($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_link', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_link($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_link');
        $portal_db->where('id_link',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_link($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_link', $id);
        $portal_db->delete('tbl_link');
    }

    public function save_link($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_link', $dados);
        return $portal_db->insert_id();
    }

    //
    //=============================================================================================================================================================
    //

 /*   public function listar_unidade_telefone(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_unidade_telefone');
    }*/


}