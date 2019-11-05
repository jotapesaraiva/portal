<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ano extends CI_Controller {

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

        $graficos = $this->indicadores_model->tempo_volume('volume','null',$nano);
        $result = array();
        foreach ($graficos as $key => $value) {
            $graph = array(
                $value['specification'],
                $value['numero']
            );
            array_push($result, $graph);
        }

        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/highcharts.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/exporting.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/export-data.js"></script>
        <script src="' . base_url() . 'assets/js/highcharts/pareto.js"></script>';
        $script['script'] = "
                    <script type='text/javascript'>
                        Highcharts.chart('grafico', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Backups com Maior Volume no ano de ".$nano."'
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
                                        text: 'Volume'
                                    }
                                },
                                legend: {
                                    enabled: false
                                },
                                tooltip: {
                                    pointFormat: 'Volume: <b>{point.y}</b>'
                                },
                                series: [{
                                    name: 'Backups',
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
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Gráfico</span>', '/backup/graficos');
        $this->breadcrumbs->push('<span>Volume</span>', '/backup/graficos/volume');
        $this->breadcrumbs->push('<span>Ano</span>', '/backup/graficos/volume/ano');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/volume/ano', $data);

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

/* End of file Ano.php */
/* Location: ./application/controllers/backup/graficos/volume/Ano.php */