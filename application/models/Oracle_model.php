<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oracle_model extends CI_Model{

//model construct function
    public function __construct() {
        parent::__construct();
        // $this->oracle_db=$this->load->database('oracle',true);
        // $this->mysql_db=$this->load->database('default',true);
        $oracle_db = $this->load->database('oracle',true); //connected with oracle
    }

    public function listar(){
        $oracle_db = $this->load->database('oracle',true); //connected with oracle
        //$oracle_db->distinct("celula");
        //$rows = array(); //will hold all results
        $oracle_db->select("distinct(celula) as setor");
        $query = $oracle_db->get('MANTIS.V_MANTIS_PROJECT_TB');
        return $query->result_array();
/*         foreach($query->result_array() as $row)
         {
             $rows['SETOR'] = $row; //add the fetched result to the result array;
         }

        return $rows; // returning rows, not row*/
    }

}