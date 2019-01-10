<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos_model extends CI_Model {

    public function site_modulo($modulo) {
        $portal = $this->load->database('default',true);
        $portal->select('status');
        $portal->from('mdl_site');
        $portal->where('aplicacao', $modulo);
        $query = $portal->get();
        // echo $portal->last_query();
        return $query->result_array();
    }

}

/* End of file Modulos_model.php */
/* Location: ./application/models/Modulos_model.php */