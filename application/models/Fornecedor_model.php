<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedor_model extends CI_Model {

    public function __construct() {
        //parent::__construct();
        //$portal_db = $this->load->model('defautl',true);
    }

    public function listar_fornecedor(){
        $portal_db = $this->load->database('default',true);

        return $portal_db->query('
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
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_contato');
        $portal_db->where('id_fornecedor',$id);
        $query = $portal_db->get();
        return $query;
    }

    // public function listar_contatos($id) {
    //     $portal_db = $this->load->database('default',true);
    //     $portal_db->select('c.*, t.*');
    //     $portal_db->from('tbl_contato c');
    //     $portal_db->join('tbl_contato_telefone ct', 'ct.id_contato=c.id_contato');
    //     $portal_db->join('tbl_telefone t', 't.id_telefone=ct.id_telefone');
    //     $portal_db->where('c.id_fornecedor',$id);
    //     $query = $portal_db->get();
    //     return $query;
    // }

    public function listar_fornecedor_telefone($id_fornecedor){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $portal_db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $portal_db->where('t.id_tipo_categoria_telefone ', 1);
        $portal_db->where('f.id_fornecedor', $id_fornecedor);
        $query = $portal_db->get();
        return $query;
    }

    public function listar_fornecedor_celular($id_fornecedor){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $portal_db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $portal_db->where('t.id_tipo_categoria_telefone ', 2);
        $portal_db->where('f.id_fornecedor', $id_fornecedor);
        $query = $portal_db->get();
        return $query;
    }

    public function update_fornecedor($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_fornecedor', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function update_fornecedor_telefone($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_fornecedor_telefone', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_fornecedor($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_fornecedor');
        $portal_db->where('id_fornecedor',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function edit_fornecedor_telefone($id_fornecedor){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $portal_db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $portal_db->where('t.id_tipo_categoria_telefone ', 1);
        $portal_db->where('f.id_fornecedor', $id_fornecedor);
        $query = $portal_db->get();
        return $query->result();
    }

    public function edit_fornecedor_celular($id_fornecedor){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone t');
        $portal_db->join('tbl_fornecedor_telefone ft', 't.id_telefone=ft.id_telefone');
        $portal_db->join('tbl_fornecedor f', 'ft.id_fornecedor=f.id_fornecedor');
        $portal_db->where('t.id_tipo_categoria_telefone ', 2);
        $portal_db->where('f.id_fornecedor', $id_fornecedor);
        $query = $portal_db->get();
        return $query-> result();
    }

    public function delete_fornecedor($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_fornecedor', $id);
        $portal_db->delete('tbl_fornecedor');
    }

    public function delete_fornecedor_telefone($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_fornecedor', $id);
        $portal_db->delete('tbl_fornecedor_telefone');
    }

    public function save_fornecedor($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_fornecedor', $dados);
        return $portal_db->insert_id();
    }

    public function salvar_fornecedor_telefone($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_fornecedor_telefone', $dados);
        return $portal_db->insert_id();
    }

}

/* End of file Fornecedor_model.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp16499/var/www/html/portal/frontend/models/Fornecedor_model.php */