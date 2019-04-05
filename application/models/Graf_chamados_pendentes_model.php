<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graf_chamados_pendentes_model extends CI_Model {

  public function chamados_pendentes($ano) {
             $portal_m = $this->load->database('mantis',true);
             $query = $portal_m->query("
              SELECT TO_CHAR(TO_DATE(periodo, 'YYYYMM'), 'MM') as MES,
                     PROJETOS,
                     SUSTENTACAO,
                     EVOLUTIVA
              FROM mantis.tab_graf_qtd_mantis
              WHERE  TO_CHAR(TO_DATE(periodo, 'YYYYMM'), 'YYYY') = ".$ano."
              UNION
                SELECT TO_CHAR(TRUNC(SYSDATE,'MM'), 'MM') MES, A.*
                  FROM (SELECT *
                          FROM (SELECT COUNT(*) AS VALOR_1, P.NAME AS NAME_1
                                  FROM MANTIS.MANTIS_BUG_TB B
                                  JOIN MANTIS.MANTIS_PROJECT_TB P
                                    ON B.PROJECT_ID = P.ID
                                  LEFT JOIN MANTIS.MANTIS_USER_TB U
                                    ON B.HANDLER_ID = U.ID
                                  JOIN MANTIS.MANTIS_BUG_STATUS_TB S
                                    ON B.STATUS = S.STATUS
                                  LEFT JOIN MANTIS_CUSTOM_FIELD_STRING_TB F
                                    ON B.ID = F.BUG_ID
                                 WHERE B.STATUS IN (10,15, 20,30, 40,50)
                                   AND B.PROJECT_ID IN (1502, 4121)
                                   AND (F.VALUE LIKE decode(b.project_id,1502,'%Corretiva%','%Manutenção%') OR
                                       F.VALUE LIKE 'Suporte')
                                 GROUP BY P.NAME
                           UNION
                                SELECT COUNT(*) AS VALOR, 'evolutiva'
                                  FROM MANTIS.MANTIS_BUG_TB B
                                  JOIN MANTIS.MANTIS_PROJECT_TB P
                                    ON B.PROJECT_ID = P.ID
                                  LEFT JOIN MANTIS.MANTIS_USER_TB U
                                    ON B.HANDLER_ID = U.ID
                                  JOIN MANTIS.MANTIS_BUG_STATUS_TB S
                                    ON B.STATUS = S.STATUS
                                  LEFT JOIN MANTIS_CUSTOM_FIELD_STRING_TB F
                                    ON B.ID = F.BUG_ID
                                 WHERE B.STATUS IN (10, 15, 20,30, 40, 50)
                                   AND B.PROJECT_ID IN (1502)
                                   AND F.VALUE LIKE '%Evolutiva%')
                        PIVOT(SUM(VALOR_1)
                           FOR(NAME_1) IN('Projetos/Man.Assistida' AS PROJETOS,
                                         'Sustentação' AS SUSTENTACAO,
                                         'evolutiva' AS EVOLUTIVA))) A
                                         order by MES asc
              ");
             return $query->result_array();

  }
}
/* End of file Graf_chamados_pendentes_model.php */
/* Location: ./application/models/Graf_chamados_pendentes_model.php */