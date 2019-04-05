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
            <script src="' . base_url() . 'assets/custom/backup/historico.js" type="text/javascript"></script>
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

          $data['historico'] = $this->table_history();

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/historico',$data);

          $this->load->view('template/footer',$script);
    }

    public function table_history() {
        $historicos = $this->link_model->historico();
        $trecho_link_grc = "http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=";
        $contador = 1;
        $html = "";
        foreach ($historicos as $historico) {
          $html .= "<tr>\n";
          $html .= "<td>". $contador++ ."</td>\n";
          $html .= "<td><a href='". $trecho_link_grc.$historico['ticket'] ."' target='_blank' title='Ultima Posicao: ". utf8_encode($historico['posicionamento']) ."' style='color: rgb(0,0,255)' > <font color='374E9E'>". $historico['ticket'] ."</font> </a></td>\n";
          $html .= "<td>". utf8_encode($historico['rec']) ."</td>\n";
          $html .= "<td>". utf8_encode($historico['centro']) ."</td>\n";
         if($historico['status']=="Fechado"){
              $html .= "<td><span class='label label-success'</span>Fechado</td>\n";
          }else if($historico['status']=="Transferido"){
              $html .= "<td><span class='label label-warning'</span>Transferido</td>\n";
          }else{
              $html .= "<td><span class='label label-important'</span>" .utf8_encode($historico['status']) ."</td>\n";
          }
          $html .= "<td>".utf8_encode($historico['responsabilidade'])."</td>\n";
          $html .= "<td>".utf8_encode($historico['abertura'])."</td>\n";
          $html .= "<td>".utf8_encode($historico['atualizacao'])."</td>\n";
          $html .= "<td>".utf8_encode($historico['causa'])."</td>\n";
        }
        return $html;
    }

}

/* End of file Historico.php */
/* Location: ./application/controllers/links/Historico.php */