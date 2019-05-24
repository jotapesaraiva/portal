<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alertas_model extends CI_Model {

    public function select_alerta() {
        // $default = $this->load->database('default',true);
        $this->db->select('a.*, g.nome_grupo');
        $this->db->from('tbl_manutencao a');
        $this->db->join('tbl_grupos g', 'g.id_grupo= a.id_grupo');
        // $this->db->where('Month(a.data_inicio_manutencao) <= Month(now() + interval 1 month)');
        $this->db->where('STR_TO_DATE(a.data_inicio_manutencao, "%Y-%m-%d %T" ) <= NOW()');
        $this->db->where('STR_TO_DATE(a.data_fim_manutencao, "%Y-%m-%d %T" ) >= NOW()');
        $query = $this->db->get();
        return $query;
    }

}

/* End of file Alertas_model.php */
/* Location: ./application/models/Alertas_model.php */