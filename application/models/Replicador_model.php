<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Replicador_model extends CI_Model {

     public function itinga() {
        $monitora = $this->load->database('monitora',TRUE);
        // $sql = "SELECT (TCR_DATA_EXEC - TO_DATE('01/01/1970','DD/MM/YYYY'))*86400 FROM TAB_CONTROLE_REPLICADOR@CORP.SEFA.PA.GOV.BR WHERE TCR_COD_UNIDADE = 35";
        $sql ="SELECT ((TCR_DATA_EXEC - DATE'1970-01-01')*86400) + 10800 AS DATA, TCR_DATA_EXEC FROM TAB_CONTROLE_REPLICADOR@CORP.SEFA.PA.GOV.BR WHERE TCR_COD_UNIDADE = 35";
        return $monitora->query($sql);
    }

}

/* End of file Replicador_model.php */
/* Location: ./application/models/Replicador_model.php */