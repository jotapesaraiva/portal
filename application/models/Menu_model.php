<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function realizado_prioridade($data_inicio,$data_fim,$equipe) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
        SELECT distinct(username), sum(IMEDIATO) IMEDIATO, sum(URGENTE) URGENTE, sum(ALTA) ALTA, sum(NORMAL) NORMAL, sum(TOTAL) TOTAL from
                (SELECT  username,
                      CASE WHEN b.PRIORITY = 60 THEN count(distinct(b.ID)) ELSE 0 END AS IMEDIATO,
                      CASE WHEN b.PRIORITY = 50 THEN count(distinct(b.ID)) ELSE 0 END AS URGENTE,
                      CASE WHEN b.PRIORITY = 40 THEN count(distinct(b.ID)) ELSE 0 END AS ALTA,
                      CASE WHEN b.PRIORITY = 30 THEN count(distinct(b.ID)) ELSE 0 END AS NORMAL,
                      count(b.ID) AS TOTAL
                FROM mantis.mantis_bug_tb b
                JOIN mantis.mantis_bug_history_tb h ON b.id = h.bug_id
                JOIN mantis.mantis_user_tb u ON h.USER_ID = u.id
                WHERE h.field_name='status'
                AND (h.old_value='50'
                AND h.new_value='60')
                AND b.STATUS IN (60,80)
                AND b.project_id IN (   SELECT A.ID
                                        FROM mantis_project_tb a
                                        LEFT JOIN mantis_project_hierarchy_tb b ON a.id = b.child_id
                                        WHERE A.ENABLED = 1
                                        start with a.id in (".$equipe.")
                                        connect by b.parent_id = prior a.id)
                AND DATE_SUBMITTED BETWEEN '".$data_inicio."' AND add_months('".$data_fim."',1)
                GROUP BY username, b.PRIORITY)
        GROUP BY username
        ORDER BY total DESC
        ");
        return $query->result_array();
    }


    public function mantis_atribuito($username){
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
            SELECT mbt.id, mbp.priority_description as numero, mbt.status, mbt.summary || ' ' || mbt.category || ' ' || mbt.date_submitted as mantis
            FROM mantis.mantis_bug_tb mbt
            JOIN mantis.mantis_user_tb mut ON mut.id = mbt.handler_id
            JOIN mantis.mantis_bug_priority_tb mbp ON mbp.priority = mbt.priority
            WHERE mut.username = '".$username."'
            AND mbt.status NOT IN (80,90)
            ");
        return $query->result_array();
    }

    public function minhas_tarefas($username) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
        SELECT count(mbt.id) as tarefas
        FROM mantis.mantis_bug_tb mbt
        JOIN mantis.mantis_user_tb mut ON mut.id = mbt.handler_id
        JOIN mantis.mantis_bug_priority_tb mbp ON mbp.priority = mbt.priority
        WHERE mut.username = '".$username."'
        AND mbt.status NOT IN (80,90)
            ");
        return $query->row();
    }

    public function score_mantis($username) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
            SELECT SUM(ABERTOS) ABERTOS, SUM(IMPEDIDOS) IMPEDIDOS, SUM(REALIZADOS) REALIZADOS
            FROM(
              SELECT
                  case when mbt.status IN(10,15,40,45,50) then count(distinct(mbt.ID)) else 0 END AS ABERTOS,
                  case when mbt.status IN(20,30) then count(distinct(mbt.ID)) else 0 END AS IMPEDIDOS,
                  case when mbt.status IN(60,70,80,90) then count(distinct(mbt.ID)) else 0 END AS REALIZADOS
              FROM mantis.mantis_bug_tb mbt
              JOIN mantis.mantis_user_tb mut ON mut.id = mbt.handler_id
              WHERE mut.username = '".$username."'
              GROUP BY mbt.status
              )
            ");
        return $query->row();
    }

    public function top_servicos($data_inicio,$data_fim,$equipe){
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
        SELECT rownum, SERVICO, Qtd_Mantis
        FROM (SELECT b.PROJECT_ID as Projetos, COUNT(b.ID) as Qtd_Mantis, p.name as SERVICO
            FROM mantis.mantis_bug_tb b
            JOIN mantis.mantis_project_tb p ON p.ID = b.PROJECT_ID
            WHERE b.PROJECT_ID IN (
                          SELECT A.ID
                          FROM mantis_project_tb a
                          LEFT JOIN mantis_project_hierarchy_tb b ON a.id = b.child_id
                          WHERE A.ENABLED = 1
                          start with a.id in (".$equipe.")
                          connect by b.parent_id = prior a.id
            )
            AND b.DATE_SUBMITTED  BETWEEN '".$data_inicio."' AND add_months('".$data_fim."',1)
            GROUP BY b.PROJECT_ID, p.name
            ORDER BY Qtd_mantis desc)
        WHERE rownum <= 10
            ");
        return $query->result_array();
    }

    public function top_categoria($data_inicio,$data_fim,$equipe)
    {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
            SELECT rownum, CATEGORIA, Qtd_Mantis
            from (SELECT CATEGORY as CATEGORIA, COUNT(ID) as Qtd_Mantis
                 from mantis.mantis_bug_tb
                 where PROJECT_ID in (
                              SELECT A.ID
                              FROM mantis_project_tb a
                              LEFT JOIN mantis_project_hierarchy_tb b ON a.id = b.child_id
                              WHERE A.ENABLED = 1
                              start with a.id in (".$equipe.")
                              connect by b.parent_id = prior a.id
                 )
                 and DATE_SUBMITTED between '".$data_inicio."' AND add_months('".$data_fim."',1)
                 GROUP BY CATEGORY
                 order by Qtd_mantis desc)
            where rownum <= 10
            ");
        return $query->result_array();
    }

    public function top_abertos($data_inicio,$data_fim,$equipe) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
            SELECT rownum, CATEGORIA, Qtd_Mantis
            from (SELECT CATEGORY as CATEGORIA, COUNT(ID) as Qtd_Mantis
                 from mantis.mantis_bug_tb
                 where PROJECT_ID in (
                              SELECT A.ID
                              FROM mantis_project_tb a
                              LEFT JOIN mantis_project_hierarchy_tb b ON a.id = b.child_id
                              WHERE A.ENABLED = 1
                              start with a.id in (".$equipe.")
                              connect by b.parent_id = prior a.id
                 )
                 and DATE_SUBMITTED  between '".$data_inicio."' AND add_months('".$data_fim."',1)
                 and status in (10,20,40,45,50,15,30)
                 GROUP BY CATEGORY
                 order by Qtd_mantis desc)
            where rownum <= 10
            ");
        return $query->result_array();
    }

}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */