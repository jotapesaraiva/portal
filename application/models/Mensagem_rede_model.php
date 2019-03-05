<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_rede_model extends CI_Model {

    public function consulta(){
        $msg = $this->load->database('msg',true);
        $msg->select('*');
        $msg->from('msg');
        $msg->where('status',0);
        $query = $msg->get();
        return $query;
    }

    public function select() {
        $msg = $this->load->database('msg',true);
        $msg->select('id, post_user, DATE_FORMAT(FROM_UNIXTIME(start_date),"%d/%m/%Y %H:%i") as start_date, DATE_FORMAT(FROM_UNIXTIME(stop_date), "%d/%m/%Y %H:%i") as stop_date, SUBSTRING(TRIM(msg),1,25) as msg, ps');
        $msg->where_in('status',array(0,1));
        $query = $msg->get('msg');
        // echo $msg->last_query();
        return $query;
    }

}

/* End of file Mensagem_rede_model.php */
/* Location: ./application/models/Mensagem_rede_model.php */