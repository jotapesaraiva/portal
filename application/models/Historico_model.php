<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_model extends CI_Model {

    public function history(){
        $portal_moni = $this->load->database('default',true);
        $portal_moni->select('*, date_format(day_time, "%d/%m/%Y") as daytime');
        $portal_moni->from('dp_backups');
        $portal_moni->where_not_in('status', array( 'Mount-Request',
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
        $portal_moni->order_by('day_time','DESC');
        $portal_moni->limit('1000');
        $query = $portal_moni->get();
        // echo $portal_moni->last_query();
        return $query->result_array();
    }

    // public function data_copy() {
    //     $portal_moni = $this->load->database('portalmoni',true);
    //     $query = $portal_moni->get();
    //     return $query->result_array();
    // }

}
/* End of file Historico_model.php */
/* Location: ./application/models/Historico_model.php */