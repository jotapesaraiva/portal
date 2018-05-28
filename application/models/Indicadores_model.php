<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicadores_model extends CI_Model {

    public function nome_job() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('nm_job as variavel');
        $portal_moni->from('tab_job_nova');
        $portal_moni->group_by('nm_job');
        $portal_moni->order_by('nm_job');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function nome_status() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('status as variavel');
        $portal_moni->from('tbl_dp_backups');
        $portal_moni->group_by('status');
        $portal_moni->order_by('status');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function backup_job($backup,$mes,$ano) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('Month(day_time) AS Mes, Day(day_time) AS Dia, ROUND (Sum(gb_written),2) AS tamanho, ROUND (Sum((time_to_sec(duration)/60)/60),1) AS duracao');
        $portal_moni->from('tbl_dp_backups');
        $portal_moni->where('Month(day_time)', $mes);
        $portal_moni->where('Year(day_time)', $ano);
        if($backup == 'Todos'){
            $portal_moni->group_by(array("Month(day_time)","Day(day_time)","Year(day_time)"));
        } else {
            $portal_moni->group_by(array("specification","Month(day_time)","Day(day_time)"));
            $portal_moni->having('specification', $backup);
        }
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function backup_status($backup,$status,$ano) {
        $portal_moni = $this->load->database('portalmoni',true);
        if($backup!= 'Todos' and $status != 'Todos'){
            $portal_moni->select('specification, Month(day_time) AS Mes, ROUND (Sum(gb_written)/count(*),2) AS MediaGB, ROUND(Sum((TIME_TO_SEC(duration)/60)/60)/count(*),2) AS MediaDuracao, Year(day_time) AS Ano');
        } else {
            $portal_moni->select('specification, Month(day_time) AS Mes, ROUND (Sum(gb_written),2) AS MediaGB, ROUND(Sum((TIME_TO_SEC(duration)/60)/60),2) AS MediaDuracao, Year(day_time) AS Ano');
        }
        $portal_moni->from('tbl_dp_backups');
        if($backup!= 'Todos' and $status != 'Todos'){
            $portal_moni->where('status =', $status);
            $portal_moni->where('Year(day_time)=', $ano);
            $portal_moni->group_by('specification', 'Month(day_time)' , 'Year(day_time)');
            $portal_moni->having('specification =', $backup);
        } elseif($backup == 'Todos' and $status == 'Todos') {
            $portal_moni->where('Year(day_time)=', $ano);
            $portal_moni->group_by('Month(day_time)', 'Year(day_time)');
        } elseif($backup != 'Todos' and $status == 'Todos') {
            $portal_moni->where('Year(day_time)=', $ano);
            $portal_moni->group_by('specification', 'Month(day_time)' , 'Year(day_time)');
            $portal_moni->having('specification =', $backup);
        } elseif($backup == 'Todos' and $status != 'Todos') {
            $portal_moni->where('status =', $status);
            $portal_moni->where('Year(day_time)=', $ano);
            $portal_moni->group_by('Month(day_time)', 'Year(day_time)');
        }
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function quantidade_status($status, $ano) {
        $portal_moni = $this->load->database('portalmoni',true);
        if($status == 'abortados'){
            $portal_moni->select('Count(status) AS abortados, Month(day_time) AS Mes');
        } elseif($status == 'completos'){
            $portal_moni->select('Count(status) AS completos, Month(day_time) AS Mes');
        }
        $portal_moni->from('tbl_dp_backups');
        if($status == 'abortados'){
            $portal_moni->where('status', 'Failed');
            $portal_moni->where('Year(day_time)', $ano);
            $portal_moni->or_where('status', 'Aborted');
            $portal_moni->where('Year(day_time)', $ano);
        } elseif($status == 'completos'){
            $portal_moni->where('status', 'Completed');
            $portal_moni->where('Year(day_time)', $ano);
            $portal_moni->or_where('status', 'Completed/Errors');
            $portal_moni->where('Year(day_time)', $ano);
            $portal_moni->or_where('status', 'Completed/Failures');
            $portal_moni->where('Year(day_time)', $ano);
        }
        $portal_moni->group_by('Month(day_time)');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function tempo_volume($variavel, $mes, $ano) {
        $portal_moni = $this->load->database('portalmoni',true);
        if($variavel == 'volume') {
            $portal_moni->select('specification, ROUND(Sum(gb_written)) as numero');
        } else {
            $portal_moni->select('specification, ROUND(Sum((time_to_sec(duration)/60)/60)) as numero');
        }
        $portal_moni->from('tbl_dp_backups');
        if($mes != 'null'){
            $portal_moni->where('Month(day_time)', $mes);
        }
        $portal_moni->where('year(day_time)', $ano);
        $portal_moni->where('specification!=','Interactive');

        $portal_moni->group_by('specification');
        $portal_moni->order_by('numero', 'DESC');
        $portal_moni->limit('10');

        $query = $portal_moni->get();
        return $query->result_array();
    }

}

/* End of file Indicadores_model.php */
/* Location: ./application/models/Indicadores_model.php */