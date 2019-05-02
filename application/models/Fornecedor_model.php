<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedor_model extends CI_Model {

    public function listar_fornecedor(){
        // $this->db = $this->load->database('default',true);

        return $this->db->query('
            SELECT  f.id_fornecedor            AS id_fornecedor,
                    f.nome_fornecedor          AS nome_fornecedor,
                    f.website_fornecedor       AS website_fornecedor,
                    f.email_fornecedor         AS email_fornecedor,
                    f.endereco_fornecedor      AS endereco_fornecedor,
                    f.comentario_fornecedor    AS comentario_fornecedor,
                    f.status_fornecedor        AS status_fornecedor,
                    s.nome_servico             AS nome_servico
              FROM tbl_fornecedor AS f
              JOIN tbl_servico    AS s
                ON s.id_servico = f.id_servico');
    }

    public function listar_contatos($id) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_contato');
        $this->db->where('id_fornecedor',$id);
        $query = $this->db->get();
        return $query;
    }

    // public function listar_contatos($id) {
        // $this->db = $this->load->database('default',true);
    //     $this->db->select('c.*, t.*');
    //     $this->db->from('tbl_contato c');
    //     $this->db->join('tbl_contato_telefone ct', 'ct.id_contato=c.id_contato');
    //     $this->db->join('tbl_telefone t', 't.id_telefone=ct.id_telefone');
    //     $this->db->where('c.id_fornecedor',$id);
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function listar_fornecedor_telefone($id_fornecedor){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $this->db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $this->db->where('t.id_tipo_categoria_telefone ', 1);
        $this->db->where('f.id_fornecedor', $id_fornecedor);
        $query = $this->db->get();
        return $query;
    }

    public function listar_fornecedor_celular($id_fornecedor){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $this->db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $this->db->where('t.id_tipo_categoria_telefone ', 2);
        $this->db->where('f.id_fornecedor', $id_fornecedor);
        $query = $this->db->get();
        return $query;
    }

    public function update_fornecedor($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_fornecedor', $dados, $where);
        return $this->db->affected_rows();
    }

    public function update_fornecedor_telefone($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_fornecedor_telefone', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_fornecedor($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_fornecedor');
        $this->db->where('id_fornecedor',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function edit_fornecedor_telefone($id_fornecedor){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $this->db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $this->db->where('t.id_tipo_categoria_telefone ', 1);
        $this->db->where('f.id_fornecedor', $id_fornecedor);
        $query = $this->db->get();
        return $query->result();
    }

    public function edit_fornecedor_celular($id_fornecedor){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone t');
        $this->db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $this->db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $this->db->where('t.id_tipo_categoria_telefone ', 2);
        $this->db->where('f.id_fornecedor', $id_fornecedor);
        $query = $this->db->get();
        return $query-> result();
    }

    public function delete_fornecedor($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_fornecedor', $id);
        $this->db->delete('tbl_fornecedor');
    }

    public function delete_fornecedor_telefone($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_fornecedor', $id);
        $this->db->delete('tbl_fornecedor_telefone');
    }

    public function save_fornecedor($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_fornecedor', $dados);
        return $this->db->insert_id();
    }

    public function salvar_fornecedor_telefone($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_fornecedor_telefone', $dados);
        return $this->db->insert_id();
    }

}

/* End of file Fornecedor_model.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp16499/var/www/html/portal/frontend/models/Fornecedor_model.php */