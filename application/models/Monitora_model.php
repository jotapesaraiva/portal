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
         $portal = $this->load->database('default',true);
         $query = $portal->query('
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
         $portal = $this->load->database('default',true);
         $portal->on_duplicate('mnt_alertas', $dados);
     }

     public function insert_mnt_alerta($dados) {
         $portal = $this->load->database('default',true);
         $portal->insert('mnt_alertas', $dados);
         // echo $portal->last_query();
         return $portal->insert_id();
     }

     public function update_mnt_alerta($id, $dados) {
         $portal = $this->load->database('default',true);
         $portal->update('mnt_alertas', $dados, $id);
         // echo $portal->last_query();
         return $portal->affected_rows();
     }

     // public function select_mnt_alerta($session) {
     public function select_mnt_alerta($session) {
         $portal = $this->load->database('default',true);
         $portal->select('*');
         $portal->from('mnt_alertas');
         $portal->where('data_fim > NOW() - INTERVAL "10" MINUTE');
         switch ($session) {
             case 'CGRE-Produção':
                    $portal->where_not_in('tipo_alerta',array('Informativo'));
                    $portal->order_by('data_inicio', 'DESC');
                    $query = $portal->get();
                    // echo $portal->last_query();
                    return $query->result_array();
                 break;
             case 'CGPS':
                    $portal->like('responsavel','CGPS');
                    $portal->order_by('data_inicio', 'DESC');
                    $query = $portal->get();
                    // echo $portal->last_query();
                    return $query->result_array();
                 break;
             default:
                    $portal->order_by('data_inicio', 'DESC');
                    $query = $portal->get();
                    // echo $portal->last_query();
                    return $query->result_array();
                 break;
         }
     }

     public function select_mnt($id) {
         $portal = $this->load->database('default',true);
         $portal->select('*');
         $portal->from('mnt_alertas');
         $portal->where('id',$id);
         $query = $portal->get();
         return $query->result_array();
     }

}

/* End of file Monitora_model.php */
/* Location: ./application/models/Monitora_model.php */