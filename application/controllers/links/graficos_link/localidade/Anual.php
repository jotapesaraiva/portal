<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anual extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
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
         $result = array();
         foreach ($dados as $key => $value) {
             $graph = array(
                 $value['centro'],
                 $value['numero']
             );
             array_push($result, $graph);
         }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/highcharts.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/exporting.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/export-data.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/pareto.js"></script>
        ';
        $script['script']    = "
            <script type='text/javascript'>
                Highcharts.chart('grafico', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Localidades com maior indisponibilidade no mês ".$nano."'
                        },
                        xAxis: {
                            crosshair: true,
                            type: 'category',
                            labels: {
                                style: {
                                    fontSize: '10px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Tickets'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Tickets: <b>{point.y}</b>'
                        },
                        series: [{
                            name: 'Unidades',
                            data: ".json_encode($result, JSON_NUMERIC_CHECK).",
                            dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                align: 'right',
                                format: '{point.y}', // one decimal
                                y: 25, // 10 pixels down from the top
                                x: -23,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                    });
                </script>";
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