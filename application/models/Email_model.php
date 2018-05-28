<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //Load Dependencies
        // $portal_m = $this->load->database('portalm',true);
    }

    // List all your items
    public function indicador_email ($mes,$ano) {
        $portal_m = $this->load->database('portalm',true);
        $portal_m->select('month(data_coleta), sum(qtd_in) as total_in, sum(qtd_out) as total_out, sum(qtd_spam) as total_spam');
        $portal_m->from('tab_indicador_email');
        $portal_m->where('month(data_coleta)',$mes);
        $portal_m->where('year(data_coleta)', $ano);
        $portal_m->group_by('month(data_coleta)');
        $query = $portal_m->get();
        return $query->row_array();

    }

    // Add a new item
    public function consulta_banco($mes,$ano) {
        $portal_m = $this->load->database('portalm',true);
        $portal_m->select('*');
        $portal_m->from('tab_indicador_email');
        $portal_m->where('month(data_coleta)', $mes);
        $portal_m->Where('year(data_coleta)', $ano);
        $query = $portal_m->get();
        return $query->result_array();
    }

    //Update one item
    public function update( $id = NULL ) {

    }

    //Delete one item
    public function delete( $id = NULL ) {

    }
}

/* End of file Email_model.php */
/* Location: ./application/models/Email_model.php */
