<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculo_multa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

    public function index() {

        $script['footerinc'] = '

            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/historico.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/daterangepicker.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css"/>
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

          $session['username'] = $this->session->userdata('username');

          $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
          $this->breadcrumbs->push('<span>Link</span>','/link');
          $this->breadcrumbs->push('<span>Calculo multa</span>','link/calculo_multa');

          if(!$this->input->post('data1')) {
            $date = date("Y-m-09");
            $date = strtotime(date("Y-m-d", strtotime($date)) . "-1 month");
            $data_inicio = date('Y-m-d', $date);
            $data['data_inicio'] = date('d/m/Y', $date);
          } else {
            $datai = str_replace('/', '-', $this->input->post('data1'));
            $data_inicio = date("Y-m-d", strtotime($datai));
            $data['data_inicio'] = $this->input->post('data1');
          }
          if(!$this->input->post('data2')) {
            $data_final = date("Y-m-10");
            $data['data_final'] = date("d/m/Y", strtotime($data_final));
            //$data['mostra_dataf'] = $data_final;
          } else {
            $dataf = str_replace('/', '-', $this->input->post('data2'));
            $data_final = date("Y-m-d", strtotime($dataf));
            $data['data_final'] = $this->input->post('data2');
          }
          $data['calculo'] = $this->create_table($data_inicio,$data_final);

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/calculo_multa',$data);

          $this->load->view('template/footer',$script);

    }

    public function create_table($inicio,$fim) {
        $calculos = $this->link_model->calculo($inicio,$fim);
        $html = "";
        foreach ($calculos as $key => $calculo) {
            $html .= "<tr>\n";
            $html .= "<td>". ($key + 1) ."</td>\n";
            $html .= "<td>".utf8_encode($calculo['centro'])."</td>\n";
            $html .= "<td> <a href='http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=".htmlentities($calculo['ticket'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank'  style='color: rgb(0,0,255)'><font color='374E9E' >".htmlentities($calculo['ticket'], ENT_QUOTES, 'ISO-8859-1')." </font></a></td>\n";
            $html .= "<td>".utf8_encode($calculo['abertura'])."</td>\n";
            $html .= "<td>".utf8_encode($calculo['atualizacao'])."</td>\n";
            $html .= "<td>".utf8_encode($calculo['tmp_portal'])."</td>\n";
            $html .= "<td>".utf8_encode($calculo['responsabilidade'])."</td>\n";
        }
        return $html;
    }


    public function teste() {
        if($this->input->post('data1')) {
          //$datai = str_replace('/', '-', $this->input->post('data1'));
          $data_inicio = date('Y-m-d', strtotime($this->input->post('data1')));
          //$data['data_inicio'] = $this->input->post('data1');
        } else {
          $date = date('Y-m-09');
          $date = strtotime(date('Y-m-d', strtotime($date)) . "-1 month");
          $data_inicio = date('Y-m-d', $date);
          //$data['data_inicio'] = date('d/m/Y', $date);
        }
        if($this->input->post('data2')) {
          //$dataf = str_replace('/', '-', $this->input->post('data2'));
          $data_final = date('Y-m-d', strtotime($this->input->post('data2')));
          //$data['data_final'] = $this->input->post('data2');
        } else {
          $data_final = date('Y-m-10');
          //$data['data_final'] = date("d/m/Y", strtotime($data_final));
        }
        echo " data inicio: ". $data_inicio ." data final: ". $data_final ." ";
        echo  "<table>";
        echo      "<caption>TESTE Calculo de multa</caption>";
        echo      "<thead>";
        echo          "<tr>";
        echo               "<th> ID </th>";
        echo               "<th>Localidade</th>";
        echo               "<th>Ticket</th>";
        echo               "<th>Abertura</th>";
        echo               "<th>Fechamento</th>";
        echo               "<th>Tempo Portal</th>";
        echo               "<th>Responsável</th>";
        echo          "</tr>";
        echo      "</thead>";
        echo      "<tbody>";
        echo $this->create_table($data_inicio,$data_final);
        echo      "</tbody>";
        echo  "</table>";

    }
}

/* End of file Calculo_multa.php */
/* Location: ./application/controllers/links/Calculo_multa.php */