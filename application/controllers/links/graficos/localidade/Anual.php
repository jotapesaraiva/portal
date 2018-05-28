<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anual extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('link_model');
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

        $curr_year = date('Y');
        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }

        $dados = $this->link_model->localidade('null',$nano);
         $array_dados = array();
         foreach ($dados as $key => $value) {
             $array_dados['centro'][$key] =  $dados[$key]['centro'];
             $array_dados['numero'][$key] = floatval($dados[$key]['numero']);
         }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/pareto.js"></script>';
        $script['script']    = '
                <script type="text/javascript">
                    $(function () {
                        $("#container").highcharts({
                        chart: {
                            zoomType: "xy"
                        },
                        title: {
                            text: "TOP 10 - Localidades que mais tiveram Indisponibilidade de Circuito no Ano de '.  $nano .'"
                        },
                        xAxis: {
                            categories: '. json_encode($array_dados['centro']).',
                            crosshair: true
                        },
                        yAxis: [{
                            title: {
                                text: "Causa"
                            },
                            labels: {
                                format: "{value} Tickets"
                            }
                        }, {
                            title: {
                                text: "Porcentagem"
                            },
                            minPadding: 0,
                            maxPadding: 0,
                            max: 100,
                            min: 0,
                            opposite: true,
                            labels: {
                                format: "{value}%"
                            }
                        }],
                         legend: {
                                align: "right",
                                x: -70,
                                verticalAlign: "top",
                                y: -5,
                                floating: true,
                                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || "white",
                                borderColor: "#CCC",
                                borderWidth: 1,
                                shadow: false
                        },
                        series: [{
                            name: "Porcentagem",
                            type: "pareto",
                            yAxis: 1,
                            zIndex: 10,
                            tooltip: {
                               valueDecimals: 1,
                               valueSuffix: " %"
                            },
                            baseSeries: 1
                        }, {
                            name: "Tickets",
                            type: "column",
                            zIndex: 2,
                            tooltip: {
                               valueSuffix: " Tickets"
                            },
                            data: '. json_encode($array_dados['numero']).'
                        }]
                    });
                });
                </script>';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $session['username'] = $this->session->userdata('username');


        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Link</span>','/link');
        $this->breadcrumbs->push('<span>Gráficos</span>','link/graficos');
        $this->breadcrumbs->push('<span>Localidade</span>','link/graficos/localidade');
        $this->breadcrumbs->push('<span>Anual</span>','link/graficos/localidade/anual');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('link/localidade/anual', $data);

        $this->load->view('template/footer',$script);

    }


    public function teste() {
       $dados = $this->link_model->localidade('1','2018');
        $array_dados = array();
        foreach ($dados as $key => $value) {
            $array_dados['centro'][$key] =  $dados[$key]['centro'];
            $array_dados['numero'][$key] = floatval($dados[$key]['numero']);
        }
       echo "todos:";
       // vd($dados);
       echo "centro:";
       vd($array_dados['centro']);
       echo "Numero:";
       // vd($array_dados['numero']);
    }

}

/* End of file Anual.php */
/* Location: ./application/controllers/links/graficos/localidade/Anual.php */