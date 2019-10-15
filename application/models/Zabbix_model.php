<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zabbix_model extends CI_Model {

    public function select_zabbix_link($id) {
        // return $portal_db->get('zbx_link_fora');
        $this->db->select('*');
        $this->db->from('zbx_link_fora');
        $this->db->where('host_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function select_ebt_grc($dado) {
        $this->db->select('*');
        $this->db->from('ebt_grc_teste');
        $this->db->where('ticket',$dado);
        $query = $this->db->get();
        return $query;
    }

    public function update_ebt_grc($id,$dados) {
        $this->db->update('ebt_grc_teste', $dados, $id);
        return $this->db->affected_rows();
    }

    public function insert_ebt_grc($dados) {
        $this->db = $this->load->database('default', true);
        $this->db->insert('ebt_grc_teste', $dados);
        return $this->db->insert_id();
    }

    public function list_grc_link($designacao) {
        $this->db->select('*');
        $this->db->from('ebt_grc_teste');
        $this->db->like('designacao',$designacao);
        $this->db->where_not_in('status',array('Fechado','Cancelado'));
        $this->db->order_by('ticket','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }
    // SELECT ticket,posicionamento
    // FROM tbl_ebt_grc
    // WHERE designacao like '%".$linha['designacao']."%'
    // AND status not in ('Fechado','Cancelado')
    // order by ticket DESC LIMIT 1

    public function select_zabbix_grc() {
        $this->db->select('*');
        $this->db->from('zbx_link_fora');
        $this->db->order_by('data_alerta', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function duplicate_zabbix_grc($dados) {
        $this->db->on_duplicate('zbx_link_fora', $dados);
    }

    public function save_zabbix_grc($dados) {
        $this->db->insert('zbx_link_fora', $dados);
        return $this->db->insert_id();
    }

    // public function replace_zabbix_grc($dados) {
    //     $this->db = $this->load->database('default',true);
    //     return $this->db->replace('zbx_link_fora', $dados);
    // }

    public function delete_zabbix_grc($id) {
        $this->db->where_not_in('id',$id);
        $this->db->delete('zbx_link_fora');
        // echo $this->db->last_query();
    }

    public function update_zabbix_grc($dados,$designacao) {
        $this->db->where('designacao',$designacao);
        $this->db->update('zbx_link_fora',$dados);
    }
    // UPDATE tab_alertas_zabbix_link
    // SET ticket='".$ticket."',posicionamento='".$posicionamento."'
    // WHERE designacao ='".$linha['designacao']."'";

    public function duplicate_zabbix_server($dados) {
        $this->db->on_duplicate('zbx_server_fora', $dados);
        // echo $this->db->last_query();
    }

    public function save_zabbix_server($dados) {
        $this->db->insert('zbx_server_fora', $dados);
        return $this->db->insert_id();
    }

    public function list_zabbix_server() {
        $this->db->select('*');
        $this->db->from('zbx_server_fora');
        if(date('H') >= '08' && date('H') <= '18'){
        }else{
            $this->db->where('priority','5');
        }
        $this->db->order_by('data_alerta', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function select_zabbix_server($id) {
        $this->db->select('*');
        $this->db->from('zbx_server_fora');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function delete_zabbix_server($id) {
        $this->db->where_not_in('id', $id);
        $this->db->delete('zbx_server_fora');
        // echo $this->db->last_query();
    }

    public function duplicate_zabbix_monitora($dados) {
        $this->db->on_duplicate('zbx_monitora', $dados);
        // echo $this->db->last_query();
    }

    public function list_zabbix_monitora() {
        $this->db->select('*');
        $this->db->from('zbx_monitora');
        if(date('H') >= '08' && date('H') <= '18'){
        } else {
            $this->db->where('priority','5');
        }
        $this->db->where('alert', '1');
        $this->db->order_by('data_alerta', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function select_monitora() {
        $this->db->select('*');
        $this->db->from('zbx_monitora');
        $this->db->order_by('data_alerta', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function update_monitora($id, $dados) {
        $this->db->update('zbx_monitora', $dados, $id);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function update_zabbix_monitora($id)
    {
        $data = array ( 'alert' => 0 );
        $this->db->where_not_in('id', $id);
        $this->db->update('zbx_monitora',$data);
        return $this->db->affected_rows();
    }

}

/* End of file ZabbixGrc_model.php */
/* Location: ./application/models/ZabbixGrc_model.php */