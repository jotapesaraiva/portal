<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spam extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('email_model');
        $this->load->helper('mxhero_helper');
    }

    public function index()
    {

        $mes = date("m");      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
        $ano = date("Y"); // Ano atual
        // $this->email_model->consultaBanco();
        $ultimo_dia = date("t", mktime(0,0,0,date("m"),'01',date("Y"))); // Mágica, plim!
        // $mes_coleta = (isset($this->input->post('mes')) ? $this->input->post('mes') : date("m"));
        if($this->input->post('mes')){
            $mes_coleta = $this->input->post('mes');
        } else {
            $mes_coleta = date("m");
        }
        if($mes_coleta <= 0) {
            $mes_coleta = 12;
            $nano = $ano-1;

            $linhas = $this->email_model->consultaBanco($mes_coleta, $nano);
            $array_dados = array();
            foreach ($linhas as $key => $value) {
                    $array_dados['data_coleta'][$key] = date("d", strtotime($linhas[$key]['data_coleta']));
                    $array_dados['qtd_in'][$key] = floatval($linhas[$key]['qtd_in']);
                    $array_dados['qtd_out'][$key] = floatval($linhas[$key]['qtd_out']);
                    $array_dados['size_in'][$key] = floatval($linhas[$key]['size_in']);
                    $array_dados['size_out'][$key] = floatval($linhas[$key]['size_out']);
                    $array_dados['qtd_spam'][$key] = floatval($linhas[$key]['qtd_spam']);
            }
            $array_total = $this->email_model->somaMesAtual($mes_coleta,$nano);
        } else {
            $linhas = $this->email_model->consultaBanco($mes_coleta, $ano);
            $array_dados = array();
            foreach ($linhas as $key => $value) {
                    $array_dados['data_coleta'][$key] = date("d", strtotime($linhas[$key]['data_coleta']));
                    $array_dados['qtd_in'][$key] = floatval($linhas[$key]['qtd_in']);
                    $array_dados['qtd_out'][$key] = floatval($linhas[$key]['qtd_out']);
                    $array_dados['size_in'][$key] = floatval($linhas[$key]['size_in']);
                    $array_dados['size_out'][$key] = floatval($linhas[$key]['size_out']);
                    $array_dados['qtd_spam'][$key] = floatval($linhas[$key]['qtd_spam']);
            }
            $array_total = $this->email_model->somaMesAtual($mes_coleta,$ano);
        }
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
                $("#grafico").highcharts({
                            chart: {
                                zoomType: "xy"
                            },
                            title: {
                                text: "          Qtd. de E-mails Caracterizados como Spam no mês de "
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
                                    text: "Qtd. Spam",
                                    style: {
                                        color: Highcharts.getOptions().colors[1]
                                    }
                                }
                            },
                            { // Secondary yAxis
                                title: {
                                    text: "Qtd. Spam",
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
                                name: "Quantidade",
                                type: "spline",
                                data : '.json_encode($array_dados['qtd_spam']).',
                                tooltip: {
                                    valueSuffix: " E-mails"
                                }
                            }]
                        });
            });
            </script>';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Email</span>','/email');
        $this->breadcrumbs->push('<span>Gráficos</span>','email/graficos');
        $this->breadcrumbs->push('<span>Causa</span>','email/graficos/causa');

        $dados = array( "array_total" => $array_total);

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');
        $this->load->view('email/spam',$dados);

        $this->load->view('template/footer',$script);
    }

    public function consulta() {
        $banco = $this->email_model->somaMesAtual('09', '2019');
        echo json_encode($banco);
    }

}

/* End of file Spam.php */
/* Location: ./application/controllers/email/Spam.php */