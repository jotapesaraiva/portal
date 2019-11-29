<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Select_model extends CI_Model {

    //function to run select all query from students table
    public function show_students(){
        $query = $this->db->get('students');
        $query_result = $query->result();
        return $query_result;
    }

}

/* End of file Select_model.php */
/* Location: ./application/models/Select_model.php */