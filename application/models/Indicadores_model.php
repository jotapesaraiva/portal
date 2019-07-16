<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicadores_model extends CI_Model {

    public function nome_job($mes) {
        $this->db->select('distinct(specification) as variavel');
        $this->db->from('dp_backups');
        $this->db->where('Month(day_time)', $mes);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function nome_status() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('status as variavel');
        $this->db->from('dp_backups');
        $this->db->group_by('status');
        $this->db->order_by('status');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function backup_job($backup,$mes,$ano) {
        // $this->db = $this->load->database('default',true);
        $this->db->select('Month(day_time) AS Mes, Day(day_time) AS Dia, ROUND (Sum(gb_written),2) AS tamanho, ROUND (Sum((time_to_sec(duration)/60)/60),1) AS duracao');
        $this->db->from('dp_backups');
        $this->db->where('Month(day_time)', $mes);
        $this->db->where('Year(day_time)', $ano);
        if($backup == 'Todos'){
            $this->db->group_by(array("Month(day_time)","Day(day_time)","Year(day_time)"));
        } else {
            $this->db->group_by(array("specification","Month(day_time)","Day(day_time)"));
            $this->db->having('specification', $backup);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function backup_status($backup,$status,$ano) {
        // $this->db = $this->load->database('default',true);
        if($backup!= 'Todos' and $status != 'Todos'){
            $this->db->select('specification, Month(day_time) AS Mes, ROUND (Sum(gb_written)/count(*),2) AS MediaGB, ROUND(Sum((TIME_TO_SEC(duration)/60)/60)/count(*),2) AS MediaDuracao, Year(day_time) AS Ano');
        } else {
            $this->db->select('specification, Month(day_time) AS Mes, ROUND (Sum(gb_written),2) AS MediaGB, ROUND(Sum((TIME_TO_SEC(duration)/60)/60),2) AS MediaDuracao, Year(day_time) AS Ano');
        }
        $this->db->from('dp_backups');
        if($backup!= 'Todos' and $status != 'Todos'){
            $this->db->where('status =', $status);
            $this->db->where('Year(day_time)=', $ano);
            $this->db->group_by('specification', 'Month(day_time)' , 'Year(day_time)');
            $this->db->having('specification =', $backup);
        } elseif($backup == 'Todos' and $status == 'Todos') {
            $this->db->where('Year(day_time)=', $ano);
            $this->db->group_by('Month(day_time)', 'Year(day_time)');
        } elseif($backup != 'Todos' and $status == 'Todos') {
            $this->db->where('Year(day_time)=', $ano);
            $this->db->group_by('specification', 'Month(day_time)' , 'Year(day_time)');
            $this->db->having('specification =', $backup);
        } elseif($backup == 'Todos' and $status != 'Todos') {
            $this->db->where('status =', $status);
            $this->db->where('Year(day_time)=', $ano);
            $this->db->group_by('Month(day_time)', 'Year(day_time)');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function quantidade_status($status, $ano) {
        // $this->db = $this->load->database('default',true);
        if($status == 'abortados'){
            $this->db->select('Count(status) AS abortados, Month(day_time) AS Mes');
        } elseif($status == 'completos'){
            $this->db->select('Count(status) AS completos, Month(day_time) AS Mes');
        }
        $this->db->from('dp_backups');
        if($status == 'abortados'){
            $this->db->where('status', 'Failed');
            $this->db->where('Year(day_time)', $ano);
            $this->db->or_where('status', 'Aborted');
            $this->db->where('Year(day_time)', $ano);
        } elseif($status == 'completos'){
            $this->db->where('status', 'Completed');
            $this->db->where('Year(day_time)', $ano);
            $this->db->or_where('status', 'Completed/Errors');
            $this->db->where('Year(day_time)', $ano);
            $this->db->or_where('status', 'Completed/Failures');
            $this->db->where('Year(day_time)', $ano);
        }
        $this->db->group_by('Month(day_time)');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function tempo_volume($variavel, $mes, $ano) {
        // $this->db = $this->load->database('default',true);
        if($variavel == 'volume') {
            $this->db->select('specification, ROUND(Sum(gb_written)) as numero');
        } else {
            $this->db->select('specification, ROUND(Sum((time_to_sec(duration)/60)/60)) as numero');
        }
        $this->db->from('dp_backups');
        if($mes != 'null'){
            $this->db->where('Month(day_time)', $mes);
        }
        $this->db->where('year(day_time)', $ano);
        $this->db->where('specification!=','Interactive');

        $this->db->group_by('specification');
        $this->db->order_by('numero', 'DESC');
        $this->db->limit('10');

        $query = $this->db->get();
        return $query->result_array();
    }

}

/* End of file Indicadores_model.php */
/* Location: ./application/models/Indicadores_model.php */