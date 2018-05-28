<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_model extends CI_Model {

    public function history(){
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('*,date_format(day_time, "%d/%m/%Y") as day_time');
        $portal_moni->from('tbl_dp_backups');
        $portal_moni->where('status <>', 'Mount-Request');
        $portal_moni->where('status <>', 'TESTE_SHAREPOINT_APP');
        $portal_moni->where('status <>', 'InProgress');
        $portal_moni->where('status<>', 'InProgress/Errors');
        $portal_moni->where('status <>', '');
        $portal_moni->where('status <>', 'InProgress/Failures');
        $portal_moni->where('status <>', 'Mount/Failures');
        $portal_moni->where('status<>', 'Mount/Errors');
        $portal_moni->where('status<>', 'Travamento');
        $portal_moni->order_by('id','DESC');
        $portal_moni->limit('1000');
        $query = $portal_moni->get();
        return $query->result_array();
    }

    public function data_copy() {
        $portal_moni = $this->load->database('portalmoni',true);
        $query = $portal_moni->get();
        return $query->result_array();
    }

}
/* End of file Historico_model.php */
/* Location: ./application/models/Historico_model.php */