<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anual extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('link_model');
        $this->load->library('Auth_AD');
        $this->load->library('breadcrumbs');
        esta_logado();
    }

    public function index() {

        $dados = $this->link_model->ticket_anual();
        $array_dados = array();
        foreach ($dados as $key => $value) {
            $array_dados['num_ano'][$key] =  $dados[$key]['ano'];
            $array_dados['tickets'][$key] = floatval($dados[$key]['numero']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/global/plugins/highcharts/js/highcharts.js"></script>';
        $script['script'] = '
        <script type="text/javascript">
            $(function () {
                $("#container").highcharts({
                    chart: {
                        zoomType: "xy"
                    },
                    title: {
                        text: "Número de Tickets abertos Anualmente"
                    },
                    xAxis: [{
                        categories: '. json_encode($array_dados['num_ano']) .',
                        crosshair: true
                    }],
                    yAxis: [{ // Primary yAxis
                        labels: {
                            format: "{value}",
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        title: {
                            text: "Tickets",
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    },{ // Secondary yAxis
                        title: {
                            text: "Tickets",
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: "{value} Tickets",
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    legend: {
                        align: "left",
                        x: 0,
                        verticalAlign: "up",
                        y: 5,
                        floating: true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || "white",
                        borderColor: "#CCC",
                        borderWidth: 1,
                        shadow: false
                    },
                    series: [{
                        name: "Tickets",
                        type: "column",
                        yAxis: 1,
                        data : '. json_encode($array_dados['tickets']) .',
                    }
                ]
                });
            });
        </script>';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Link</span>','/link');
        $this->breadcrumbs->push('<span>Gráficos</span>','link/graficos');
        $this->breadcrumbs->push('<span>Ticket</span>','link/graficos/ticket');
        $this->breadcrumbs->push('<span>Anual</span>','link/graficos/ticket/anual');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('link/ticket/anual');

        $this->load->view('template/footer',$script);
    }

    public function teste() {
       $dados = $this->link_model->ticket_anual();
        $array_dados = array();
        foreach ($dados as $key => $value) {
            $array_dados['num_ano'][$key] =  $dados[$key]['ano'];
            $array_dados['tickets'][$key] = floatval($dados[$key]['numero']);
        }
       echo "todos:";
       vd($dados);
       echo "numero mes:";
       //vd($array_dados['num_mes']);
       echo "tickets:";
       //vd($array_dados['tickets']);
    }

}

/* End of file Anual.php */
/* Location: ./application/controllers/links/graficos/ticket/Anual.php */