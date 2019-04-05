<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resolvidos_model extends CI_Model {

    public function usuarios($data_inicio, $data_fim){
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
            SELECT p.username AS usuario, trunc(DATE_MODIFIED) AS data, count(*) AS qtd
            FROM mantis.mantis_bug_tb b
            LEFT JOIN mantis_custom_field_string_tb f on b.id = f.bug_id--ok
            JOIN mantis.mantis_bug_history_tb h ON b.id = h.bug_id--ok
            JOIN mantis.mantis_user_tb p ON b.handler_id = p.id--OK
            WHERE h.field_name='status' and (h.old_value='50' and h.new_value='60')--ok
            AND b.status IN (80, 60, 90, 45, 70)--ok
            AND (f.value LIKE 'Suporte' OR f.value LIKE '%Corretiva%')--ok
            AND trunc(DATE_MODIFIED)  between '".$data_inicio."' AND '".$data_fim."'--ok
            AND b.project_id =1502
            GROUP BY p.username, trunc(DATE_MODIFIED)
            ORDER BY trunc(DATE_MODIFIED) ASC
            ");
            // SELECT p.username AS usuario, TO_DATE(b.last_updated, 'dd/mm/yy') AS data, count(*) AS qtd
            // FROM mantis.mantis_bug_tb b
            // LEFT JOIN mantis_custom_field_string_tb f on b.id = f.bug_id
            // JOIN mantis.mantis_user_tb p ON b.handler_id = p.id
            // WHERE b.project_id = 1502
            // AND b.status IN (80, 60, 90, 45, 70)
            // AND (f.value LIKE 'Suporte' OR f.value LIKE '%Corretiva%')
            // AND TO_DATE(b.last_updated, 'dd/mm/yy') BETWEEN '".$data_inicio."' AND '".$data_fim."'
            // GROUP BY p.username, TO_DATE(b.last_updated, 'dd/mm/yy')
            // ORDER BY TO_DATE(b.last_updated, 'dd/mm/yy') ASC
        // echo $portal_ora->last_query();
        return $query->result_array();
    }

    public function nome_usuario($data_inicio,$data_fim) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
            SELECT p.username AS usuario, count(*) AS qtd
            FROM mantis.mantis_bug_tb b
            LEFT JOIN mantis_custom_field_string_tb f on b.id = f.bug_id--ok
            JOIN mantis.mantis_bug_history_tb h ON b.id = h.bug_id--ok
            JOIN mantis.mantis_user_tb p ON b.handler_id = p.id--OK
            WHERE h.field_name='status' and (h.old_value='50' and h.new_value='60')--ok
            AND b.status IN (80, 60, 90, 45, 70)--ok
            AND (f.value LIKE 'Suporte' OR f.value LIKE '%Corretiva%')--ok
            AND trunc(DATE_MODIFIED)  between '".$data_inicio."' AND '".$data_fim."'--ok
            AND b.project_id =1502
            GROUP BY p.username
            ORDER BY p.username
            ");
            // SELECT p.username AS usuario, count(*) AS qtd
            // FROM mantis.mantis_bug_tb b
            // LEFT JOIN mantis_custom_field_string_tb f on b.id = f.bug_id
            // JOIN mantis.mantis_user_tb p ON b.handler_id = p.id
            // WHERE b.project_id IN (
            //   SELECT A.ID
            //   FROM mantis_project_tb a
            //   LEFT JOIN mantis_project_hierarchy_tb b
            //   ON a.id = b.child_id
            //   WHERE A.ENABLED = 1
            //  start with a.id = 341
            // connect by b.parent_id = prior a.id
            // )
            // AND b.status IN (80, 60, 90, 45, 70)
            // AND (f.value LIKE 'Suporte' OR f.value LIKE '%Corretiva%')
            // AND TO_DATE(b.last_updated, 'dd/mm/yy') between '".$data_inicio."' and '".$data_fim."'
            // GROUP BY p.username
            // ORDER BY p.username
        // echo $portal_ora->last_query();
        return $query->result_array();
    }

}

/* End of file Resolvidos_model.php */
/* Location: ./application/models/Resolvidos_model.php */