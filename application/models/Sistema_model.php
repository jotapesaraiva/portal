<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema_model extends CI_Model {

    public function modulos($group) {
        // $portal_db = $this->load->database('default',true);
        $this->db->select('*');
        $this->db->from('tbl_modulos');
        $this->db->where('grupos',$group);
        $query = $this->db->get();
        return $query;
    }


// SELECT g.nome_grupo, m.nome_modulo
// FROM tbl_permissao p
// JOIN tbl_grupos g ON g.id_grupo=p.id_grupo
// JOIN tbl_modulos m ON m.id_modulo=p.id_modulo
// WHERE g.nome_grupo = 'CGRE-Produção'

}

/* End of file Sistema_model.php */
/* Location: ./application/models/Sistema_model.php */