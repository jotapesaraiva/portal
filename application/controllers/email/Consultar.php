<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('email_model');
        $this->load->helper('mxhero_helper');
    }

    public function index()
    {
        $curr_year = date('Y');
        $curr_mes = date('n');
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
            $nmes = $curr_mes;
            $data['nmes'] = date('n');
            $data['mes'] = dataEmPortugues(date('n'));
        }
        $linhas = $this->email_model->consultaBanco($nmes,$nano);
        $array_dados = array();
        foreach ($linhas as $key => $value) {
                $array_dados['data_coleta'][$key] = date("d", strtotime($linhas[$key]['data_coleta']));
                $array_dados['qtd_in'][$key] = floatval($linhas[$key]['qtd_in']);
                $array_dados['qtd_out'][$key] = floatval($linhas[$key]['qtd_out']);
                $array_dados['size_in'][$key] = floatval($linhas[$key]['size_in']);
                $array_dados['size_out'][$key] = floatval($linhas[$key]['size_out']);
                $array_dados['qtd_spam'][$key] = floatval($linhas[$key]['qtd_spam']);
        }
        $array_total = $this->email_model->somaMesAtual($nmes,$nano);

        // vd($array_dados);
        $css['headerinc'] = '
        <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="' . base_url() . 'assets/js/highcharts/highcharts.js"></script>
            <script src="' . base_url() . 'assets/js/highcharts/exporting.js"></script>
            <script src="' . base_url() . 'assets/js/highcharts/export-data.js"></script>
            <script src="' . base_url() . 'assets/js/highcharts/pareto.js"></script>';
        $script['script'] = '
            <script type="text/javascript">
            $(function () {
            Highcharts.setOptions({
                                        colors : [ "#485F77","#E55B3C","#3CC6E6"]
                                    });
                $("#grafico_1").highcharts({
                    chart: {
                        zoomType: "xy"
                    },
                    title: {
                        text: "Fluxo de E-mails de Entrada e Saida no mês de "
                    },
                    xAxis: [{
                        categories: '.json_encode($array_dados['data_coleta']).',
                        crosshair: true
                    }],
                    yAxis: [{ // Primary yAxis
                        allowDecimals: false,
                        labels: {
                            format: "{value}",
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        },
                        title: {
                            text: "Qtd. Email",
                            style: {
                                color: Highcharts.getOptions().colors[1]
                            }
                        }
                    },

                    { // Secondary yAxis
                        title: {
                            text: "Qtd. Email",
                            style: {
                                color: Highcharts.getOptions().colors[0]
                            }
                        },
                        labels: {
                            format: "{value} ",
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
                            name: "Qtd. Emails Entrada",
                            type: "spline",
                            data : '.json_encode($array_dados['qtd_in']).',
                            tooltip: {
                                valueSuffix: " Emails"
                            }
                        },
                        {
                            name: "Qtd. Emails Saida",
                            type: "spline",
                            data : '.json_encode($array_dados['qtd_out']).',
                            tooltip: {
                                valueSuffix: " Emails"
                            }
                        },
                        {
                            name: "Quantidade SPAM",
                            type: "spline",
                            data : '.json_encode($array_dados['qtd_spam']).',
                            tooltip: {
                                valueSuffix: " E-mails SPAM"
                            }
                        }]
                });
                $("#grafico_2").highcharts({
                            chart: {
                                zoomType: "xy"
                            },
                            title: {
                                text: "Fluxo de Dados em MB dos E-mails no mês de "
                            },
                            xAxis: [{
                                categories: '.json_encode($array_dados['data_coleta']).',
                                crosshair: true
                            }],
                            yAxis: [{ // Primary yAxis
                                allowDecimals: false,
                                labels: {
                                    format: "{value}",
                                    style: {
                                        color: Highcharts.getOptions().colors[1]
                                    }
                                },
                                title: {
                                    text: "Fluxo de Dados em MB",
                                    style: {
                                        color: Highcharts.getOptions().colors[1]
                                    }
                                }
                            },
                            { // Secondary yAxis
                                title: {
                                    text: "Fluxo de Dados em MB",
                                    style: {
                                        color: Highcharts.getOptions().colors[0]
                                    }
                                },
                                labels: {
                                    format: "{value} ",
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
                                name: "Tamanho Entrada",
                                type: "spline",
                                data : '.json_encode($array_dados['size_in']).',
                                tooltip: {
                                    valueSuffix: " MB"
                                }
                                },
                                {
                                name: "Tamanho Saída",
                                type: "spline",
                                    data : '.json_encode($array_dados['size_out']).',
                                tooltip: {
                                    valueSuffix: " MB"
                                }
                                }]
                });
            });
            </script>';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Email</span>','/email');
        $this->breadcrumbs->push('<span>Consultar</span>','email/consultar');


        $data['array_total'] = $array_total;

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');
        $this->load->view('email/consultar',$data);

        $this->load->view('template/footer',$script);
    }

    public function consulta() {
        $banco = $this->email_model->somaMesAtual('09', '2019');
        // vd($banco);
        // echo $banco['data_coleta'];
        echo json_encode($banco);
    }


}

/* End of file Consultar.php */
/* Location: ./application/controllers/email/Consultar.php */