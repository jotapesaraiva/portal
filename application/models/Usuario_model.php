<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{

    public function listar_cargo(){
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_cargo');
    }

    public function update_cargo($where,$dados){
        // $portal_db = $this->load->database('default',true);
        $this->db->update('tbl_cargo', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_cargo($id){
        // $portal_db = $this->load->database('default',true);
        $this->db->from('tbl_cargo');
        $this->db->where('id_cargo',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_cargo($id){
        // $portal_db = $this->load->database('default',true);
        $this->db->where('id_cargo', $id);
        $this->db->delete('tbl_cargo');
    }

    public function save_cargo($dados){
        // $portal_db = $this->load->database('default',true);
        $this->db->insert('tbl_cargo', $dados);
        return $this->db->insert_id();
    }

    //
    //=============================================================================================================================================================
    //

    public function listar_permissao(){
        // $portal_db = $this->load->database('default',true);
        return $this->db->get('tbl_permissao');
    }

    public function update_permissao($where,$dados){
        // $portal_db = $this->load->database('default',true);
        $this->db->update('tbl_permissao', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_permissao($id){
        // $portal_db = $this->load->database('default',true);
        $this->db->from('tbl_permissao');
        $this->db->where('id_permissao',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_permissao($id){
        // $portal_db = $this->load->database('default',true);
        $this->db->where('id_permissao', $id);
        $this->db->delete('tbl_permissao');
    }

    public function save_permissao($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_permissao', $dados);
        return $this->db->insert_id();
    }
    //
    //=============================================================================================================================================================
    //
    // public function get_byid($id=NULL) {
    //     if($id != NULL):
            // $this->db = $this->load->database('default',true);
    //         $this->db->where('id_usuario',$id);
    //         $this->db->limit(1);
    //         $query = $this->db->get('tbl_usuario');
    //         return $query;
    //     else:
    //         return FALSE;
    //     endif;
    // }

    public function permissao($user_login) {
            if($user_login != NULL):
                $this->db->where('login_usuario',$user_login);
                $this->db->limit(1);
                $query = $this->db->get('tbl_usuario');
                return $query;
            else:
                return FALSE;
            endif;
    }

    public function listar_usuarios($id=NULL){
        // $this->db = $this->load->database('default',true);
        $sql = 'SELECT
               u.*,
               c.nome_cargo,
               p.nome_permissao,
               g.nome_grupo
            FROM tbl_usuario AS u
            JOIN tbl_cargo AS c ON c.id_cargo = u.id_cargo
            JOIN tbl_grupos AS g ON g.id_grupo = u.id_grupo
            JOIN tbl_permissao AS p ON p.id_permissao = u.id_permissao';
        if($id !=null){
            $sql .= ' WHERE u.id_usuario='.$id.'';
        }
        return $this->db->query($sql);
        //return $this->db->get('tbl_usuario');
    }

    public function listar_usuario_telefone($id_usuario) {
            // $this->db = $this->load->database('default',true);
            $this->db->select('*');
            $this->db->from('tbl_usuario_telefone ut');
            $this->db->join('tbl_telefone t','t.id_telefone=ut.id_telefone');
            $this->db->where('ut.id_usuario',$id_usuario);
            $query = $this->db->get();
            return $query;
    }

    public function update_usuario($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_usuario', $dados, $where);
        return $this->db->affected_rows();
    }

    public function update_usuario_telefone($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_usuario_telefone', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_usuario($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_usuario');
        $this->db->where('id_usuario',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function edit_usuario_telefone($id_usuario, $categoria) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('t.id_telefone,t.numero_telefone');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_usuario_telefone ut', 't.id_telefone=ut.id_telefone');
        $this->db->join('tbl_usuario u', 'ut.id_usuario=u.id_usuario');
        $this->db->where('t.id_tipo_categoria_telefone ', $categoria);
        $this->db->where('u.id_usuario', $id_usuario);
        $query = $this->db->get();
        return $query-> result();
    }

    public function list_usuario_telefone($id_usuario,$categoria) {
        // $default = $this->load->database('default',true);
        $this->db->select('GROUP_CONCAT(t.numero_telefone ORDER BY t.numero_telefone SEPARATOR ", " ) AS telefone');
        $this->db->from('tbl_usuario u');
        $this->db->join('tbl_usuario_telefone ut','ut.id_usuario=u.id_usuario');
        $this->db->join('tbl_telefone t','t.id_telefone=ut.id_telefone');
        $this->db->where('u.id_usuario',$id_usuario);
        $this->db->where('t.id_tipo_categoria_telefone',$categoria);
        $query = $this->db->get();
        return $query-> result_array();
    }

    public function delete_usuario($id){
        // $portal_db = $this->load->database('default',true);
        $this->db->where('id_usuario', $id);
        $this->db->delete('tbl_usuario');
    }

    public function delete_usuario_telefone($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_usuario', $id);
        $this->db->delete('tbl_usuario_telefone');
    }

    public function save_usuario($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_usuario', $dados);
        return $this->db->insert_id();
    }

    public function salvar_usuario_telefone($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_usuario_telefone', $dados);
        return $this->db->insert_id();
    }

    public function listar_modulos($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('m.nome_modulo');
        $this->db->from('tbl_usuario u');
        $this->db->join('tbl_perfil p', 'p.id_grupo=u.id_grupo');
        $this->db->join('tbl_modulos m','m.id_modulo=p.id_modulo');
        $this->db->where('u.id_usuario',$id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function id_user($username){
        // $this->db = $this->load->database('default',true);
        $this->db->select('id_usuario');
        $this->db->from('tbl_usuario');
        $this->db->where('login_usuario',$username);
        $query = $this->db->get();
        return $query->row();
    }


    public function user_telefone($id_usuario, $categoria) {
        $default = $this->load->database('default',true);
        $default->select('GROUP_CONCAT(t.numero_telefone ORDER BY t.numero_telefone SEPARATOR ", " ) AS numero');
        $default->from('tbl_usuario u');
        $default->join('tbl_usuario_telefone ut','ut.id_usuario=u.id_usuario');
        $default->join('tbl_telefone t','t.id_telefone=ut.id_telefone');
        $default->where('u.id_usuario',$id_usuario);
        $default->where('t.id_tipo_categoria_telefone',$categoria);
        $query = $default->get();
        return $query-> row();
    }


    //
    //=============================================================================================================================================================
    //

    public function listar_grupo() {
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_grupos');
    }

    public function edit_grupo($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_grupos');
        $this->db->where('id_grupo',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save_grupo($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_grupos', $dados);
        return $this->db->insert_id();
    }

    public function update_grupo($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_grupos', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_grupo($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_grupo', $id);
        $this->db->delete('tbl_grupos');
    }

    //
    //=============================================================================================================================================================
    //

    public function listar_modulo() {
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_modulos');
    }

    public function edit_modulo($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_modulos');
        $this->db->where('id_modulo',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save_modulo($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_modulos', $dados);
        return $this->db->insert_id();
    }

    public function update_modulo($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_modulos', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_modulo($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_modulo', $id);
        $this->db->delete('tbl_modulos');
    }

    //
    //=============================================================================================================================================================
    //
    public function listar_perfil() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('p.id_perfil,p.id_modulo,p.id_grupo,g.nome_grupo');
        $this->db->from('tbl_perfil p');
        $this->db->join('tbl_grupos g','g.id_grupo=p.id_grupo');
        return $this->db->get();
    }

    public function edit_perfil($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_perfil');
        $this->db->where('id_grupo',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function save_perfil($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_perfil', $dados);
        return $this->db->insert_id();
    }

    public function update_perfil($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_grupos', $dados, $where);
        return $this->db->affected_rows();
    }

    public function delete_perfil($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_grupos', $id);
        $this->db->delete('tbl_grupo');
    }

    public function membros_grupo($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('u.nome_usuario, u.id_usuario');
        $this->db->from('tbl_usuario u');
        $this->db->where('u.id_grupo',$id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function usuario_grupo($username) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('g.nome_grupo');
        $this->db->from('tbl_usuario u');
        $this->db->join('tbl_grupos g','u.id_grupo=g.id_grupo');
        $this->db->where('u.login_usuario',$username);
        $query = $this->db->get();
        return $query->row();
    }

    public function modulos_grupo($id_group) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('m.id_modulo');
        $this->db->from('tbl_perfil p');
        $this->db->join('tbl_modulos m','p.id_modulo=m.id_modulo');
        $this->db->where('p.id_grupo',$id_group);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function modulos_grupo_nome($nome_group) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_perfil p');
        $this->db->join('tbl_modulos m','p.id_modulo=m.id_modulo');
        $this->db->join('tbl_grupos g','p.id_grupo=g.id_grupo');
        $this->db->where('g.nome_grupo',$nome_group);
        $query = $this->db->get();
        return $query;
    }

    public function list_modulos() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_modulos');
        $query = $this->db->get();
        return $query;
    }

    public function delete_modulos($id_grupo) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_grupo', $id_grupo);
        $this->db->delete('tbl_perfil');
    }

    public function resp_tecnico() {
        // $default = $this->load->database('default',true);
        $this->db->where_not_in('id_grupo',array('11','10'));
        $query = $this->db->get('tbl_usuario');
        return $query;
    }

}