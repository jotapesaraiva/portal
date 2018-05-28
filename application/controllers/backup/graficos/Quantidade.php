<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quantidade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('indicadores_model');
        $this->load->library('highcharts');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()) {
            $username = $this->session->userdata('username');
        } else {
            // $data = array('error_message' => 'Efetue o login para acessar o sistema');
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }
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

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Gráfico</span>', '/backup/graficos');
        $this->breadcrumbs->push('<span>Quantidade</span>', '/backup/graficos/quantidade');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/quantidade', $data);

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

/* End of file Quantidade.php */
/* Location: ./application/controllers/backup/graficos/Quantidade.php */