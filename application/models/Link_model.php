<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_model extends CI_Model{


    // public function xxxcalculo_atendimento($data_inicio,$data_final) {
    //     $mantis = $this->load->database('mantis',true);
    //     $sql = "
    //         SELECT
    //             mbt.id as mantis,
    //             substr(regexp_substr(mbt.summary,'-[^'']*'),3) as resumo,
    //             --mbt.summary as resumo,
    //             mcf3.value as ticket,
    //            to_char(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf1.value / 60 / 60 / 24) - 0.125, 'dd/mm/yyyy hh24:mi:ss') as inicio_chamado,
    //            to_char(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf2.value / 60 / 60 / 24) - 0.125,'dd/mm/yyyy hh24:mi:ss') as fim_chamado,
    //             (trunc(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf2.value / 60 / 60 / 24) - 0.125) - trunc(to_date('01-JAN-1970', 'dd-mon-yyyy') + (mcf1.value / 60 / 60 / 24) - 0.125))
    //             || ' dias '  ||
    //             TO_CHAR(to_date('00-00-00', 'hh24:mi:ss')+ to_number((to_date('01-JAN-1970', 'dd-mon-yyyy') +
    //                        (mcf2.value / 60 / 60 / 24) - 0.125) - (to_date('01-JAN-1970', 'dd-mon-yyyy') +
    //                        (mcf1.value / 60 / 60 / 24) - 0.125)), 'hh24:mi:ss') as calculo_horas,
    //             mcf4.value as responsabilidade
    //         from mantis.mantis_bug_tb mbt
    //         left join mantis.mantis_custom_field_string_tb mcf1 on mbt.id=mcf1.bug_id
    //         left join mantis.mantis_custom_field_string_tb mcf2 on mbt.id=mcf2.bug_id
    //         left join mantis.mantis_custom_field_string_tb mcf3 on mbt.id=mcf3.bug_id
    //         left join mantis.mantis_custom_field_string_tb mcf4 on mbt.id=mcf4.bug_id
    //         where mbt.project_id = 521 and mcf1.field_id = 381 and mcf2.field_id = 401 and mcf3.field_id = 361 and (mcf4.field_id = 1541 and mcf4.value in ('Embratel','PRODEPA'))
    //         and mbt.status in (60,80)
    //         and trunc(mbt.date_submitted) between '".$data_inicio."' and '".$data_final."'
    //         order by mcf1.value asc";
    //     $stmt = oci_parse($mantis->conn_id,$sql);
    //     oci_execute($stmt, OCI_NO_AUTO_COMMIT);
    //     // $nrows = oci_fetch_all($stmt, $res);//retorna o numero de ocorrencias
    //     // echo "$nrows rows fetched<br>\n";
    //     // var_dump($res);
    //     // oci_fetch_all($stmt, $res);//cria array apartir das colunas
    //     oci_fetch_all($stmt, $res,null, null, OCI_FETCHSTATEMENT_BY_ROW);//cria array apartir das linhas
    //     // echo $this->mantis->last_query();
    //     return $res;
    // }

/*    public function calculo_atendimento($data_inicio,$data_final){
        $mantis = $this->load->database('mantis',true);
        $query = $mantis->query("SELECT
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
                        order by mcf1.value asc");
        // echo $portal_ora->last_query();
        return $query;
    }
*/

    public function calculo_atendimento($data_inicio,$data_final){
        $mantis = $this->load->database('mantis',true);
        $query = $mantis->query("SELECT
                            mbt.id as mantis,
                            substr(regexp_substr(mbt.summary,'-[^'']*'),3) as resumo,
                            --mbt.summary as resumo,
                            mcf5.value as provedor,
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
                        left join mantis.mantis_custom_field_string_tb mcf5 on mbt.id=mcf5.bug_id
                        where mbt.project_id = 521 and mcf1.field_id = 381 and mcf2.field_id = 401 and mcf3.field_id = 361 and mcf4.field_id = 1541 and mcf5.field_id = 3901 --  and (mcf4.field_id = 1541 and mcf4.value in ('Embratel','PRODEPA'))
                        and mbt.status in (60,80)
                        and trunc(mbt.date_submitted) between '".$data_inicio."' and '".$data_final."'
                        order by mcf1.value asc");
        // echo $portal_ora->last_query();
        return $query;
    }

    public function listar_link() {
        // $this->db = $this->load->database('default',true);
        //return $this->db->get('tbl_link');
        $this->db->select('*');
        $this->db->from('tbl_link l');
        $this->db->join('tbl_unidade u', 'u.id_unidade=l.id_unidade');
        $this->db->join('tbl_tipo_velocidade tv','tv.id_tipo_velocidade=l.id_tipo_velocidade');
        $this->db->join('tbl_tipo_acesso ta','ta.id_tipo_acesso=l.id_tipo_acesso');
        $this->db->join('tbl_fornecedor f','f.id_fornecedor=l.id_fornecedor');
        $query = $this->db->get();
        return $query;
    }

    public function update_link($where,$dados) {
        $this->db->update('tbl_link', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_link($id) {
        $this->db->from('tbl_link');
        $this->db->where('id_link',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_link($id){
        $this->db->where('id_link', $id);
        $this->db->delete('tbl_link');
    }

    public function save_link($dados){
        $this->db->insert('tbl_link', $dados);
        return $this->db->insert_id();
    }

    //
    //=============================================================================================================================================================
    //

    public function listar_acesso(){
        return $this->db->get('tbl_tipo_acesso');

    }

    public function update_acesso($where,$dados){
        $this->db->update('tbl_tipo_acesso', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_acesso($id){
        $this->db->from('tbl_tipo_acesso');
        $this->db->where('id_tipo_acesso',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_acesso($id){
        $this->db->where('id_tipo_acesso', $id);
        $this->db->delete('tbl_tipo_acesso');
    }

    public function save_acesso($dados){
        $this->db->insert('tbl_tipo_acesso', $dados);
        return $this->db->insert_id();
    }

    //
    //=============================================================================================================
    //

    public function listar_velocidade(){
        return $this->db->get('tbl_tipo_velocidade');
    }

    public function update_velocidade($where,$dados){
        $this->db->update('tbl_tipo_velocidade', $dados, $where);
        return $this->db->affected_rows();
    }

    public function edit_velocidade($id){
        $this->db->from('tbl_tipo_velocidade');
        $this->db->where('id_tipo_velocidade',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_velocidade($id){
        $this->db->where('id_tipo_velocidade', $id);
        $this->db->delete('tbl_tipo_velocidade');
    }

    public function save_velocidade($dados){
        $this->db->insert('tbl_tipo_velocidade', $dados);
        return $this->db->insert_id();
    }

    //
    //===============================================================================================================================================
    //

    public function historico() {
        $this->db->select('ticket, posicionamento, rec, centro, status, responsabilidade, causa, date_format(abertura, "%d/%m/%Y %H:%i:%s") as abertura, date_format(atualizacao, "%d/%m/%Y %H:%i:%s") as atualizacao');
        $this->db->from('ebt_grc_teste');
        $this->db->order_by('id', 'DESC');
        $this->db->limit('1000');
        $query = $this->db->get();
        return $query;
    }

    public function calculo($inicio,$fim) {
        $this->db->select('centro, ticket, date_format(abertura, "%d/%m/%Y %H:%i:%s") AS abertura, date_format(atualizacao, "%d/%m/%Y %H:%i:%s") AS atualizacao, tempo_operadora , responsabilidade');
        $this->db->from('ebt_grc_teste');
        // $this->db->join('tbl_ebt_fatura f','g.ticket = f.ticket','left');
        $where = "atualizacao BETWEEN '". $inicio ."' AND '". $fim ."'";
        $this->db->where($where);
        $this->db->order_by('centro', 'DESC');
        $this->db->limit('100');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query;
    }

    public function ticket($mes) {
        $this->db->select('Month(atualizacao) as mes, count(ticket) as numero');
        $this->db->from('ebt_grc_teste');
        $this->db->where('year(atualizacao)',$mes);
        $this->db->group_by('Month(atualizacao)');
        $this->db->order_by('mes', 'ASC');
        $this->db->limit('12');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ticket_anual() {
        $this->db->select('year(atualizacao) as ano, count(ticket) as numero');
        $this->db->from('ebt_grc_teste');
        $this->db->where('year(atualizacao) >=','2010');
        $this->db->group_by('year(atualizacao)');
        $this->db->order_by('ano', 'ASC');
        $this->db->limit('12');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function causa($mes,$ano) {
        $this->db->select('causa, count(causa) as numero');
        $this->db->from('ebt_grc_teste');
        if($mes != 'null'){
            $this->db->where('Month(atualizacao)',$mes);
        }
        $this->db->where('year(atualizacao)',$ano);
        $this->db->group_by('causa');
        $this->db->order_by('numero', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tempo($mes,$ano) {
        $this->db->select('centro, sum(TIMESTAMPDIFF(HOUR,abertura,atualizacao)) AS tempo');
        $this->db->from('ebt_grc_teste');
        $this->db->where('Month(atualizacao)',$mes);
        $this->db->where('year(atualizacao)',$ano);
        $this->db->group_by('centro');
        $this->db->order_by('tempo', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function localidade($mes,$ano) {
        $this->db->select('centro, count(ticket) as numero');
        $this->db->from('ebt_grc_teste');
        if($mes != 'null'){
            $this->db->where('Month(atualizacao)',$mes);
        }
        $this->db->where('year(atualizacao)',$ano);
        $this->db->group_by('centro');
        $this->db->order_by('numero', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function select_link_fora() {
            // $portal = $this->load->database('default',true);
            $this->db->select('*');
            $this->db->from('zbx_link_fora');
            $this->db->order_by('data_alerta', 'DESC');
            $query = $this->db->get();
            // echo $this->db->last_query();
            return $query->result_array();
    }

    public function update_link_fora($id, $dados) {
        // $this->db = $this->load->database('default',true);
        $this->db->update('zbx_link_fora', $dados, $id);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }


}
