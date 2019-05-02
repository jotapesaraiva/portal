<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analise_model extends CI_Model {


    public function evolutiva($value){
        // $mantis = $this->load->database('mantis',TRUE);
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
    return $this->db->query($sql);
    }

    public function projetos($value){
        // $mantis = $this->load->database('mantis',TRUE);
        $sql="
        SELECT DISTINCT(b.ID), b.SUMMARY, b.STATUS, b.STATUS_DESCRIPTION, b.NAME, b.CATEGORY, b.USERNAME, b.DATE_SUBMITTED, b.PRIORITY, b.SOLICITANTE, c.PLANEJADO, bb.PRIORIZADO
        FROM (
            SELECT b.id,b.summary,b.status,s.status_description,p.name,b.category,u.username,b.DATE_SUBMITTED,b.PRIORITY, f2.value SOLICITANTE
            FROM mantis.mantis_bug_tb b
            JOIN mantis.mantis_project_tb p ON b.project_id = p.id
            LEFT JOIN mantis.mantis_user_tb u ON b.HANDLER_ID = u.id
            JOIN mantis_custom_field_string_tb f2 ON b.id = f2.bug_id AND f2.field_id = 1181
            JOIN MANTIS.MANTIS_BUG_STATUS_TB s ON b.status = s.status
            LEFT JOIN mantis_custom_field_string_tb f ON b.id = f.bug_id
            WHERE p.name in ('Operação Assistida')
            ) b
        LEFT JOIN (
            SELECT BUG_ID, VALUE AS priorizado
            FROM MANTIS.Mantis_Custom_Field_String_Tb
            WHERE field_id = '3101'
            AND VALUE = 'Sim' ) bb ON b.id = bb.bug_id
        LEFT JOIN (
            SELECT BUG_ID, VALUE AS planejado
            FROM MANTIS.Mantis_Custom_Field_String_Tb
            WHERE field_id = '2621' ) c ON b.id = c.bug_id";
        if($value == 'Pendentes'){
            $sql .= " WHERE b.STATUS IN (10,15,20,40,50,70,30)";
        } else{
            $sql .= " WHERE b.STATUS NOT IN (10,15,20,40,50,70,30)";
        }
        $sql .= " ORDER BY b.id DESC";
    return $this->db->query($sql);
    }

    public function sustentacao($value) {
        // $mantis = $this->load->database('mantis', TRUE);
        $sql = "
         SELECT b.ID, b.SUMMARY, b.STATUS, b.STATUS_DESCRIPTION, b.NAME, b.CATEGORY, b.USERNAME, b.DATE_SUBMITTED, b.PRIORITY, b.SOLICITANTE, c.PLANEJADO, bb.PRIORIZADO
           FROM (
                SELECT b.id,b.summary,b.status,s.status_description,p.name,b.category,u.username,b.DATE_SUBMITTED,b.PRIORITY, f2.value SOLICITANTE
                FROM mantis.mantis_bug_tb b
                JOIN mantis.mantis_project_tb p ON b.project_id = p.id
                LEFT JOIN mantis.mantis_user_tb u ON b.HANDLER_ID = u.id
                JOIN mantis_custom_field_string_tb f2 ON b.id = f2.bug_id AND f2.field_id = 1181
                JOIN MANTIS.MANTIS_BUG_STATUS_TB s ON b.status = s.status
                LEFT JOIN mantis_custom_field_string_tb f ON b.id = f.bug_id
                WHERE  p.name IN ('Demandas','Sustentação')
                AND (f.value LIKE '%Corretiva%' OR f.value LIKE 'Suporte')
            ) b
            LEFT JOIN (
                SELECT BUG_ID, VALUE AS priorizado
                FROM MANTIS.Mantis_Custom_Field_String_Tb
                WHERE field_id = '3101'
                AND VALUE = 'Sim') bb ON b.id = bb.bug_id
            LEFT JOIN (
                SELECT BUG_ID, VALUE AS planejado
                FROM MANTIS.Mantis_Custom_Field_String_Tb
                WHERE field_id = '2621') c ON b.id = c.bug_id";
        if($value == 'Pendentes'){
            $sql .= " WHERE b.STATUS IN (10,15,20,40,50,30)"  ;
        }else{
            $sql .= " WHERE b.STATUS NOT IN (10,15,20,40,50,70,30)";
        }
        return $this->db->query($sql);
    }


    public function consulta_status() {
        // $mantis = $this->load->database('mantis',TRUE);
        $sql = "SELECT * from mantis.mantis_bug_status_tb";
        return $this->db->query($sql);
    }

}

/* End of file Analise_model.php */
/* Location: ./application/models/Analise_model.php */