<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamado_links extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
    // esta_logado();
    $this->load->model('link_model');
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
        <script src="' . base_url() . 'assets/custom/chamado_links.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/daterangepicker.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

          $session['username'] = $this->session->userdata('username');

          if(!$this->input->post('data1')) {
            $date = date("Y-m-10");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-1 month");
            $data_inicio = date('d-m-Y', $date);
            $data['data_inicio'] = date('d/m/Y', $date);
          } else {
            $datai = str_replace('/', '-', $this->input->post('data1'));
            $data_inicio = date("d-m-Y", strtotime($datai));
            $data['data_inicio'] = $this->input->post('data1');
          }

          if(!$this->input->post('data2')) {
            $data_final = date("09-m-Y");
            $data['data_final'] = date("d/m/Y", strtotime($data_final));
            //$data['mostra_dataf'] = $data_final;
          } else {
            $dataf = str_replace('/', '-', $this->input->post('data2'));
            $data_final = date("d-m-Y", strtotime($dataf));
            $data['data_final'] = $this->input->post('data2');
          }
          // vd($data_final);
          $data['chamados'] = $this->create_table($data_inicio,$data_final);
          $this->load->model('link_model');
          // $this->teste($data_inicio,$data_final);

          $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
          $this->breadcrumbs->push('<span>Link</span>','/link');
          $this->breadcrumbs->push('<span>Calculo de atendimento</span>','link/chamado_links');

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/chamado_links',$data);

          $this->load->view('template/footer',$script);
    }


    public function create_table($data_inicio,$data_final) {
      $chamados = $this->link_model->calculo_atendimento($data_inicio,$data_final);
      $html = "";
      $count = 0;
      foreach ($chamados as $chamado) {
          $html .= "<tr>\n";
          $html .= "<td>". $count++ ."</td>\n";
          $html .= "<td>".$chamado['MANTIS']."</td>\n";
          $html .= "<td>".$chamado['RESUMO']."</td>\n";
          $html .= "<td> <a href='http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=".htmlentities($chamado['TICKET'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank'  style='color: rgb(0,0,255)'><font color='374E9E' >".htmlentities($chamado['TICKET'], ENT_QUOTES, 'ISO-8859-1')." </font></a></td>\n";
          $html .= "<td>".$chamado['INICIO_CHAMADO']."</td>\n";
          $html .= "<td>".$chamado['FIM_CHAMADO']."</td>\n";
          $html .= "<td>".$chamado['CALCULO_HORAS']."</td>\n";
          $html .= "<td>".$chamado['RESPONSABILIDADE']."</td>\n";
      }
      return $html;
    }

    public function teste() {
      $data_inicio= '09-01-2019';
      $data_final = '10-02-2019';
      $chamados = $this->link_model->calculo_atendimento($data_inicio,$data_final);
      foreach ($chamados as $chamado) {
        echo $chamado['MANTIS'];
        echo $chamado['RESUMO'];
        echo $chamado['TICKET'];
        echo $chamado['INICIO_CHAMADO'];
        echo $chamado['FIM_CHAMADO'];
        echo $chamado['CALCULO_HORAS'];
        echo $chamado['RESPONSABILIDADE'];
      }
      // vd($chamados);
    }

}

/* End of file Chamado_links.php */
/* Location: ./application/controllers/links/Chamado_links.php */