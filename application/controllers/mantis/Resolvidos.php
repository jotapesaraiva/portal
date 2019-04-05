<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resolvidos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('resolvidos_model');
    }

    public function index(){
        if($this->input->post('data_inicio')) {
            $data_inicio = $this->input->post('data_inicio');
            $data['data_inicio'] = $data_inicio;
        } else {
            $data_inicio = date('d/m/Y', strtotime('-'.date('w').' days'));
            $data['data_inicio'] = date('d-m-Y', strtotime('-'.date('w').' days'));
        }

        if($this->input->post('data_fim')) {
            $data_fim = $this->input->post('data_fim');
            $data['data_fim'] = $data_fim;
        } else {
            $data_fim = date('d/m/Y', strtotime('+'.(6-date('w')).' days'));
            $data['data_fim'] = date('d-m-Y', strtotime('+'.(6-date('w')).' days'));
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
                chart.colors.step = 15;
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
                  series.dataFields.valueY = field;//faz referencia ao chart.data
                  series.dataFields.categoryX = "DATA";//faz referencia o chart.data
                  series.name = name;//nome que vai ser exibido
                  series.field = field;
                  series.columns.template.tooltipText = "{field}: [bold]{valueY}[/]";
                  series.stacked = stacked;// junta tudo em um só coluna.
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
        $this->breadcrumbs->push('<span>Resolvidos</span>', '/mantis/resolvidos');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('mantis/resolvidos',$data);

        $this->load->view('template/footer',$script);
    }

    public function chart_data($data_inicio,$data_fim) {
        $usuarios = $this->resolvidos_model->usuarios($data_inicio,$data_fim);
        $data_atual = '';
        $dados = '[';
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
        $dados = $this->resolvidos_model->nome_usuario($data_inicio,$data_fim);
        $concat = '';
        foreach ($dados as $value) {
            $concat .= 'createSeries("'.$value['USUARIO'].'", "'.$value['USUARIO'].' - '.$value['QTD'].'", true); ';
        }
        return $concat;
        // echo $concat;
    }

    public function semana() {
        $Week = date('w'); /* Semana atual... */
        $FirstDay = date('d/m/Y', strtotime('-'.$Week.' days'));
        $LastDay = date('d/m/Y', strtotime('+'.(6-$Week).' days'));
        // echo date('Y-m-d', strtotime('sunday last week', strtotime('2015-10-15')));//Primeiro dia da semana último domingo
        // echo '<br />'.date('Y-m-d', strtotime('saturday this week', strtotime('2015-10-15')));//Último dia da semana próximo sábado
        var_dump($Week);
        var_dump($FirstDay);
        var_dump($LastDay);
    }

}

/* End of file Resolvidos.php */
/* Location: ./application/controllers/mantis/Resolvidos.php */