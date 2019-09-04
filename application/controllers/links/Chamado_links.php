<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamado_links extends CI_Controller {

  public function __construct() {
    parent::__construct();
    //Do your magic here
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
      <script src="' . base_url() . 'assets/custom/links/chamado_links.js" type="text/javascript"></script>
      <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
      $script['script'] = '
      <script src="' . base_url() . 'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>';

      $session['username'] = $this->session->userdata('username');

      $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
      $this->breadcrumbs->push('<span>Link</span>','/link');
      $this->breadcrumbs->push('<span>Calculo de atendimento</span>','link/chamado_links');

      $this->load->view('template/header',$css);
      $this->load->view('template/navbar',$session);
      $this->load->view('template/sidebar');

      $this->load->view('link/chamado_links',$data);

      $this->load->view('template/footer',$script);
    }

    public function datatable_list($datai,$dataf){
      // Datatables Variables
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $chamados = $this->link_model->calculo_atendimento($datai,$dataf);

      $data = array();
      foreach ($chamados->result_array() as $key => $value) {
          $row = array();
          $row[] = $key + 1;
          $row[] = anchor_popup("http://intranet.sefa.pa.gov.br/mantis/view.php?id=".$value['MANTIS']."", $value['MANTIS']);
          $row[] = $value['RESUMO'];
          $row[] = $value['PROVEDOR'];
          $row[] = "<a href='http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=".htmlentities($value['TICKET'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank'  style='color: rgb(0,0,255)'><font color='374E9E' >".htmlentities($value['TICKET'], ENT_QUOTES, 'ISO-8859-1')." </font></a>";
          $row[] = $value['INICIO_CHAMADO'];
          $row[] = $value['FIM_CHAMADO'];
          $row[] = $value['CALCULO_HORAS'];
          $row[] = $value['RESPONSABILIDADE'];

          $data[] = $row;
      }
          $output = array (
              "draw"            => $draw,
              "recordsTotal"    => $chamados->num_rows(),
              "recordsFiltered" => $chamados->num_rows(),
              "data"            => $data,
          );
          echo json_encode($output);
    }

    public function teste(){
      $chamados = $this->link_model->calculo_atendimento(date_start_dez(),date_end());
      vd($chamados);
    }

}

/* End of file Chamado_links.php */
/* Location: ./application/controllers/links/Chamado_links.php */