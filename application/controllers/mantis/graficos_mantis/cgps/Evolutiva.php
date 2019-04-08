<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evolutiva extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('graf_evolutiva_model');
    }


    public function index() {
        if($this->input->post('data_inicio')) {
            $data_inicio = '01-'.$this->input->post('data_inicio');
            $data['data_inicio'] = $this->input->post('data_inicio');
        } else {
            $data_inicio = date('01/01/Y');
            $data['data_inicio'] = date('01-Y');
        }
        if($this->input->post('data_fim')) {
            $data_fim = date('d').'-'.$this->input->post('data_fim');
            $data['data_fim'] = $this->input->post('data_fim');
        } else {
            $data_fim = date('d/m/Y');
            $data['data_fim'] = date('m-Y');
        }

        $this->output->enable_profiler(FALSE);
        $chart_data = $this->chart_data($data_inicio,$data_fim);
        $graph = $this->graph($data_inicio,$data_fim);
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        ';
        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
        <script src="'.base_url().'assets/global/plugins/amcharts4/core.js" type="text/javascript"></script>
        <script src="'.base_url().'assets/global/plugins/amcharts4/charts.js" type="text/javascript"></script>
        <script src="'.base_url().'assets/global/plugins/amcharts4/themes/animated.js" type="text/javascript"></script>
        ';
        $script['script'] = '
        <script src="' . base_url() . 'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
        <script>
                am4core.useTheme(am4themes_animated);
                var chart = am4core.create("chartdiv", am4charts.XYChart);
                // Add data
                chart.data = '.$chart_data.'
                chart.padding(10, 30, 10, 20);
                chart.legend = new am4charts.Legend();// Legend
                // chart.legend.position = "top";
                chart.colors.step = 15;
                // Add cursor
                chart.cursor = new am4charts.XYCursor();
                // Create X axes
                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.title.text = "Dias";
                categoryAxis.dataFields.category = "DATA";
                categoryAxis.interactionsEnabled = false;
                categoryAxis.renderer.minGridDistance = 60;
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.cellStartLocation = 0.1;
                categoryAxis.renderer.cellEndLocation = 0.9;
                // Create Y axes
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.tooltip.disabled = true;
                valueAxis.title.text = "Quantidade";
                valueAxis.renderer.grid.template.strokeOpacity = 0.05;
                valueAxis.renderer.minGridDistance = 20;
                valueAxis.interactionsEnabled = false;
                valueAxis.min = 0;
                valueAxis.renderer.minWidth = 35;
                // Create series
                function createSeries(field, name, stacked) {
                  var series = chart.series.push(new am4charts.ColumnSeries());
                  series.dataFields.valueY = field;
                  series.dataFields.categoryX = "DATA";
                  series.name = name;
                  series.field = field;
                  series.columns.template.tooltipText = "{field}: [bold]{valueY}[/]";
                  series.stacked = stacked;
                  series.columns.template.width = am4core.percent(75);
                }
                //criar dinamicamente o createSeries.
                '.$graph.'
                //habilitar export em pdf img csv print ...
                chart.exporting.menu = new am4core.ExportMenu();
        </script>';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Mantis</span>', '/mantis;');
        $this->breadcrumbs->push('<span>Evolutiva</span>', '/mantis/graf_evolutiva');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('mantis/graficos_mantis/cgps/evolutiva',$data);

        $this->load->view('template/footer',$script);
    }

    public function chart_data($data_inicio,$data_fim) {
        $usuarios = $this->graf_evolutiva_model->evolutiva_usuarios($data_inicio,$data_fim);
        // $usuarios = $this->graf_evolutiva_model->evolutiva_usuarios('01/01/2019','03/04/2019');
        $data_atual = '';
        $dados = ' [';
        $virgula = '';
        $chave = '';
        foreach ($usuarios as $value) {
            if($data_atual == $value['DATA']){
                $dados .= ', "'.$value['USUARIO'] .'" : '. $value['QTD'];
            } else {
                $dados .= $chave;
                $dados .= $virgula;
                $dados .= '{ "DATA" : "'.$value['DATA'] .'", ';
                $dados .= '"'.$value['USUARIO'] .'" : '. $value['QTD'];
            }
            $data_atual = $value['DATA'];
            $virgula = ',';
            $chave ='}';
        }
        $dados .= '}],';
        // echo $dados;
        return $dados;
    }

    public function graph($data_inicio,$data_fim) {
        $dados = $this->graf_evolutiva_model->evolutiva_qtd($data_inicio,$data_fim);
        $concat = '';
        foreach ($dados as $value) {
            $concat .= 'createSeries("'.$value['USUARIO'].'", "'.$value['USUARIO'].' - '.$value['QTD'].'", true); ';
        }
        return $concat;
        // echo $concat;
    }


}

/* End of file graf_evolutiva.php */
/* Location: ./application/views/mantis/graf_evolutiva.php */