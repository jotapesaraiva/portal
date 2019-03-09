<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projetos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('analise_model');
        $this->load->helper('color_mantis');
        $this->load->helper('priority_mantis');
    }

    public function index() {
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/mantis/projetos.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/daterangepicker.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Mantis</span>','/mantis');
        $this->breadcrumbs->push('<span>Evolutiva</span>','mantis/projetos');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('mantis/projetos');

        $this->load->view('template/footer',$script);
    }

    public function datatable_list($value){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $projetos = $this->analise_model->projetos($value);

        $data = array();
        // $cont = 1;
        foreach ($projetos->result_array() as $proj) {
            $row = array();
            // $row[] = $cont++;
            $row[] = "<a href = 'http://intranet.sefa.pa.gov.br/mantis/view.php?id=".$proj['ID']." 'target='_blank'> ".$proj['ID']." </a>";
            $row[] = $proj['DATE_SUBMITTED'];
            // $proj['STATUS']
            $row[] = '<a class="label label-'.color_mantis($proj['STATUS']).'">'.$proj['STATUS_DESCRIPTION'].'</a>';
            $row[] = '<a class="label label-'.priority_mantis($proj['PRIORITY']).'">'.priority_mantis($proj['PRIORITY']).'</a>';
            $row[] = $proj['SUMMARY'];
            $row[] = $proj['CATEGORY'];
            $row[] = $proj['USERNAME'];
            $row[] = $proj['SOLICITANTE'];
            $row[] = $proj['PLANEJADO'];
            $row[] = $proj['PRIORIZADO'];
            $data[] = $row;
        }
            $output = array (
                "draw"            => $draw,
                "recordsTotal"    => $projetos->num_rows(),
                "recordsFiltered" => $projetos->num_rows(),
                "data"            => $data,
            );
            echo json_encode($output);
    }

}

/* End of file Projetos.php */
/* Location: ./application/controllers/mantis/Projetos.php */