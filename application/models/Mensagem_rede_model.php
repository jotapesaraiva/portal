<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_rede_model extends CI_Model {

    public function consulta_old(){
        $msg_old = $this->load->database('msg_old',true);
        $msg_old->where('status',0);
        $query = $msg_old->get('msg');
        return $query;
    }

    public function select_old() {
        $msg_old = $this->load->database('msg_old',true);
        $msg_old->select('id, post_user, DATE_FORMAT(FROM_UNIXTIME(start_date),"%d/%m/%Y %H:%i") as start_date, DATE_FORMAT(FROM_UNIXTIME(stop_date), "%d/%m/%Y %H:%i") as stop_date, SUBSTRING(TRIM(msg),1,25) as msg, ps');
        $msg_old->where_in('status',array(0,1));
        $query = $msg_old->get('msg');
        // echo $msg->last_query();
        return $query;
    }

    public function select_id($id)
    {
        $msg_old = $this->load->database('msg_old',true);
        $msg_old->select('id, post_user, approved_user, received_user, DATE_FORMAT(FROM_UNIXTIME(start_date),"%d/%m/%Y %H:%i") as start_date, DATE_FORMAT(FROM_UNIXTIME(stop_date), "%d/%m/%Y %H:%i") as stop_date, TRIM(msg) as msg, ps');
        $msg_old->where('id',$id);
        $query = $msg_old->get('msg');
        return $query->row();
    }

    public function update_old($where,$dados)
    {
        $msg_old = $this->load->database('msg_old',true);
        $msg_old->update('msg', $dados, $where);
        return $msg_old->affected_rows();
    }

    public function insert_new($dados)
    {
        $msg_new = $this->load->database('msg_new', true);
        $msg_new->insert('msg', $dados);
        return $msg_new->insert_id();
    }


    public function meio_new()
    {
        $msg_new = $this->load->database('msg_new', true);
        $query = $msg_new->get('meio');
        return $query->result();
    }

    public function test()
    {
        $msg_old = $this->load->database('msg_old',true);
        $msg_old->where('id','2375');
        $query = $msg_old->get('msg');
        return $query->row();

    }

}

/* End of file Mensagem_rede_model.php */
/* Location: ./application/models/Mensagem_rede_model.php */