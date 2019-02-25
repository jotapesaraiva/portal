<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voip_model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $portal_db = $this->load->database('default',true);
    }

    public function listar_ramal(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->query('
            SELECT *
            From tbl_telefone_voip tv
            JOIN tbl_telefone t ON tv.id_telefone=t.id_telefone
            JOIN tbl_unidade_telefone ut ON t.id_telefone=ut.id_telefone
            JOIN tbl_unidade u ON ut.id_unidade=u.id_unidade
            JOIN tbl_tipo_contexto_voip cov ON tv.id_tipo_contexto_voip=cov.id_tipo_contexto_voip
            JOIN tbl_tipo_categoria_voip cav ON tv.id_tipo_categoria_voip=cav.id_tipo_categoria_voip
            JOIN tbl_tipo_equipamento_voip eqv ON tv.id_tipo_equipamento_voip=eqv.id_tipo_equipamento_voip
            ORDER BY u.nome_unidade');
    }

    public function update_ramal($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_telefone_voip', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_ramal($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('tbl_telefone_voip tv');
        $portal_db->join('tbl_telefone t','tv.id_telefone=t.id_telefone');
        $portal_db->join('tbl_unidade_telefone ut','t.id_telefone=ut.id_telefone');
        $portal_db->join('tbl_unidade u','ut.id_unidade=u.id_unidade');
        $portal_db->join('tbl_tipo_contexto_voip cov','tv.id_tipo_contexto_voip=cov.id_tipo_contexto_voip');
        $portal_db->join('tbl_tipo_categoria_voip cav','tv.id_tipo_categoria_voip=cav.id_tipo_categoria_voip');
        $portal_db->join('tbl_tipo_equipamento_voip eqv','tv.id_tipo_equipamento_voip=eqv.id_tipo_equipamento_voip' );
        $portal_db->where('tv.id_telefone_voip',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_ramal($id_telefone_voip) {
        //DELETE FROM `portal`.`tbl_telefone_voip` WHERE  `id_telefone_voip`=31;
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_telefone_voip', $id_telefone_voip);
        $portal_db->delete('tbl_telefone_voip');
    }

    public function delete_unidade_telefone($id_telefone){
        //DELETE FROM `portal`.`tbl_unidade_telefone` WHERE  `id_unidade`=10 AND `id_telefone`=39;
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_telefone', $id_telefone);
        $portal_db->delete('tbl_unidade_telefone');
    }

    public function save_ramal($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_telefone_voip', $dados);
        return $portal_db->insert_id();
    }
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================

    public function listar_categoria(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_tipo_categoria_voip');
    }

    public function update_categoria($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_tipo_categoria_voip', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_categoria($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_tipo_categoria_voip');
        $portal_db->where('id_tipo_categoria_voip',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_categoria($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_tipo_categoria_voip', $id);
        $portal_db->delete('tbl_tipo_categoria_voip');
    }

    public function save_categoria($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_tipo_categoria_voip', $dados);
        return $portal_db->insert_id();
    }
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================

    public function listar_equipamento(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_tipo_equipamento_voip');
    }

    public function update_equipamento($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_tipo_equipamento_voip', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_equipamento($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_tipo_equipamento_voip');
        $portal_db->where('id_tipo_equipamento_voip',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_equipamento($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_tipo_equipamento_voip', $id);
        $portal_db->delete('tbl_tipo_equipamento_voip');
    }

    public function save_equipamento($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_tipo_equipamento_voip', $dados);
        return $portal_db->insert_id();
    }
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================
    public function listar_contexto(){
            $portal_db = $this->load->database('default',true);
            return $portal_db->get('tbl_tipo_contexto_voip');

    }

    public function update_contexto($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_tipo_contexto_voip', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_contexto($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_tipo_contexto_voip');
        $portal_db->where('id_tipo_contexto_voip',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_contexto($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_tipo_contexto_voip', $id);
        $portal_db->delete('tbl_tipo_contexto_voip');
    }

    public function save_contexto($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_tipo_contexto_voip', $dados);
        return $portal_db->insert_id();
    }

//=============================================================================================================
//=============================================================================================================
//=============================================================================================================

    public function select($value) {
        $portal_db = $this->load->database('default',true);
        $sql = "SELECT t.numero_telefone, tv.setor_telefone_voip, u.nome_unidade
                FROM tbl_telefone t
                JOIN tbl_telefone_voip tv ON t.id_telefone=tv.id_telefone
                JOIN tbl_unidade_telefone ut ON t.id_telefone=ut.id_telefone
                JOIN tbl_unidade u ON u.id_unidade=ut.id_unidade
                                    ";
            if($value == 'dti'){
        $sql .= "WHERE tv.setor_telefone_voip LIKE '%CGRE%'
                    OR tv.setor_telefone_voip LIKE '%CGPS%'
                    OR tv.setor_telefone_voip LIKE '%CGDA%'
                    OR tv.setor_telefone_voip LIKE'%CGAQ%'";
            } else {
        $sql .= "WHERE tv.setor_telefone_voip NOT LIKE '%CGRE%'
                    AND tv.setor_telefone_voip NOT LIKE '%CGPS%'
                    AND tv.setor_telefone_voip NOT LIKE '%CGDA%'
                    AND tv.setor_telefone_voip NOT LIKE'%CGAQ%'";
            }
        return $portal_db->query($sql);
    }

}