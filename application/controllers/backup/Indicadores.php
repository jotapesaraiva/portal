<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicadores extends CI_Controller {

     public function __construct() {
         parent::__construct();
         //Do your magic here
         $this->load->model('indicadores_model');
         $this->load->library('highcharts');
         $this->load->library('Auth_AD');
         esta_logado();
     }

    public function index() {

        $graficos = $this->indicadores_model->tempo_volume('Outro',4,2018);
        $pareto = $this->indicadores_model->tempo_volume('pareto',4,2018);

        vd($graficos);
        // pr($array_abort);
    }

    public function crescimento_dia() {
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
        if($this->input->post('backup')){
            $nbackup = $this->input->post('backup');
            $data['nbackup'] = $nbackup;
        } else {
            $nbackup = "Todos";
            $data['nbackup'] = "Todos";
        }

        $linhas = $this->indicadores_model->backup_job($nbackup,$nmes,$nano);
        // $linhas = $this->indicadores_model->backup_job('EMAIL',03,2015);
        $array_dados = array();
        foreach ($linhas as $key => $value) {
                $array_dados['dia'][$key] = $linhas[$key]['Dia'];
                $array_dados['mes'][$key] = $linhas[$key]['Mes'];
                $array_dados['tamanho'][$key] = floatval($linhas[$key]['tamanho']);
                $array_dados['duracao'][$key] = floatval($linhas[$key]['duracao']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/global/plugins/highcharts/js/highcharts.js"></script>';
        // $script['script']    = '<script src="'. base_url().'assets/custom/crescimento.js"></script>';
        $script['script']    = '<script>
        $(function () {
            $("#container").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "Evolução Diária do Job de Backup '. $nbackup .' em '. $nmes .' de '. $nano .'"
                },
                xAxis: [{
                    categories: '. json_encode($array_dados['dia']) .',
                    crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: "{value} Hs",
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: "Tempo",
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                },
                { // Secondary yAxis
                    title: {
                        text: "Volume",
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: "{value} GB",
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
                    name: "Volume",
                    type: "column",
                    yAxis: 1,
                    data : '. json_encode($array_dados['tamanho']) .',
                    tooltip: {
                        valueSuffix: " GB"
                    }
                 },{
                    name: "Tempo",
                    type: "spline",
                        data : '. json_encode($array_dados['duracao']) .',
                    tooltip: {
                        valueSuffix: " Hs"
                    }
                }]
            });
        });</script>';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $session['username'] = $this->session->userdata('username');

        $data['nm_job'] = $this->option_job($this->indicadores_model->nome_job());

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/crescimento_dia', $data);

        $this->load->view('template/footer',$script);
    }

    public function crescimento_mes() {
        $curr_year = date('Y');
        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }
        if($this->input->post('status')){
            $nstatus = $this->input->post('status');
            $data['nstatus'] = $nstatus;
        } else {
            $nstatus = "Todos";
            $data['nstatus'] = "Todos";
        }
        if($this->input->post('backup')){
            $nbackup = $this->input->post('backup');
            $data['nbackup'] = $nbackup;
        } else {
            $nbackup = "Todos";
            $data['nbackup'] = "Todos";
        }

        $linhas = $this->indicadores_model->backup_status($nbackup,$nstatus,$nano);
        $array_dados = array();
        foreach ($linhas as $key => $value) {
                $array_dados['Mes'][$key] = $linhas[$key]['Mes'];
                $array_dados['MediaGB'][$key] = floatval($linhas[$key]['MediaGB']);
                $array_dados['MediaDuracao'][$key] = floatval($linhas[$key]['MediaDuracao']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/global/plugins/highcharts/js/highcharts.js"></script>';
        $script['script']    = '
                        <script type="text/javascript">
        $(function () {
            $("#container").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "Evolução  Mensal Job de Backup '.$nbackup.' em '.$nano.'"
                },
                xAxis: [{
                    categories: '. json_encode($array_dados['Mes']) .',
                   crosshair: true
                }],
                yAxis: [{ // Primary yAxis
                    labels: {
                        format: "{value} Hs",
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    },
                    title: {
                        text: "Tempo",
                        style: {
                            color: Highcharts.getOptions().colors[1]
                        }
                    }
                }, { // Secondary yAxis
                    title: {
                        text: "Volume",
                        style: {
                            color: Highcharts.getOptions().colors[0]
                        }
                    },
                    labels: {
                        format: "{value} GB",
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
                    name: "Volume",
                    type: "column",
                    yAxis: 1,
                    data : '. json_encode($array_dados['MediaGB']) .',
                    tooltip: {
                        valueSuffix: " GB"
                    }
                }, {
                    name: "Tempo",
                    type: "spline",
                        data : '. json_encode($array_dados['MediaDuracao']) .',
                    tooltip: {
                        valueSuffix: " Hs"
                    }
                }]
            });
        });
                </script>';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $session['username'] = $this->session->userdata('username');

        $data['nm_job'] = $this->option_job($this->indicadores_model->nome_job());
        $data['nm_status'] = $this->option_job($this->indicadores_model->nome_status());

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/crescimento_mes', $data);

        $this->load->view('template/footer',$script);

    }

    public function quantidade() {
        $curr_year = date('Y');
        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }

        $abort = $this->indicadores_model->quantidade_status('abortados',$nano);
        $array_abort = array();
        foreach ($abort as $key => $value) {
                $array_abort['Mes'][$key] = $abort[$key]['Mes'];
                $array_abort['abortados'][$key] = floatval($abort[$key]['abortados']);
        }
        $complet = $this->indicadores_model->quantidade_status('completos',$nano);
        $array_complet = array();
        foreach ($complet as $key => $value) {
                $array_complet['Mes'][$key] = $complet[$key]['Mes'];
                $array_complet['completos'][$key] = floatval($complet[$key]['completos']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/global/plugins/highcharts/js/highcharts.js"></script>';
        $script['script']    = '
        <script type="text/javascript">
        $(function () {
            $("#container").highcharts({
                chart: {
                    type: "column"
                },
                title: {
                    text: "Quantidade / Porcentagem de Backups Mensais realizados em '.$nano.'"
                },
                xAxis: {
                    categories: '. json_encode($array_abort['Mes']) .',
                },
                yAxis: {
                     min: 0,
                    title: {
                        text: "Quantidade"
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: "bold",
                            color: (Highcharts.theme && Highcharts.theme.textColor) || "gray"
                        }
                    }
                },
                legend: {
                    align: "right",
                    x: -70,
                    verticalAlign: "top",
                    y: -5,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background) || "white",
                    borderColor: "#CCC",
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    pointFormat: "<span style=color:{series.color}>{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>",
                    shared: true
                },
                plotOptions: {
                    column: {
                        stacking: "normal",
                        dataLabels: {
                            enabled: true,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || "white",
                            style: {
                                textShadow: "0 0 3px black, 0 0 3px black"
                            }
                        }
                    }
                },
                series: [{
                    name: "Abortou/Falhou",
                   data : '. json_encode($array_abort['abortados']) .',
                }, {
                    name: "Completos",
                    data : '. json_encode($array_complet['completos']) .',
                }]
            });
        });
        </script>';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $session['username'] = $this->session->userdata('username');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/quantidade', $data);

        $this->load->view('template/footer',$script);
    }

    public function tempo_mes() {
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
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/pareto.js"></script>
        ';
        $script['script']    = '
        <script type="text/javascript">
            $(function () {
                $("#container").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "TOP 10 - Backups com Maior Tempo de Execução no mês de '. dataEmPortugues($nmes) .' de '.  $nano .'"
                },
                xAxis: {
                    categories: '. json_encode($array_dados['specification']).',
                    crosshair: true
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
                       valueSuffix: " %"
                    },
                    baseSeries: 1
                }, {
                    name: "Tempo",
                    type: "column",
                    zIndex: 2,
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

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/tempo_mes', $data);

        $this->load->view('template/footer',$script);

    }

    public function tempo_ano() {
        $curr_year = date('Y');

        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }

        $graficos = $this->indicadores_model->tempo_volume('tempo','null',$nano);
        foreach ($graficos as $key => $value) {
                $array_dados['specification'][$key] = $graficos[$key]['specification'];
                $array_dados['numero'][$key] = floatval($graficos[$key]['numero']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/pareto.js"></script>
        ';
        $script['script']    = '
        <script type="text/javascript">
            $(function () {
                $("#container").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "TOP 10 - Backups com Maior Tempo de Execução no ano de '.  $nano .'"
                },
                xAxis: {
                    categories: '. json_encode($array_dados['specification']).',
                    crosshair: true
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
                       valueSuffix: " %"
                    },
                    baseSeries: 1
                }, {
                    name: "Tempo",
                    type: "column",
                    zIndex: 2,
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

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/tempo_ano', $data);

        $this->load->view('template/footer',$script);

    }

    public function volume_mes() {

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

        $graficos = $this->indicadores_model->tempo_volume('volume',$nmes,$nano);
        foreach ($graficos as $key => $value) {
                $array_dados['specification'][$key] = $graficos[$key]['specification'];
                $array_dados['numero'][$key] = floatval($graficos[$key]['numero']);
        }


        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/pareto.js"></script>
        ';
        $script['script']    = '
        <script type="text/javascript">
            $(function () {
                $("#container").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "TOP 10 - Backups com Maior Volume no mês de '. dataEmPortugues($nmes) .' de '.  $nano .'"
                },
                xAxis: {
                    categories: '. json_encode($array_dados['specification']).',
                    crosshair: true
                },
                yAxis: [{
                    title: {
                        text: "Volume"
                    },
                    labels: {
                        format: "{value} GB"
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
                       valueSuffix: " %"
                    },
                    baseSeries: 1
                }, {
                    name: "Volume",
                    type: "column",
                    zIndex: 2,
                    tooltip: {
                       valueSuffix: " GB"
                    },
                    data: '. json_encode($array_dados['numero']).'
                }]
            });
        });
        </script>';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $session['username'] = $this->session->userdata('username');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/volume_mes', $data);

        $this->load->view('template/footer',$script);
    }

    public function volume_ano() {
        $curr_year = date('Y');
        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }

        $graficos = $this->indicadores_model->tempo_volume('volume','null',$nano);
        foreach ($graficos as $key => $value) {
                $array_dados['specification'][$key] = $graficos[$key]['specification'];
                $array_dados['numero'][$key] = floatval($graficos[$key]['numero']);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/pareto.js"></script>
        ';
        $script['script']    = '
        <script type="text/javascript">
            $(function () {
                $("#container").highcharts({
                chart: {
                    zoomType: "xy"
                },
                title: {
                    text: "TOP 10 - Backups com Maior Volume no ano de '.  $nano .'"
                },
                xAxis: {
                    categories: '. json_encode($array_dados['specification']).',
                    crosshair: true
                },
                yAxis: [{
                    title: {
                        text: "Volume"
                    },
                    labels: {
                        format: "{value} GB"
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
                       valueSuffix: " %"
                    },
                    baseSeries: 1
                }, {
                    name: "Volume",
                    type: "column",
                    zIndex: 2,
                    tooltip: {
                       valueSuffix: " GB"
                    },
                    data: '. json_encode($array_dados['numero']).'
                }]
            });
        });
        </script>';
        $css['headerinc']    = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $session['username'] = $this->session->userdata('username');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/volume_ano', $data);

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

/* End of file Indicadores.php */
/* Location: ./application/controllers/backup/Indicadores.php */