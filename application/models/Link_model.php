<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_model extends CI_Model{


    public function calculo_atendimento($data_inicio,$data_final) {
        $mantis = $this->load->database('mantis',true);
        $sql = "
            SELECT
                mbt.id as mantis,
                substr(regexp_substr(mbt.summary,'-[^'']*'),3) as resumo,
                --mbt.summary as resumo,
                mcf3.value as ticket,
               to_char(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf1.value / 60 / 60 / 24) - 0.125, 'dd/mm/yyyy hh24:mi:ss') as inicio_chamado,
               to_char(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf2.value / 60 / 60 / 24) - 0.125,'dd/mm/yyyy hh24:mi:ss') as fim_chamado,
                (trunc(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf2.value / 60 / 60 / 24) - 0.125) - trunc(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf1.value / 60 / 60 / 24) - 0.125))
                || ' dias '  ||
                TO_CHAR(to_date('00-00-00', 'hh24:mi:ss')+ to_number((to_date('01-JAN-1970', 'dd-mon-yyyy') +
                           (mcf2.value / 60 / 60 / 24) - 0.125) - (to_date('01-JAN-1970', 'dd-mon-yyyy') +
                           (mcf1.value / 60 / 60 / 24) - 0.125)), 'hh24:mi:ss') as calculo_horas,
                mcf4.value as responsabilidade
            from mantis.mantis_bug_tb mbt
            left join mantis.mantis_custom_field_string_tb mcf1 on mbt.id=mcf1.bug_id
            left join mantis.mantis_custom_field_string_tb mcf2 on mbt.id=mcf2.bug_id
            left join mantis.mantis_custom_field_string_tb mcf3 on mbt.id=mcf3.bug_id
            left join mantis.mantis_custom_field_string_tb mcf4 on mbt.id=mcf4.bug_id
            where mbt.project_id = 521 and mcf1.field_id = 381 and mcf2.field_id = 401 and mcf3.field_id = 361 and (mcf4.field_id = 1541 and mcf4.value in ('Embratel','PRODEPA'))
            and mbt.status in (60,80)
            and trunc(mbt.date_submitted) between '".$data_inicio."' and '".$data_final."'
            order by mcf1.value asc";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        // $nrows = oci_fetch_all($stmt, $res);//retorna o numero de ocorrencias
        // echo "$nrows rows fetched<br>\n";
        // var_dump($res);
        // oci_fetch_all($stmt, $res);//cria array apartir das colunas
        oci_fetch_all($stmt, $res,null, null, OCI_FETCHSTATEMENT_BY_ROW);//cria array apartir das linhas
        return $res;
    }


    public function listar_link() {
        $portal_db = $this->load->database('default',true);
        //return $portal_db->get('tbl_link');
        $portal_db->select('*');
        $portal_db->from('tbl_link l');
        $portal_db->join('tbl_unidade u', 'u.id_unidade=l.id_unidade');
        $portal_db->join('tbl_tipo_velocidade tv','tv.id_tipo_velocidade=l.id_tipo_velocidade');
        $portal_db->join('tbl_tipo_acesso ta','ta.id_tipo_acesso=l.id_tipo_acesso');
        $portal_db->join('tbl_fornecedor f','f.id_fornecedor=l.id_fornecedor');
        $query = $portal_db->get();
        return $query;
    }

    public function update_link($where,$dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_link', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_link($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_link');
        $portal_db->where('id_link',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_link($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_link', $id);
        $portal_db->delete('tbl_link');
    }

    public function save_link($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_link', $dados);
        return $portal_db->insert_id();
    }

    //
    //=============================================================================================================================================================
    //

    public function listar_acesso(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_tipo_acesso');

    }

    public function update_acesso($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_tipo_acesso', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_acesso($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_tipo_acesso');
        $portal_db->where('id_tipo_acesso',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_acesso($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_tipo_acesso', $id);
        $portal_db->delete('tbl_tipo_acesso');
    }

    public function save_acesso($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_tipo_acesso', $dados);
        return $portal_db->insert_id();
    }

    //
    //=============================================================================================================
    //

    public function listar_velocidade(){
        $portal_db = $this->load->database('default',true);
        return $portal_db->get('tbl_tipo_velocidade');
    }

    public function update_velocidade($where,$dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->update('tbl_tipo_velocidade', $dados, $where);
        return $portal_db->affected_rows();
    }

    public function edit_velocidade($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->from('tbl_tipo_velocidade');
        $portal_db->where('id_tipo_velocidade',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_velocidade($id){
        $portal_db = $this->load->database('default',true);
        $portal_db->where('id_tipo_velocidade', $id);
        $portal_db->delete('tbl_tipo_velocidade');
    }

    public function save_velocidade($dados){
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_tipo_velocidade', $dados);
        return $portal_db->insert_id();
    }

    //
    //=============================================================================================================
    //

    public function historico() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('ticket, posicionamento, rec, centro, status, responsabilidade, causa, date_format(abertura, "%d/%m/%Y %H:%i:%s") as abertura, date_format(atualizacao, "%d/%m/%Y %H:%i:%s") as atualizacao');
        $portal_moni->from('tbl_ebt_grc');
        $portal_moni->order_by('id', 'DESC');
        $portal_moni->limit('1000');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function calculo($inicio,$fim) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('g.centro, g.ticket, date_format(g.abertura, "%d/%m/%Y %H:%i:%s") AS abertura, date_format(g.atualizacao, "%d/%m/%Y %H:%i:%s") AS atualizacao, g.tempo_embratel_hora as tmp_portal , g.responsabilidade');
        $portal_moni->from('tbl_ebt_grc g');
        $portal_moni->join('tbl_ebt_fatura f','g.ticket = f.ticket','left');
        $where = "atualizacao BETWEEN '". $inicio ."' AND '". $fim ."'";
        $portal_moni->where($where);
        $portal_moni->order_by('g.centro', 'DESC');
        $portal_moni->limit('100');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function ticket($mes) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('Month(atualizacao) as mes, count(ticket) as numero');
        $portal_moni->from('tbl_ebt_grc');
        $portal_moni->where('year(atualizacao)',$mes);
        $portal_moni->group_by('Month(atualizacao)');
        $portal_moni->order_by('mes', 'ASC');
        $portal_moni->limit('12');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function ticket_anual() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('year(atualizacao) as ano, count(ticket) as numero');
        $portal_moni->from('tbl_ebt_grc');
        $portal_moni->where('year(atualizacao) >=','2010');
        $portal_moni->group_by('year(atualizacao)');
        $portal_moni->order_by('ano', 'ASC');
        $portal_moni->limit('12');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function causa($mes,$ano) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('causa, count(causa) as numero');
        $portal_moni->from('tbl_ebt_grc');
        if($mes != 'null'){
            $portal_moni->where('Month(atualizacao)',$mes);
        }
        $portal_moni->where('year(atualizacao)',$ano);
        $portal_moni->group_by('causa');
        $portal_moni->order_by('numero', 'DESC');
        $portal_moni->limit('10');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function tempo($mes,$ano) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('centro, sum(TIMESTAMPDIFF(HOUR,abertura,atualizacao)) AS tempo');
        $portal_db->from('ebt_grc');
        $portal_db->where('Month(atualizacao)',$mes);
        $portal_db->where('year(atualizacao)',$ano);
        $portal_db->group_by('centro');
        $portal_db->order_by('tempo', 'DESC');
        $portal_db->limit('10');
        $query = $portal_db->get();
        // echo $portal_db->last_query();
        return $query->result_array();
    }

    public function localidade($mes,$ano) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('centro, count(ticket) as numero');
        $portal_moni->from('tbl_ebt_grc');
        if($mes != 'null'){
            $portal_moni->where('Month(atualizacao)',$mes);
        }
        $portal_moni->where('year(atualizacao)',$ano);
        $portal_moni->group_by('centro');
        $portal_moni->order_by('numero', 'DESC');
        $portal_moni->limit('10');
        $query = $portal_moni->get();
        return $query->result_array();
    }


    public function select_link_fora() {

            $portal = $this->load->database('default',true);
            $portal->select('*');
            $portal->from('zbx_link_fora');
            $portal->order_by('data_alerta', 'DESC');
            $query = $portal->get();
            // echo $portal->last_query();
            return $query->result_array();
    }

    public function update_link_fora($id, $dados) {
        $portal = $this->load->database('default',true);
        $portal->update('zbx_link_fora', $dados, $id);
        // echo $portal->last_query();
        return $portal->affected_rows();
    }


}
