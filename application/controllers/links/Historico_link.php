<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_link extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

    public function index() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/links/historico_link.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

          $session['username'] = $this->session->userdata('username');

          $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
          $this->breadcrumbs->push('<span>Link</span>','/link');
          $this->breadcrumbs->push('<span>Histórico</span>','link/historico');

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/historico');

          $this->load->view('template/footer',$script);
    }

    public function datatable_list(){
      // Datatables Variables
      $trecho_link_grc = "http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=";
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $historicos = $this->link_model->historico();

      $data = array();
      foreach ($historicos->result_array() as $key => $value) {
          $row = array();
          $row[] = $key + 1;
          $row[] = "<a href='". $trecho_link_grc.$value['ticket'] ."' target='_blank' title='Ultima Posicao: ". utf8_encode($value['posicionamento']) ."' style='color: rgb(0,0,255)' > <font color='374E9E'>". $value['ticket'] ."</font> </a>";
          $row[] = utf8_encode($value['rec']);
          $row[] = utf8_encode($value['centro']);
          if($value['status'] == 'Fechado') {
            $row[] = "<a class='label label-success'>Fechado</a>";
          }else if($value['status'] == 'Transferido'){
            $row[] = "<a class='label label-warning'>Transferido</a>";
          } else {
            $row[] = "<a class='label label-info'>" .utf8_encode($value['status'])."</a>";
          }
          $row[] = utf8_encode($value['responsabilidade']);
          $row[] = utf8_encode($value['abertura']);
          $row[] = utf8_encode($value['atualizacao']);
          $row[] = utf8_encode($value['causa']);

          $data[] = $row;
      }
          $output = array (
              "draw"            => $draw,
              "recordsTotal"    => $historicos->num_rows(),
              "recordsFiltered" => $historicos->num_rows(),
              "data"            => $data,
          );
          echo json_encode($output);
    }

}

/* End of file Historico.php */
/* Location: ./application/controllers/links/Historico.php */