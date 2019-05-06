<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_model extends CI_Model {

    public function history(){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*, date_format(day_time, "%d/%m/%Y") as daytime');
        $this->db->from('dp_backups');
        $this->db->where_not_in('status', array( 'Mount-Request',
                                                    'Mount/Failures',
                                                    'Mount/Errors',
                                                    'Travamento',
                                                    'TESTE_SHAREPOINT_APP',
                                                    'TESTE',
                                                    'InProgress',
                                                    'InProgress/Errors',
                                                    'InProgress/Failures',
                                                    '')
                                    );
        $this->db->order_by('day_time','DESC');
        $this->db->limit('1000');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query;
    }

    // public function data_copy() {
    //     $this->db = $this->load->database('portalmoni',true);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

}
/* End of file Historico_model.php */
/* Location: ./application/models/Historico_model.php */