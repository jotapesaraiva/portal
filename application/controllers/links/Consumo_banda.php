<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumo_banda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('consumo_model');
        $this->load->library('Auth_AD');
        $this->load->library('breadcrumbs');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            // $data = array('error_message' => 'Efetue o login para acessar o sistema');
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }
    }

    public function index() {
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/historico.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

          $session['username'] = $this->session->userdata('username');

          $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
          $this->breadcrumbs->push('<span>Link</span>','/link');
          $this->breadcrumbs->push('<span>Consumo de Banda</span>','link/consumo_banda');

          if($this->input->post('periodo_consumo')){
            $periodo_consumo = $this->input->post('periodo_consumo');
            $data['periodo_consumo'] = $periodo_consumo;
          } else {
            $periodo_consumo = "";
            $data['periodo_consumo'] = "";
          }
          $data['consumo'] = $this->table_consumo($periodo_consumo);

          $this->load->view('template/header',$css);
          $this->load->view('template/navbar',$session);
          $this->load->view('template/sidebar');

          $this->load->view('link/consumo_banda',$data);

          $this->load->view('template/footer',$script);
    }

    public function table_consumo($interval) {
      $html ="";
      $consumo_atual =  $this->consumo_model->consumo_atual($interval);
      $contador = 1;
      foreach ($consumo_atual->result_array() as $linha) {
        $Porcentagem = $linha['Porcentagem'];
        $html .= "<tr>\n";
        $html .= "  <td>".$contador++."</td>\n";
        //$html .= "<td><a href='/?m=analise&f=backup&a=dados_copiados_bkp&aux=".$linha['session_id']."&aux2=".$linha['specification']."'target='_self''</a>".utf8_encode($linha['specification'])."</td>\n";
        $html .= "  <td>
                      <a href='/portal/links/consumo_banda/consumo_unidade/".$linha['localidade']."' target='_self' >".$linha['localidade']."</a>
                    </td>\n";
        if ($Porcentagem == '100'){
        $html .= "  <td>
                        <div class='progress progress-striped active'>
                            <div class='progress-bar progress-bar-danger' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>
                                <span style='font-weight: bold;'>".$linha['Porcentagem']."%</span>
                            </div>
                        </div>
                    </td>\n";
        } else if ($Porcentagem >='70') {
        $html .= "  <td>
                        <div class='progress progress-striped active'>
                            <div class='progress-bar progress-bar-warning' role='progressbar' aria-valuenow='80' aria-valuemin='0' aria-valuemax='100' style='width: 80%'>
                                <span style='font-weight: bold;'>".$linha['Porcentagem']."%</span>
                            </div>
                        </div>
                    </td>\n";
        } else if ($Porcentagem >='30') {
            $html .= "  <td>
                            <div class='progress progress-striped active'>
                                <div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' style='width: 30%'>
                                    <span style='font-weight: bold;'>".$linha['Porcentagem']."%</span>
                                </div>
                            </div>
                        </td>\n";
        } else {
        $html .= "  <td>
                        <div class='progress progress-striped active'>
                            <div class='progress-bar progress-bar-info' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 10%'>
                                <span style='font-weight: bold;'>".$linha['Porcentagem']."%</span>
                            </div>
                        </div>
                    </td>\n";
        }
      $html .= "  <td>".$linha['periodo_final']."</td>\n";
      $html .= "  <td>".$linha['velocidade']."</td>\n";
      $html .= "  <td>".$linha['entrada_media']."</td>\n";
      $html .= "  <td>".$linha['entrada_maxima']."</td>\n";
      $html .= "  <td>".$linha['saida_media']."</td>\n";
      $html .= "  <td>".$linha['saida_maxima']."</td>\n";
      $html .= "</tr>\n";
    }
      return $html;
    }

    public function consumo_unidade($unidade) {

    }

    public function teste() {


      // echo $this->router->fetch_class();
      // echo $this->router->fetch_method();
      // echo $this->table_consumo('7 HOUR');
       // $interval =  $this->consumo_model->consumo_atual('7 HOUR');
       // vd($interval->result_array());
       // $this->output->enable_profiler(TRUE);
    }

}

/* End of file consumo_banda.php */
/* Location: ./application/controllers/links/consumo_banda.php */