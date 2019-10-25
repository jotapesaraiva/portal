<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato_model extends CI_Model {

    // public function listar_contato(){
    //     // $this->db = $this->load->database('default',true);
    //     return $this->db->get('tbl_contato');
    // }
    public function listar_contato(){
        // $this->db = $this->load->database('default',true);
        // return $this->db->query('
        //     SELECT
        //         u.id_contato,
        //         u.nome_contato,
        //         u.email_contato,
        //         u.cargo_contato,
        //         u.comentario_contato,
        //         f.nome_fornecedor
        //     FROM tbl_contato AS u
        //     JOIN tbl_fornecedor AS f ON u.id_fornecedor=f.id_fornecedor
        //     ');
        $this->db->select('u.id_contato, u.nome_contato, u.email_contato, u.cargo_contato, u.comentario_contato, f.nome_fornecedor');
        $this->db->from('tbl_contato u');
        $this->db->join('tbl_fornecedor f', 'u.id_fornecedor=f.id_fornecedor');
        $query = $this->db->get();
        return $query;
    }

    public function listar_contato_telefone($id_contato){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_contato_telefone ct', 't.id_telefone=ct.id_telefone');
        $this->db->join('tbl_contato c', 'ct.id_contato=c.id_contato');
        $this->db->where('t.id_tipo_categoria_telefone ', 1);
        $this->db->where('c.id_contato', $id_contato);
        $query = $this->db->get();
        return $query;
    }

    public function listar_contato_celular($id_contato){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_contato_telefone ct', 't.id_telefone=ct.id_telefone');
        $this->db->join('tbl_contato c', 'ct.id_contato=c.id_contato');
        $this->db->where('t.id_tipo_categoria_telefone ', 2);
        $this->db->where('c.id_contato', $id_contato);
        $query = $this->db->get();
        return $query;
    }

    public function listar_telefone($id_contato){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_contato_telefone ct', 't.id_telefone=ct.id_telefone');
        $this->db->join('tbl_contato c', 'ct.id_contato=c.id_contato');
        $this->db->where('c.id_contato', $id_contato);
        $query = $this->db->get();
        return $query;
    }
    public function update_contato($where,$dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_contato', $dados, $where);
        return $this->db->affected_rows();
    }

    public function update_contato_telefone($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_contato_telefone', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_contato($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_contato');
        $this->db->where('id_contato',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function edit_contato_phone($id_contato,$phone){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_contato_telefone ct', 't.id_telefone=ct.id_telefone');
        $this->db->join('tbl_contato c', 'ct.id_contato=c.id_contato');
        $this->db->where('t.id_tipo_categoria_telefone ',$phone);
        $this->db->where('c.id_contato', $id_contato);
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_contato_telefone($id_contato){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_contato_telefone ct', 't.id_telefone=ct.id_telefone');
        $this->db->join('tbl_contato c', 'ct.id_contato=c.id_contato');
        $this->db->where('t.id_tipo_categoria_telefone ', 1);
        $this->db->where('c.id_contato', $id_contato);
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_contato_celular($id_contato){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_contato_telefone ct', 't.id_telefone=ct.id_telefone');
        $this->db->join('tbl_contato c', 'ct.id_contato=c.id_contato');
        $this->db->where('t.id_tipo_categoria_telefone ', 2);
        $this->db->where('c.id_contato', $id_contato);
        $query = $this->db->get();
        return $query-> result();
    }

    public function delete_contato($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_contato', $id);
        $this->db->delete('tbl_contato');
    }

    public function delete_contato_telefone($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_contato', $id);
        $this->db->delete('tbl_contato_telefone');
    }

    public function delete_contato_telefone_e($id_telefone,$id){
        $this->db->where('id_telefone', $id_telefone);
        $this->db->where('id_contato', $id);
        $this->db->delete('tbl_contato_telefone');
    }

    public function save_contato($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_contato', $dados);
        return $this->db->insert_id();
    }

    public function busca_telefone_contato($id_contato) {
        // $this->db = $this->load->database('default',true);
        return $this->db->query('
            SELECT *
            FROM tbl_telefone AS t
            JOIN tbl_contato_telefone AS ct ON ct.id_telefone = t.id_telefone
            WHERE ct.id_contato={$id_contato}
            AND ct.id_tipo_categoria_telefone <> 4
    ');
    }

    public function busca_celular_contato($id_contato){
        // $this->db = $this->load->database('default',true);
        return $this->db->query('
            SELECT *
            FROM tbl_telefone AS t
            JOIN tbl_contato_telefone AS ct ON ct.id_telefone = t.id_telefone
            WHERE ct.id_contato={$id_contato}
            AND ct.id_tipo_categoria_telefone <> 4
            ');
    }

    public function salvar_contato_telefone($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_contato_telefone', $dados);
        return $this->db->insert_id();
    }

    public function salvar_celular_contato(){

    }

}

/* End of file contato_model.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp15952/var/www/html/portal/frontend/models/contato_model.php */