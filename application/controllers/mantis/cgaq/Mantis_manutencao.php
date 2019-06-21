<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantis_manutencao extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('mantis_model');
        $this->load->helper('month_helper');
    }

    public function index(){
        $data['data_inicio'] = date_start_traco();
        $data['data_fim'] = date('d-m-Y');

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/mantis/manutencao.js" type="text/javascript"></script>';
        $script['script'] = '
            <script src="' . base_url() . 'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Mantis</span>','/mantis');
        $this->breadcrumbs->push('<span>Manutenção</span>','mantis/manutencao');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('mantis/manutencao',$data);

        $this->load->view('template/footer',$script);
    }

    public function datatable_list($datai,$dataf){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $manutencao = $this->mantis_model->chamado_manutencao($datai,$dataf);

        $data = array();
        foreach ($manutencao->result_array() as $key => $manu) {
            $row = array();
            $row[] = $key + 1;
            $row[] = "<a href = 'http://intranet.sefa.pa.gov.br/mantis/view.php?id=".$manu['MANTIS']." 'target='_blank'> ".$manu['MANTIS']." </a>";
            $row[] = $manu['RESUMO'];
            $row[] = $manu['CATEGORIA'];
            $row[] = $manu['TECNICO'];
            $row[] = $manu['INICIO_CHAMADO'];
            $row[] = $manu['FIM_CHAMADO'];
            $row[] = $manu['TEMPO_ATENDIMENTO'];
            $row[] = $manu['LOCALIDADE'];

            $data[] = $row;
        }
            $output = array (
                "draw"            => $draw,
                "recordsTotal"    => $manutencao->num_rows(),
                "recordsFiltered" => $manutencao->num_rows(),
                "data"            => $data,
            );
            echo json_encode($output);
    }

}