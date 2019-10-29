<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitora_model extends CI_Model {


     public function monitora() {
         $monitora = $this->load->database('monitora',true);
         $query = $monitora->query('
            SELECT DISTINCT(DESC_ALERTA), ORIGEM, METRICA_ATUAL, PLANO_ACAO, TIPO_ALERTA, RESPONSAVEL, ACIONAMENTO, INTERROMPER, DESC_SERVICO, INFO_ADICIONAL
            FROM monitoramento.tab_alerta_servico');
         // echo $portal_ora->last_query();
         return $query->result_array();
     }


    public function alerta_repetido($alerta,$origem) {
         // $portal = $this->load->database('default',true);
         $query = $this->db->query('
             SELECT COUNT(ID) AS quantidade,id FROM (
             SELECT id, tipo_alerta, desc_alerta, origem
             FROM mnt_alertas
             WHERE desc_alerta="'.$alerta.'"
             AND origem="'.$origem.'"
             AND data_fim > NOW() - INTERVAL "15" MINUTE ) AS TEMPO ');
         // echo $portal->last_query();
         return $query->result_array();
     }


     // SELECT COUNT(ID) AS quantidade,id FROM (
     //  SELECT id, tipo_alerta, desc_alerta, origem
     //  FROM mnt_alertas WHERE desc_alerta="Falha na execução do Job J_STOP_ESTATISTICAS_TAXPAF." AND origem="CORP" AND data_fim > NOW() - INTERVAL "15" MINUTE ) AS TEMPO

     public function duplicate_mnt_alerta($dados) {
         // $portal = $this->load->database('default',true);
         $this->db->on_duplicate('mnt_alertas', $dados);
     }

     public function insert_mnt_alerta($dados) {
         // $this->db = $this->load->database('default',true);
         $this->db->insert('mnt_alertas', $dados);
         // echo $this->db->last_query();
         return $this->db->insert_id();
     }

     public function update_mnt_alerta($id, $dados) {
         // $this->db = $this->load->database('default',true);
         $this->db->update('mnt_alertas', $dados, $id);
         // echo $this->db->last_query();
         return $this->db->affected_rows();
     }

     // public function select_mnt_alerta($session) {
     public function select_mnt_alerta($session) {
         // $this->db = $this->load->database('default',true);
         $this->db->select('*');
         $this->db->from('mnt_alertas');
         $this->db->where('data_fim > NOW() - INTERVAL "10" MINUTE');
         switch ($session) {
             case 'CGDA-Banco':
                    $this->db->order_by('data_inicio', 'DESC');
                    $query = $this->db->get();
                    // echo $this->db->last_query();
                    return $query->result_array();
                 break;
             case 'CGPS':
                    $this->db->like('responsavel','CGPS');
                    $this->db->order_by('data_inicio', 'DESC');
                    $query = $this->db->get();
                    // echo $this->db->last_query();
                    return $query->result_array();
                 break;
             default:
                    $this->db->where_not_in('tipo_alerta',array('Informativo'));
                    $this->db->order_by('data_inicio', 'DESC');
                    $query = $this->db->get();
                    // echo $this->db->last_query();
                    return $query->result_array();
                 break;
         }
     }

     public function select_mnt($id) {
         // $this->db = $this->load->database('default',true);
         $this->db->select('*');
         $this->db->from('mnt_alertas');
         $this->db->where('id',$id);
         $query = $this->db->get();
         return $query->result_array();
     }

}

/* End of file Monitora_model.php */
/* Location: ./application/models/Monitora_model.php */