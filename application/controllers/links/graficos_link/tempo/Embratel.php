<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embratel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
        //Do your magic here
    }

    public function index() {
        // $curr_year = date('Y');
        // $curr_mes = date('n');
        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }

        if($this->input->post('mes')){
            $nmes = $this->input->post('mes');
            $data['nmes'] = $nmes;
            $data['mes'] = dataEmPortugues($nmes);
        } else {
            $nmes = date('n');
            $data['nmes'] = date('n');
            $data['mes'] = dataEmPortugues(date('n'));
        }
        $dados = $this->link_model->tempo($nmes,$nano);
         $array_dados = array();
         foreach ($dados as $key => $value) {
             $array_dados['centro'][$key] =  $dados[$key]['centro'];
             $array_dados['tempo'][$key] = floatval($dados[$key]['tempo']);
         }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/highcharts.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/exporting.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/export-data.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/pareto.js"></script>>';
        $script['script']    = '
                <script type="text/javascript">
                    $(function () {
                        $("#grafico").highcharts({
                        chart: {
                            zoomType: "xy"
                        },
                        title: {
                            text: "TOP 10 - Unidades com maior tempo de indisponibilidade no mês '. dataEmPortugues($nmes) .' de '.  $nano .'"
                        },
                        xAxis: {
                            categories: '. json_encode($array_dados['centro']).',
                            crosshair: true
                        },
                        yAxis: [{
                            title: {
                                text: "Tempo"
                            },
                            labels: {
                                format: "{value} Horas"
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
                            baseSeries: 1,
                            dashStyle: "longdash"
                        }, {
                            name: "Tempo",
                            type: "column",
                            zIndex: 2,
                            tooltip: {
                               valueSuffix: " Horas"
                            },
                            data: '. json_encode($array_dados['tempo']).'
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
        $this->breadcrumbs->push('<span>Causa</span>','link/graficos/causa');
        $this->breadcrumbs->push('<span>Mensal</span>','link/graficos/causa/mensal');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('link/causa/mensal', $data);

        $this->load->view('template/footer',$script);


    }

}

/* End of file Embratel.php */
/* Location: ./application/controllers/links/graficos_link/tempo/Embratel.php */