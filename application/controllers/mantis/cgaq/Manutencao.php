<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('mantis_model');
        $this->load->helper('month_helper');
    }

    public function index(){
         // $data['data_inicio'] = date_start_traco();
         // $data['data_fim'] = date('d-m-Y');

        if(!$this->input->post('data_inicio')):
            $data_inicio = date_start();
            $data['data_inicio'] = date_start();
        else:
            $datai = str_replace('/', '-', $this->input->post('data_inicio'));
            $data_inicio = date("d/m/Y", strtotime($datai));
            $data['data_inicio'] = $this->input->post('data_inicio');
        endif;
        if(!$this->input->post('data_fim')):
            $data_fim = date('d/m/Y');
            $data['data_fim'] = date('d/m/Y');
        else:
            $dataf = str_replace('/', '-', $this->input->post('data_fim'));
            $data_fim = date("d/m/Y", strtotime($dataf));
            $data['data_fim'] = $this->input->post('data_fim');
        endif;

        $data['calculo'] = $this->create_table($data_inicio,$data_fim);

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';

        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/historico.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/daterangepicker.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

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

    public function create_table($datai,$dataf){

        $manutencao = $this->mantis_model->chamado_manutencao($datai,$dataf);

        $html = "";
        foreach ($manutencao->result_array() as $key => $manu) {
            $html .= "<tr>\n";
            $html .= "<td>". ($key + 1) ."</td>\n";
            $html .= "<td> <a href = 'http://intranet.sefa.pa.gov.br/mantis/view.php?id=".$manu['MANTIS']." 'target='_blank'> ".$manu['MANTIS']." </a> </td>\n";
            $html .= "<td>" .$manu['RESUMO']. "</td>\n";
            $html .= "<td>" .$manu['CATEGORIA']. "</td>\n";
            $html .= "<td>" .$manu['TECNICO']. "</td>\n";
            $html .= "<td>" .$manu['INICIO_CHAMADO']. "</td>\n";
            $html .= "<td>" .$manu['FIM_CHAMADO']. "</td>\n";
            $html .= "<td>" .$manu['TEMPO_ATENDIMENTO']. "</td>\n";
            $html .= "<td>" .$manu['LOCALIDADE']. "</td>\n";
            $html .= "</tr>\n";
        }
        return $html;
    }


    public function datatable_list_old($datai,$dataf){
        // $datai = $this->input->post('data_inicio');
        // $dataf = $this->input->post('data_fim');
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $manutencao = $this->mantis_model->chamado_manutencao($datai,$dataf);

        $data = array();
        $cont = 1;
        foreach ($manutencao->result_array() as $manu) {
            $row = array();
            $row[] = $cont++;
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