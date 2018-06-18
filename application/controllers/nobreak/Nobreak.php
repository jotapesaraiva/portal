<?php defined('BASEPATH') OR exit('No direct script access aloowed');

class Nobreak extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('nobreak_model');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }
    }

    public function index(){

        if($this->input->post('nobreak')) {
          $nobreak = $this->input->post('nobreak');
          $data['nobreak'] = $nobreak;
        } else {
          $nobreak = "";
          $data['nobreak'] = "";
        }
        if($this->input->post('variavel')) {
          $variavel = $this->input->post('variavel');
          $data['variavel'] = $variavel;
        } else {
          $variavel = "";
          $data['variavel'] = "";
        }
        if($this->input->post('tipo_graf')) {
          $tipo_graf = $this->input->post('tipo_graf');
          $data['tipo_graf'] = $tipo_graf;
        } else {
          $tipo_graf = "";
          $data['tipo_graf'] = "";
        }

        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/nobreak.js" type="text/javascript"></script>';
        $css['headerinc'] = '';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');

        $data['temp1'] = $this->nobreak_model->consulta_nbk1();
        $data['temp2'] = $this->nobreak_model->consulta_nbk2();

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Tecnicos</span>', '/gerencias/tecnico');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('nobreak/nobreak2', $data);
        //Modais
        $this->load->view('nobreak/nbk1_modal');
        $this->load->view('nobreak/nbk2_modal');

        $this->load->view('template/footer',$script);
    }

    public function teste() {
        $temp = $this->nobreak_model->query_nobreak();
        vd($temp->result());
    }

    public function testess() {
        $tipo_graf = $this->input->post('tipo_graf');
        if(!isset ($tipo_graf)){
            $tipo_graf='diario';
        }
        //$tipo_graf = $_POST['tipo_graf'];

        $mes_graf = $this->input->post('mes');
        if(!isset ($mes_graf)){
            $mes_graf=date("m");
        }
        //$mes_graf = $_POST['mes'];
        $nobreak = $this->input->post('nobreak');
        if(!isset ($nobreak)){
            $nobreak='Primario';
        }
        //$nobreak = $_POST['nobreak'];
        $dia = $this->input->post('dia');
        if(!isset ($dia)){
                $dia = date('d');
        }
        //$dia = $_POST['dia'];

        if(!isset ($variavel)){
                $variavel = 'frequencia';
        }
        $variavel = $this->input->post('variavel');//$_POST['variavel'];

        $mes = date("m");      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
        $ano = date("Y"); // Ano atual
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!
        $data_consulta = $ano.'-'.$mes.'-'.$dia;
        if($tipo_graf=='diario'){
            $array_dados_nobreak = $this->nobreak_model->get_nobreak($data_consulta,$nobreak,$variavel);
        } else {
            $nobreak_men = 'Mensal_'.$nobreak;
            $array_dados_nobreak = $this->nobreak_model->get_nobreak($mes_graf,$nobreak_men,$variavel,1);
        }
        //var_dump($array_dados_nobreak);
        // $this->load->model('nobreak_model');
        $temps1 = $this->nobreak_model->consulta_nbk1();
        $temps2 = $this->nobreak_model->consulta_nbk2();
        //var_dump($temps1);
        $dados = array(
            "temps1" => $temps1,
            "temps2" => $temps2,
            "array_dados_nobreak" => $array_dados_nobreak
        );
        $script['footerinc'] = '<script src="assets/custom/nobreak.js" type="text/javascript"></script>';
        $css['headerinc'] = '';
        $this->load->view('template/header',$css);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('nobreak/nobreak',$dados);
        $this->load->view('template/footer',$script);
        //Modais
        $this->load->view('nobreak/nbk1_modal');
        $this->load->view('nobreak/nbk2_modal');
    }

}