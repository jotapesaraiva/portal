<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph_cgps extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
    }

    public function index() {
        $this->load->model('mantis_model');
        $result = $this->mantis_model->graf_resolvido_d();
        vd($result);
    }

    public function teste() {
        // $array = array("hello", "fine", "good", "fine", "hello", "bye");

        // $get_sorted_unique_array = array_values(array_unique($array));
        // vd($get_sorted_unique_array);
        $this->load->model('mantis_model');
        $result = $this->mantis_model->graf_resolvido_d();
        vd($result);
    }

}

/* End of file Graph_cgps.php */
/* Location: ./application/controllers/dash/Graph_cgps.php */