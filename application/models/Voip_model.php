<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voip_model extends CI_Model{

    public function listar_ramal(){
        // $this->db = $this->load->database('default',true);
        return $this->db->query('
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
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_telefone_voip', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_ramal($id){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_telefone_voip tv');
        $this->db->join('tbl_telefone t','tv.id_telefone=t.id_telefone');
        $this->db->join('tbl_unidade_telefone ut','t.id_telefone=ut.id_telefone');
        $this->db->join('tbl_unidade u','ut.id_unidade=u.id_unidade');
        $this->db->join('tbl_tipo_contexto_voip cov','tv.id_tipo_contexto_voip=cov.id_tipo_contexto_voip');
        $this->db->join('tbl_tipo_categoria_voip cav','tv.id_tipo_categoria_voip=cav.id_tipo_categoria_voip');
        $this->db->join('tbl_tipo_equipamento_voip eqv','tv.id_tipo_equipamento_voip=eqv.id_tipo_equipamento_voip' );
        $this->db->where('tv.id_telefone_voip',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_ramal($id_telefone_voip) {
        //DELETE FROM `portal`.`tbl_telefone_voip` WHERE  `id_telefone_voip`=31;
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_telefone_voip', $id_telefone_voip);
        $this->db->delete('tbl_telefone_voip');
    }

    public function delete_unidade_telefone($id_telefone){
        //DELETE FROM `portal`.`tbl_unidade_telefone` WHERE  `id_unidade`=10 AND `id_telefone`=39;
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_telefone', $id_telefone);
        $this->db->delete('tbl_unidade_telefone');
    }

    public function save_ramal($dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_telefone_voip', $dados);
        return $this->db->insert_id();
    }
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================

    public function listar_categoria(){
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_tipo_categoria_voip');
    }

    public function update_categoria($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_tipo_categoria_voip', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_categoria($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_tipo_categoria_voip');
        $this->db->where('id_tipo_categoria_voip',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_categoria($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_tipo_categoria_voip', $id);
        $this->db->delete('tbl_tipo_categoria_voip');
    }

    public function save_categoria($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_tipo_categoria_voip', $dados);
        return $this->db->insert_id();
    }
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================

    public function listar_equipamento(){
        // $this->db = $this->load->database('default',true);
        return $this->db->get('tbl_tipo_equipamento_voip');
    }

    public function update_equipamento($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_tipo_equipamento_voip', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_equipamento($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_tipo_equipamento_voip');
        $this->db->where('id_tipo_equipamento_voip',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_equipamento($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_tipo_equipamento_voip', $id);
        $this->db->delete('tbl_tipo_equipamento_voip');
    }

    public function save_equipamento($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_tipo_equipamento_voip', $dados);
        return $this->db->insert_id();
    }
//=============================================================================================================
//=============================================================================================================
//=============================================================================================================
    public function listar_contexto(){
            // $this->db = $this->load->database('default',true);
            return $this->db->get('tbl_tipo_contexto_voip');

    }

    public function update_contexto($where,$dados){
        // $this->db = $this->load->database('default',true);
        $this->db->update('tbl_tipo_contexto_voip', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_contexto($id){
        // $this->db = $this->load->database('default',true);
        $this->db->from('tbl_tipo_contexto_voip');
        $this->db->where('id_tipo_contexto_voip',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_contexto($id){
        // $this->db = $this->load->database('default',true);
        $this->db->where('id_tipo_contexto_voip', $id);
        $this->db->delete('tbl_tipo_contexto_voip');
    }

    public function save_contexto($dados){
        // $this->db = $this->load->database('default',true);
        $this->db->insert('tbl_tipo_contexto_voip', $dados);
        return $this->db->insert_id();
    }

//=============================================================================================================
//=============================================================================================================
//=============================================================================================================

    public function select($value) {
        // $this->db = $this->load->database('default',true);
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
        return $this->db->query($sql);
    }

}