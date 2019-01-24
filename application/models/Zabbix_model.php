<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zabbix_model extends CI_Model {

    public function select_zabbix_link($id) {
        $portal_db = $this->load->database('default',true);
        // return $portal_db->get('zbx_link_fora');
        $portal_db->select('*');
        $portal_db->from('zbx_link_fora');
        $portal_db->where('host_id', $id);
        $query = $portal_db->get();
        return $query->result_array();
    }

    public function list_grc_link($designacao) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('ebt_grc');
        $portal_db->like('designacao',$designacao);
        $portal_db->where_not_in('status',array('Fechado','Cancelado'));
        $portal_db->order_by('ticket','DESC');
        $query = $portal_db->get();
        return $query->result_array();
    }
    // SELECT ticket,posicionamento
    // FROM tbl_ebt_grc
    // WHERE designacao like '%".$linha['designacao']."%'
    // AND status not in ('Fechado','Cancelado')
    // order by ticket DESC LIMIT 1

    public function select_zabbix_grc() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('zbx_link_fora');
        $portal_db->order_by('data_alerta', 'DESC');
        $query = $portal_db->get();
        return $query->result_array();
    }

    public function duplicate_zabbix_grc($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->on_duplicate('zbx_link_fora', $dados);
    }

    public function save_zabbix_grc($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('zbx_link_fora', $dados);
        return $portal_db->insert_id();
    }

    // public function replace_zabbix_grc($dados) {
    //     $portal_db = $this->load->database('default',true);
    //     return $portal_db->replace('zbx_link_fora', $dados);
    // }

    public function delete_zabbix_grc($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where_not_in('id',$id);
        $portal_db->delete('zbx_link_fora');
        // echo $portal_db->last_query();
    }

    public function update_zabbix_grc($dados,$designacao) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where('designacao',$designacao);
        $portal_db->update('zbx_link_fora',$dados);
    }
    // UPDATE tab_alertas_zabbix_link
    // SET ticket='".$ticket."',posicionamento='".$posicionamento."'
    // WHERE designacao ='".$linha['designacao']."'";

    public function duplicate_zabbix_server($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->on_duplicate('zbx_server_fora', $dados);
        // echo $portal_db->last_query();
    }

    public function save_zabbix_server($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('zbx_server_fora', $dados);
        return $portal_db->insert_id();
    }

    public function list_zabbix_server() {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('zbx_server_fora');
        $portal_db->order_by('data_alerta', 'DESC');
        $query = $portal_db->get();
        return $query->result_array();
    }
    public function select_zabbix_server($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->select('*');
        $portal_db->from('zbx_server_fora');
        $portal_db->where('host_id',$id);
        $query = $portal_db->get();
        return $query->row();
    }

    public function delete_zabbix_server($id) {
        $portal_db = $this->load->database('default',true);
        $portal_db->where_not_in('id', $id);
        $portal_db->delete('zbx_server_fora');
        // echo $portal_db->last_query();
    }
}

/* End of file ZabbixGrc_model.php */
/* Location: ./application/models/ZabbixGrc_model.php */