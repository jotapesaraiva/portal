<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos_model extends CI_Model {

    public function listar_contratos()
    {
        $default = $this->load->database('default', TRUE);
        $query = $default->get('tbl_contratos');
        return $query;
    }

    public function save_contrato($dados) {
        $portal_db = $this->load->database('default',true);
        $portal_db->insert('tbl_contratos', $dados);
        return $portal_db->insert_id();
    }

    public function edit_contrato($id)
    {
        # code...
    }

    public function update_contrato($dados,$id)
    {
        # code...
    }

    public function delete_contrato($id)
    {
        # code...
    }

}

/* End of file Contratos_model.php */
/* Location: ./application/models/Contratos_model.php */