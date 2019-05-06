<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evolutiva extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //Do your magic here
        esta_logado();
        $this->load->model('analise_model');
        $this->load->helper('color_mantis');
        $this->load->helper('priority_mantis');
    }

    public function index() {
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/custom/mantis/evolutiva.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Mantis</span>','/mantis');
        $this->breadcrumbs->push('<span>Evolutiva</span>','mantis/evolutiva');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('mantis/evolutiva');

        $this->load->view('template/footer',$script);
    }

    public function datatable_list($value){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $evolutivas = $this->analise_model->evolutiva($value);

        $data = array();
        foreach ($evolutivas->result_array() as $key => $evol) {
            $row = array();
            $row[] = $key++;
            $row[] = "<a href = 'http://intranet.sefa.pa.gov.br/mantis/view.php?id=".$evol['ID']." 'target='_blank'> ".$evol['ID']." </a>";
            // $row[] = $evol['DATE_SUBMITTED'];
            $row[] = $evol['LAST_UPDATED'];
            $row[] = '<a class="label label-'.color_mantis($evol['STATUS']).'">'.$evol['STATUS_DESCRIPTION'].'</a>';
            $row[] = '<a class="label label-'.priority_mantis($evol['PRIORITY']).'">'.priority_mantis($evol['PRIORITY']).'</a>';
            $row[] = $evol['SUMMARY'];
            $row[] = $evol['CATEGORY'];
            $row[] = $evol['USERNAME'];
            $row[] = $evol['SOLICITANTE'];
            // $row[] = $evol['NAME'];
            $data[] = $row;
        }
            $output = array (
                "draw"            => $draw,
                "recordsTotal"    => $evolutivas->num_rows(),
                "recordsFiltered" => $evolutivas->num_rows(),
                "data"            => $data,
            );
            echo json_encode($output);
    }
}

/* End of file Evolutiva.php */
/* Location: ./application/controllers/mantis/Evolutiva.php */