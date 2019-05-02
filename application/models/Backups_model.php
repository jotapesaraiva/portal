<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backups_model extends CI_Model {

    public function falhos() {
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('dp_backups');
        $this->db->where_not_in('status',array('InProgress','InProgress/Errors','Mount-Request','InProgress/Failures','Mount/Failures','Mount/Errors','Completed'));
        $this->db->not_like('specification', 'TESTE');
        $this->db->where('day_time > DATE_SUB(curdate(), INTERVAL 1 MONTH)');
        $this->db->group_by(array('mantis','specification'));
        $this->db->order_by('day_time','DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }
    // SELECT *
    // FROM tbl_dp_backups_temp
    // WHERE (status not in('InProgress','InProgress/Errors','Mount-Request','InProgress/Failures','Mount/Failures','Mount/Errors','Completed'))
    // AND (specification not like '%TESTE%')
    // AND (timestamp(concat(day_time,' ',start_time)) > (NOW()-interval 30 DAY))
    // GROUP BY mantis, specification
    // ORDER BY id DESC
    public function select_backup($id){
        // $this->db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('dp_backups');
        $this->db->where('id',$id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

}
/* End of file Backups_model.php */
/* Location: ./application/models/Backups_model.php */