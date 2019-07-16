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
        <script src="' . base_url() . 'assets/js/highcharts/highcharts.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/exporting.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/export-data.js"></script>';
        $script['script']    = '
        <script type="text/javascript">
        $(function () {
            $("#grafico").highcharts({
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

        $data['nm_job'] = $this->option_job($this->indicadores_model->nome_job(date('m')));
        $data['nm_status'] = $this->option_job($this->indicadores_model->nome_status());

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Gráfico</span>', '/backup/graficos');
        $this->breadcrumbs->push('<span>Crescimento</span>', '/backup/graficos/crescimento');
        $this->breadcrumbs->push('<span>Mês</span>', '/backup/graficos/crescimento/mes');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/crescimento/mes', $data);

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

/* End of file mes.php */
/* Location: ./application/controllers/backup/graficos/crescimento/mes.php */