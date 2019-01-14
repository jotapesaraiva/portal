<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backups_model extends CI_Model {

    public function falhos() {
        $portal = $this->load->database('default',true);
        $portal->select('*');
        $portal->from('dp_backups');
        $portal->where_not_in('status',array('InProgress','InProgress/Errors','Mount-Request','InProgress/Failures','Mount/Failures','Mount/Errors','Completed'));
        $portal->not_like('specification', 'TESTE');
        $portal->where('day_time > DATE_SUB(curdate(), INTERVAL 1 MONTH)');
        $portal->group_by(array('mantis','specification'));
        $portal->order_by('day_time','DESC');
        $query = $portal->get();
        // echo $portal->last_query();
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
        $portal = $this->load->database('default',true);
        $portal->select('*');
        $portal->from('dp_backups');
        $portal->where('id',$id);
        $query = $portal->get();
        // echo $portal->last_query();
        return $query->result_array();
    }

}
/* End of file Backups_model.php */
/* Location: ./application/models/Backups_model.php */