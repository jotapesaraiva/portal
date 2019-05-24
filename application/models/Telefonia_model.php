<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telefonia_model extends CI_Model{

    public function listar_categoria(){
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_tipo_categoria_telefone');

    }

    public function update_categoria($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_tipo_categoria_telefone', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_categoria($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_tipo_categoria_telefone');
        $this->db->where('id_tipo_categoria_telefone',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_categoria($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_tipo_categoria_telefone', $id);
        $this->db->delete('tbl_tipo_categoria_telefone');
    }

    public function save_categoria($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_tipo_categoria_telefone', $dados);
        return $this->db->insert_id();
    }

    //=============================================================================

    public function listar_telefone($num_telefone=null) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone');
        if($num_telefone != null){
            $this->db->where('numero_telefone',$num_telefone);
        } else {
            $this->db->where('id_tipo_categoria_telefone',1);
        }
        $query = $this->db->get();
        return $query;
    }

    public function id_telefone($num_telefone) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('id_telefone');
        $this->db->from('tbl_telefone');
        $this->db->where('numero_telefone',$num_telefone);
        $query = $this->db->get();
        return $query->row();
    }

    public function listar_celular() {
        // $this->db = $this->load->database('default',true);
        return $this->db->query('
                            SELECT *
                            FROM tbl_telefone
                            WHERE id_tipo_categoria_telefone=1');
    }

    public function tipo_telefone($telefone){
        $this->db->select('tct.nome_tipo_categoria_telefone');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_tipo_categoria_telefone tct', 'tct.id_tipo_categoria_telefone=t.id_tipo_categoria_telefone');
        $this->db->where('t.numero_telefone',$telefone);
        $query = $this->db->get();
        return $query->row();
    }


    public function save_telefone($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_telefone', $dados);
        return $this->db->insert_id();
    }

    public function salvar_telefone($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_telefone', $dados);
        return $this->db->insert_id();
    }

    public function update_telefone($where, $dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_telefone', $dados, $where);
        return $this->db->affected_rows();
    }
    public function delete_telefone($id_telefone) {
        // DELETE FROM `portal`.`tbl_telefone` WHERE `id_telefone`=39;
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_telefone', $id_telefone);
        $this->db->delete('tbl_telefone');
    }
    // public function delete_usuario_telefone($id_telefone, $id_usuario) {
    //     $this->db->where('id_telefone', $id_telefone);
    // }

}