<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos_model extends CI_Model {

    public function listar_ativos() {
        $default = $this->load->database('default', TRUE);
        $query = $default->get('tbl_ativos');
        return $query;
    }

    public function save_ativo($dados)
    {
        # code...
    }

    public function edit_ativo($id)
    {
        # code...
    }

    public function update_ativo($dados,$id)
    {
        # code...
    }

    public function delete_ativo($id)
    {
        # code...
    }

}

/* End of file Ativos_model.php */
/* Location: ./application/models/Ativos_model.php */