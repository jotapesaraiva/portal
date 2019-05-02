<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servico_model extends CI_Model {

    public function listar_servico(){
        return $this->db->get('tbl_servico');

    }
}

/* End of file Servico_model.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp56966/var/www/html/portal/frontend/models/Servico_model.php */