<?php defined('BASEPATH') OR exit('No direct script access aloowed');

class Nobreak extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('nobreak_model');

    }

    public function index(){
        $script['footerinc'] = '<script src="assets/custom/nobreak.js" type="text/javascript"></script>';
        $css['headerinc'] = '';
        $this->load->view('template/header',$css);
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('nobreak/nobreak2');
        $this->load->view('template/footer',$script);
        //Modais
        $this->load->view('nobreak/nbk1_modal');
        $this->load->view('nobreak/nbk2_modal');
    }

    public function teste(){
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