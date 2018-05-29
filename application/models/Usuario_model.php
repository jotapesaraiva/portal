<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{

    public function listar_cargo(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_cargo');
    }

    public function update_cargo($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_cargo', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_cargo($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_cargo');
        $portal_db->where('id_cargo',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_cargo($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_cargo', $id);
        $portal_db->delete('tbl_cargo');
    }

    public function save_cargo($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_cargo', $dados);
        return $portal_db->insert_id();
    }

    //
    //=============================================================================================================================================================
    //

    public function listar_permissao(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_permissao');
    }

    public function update_permissao($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_permissao', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_permissao($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_permissao');
        $portal_db->where('id_permissao',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_permissao($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_permissao', $id);
        $portal_db->delete('tbl_permissao');
    }

    public function save_permissao($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_permissao', $dados);
        return $portal_db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //

    public function listar_usuarios(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->query('
            SELECT
               u.*,
               c.nome_cargo,
               p.nome_permissao
            FROM tbl_usuario AS u
            JOIN tbl_cargo AS c ON c.id_cargo = u.id_cargo
            JOIN tbl_permissao AS p ON p.id_permissao = u.id_permissao');
        //return $portal_db->get('tbl_usuario');
    }

    public function update_usuario($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_usuario', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function update_usuario_telefone($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_usuario_telefone', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_usuario($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_usuario');
        $portal_db->where('id_usuario',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function edit_usuario_telefone($id_usuario, $categoria) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_usuario_telefone ut', 't.id_telefone=ut.id_telefone');
        $portal_db->join('tbl_usuario u', 'ut.id_usuario=u.id_usuario');
        $portal_db->where('t.id_tipo_categoria_telefone ', $categoria);
        $portal_db->where('u.id_usuario', $id_usuario);
        $query = $portal_db->get();
        return $query-> result();
    }

    public function delete_usuario($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_usuario', $id);
        $portal_db->delete('tbl_usuario');
    }

    public function delete_usuario_telefone($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_usuario', $id);
        $portal_db->delete('tbl_usuario_telefone');
    }

    public function save_usuario($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_usuario', $dados);
        return $portal_db->insert_id();
    }

    public function salvar_usuario_telefone($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_usuario_telefone', $dados);
        return $portal_db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //

    public function listar_grupo() {
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_grupos');
    }

    public function edit_grupo($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_grupos');
        $portal_db->where('id_grupo',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function save_grupo($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_grupos', $dados);
        return $portal_db->insert_id();
    }

    public function update_grupo($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_grupos', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_grupo($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_grupo', $id);
        $portal_db->delete('tbl_grupos');
    }

    //
    //=============================================================================================================================================================
    //

    public function listar_modulo() {
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_modulos');
    }

    public function edit_modulo($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_modulos');
        $portal_db->where('id_modulo',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function save_modulo($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_modulos', $dados);
        return $portal_db->insert_id();
    }

    public function update_modulo($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_modulos', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_modulo($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_modulo', $id);
        $portal_db->delete('tbl_modulos');
    }

    //
    //=============================================================================================================================================================
    //
    public function listar_perfil() {
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_perfil');
    }

    public function edit_perfil($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_perfil');
        $portal_db->where('id_perfil',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function save_perfil($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_perfil', $dados);
        return $portal_db->insert_id();
    }

    public function update_perfil($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_perfil', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function delete_perfil($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_perfil', $id);
        $portal_db->delete('tbl_perfil');
    }

    public function membros_grupo($id) {
        $portal_db = $this->load->database('default',true);
        return $query = $portal_db->query('SELECT u.nome_usuario, u.id_usuario
                                    FROM tbl_usuario u
                                    WHERE u.id_grupo='.$id.' ');
    }

    public function modulos_grupo($id_group) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_perfil p');
        $portal_db->join('tbl_modulos m','p.id_modulo=m.id_modulo');
        $portal_db->where('p.id_grupo',$id_group);
        $query = $portal_db->get();
        return $query->result_array();
    }
    public function modulos_grupo_nome($nome_group) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_perfil p');
        $portal_db->join('tbl_modulos m','p.id_modulo=m.id_modulo');
        $portal_db->join('tbl_grupos g','p.id_grupo=g.id_grupo');
        $portal_db->where('g.nome_grupo',$nome_group);
        $query = $portal_db->get();
        return $query;
    }

    public function list_modulos() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_modulos');
        $query = $portal_db->get();
        return $query;
    }

}