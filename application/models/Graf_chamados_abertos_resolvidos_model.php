<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graf_chamados_abertos_resolvidos_model extends CI_Model {

    public function abertos_resolvidos($data_inicio,$data_fim) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query(
            "select data,
            sum(TOTAL_RESOLVIDO) RESOLVIDO,
            sum(TOTAL_ABERTOS) ABERTOS
            from (
                 SELECT
                 trunc(b.DATE_SUBMITTED) as data,
                 count(distinct(b.id))AS TOTAL_ABERTOS,
                 case when b.STATUS IN (80,60,90,45) then count(b.id) else 0 END AS TOTAL_RESOLVIDO
                 FROM mantis.mantis_bug_tb b
                 join mantis_custom_field_string_tb f on b.id = f.bug_id
                 WHERE trunc(b.DATE_SUBMITTED) between '".$data_inicio."' and '".$data_fim."'
                  AND (f.value like 'Suporte' or f.value like '%Corretiva%')
                and (CATEGORY != 'Arquitetura' OR CATEGORY != 'Projeto')
                AND b.project_id = 1502
                group by trunc(b.DATE_SUBMITTED),b.STATUS)
            group by data
            order by data");
             return $query->result_array();
    }

}

/* End of file Graf_chamados_abertos_resolvidos_model.php */
/* Location: ./application/models/Graf_chamados_abertos_resolvidos_model.php */