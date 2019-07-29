<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unidade_model extends CI_Model{

    public function listar_unidade($id=null) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade u');
        $this->db->join('tbl_cidade c','c.id_cidade=u.id_cidade');
        $this->db->join('tbl_expediente e','e.id_expediente=u.id_expediente');
        $this->db->order_by('u.nome_unidade');
        if($id != null){
            $this->db->where('u.id_unidade', $id);
        }
        $query = $this->db->get();
        return $query;
    }
//1-celular;2-fixo;3-ramal;4-voip
    public function listar_unidade_telefone($id=null,$categoria) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_unidade_telefone ut','ut.id_telefone=t.id_telefone');
        if($id!=null){
        $this->db->where('ut.id_unidade', $id);
        }
        $this->db->where('t.id_tipo_categoria_telefone', $categoria);
        $query = $this->db->get();
        return $query;
    }

    public function listar_unidade_usuario($id_unidade,$id_cargo){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_unidade_usuario uu');
        $this->db->join('tbl_usuario us', 'uu.id_usuario=us.id_usuario');
        // $this->db->join('tbl_usuario_telefone ut', 'ut.id_usuario=uu.id_usuario');
        // $this->db->join('tbl_telefone t', 't.id_telefone=ut.id_telefone');
        $this->db->where('us.id_cargo', $id_cargo);
        $this->db->where('uu.id_unidade', $id_unidade);
        $query = $this->db->get();
        return $query;
    }

    public function listar_link($id=null) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_link l');
        if($id != null){
            $this->db->where('l.id_unidade', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function editar_link($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_link l');
        $this->db->where('l.id_unidade',$id);
        $query = $this->db->get();
/*        if (!empty($query)) {
            return $query->row();
        } else {
            return false;
        }*/
        return $query;
    }

    public function edit_unidade_telefone($id_unidade,$categoria){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_unidade_telefone ut', 't.id_telefone=ut.id_telefone');
        $this->db->join('tbl_unidade u', 'ut.id_unidade=u.id_unidade');
        $this->db->where('t.id_tipo_categoria_telefone ', $categoria);
        $this->db->where('u.id_unidade', $id_unidade);
        $query = $this->db->get();
        return $query;
    }

    public function update_unidade($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_unidade', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_unidade($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_unidade', $id);
        $this->db->delete('tbl_unidade');
    }

    public function delete_unidade_telefone($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_telefone', $id);
        $this->db->delete('tbl_unidade_telefone');
    }

    public function save_unidade($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_unidade', $dados);
        return $this->db->insert_id();
    }

    public function salvar_unidade_telefone($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_unidade_telefone', $dados);
        return $this->db->insert_id();
    }

    public function update_unidade_telefone($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_unidade_telefone', $dados, $where);
        return $this->db->affected_rows();
    }
    //
    //=============================================================================================================================================================
    //

    public function listar_expediente(){
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_expediente');

    }

    public function update_expediente($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_expediente', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_expediente($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_expediente');
        $this->db->where('id_expediente',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_expediente($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_expediente', $id);
        $this->db->delete('tbl_expediente');
    }

    public function save_expediente($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_expediente', $dados);
        return $this->db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //
    public function listar_cidade(){
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_cidade');
    }

    public function update_cidade($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_cidade', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_cidade($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_cidade');
        $this->db->where('id_cidade',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_cidade($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_cidade', $id);
        $this->db->delete('tbl_cidade');
    }

    public function save_cidade($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_cidade', $dados);
        return $this->db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //

    public function listar_links() {
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_link');
    }

    public function update_link($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_link', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_link($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_link');
        $this->db->where('id_link',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_link($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_link', $id);
        $this->db->delete('tbl_link');
    }

    public function save_link($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_link', $dados);
        return $this->db->insert_id();
    }

    //
    //=============================================================================================================================================================
    //


}