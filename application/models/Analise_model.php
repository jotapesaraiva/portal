<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analise_model extends CI_Model {


    public function evolutiva($value){
        $mantis = $this->load->database('mantis',TRUE);
        $sql="
        SELECT DISTINCT(b.id),b.summary,b.status,s.status_description,p.name,b.category,f2.value as SOLICITANTE,u.username,b.DATE_SUBMITTED,b.PRIORITY,b.LAST_UPDATED
        FROM mantis.mantis_bug_tb b
        JOIN mantis.mantis_project_tb p ON b.project_id = p.id
        LEFT JOIN mantis.mantis_user_tb u ON b.HANDLER_ID = u.id
        JOIN mantis_custom_field_string_tb f2 on b.id = f2.bug_id and f2.field_id = 1181
        JOIN MANTIS.MANTIS_BUG_STATUS_TB s ON b.status = s.status
        left join mantis_custom_field_string_tb f on b.id = f.bug_id";
        if($value == 'Pendentes'){
            $sql .= " WHERE  b.STATUS IN (10,15,20,30,40,50) and p.name in ('Demandas','Sustentação')";
        } else{
            $sql .= " WHERE  b.STATUS IN (45,60,80,90) and p.name in ('Demandas','Sustentação')";
        }
        $sql .= " AND (f.value like '%Evolutiva%')
                order by b.LAST_UPDATED DESC";
    // $stmt = oci_parse($mantis->conn_id,$sql);
    // oci_execute($stmt, OCI_NO_AUTO_COMMIT);
    // oci_fetch_all($stmt, $res,null, null, OCI_FETCHSTATEMENT_BY_ROW);//cria array apartir das linhas
    // return $res;
    return $mantis->query($sql);
    }

}

/* End of file Analise_model.php */
/* Location: ./application/models/Analise_model.php */