<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

    public function select_mxhero($rota) //$rota -> in ou ->out
    {
        $mxhero = $this->load->database('mxhero', TRUE);
        $mxhero->select("date_format(insert_date,'%Y-%m-%d') as data_coleta, count(*) as qtd,sum(bytes_size/1000000) as size");
        $mxhero->from('mail_records');
        $mxhero->where("flow in ('".$rota."','both')");
        $mxhero->where('insert_date >= CURDATE()');
        $mxhero->group_by('day(insert_date)');
        $query = $mxhero->get();
        // echo $mxhero->last_query();
        return $query->row_array();
    }

    public function select_spam_mxhero()
    {
        $mxhero = $this->load->database('mxhero', TRUE);
        $query = $mxhero->query("
            select a.data_coleta, a.spam+b.spam total from (
                    select date_format(insert_date,'%Y-%m-%d') data_coleta, count(distinct(subject)) as SPAM
                    from mail_records
                    where state_reason like '%blocklist%'
                    and insert_date >= CURDATE()
                    group by day(insert_date)
                ) a
                join (
                    select date_format(insert_date,'%Y-%m-%d') data_coleta, count(*) as SPAM
                    from mail_records
                    where state_reason like '%spamassassin%'
                    and insert_date >= CURDATE()
                    group by day(insert_date)
                ) b
                on a.data_coleta=b.data_coleta
                ");
        return $query->row_array();
    }


    public function select_mxhero_date($rota) //$rota -> in ou ->out
    {
        $mxhero = $this->load->database('mxhero', TRUE);
        $mxhero->select("date_format(insert_date,'%Y-%m-%d') as data_coleta, count(*) as qtd,sum(bytes_size/1000000) as size");
        $mxhero->from('mail_records');
        $mxhero->where("flow in ('".$rota."','both')");
        $mxhero->where('insert_date >= "2019-09-20"');
        $mxhero->group_by('day(insert_date)');
        $query = $mxhero->get();
        // echo $mxhero->last_query();
        return $query->row_array();
    }

    public function select_spam_mxhero_date()
    {
        $mxhero = $this->load->database('mxhero', TRUE);
        $query = $mxhero->query("
            select a.data_coleta, a.spam+b.spam total from (
                    select date_format(insert_date,'%Y-%m-%d') data_coleta, count(distinct(subject)) as SPAM
                    from mail_records
                    where state_reason like '%blocklist%'
                    and insert_date >= '2019-09-20'
                    group by day(insert_date)
                ) a
                join (
                    select date_format(insert_date,'%Y-%m-%d') data_coleta, count(*) as SPAM
                    from mail_records
                    where state_reason like '%spamassassin%'
                    and insert_date >= '2019-09-20'
                    group by day(insert_date)
                ) b
                on a.data_coleta=b.data_coleta
                ");
        return $query->row_array();
    }

    public function select_mx()
    {
        $mxhero = $this->load->database('mxhero', TRUE);
        $query = $mxhero->query("
            select * from mail_records where insert_date >= CURDATE()
                    ");
            return $query->row_array();
    }

    public function insert_mxhero($dados)
    {
        $this->db->insert('tbl_indicador_email', $dados);
        return $this->db->insert_id();
    }

    public function update_mxhero($where,$dados)
    {
        $this->db->update('tbl_indicador_email', $dados, $where);
        return $this->db->affected_rows();
    }
    //
    //####################################################################################################################################
    //####################################################################################################################################
    //####################################################################################################################################
    //
    // List all your items
    public function indicador_email ($mes,$ano) {
        $this->db->select('month(data_coleta), sum(qtd_in) as total_in, sum(qtd_out) as total_out, sum(qtd_spam) as total_spam');
        $this->db->from('tbl_indicador_email');
        $this->db->where('month(data_coleta)',$mes);
        $this->db->where('year(data_coleta)', $ano);
        $this->db->group_by('month(data_coleta)');
        $query = $this->db->get();
        return $query->row_array();

    }

    // Add a new item
    public function consultaBanco($mes,$ano) {
        $this->db->select('*');
        $this->db->from('tbl_indicador_email');
        $this->db->where('month(data_coleta)', $mes);
        $this->db->Where('year(data_coleta)', $ano);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function somaMesAtual($mes,$ano)
    {
        $this->db->select('sum(qtd_in) as total_in, sum(qtd_out) as total_out, sum(qtd_spam) as total_spam'); //month(data_coleta),
        $this->db->from('tbl_indicador_email');
        $this->db->where('month(data_coleta)', $mes);
        $this->db->Where('year(data_coleta)', $ano);
        $this->db->group_by('month(data_coleta)');
        $query = $this->db->get();
        return $query->row_array();
    }

    //Update one item
    public function update( $id = NULL ) {

    }

    //Delete one item
    public function delete( $id = NULL ) {

    }
}

/* End of file Email_model.php */
/* Location: ./application/models/Email_model.php */
