<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculo_multa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('month_helper');
        $this->load->model('link_model');
        esta_logado();
    }

    public function index() {
      $data['data_inicio'] = date_start_dez();
      $data['data_fim'] = date('d-m-Y');

      $css['headerinc'] = '
          <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
          <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
      $script['footerinc'] = '
          <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
          <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
          <script src="' . base_url() . 'assets/custom/links/calculo_multa.js" type="text/javascript"></script>
          <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
      $script['script'] = '
          <script src="' . base_url() . 'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>';

          $session['username'] = $this->session->userdata('username');

          $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
          $this->breadcrumbs->push('<span>Link</span>','/link');
          $this->breadcrumbs->push('<span>Calculo multa</span>','link/calculo_multa');

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/calculo_multa',$data);

          $this->load->view('template/footer',$script);
    }

    public function datatable_list($datai,$dataf){
      // Datatables Variables
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $datainicio = date("Y-m-d", strtotime($datai));
      $datafim = date("Y-m-d", strtotime($dataf));

      $calculos = $this->link_model->calculo($datainicio,$datafim);

      $data = array();
      foreach ($calculos->result_array() as $key => $value) {
          $row = array();
          $row[] = $key + 1;
          $row[] = $value['centro'];
          $row[] = "<a href='http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=".htmlentities($value['ticket'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank'  style='color: rgb(0,0,255)'><font color='374E9E' >".htmlentities($value['ticket'], ENT_QUOTES, 'ISO-8859-1')." </font></a>";
          $row[] = $value['abertura'];
          $row[] = $value['atualizacao'];
          // $row[] = date("d/m/Y H:i:s", $value['tempo_operadora']);
          $row[] = $value['tempo_operadora'];
          $row[] = $value['responsabilidade'];

          $data[] = $row;
      }
          $output = array (
              "draw"            => $draw,
              "recordsTotal"    => $calculos->num_rows(),
              "recordsFiltered" => $calculos->num_rows(),
              "data"            => $data,
          );
          echo json_encode($output);
    }

}

/* End of file Calculo_multa.php */
/* Location: ./application/controllers/links/Calculo_multa.php */