<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Telefonia_model extends CI_Model{

    public function listar_categoria(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_tipo_categoria_telefone');

    }

    public function update_categoria($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_tipo_categoria_telefone', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_categoria($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_tipo_categoria_telefone');
        $portal_db->where('id_tipo_categoria_telefone',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_categoria($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_tipo_categoria_telefone', $id);
        $portal_db->delete('tbl_tipo_categoria_telefone');
    }

    public function save_categoria($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_tipo_categoria_telefone', $dados);
        return $portal_db->insert_id();
    }

    //=============================================================================

    public function listar_telefone() {
        $portal_db = $this->load->database('default',true);
        return $portal_db->query('
                            SELECT *
                            FROM tbl_telefone
                            WHERE id_tipo_categoria_telefone=1
            ');
    }

    public function listar_celular() {
        $portal_db = $this->load->database('default',true);
        return $portal_db->query('
                            SELECT *
                            FROM tbl_telefone
                            WHERE id_tipo_categoria_telefone=1');
    }

    public function save_telefone($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_telefone', $dados);
        return $portal_db->insert_id();
    }

    public function salvar_telefone($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_telefone', $dados);
        return $portal_db->insert_id();
    }

    public function update_telefone($where, $dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_telefone', $dados, $where);
        return $portal_db->affected_rows();
    }
    public function delete_telefone($id_telefone){
        // DELETE FROM `portal`.`tbl_telefone` WHERE `id_telefone`=39;
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_telefone', $id_telefone);
        $portal_db->delete('tbl_telefone');
    }

}