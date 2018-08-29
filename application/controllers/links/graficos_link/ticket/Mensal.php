<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('link_model');
        $this->load->library('Auth_AD');
        $this->load->library('breadcrumbs');
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

        $dados = $this->link_model->ticket($nano);
        $array_dados = array();
        foreach ($dados as $key => $value) {
            $array_dados['num_mes'][$key] =  $dados[$key]['mes'];
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
                        text: "Número de Tickets abertos Mensalmente no Ano de '.$nano.'"
                    },
                    xAxis: [{
                        categories: '. json_encode($array_dados['num_mes']) .',
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
        $this->breadcrumbs->push('<span>Mensal</span>','link/graficos/ticket/mensal');

        //$data['historico'] = $this->table_history();

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('link/ticket/mensal',$data);

        $this->load->view('template/footer',$script);
    }


}

/* End of file mensal.php */
/* Location: ./application/controllers/links/graficos/ticket/mensal.php */