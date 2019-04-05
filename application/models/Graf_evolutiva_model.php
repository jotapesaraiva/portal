<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graf_evolutiva_model extends CI_Model {

    public function evolutiva_usuarios($data_inicio, $data_fim){
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
                SELECT p.username AS usuario, trunc(DATE_MODIFIED, 'MM') AS data, count(distinct (b.id)) AS qtd
                FROM mantis.mantis_bug_tb b
                LEFT JOIN mantis_custom_field_string_tb f on b.id = f.bug_id--ok
                JOIN mantis.mantis_bug_history_tb h ON b.id = h.bug_id--ok
                JOIN mantis.mantis_user_tb p ON b.handler_id = p.id--OK
                WHERE h.field_name='status' and (h.new_value='60' or h.new_value='80')
                AND b.status IN (80, 60, 90, 45)--ok
                and (f.value like '%Evolutiva%')
                AND trunc(DATE_MODIFIED) between '".$data_inicio."' AND '".$data_fim."'
                AND b.project_id =1502
                GROUP BY p.username, trunc(DATE_MODIFIED, 'MM')
                ORDER BY trunc(DATE_MODIFIED, 'MM') ASC
            ");
        return $query->result_array();
    }

    public function evolutiva_qtd($data_inicio,$data_fim) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
                SELECT p.username AS usuario, count(distinct(b.id)) AS qtd
                FROM mantis.mantis_bug_tb b
                LEFT JOIN mantis_custom_field_string_tb f on b.id = f.bug_id--ok
                JOIN mantis.mantis_bug_history_tb h ON b.id = h.bug_id--ok
                JOIN mantis.mantis_user_tb p ON b.handler_id = p.id--OK
                WHERE h.field_name='status' and (h.new_value='60' or h.new_value='80')
                AND b.status IN (80, 60, 90, 45)--ok
                and (f.value like '%Evolutiva%')
                AND trunc(DATE_MODIFIED, 'MM') between '".$data_inicio."' AND '".$data_fim."'
                AND b.project_id =1502
                GROUP BY p.username
                ORDER BY p.username
            ");
        return $query->result_array();
    }

}

/* End of file Graf_evolutiva_model.php */
/* Location: ./application/models/Graf_evolutiva_model.php */