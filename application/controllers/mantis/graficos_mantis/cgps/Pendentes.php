<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendentes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('graf_chamados_pendentes_model', 'pendentes_model');
        $this->load->helper('date_helper');
    }

    public function index(){
        if($this->input->post('ano')) {
            $ano = $this->input->post('ano');
            $data['ano'] = $ano;
        } else {
            $ano = date('Y');
            $data['ano'] = date('Y');
        }

        $this->output->enable_profiler(FALSE);
        $chart_data = $this->chart_data($ano);

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
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        // Add data
        chart.data = '.$chart_data.';

        // Create data axis
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "DATA";
        // categoryAxis.renderer.opposite = true;

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Quantidade";
        // valueAxis.renderer.opposite = true;
        // valueAxis.renderer.grid.template.disabled = true;

        // Create series
        var series1 = chart.series.push(new am4charts.LineSeries());
        series1.dataFields.valueY = "PROJETOS";
        series1.dataFields.categoryX = "DATA";
        series1.name = "Projetos";
        series1.strokeWidth = 3;
        series1.tensionX = 0.8;
        series1.bullets.push(new am4charts.CircleBullet());
        series1.tooltipText = "{name} : {valueY}";
        series1.legendSettings.valueText = "{valueY}";
        series1.visible  = false;

        var series2 = chart.series.push(new am4charts.LineSeries());
        series2.dataFields.valueY = "EVOLUTIVA";
        series2.dataFields.categoryX = "DATA";
        series2.name = "Evolutiva";
        series2.strokeWidth = 3;
        series2.tensionX = 0.8;
        series2.bullets.push(new am4charts.CircleBullet());
        series2.tooltipText = "{name} : {valueY}";
        series2.legendSettings.valueText = "{valueY}";

        var series3 = chart.series.push(new am4charts.LineSeries());
        series3.dataFields.valueY = "SUSTENTACAO";
        series3.dataFields.categoryX = "DATA";
        series3.name = "Sustentação";
        series3.strokeWidth = 3;
        series3.tensionX = 0.8;
        series3.bullets.push(new am4charts.CircleBullet());
        series3.tooltipText = "{name} : {valueY}";
        series3.legendSettings.valueText = "{valueY}";

        // Add cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.opacity = 0;
        chart.cursor.lineY.opacity = 0;

        // Add legend
        chart.legend = new am4charts.Legend();

        //habilitar export em pdf img csv print ...
        chart.exporting.menu = new am4core.ExportMenu();
        </script>';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Mantis</span>', '/mantis;');
        $this->breadcrumbs->push('<span>Chamados Pendentes</span>', '/mantis/graf_chamados_pendentes');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('mantis/graf_chamados_pendentes',$data);

        $this->load->view('template/footer',$script);
    }

    public function chart_data($ano) {
    // public function chart_data() {
        $chamados = $this->pendentes_model->chamados_pendentes($ano);
        // $chamados = $this->pendentes_model->chamados_pendentes('2019');
        $result = array();
        foreach ($chamados as $value) {
            $retorno = array(
                'DATA' => dataEmPortugues($value['MES']),
                'PROJETOS' => intval($value['PROJETOS']),
                'EVOLUTIVA' => intval($value['EVOLUTIVA']),
                'SUSTENTACAO' => intval($value['SUSTENTACAO'])
            );
            array_push($result,$retorno);
        }
        return json_encode($result);
        // echo json_encode($result);
    }

}

/* End of file graf_chamados_pendentes.php */
/* Location: ./application/controllers/mantis/graf_chamados_pendentes.php */