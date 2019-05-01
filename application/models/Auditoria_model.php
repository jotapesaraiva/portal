<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditoria_model extends CI_Model {

    public function do_insert($dados=NULL, $redir=FALSE){
        if ($dados != NULL):
            $portal_db = $this->load->database('default',true);
            $portal_db ->insert('tbl_auditoria', $dados);
            if ($portal_db ->affected_rows()>0):
                set_msg('msgok', 'Cadastro efetuado com sucesso', 'sucesso');
            else:
                set_msg('msgerro','Erro ao inserir dados','erro');
            endif;
            // if ($redir) redirect(current_url());
        endif;
    }

     public function get_byid($id=NULL){
        if ($id != NULL):
            $portal_db = $this->load->database('default',true);
            $portal_db->where('id', $id);
            $portal_db->limit(1);
            return $portal_db->get('tbl_auditoria');
        else:
            return FALSE;
        endif;
    }

    public function get_all($limit=0){
        $portal_db = $this->load->database('default',true);
        if ($limit > 0) $portal_db->limit($limit);
        return $portal_db->get('tbl_auditoria');
    }

}

/* End of file Auditoria_model.php */
/* Location: ./application/models/Auditoria_model.php */