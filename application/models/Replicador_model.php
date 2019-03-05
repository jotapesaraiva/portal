<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replicador_model extends CI_Model {

     public function replicador() {
        $monitora = $this->load->database('monitora',TRUE);
        $sql ="SELECT (((TCR_DATA_EXEC - DATE'1970-01-01')*86400) + 10800) AS DATA
                 FROM TAB_CONTROLE_REPLICADOR@CORP.SEFA.PA.GOV.BR
                WHERE TCR_COD_UNIDADE = 35";
        return $monitora->query($sql);
    }

    public function replicador_full() {
        $monitora = $this->load->database('monitora',TRUE);
        $sql ="SELECT *
                 FROM TAB_CONTROLE_REPLICADOR@CORP.SEFA.PA.GOV.BR
                WHERE TCR_COD_UNIDADE = 35";
        return $monitora->query($sql);
    }

    public function renvia() {
        $monitora = $this->load->database('monitora',TRUE);
        $sql = "SELECT TEMPO
                FROM (
                    SELECT DECODE(GROUPING(lpad(a.TAR_COD_AGENTE, 3, 0) || '-' || rpad(a.tar_nom_agente, 20)), 1, 'RECEPÇÃO ONLINE', lpad(a.TAR_COD_AGENTE, 3, 0) || '-' || rpad(a.tar_nom_agente, 20)) AS ORIGEM,
                    TO_CHAR(MAX(p.tpo_fec_recepcao), 'dd/mm/yy hh24:mi:ss') AS ULTIMA,
                              MAX(p.tpo_fec_recepcao) AS ULTIMA2,
                    --TRUNC(SYSDATE - MAX(p.tpo_fec_recepcao)) || ' dias ' || TO_CHAR(to_date('00-00-00', 'hh24:mi:ss') + to_number(SYSDATE - MAX(p.tpo_fec_recepcao)),'hh24:mi:ss') AS TEMPO,
                    (((MAX( p.tpo_fec_recepcao) - DATE'1970-01-01')*86400) + 10800) AS TEMPO,
                            SUM(DECODE(TRUNC(p.tpo_fec_recepcao), TRUNC(SYSDATE), 1, 0)) AS NODIA,
                                             COUNT(*) AS NASEMANA,
                                                    0 AS ERROS
                         FROM tab_protocolo_pagos_online@corp.sefa.pa.gov.br p, tab_agente_recaudador@corp.sefa.pa.gov.br a
                         WHERE p.tpo_fec_recepcao > TRUNC(SYSDATE) - 7
                           AND a.tar_cod_agente = p.tpo_codigobanco
                      GROUP BY CUBE(lpad(a.TAR_COD_AGENTE, 3, 0) || '-' || rpad(a.tar_nom_agente, 20))

                      ) WHERE origem = 'RECEPÇÃO ONLINE'";
        return $monitora->query($sql);
    }

    public function renvia_full() {
        $monitora = $this->load->database('monitora',TRUE);
        $sql = "SELECT DECODE(GROUPING(lpad(a.TAR_COD_AGENTE, 3, 0) || '-' || rpad(a.tar_nom_agente, 20)), 1, 'RECEPÇÃO ONLINE', lpad(a.TAR_COD_AGENTE, 3, 0) || '-' || rpad(a.tar_nom_agente, 20)) AS ORIGEM,
                    TO_CHAR(MAX(p.tpo_fec_recepcao), 'dd/mm/yy hh24:mi:ss') AS ULTIMA,
                              MAX(p.tpo_fec_recepcao) AS ULTIMA2,
                    TRUNC(SYSDATE - MAX(p.tpo_fec_recepcao)) || ' dias ' || TO_CHAR(to_date('00-00-00', 'hh24:mi:ss') + to_number(SYSDATE - MAX(p.tpo_fec_recepcao)),'hh24:mi:ss') AS TEMPO,
                            SUM(DECODE(TRUNC(p.tpo_fec_recepcao), TRUNC(SYSDATE), 1, 0)) AS NODIA,
                                             COUNT(*) AS NASEMANA,
                                                    0 AS ERROS
                         FROM tab_protocolo_pagos_online@corp.sefa.pa.gov.br p, tab_agente_recaudador@corp.sefa.pa.gov.br a
                         WHERE p.tpo_fec_recepcao > TRUNC(SYSDATE) - 7
                           AND a.tar_cod_agente = p.tpo_codigobanco
                      GROUP BY CUBE(lpad(a.TAR_COD_AGENTE, 3, 0) || '-' || rpad(a.tar_nom_agente, 20))";
        return $monitora->query($sql);
    }

}

/* End of file Replicador_model.php */
/* Location: ./application/models/Replicador_model.php */