<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
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

        $graficos = $this->indicadores_model->tempo_volume('tempo',$nmes,$nano);
        // $pareto = $this->indicadores_model->tempo_volume('Todos',$nmes,$nano);

        foreach ($graficos as $key => $value) {
                $array_dados['specification'][$key] = $graficos[$key]['specification'];
                $array_dados['numero'][$key] = floatval($graficos[$key]['numero']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/highcharts.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/exporting.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/export-data.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/pareto.js"></script>
        ';
        $script['script']    = '
        <script type="text/javascript">
            $(function () {
                $("#grafico").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "TOP 10 - Backups com Maior Tempo de Execução no mês de '. dataEmPortugues($nmes) .' de '.  $nano .'"
                },
                xAxis: {
                    categories: '. json_encode($array_dados['specification']).',
                    crosshair : true
                },
                yAxis: [{
                    title: {
                        text: "Tempo"
                    },
                    labels: {
                        format: "{value} Hs"
                    }
                }, {
                    title: {
                        text: "Porcentagem"
                    },
                    minPadding: 0,
                    maxPadding: 0,
                    max       : 100,
                    min       : 0,
                    opposite  : true,
                    labels    : {
                        format: "{value}%"
                    }
                }],
                 legend: {
                        align          : "right",
                        x              : -70,
                        verticalAlign  : "top",
                        y              : -5,
                        floating       : true,
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || "white",
                        borderColor    : "#CCC",
                        borderWidth    : 1,
                        shadow         : false
                },
                series: [{
                    name   : "Porcentagem",
                    type   : "pareto",
                    yAxis  : 1,
                    zIndex : 10,
                    tooltip: {
                        valueDecimals: 1,
                        valueSuffix  : " %"
                    },
                    baseSeries: 1
                }, {
                    name   : "Tempo",
                    type   : "column",
                    zIndex : 2,
                    tooltip: {
                       valueSuffix: " Hs"
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
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Gráfico</span>', '/backup/graficos');
        $this->breadcrumbs->push('<span>Tempo</span>', '/backup/graficos/tempo');
        $this->breadcrumbs->push('<span>Mês</span>', '/backup/graficos/tempo/mes');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/tempo/mes', $data);

        $this->load->view('template/footer',$script);

    }

    public function option_job($dados) {
        $html = "";
        foreach ($dados as $dado) {
            $html .= "<option value='".$dado['variavel']."' >".$dado['variavel']."</option>";
        }
        return $html;
    }

}

/* End of file Mes.php */
/* Location: ./application/controllers/backup/graficos/tempo/Mes.php */