<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meu_perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
        $this->load->model('usuario_model');
        $this->load->model('menu_model');
        $this->load->helper('month_helper');
        $this->load->helper('equipe_helper');
        $this->load->helper('color_mantis_helper');
        $this->load->helper('midia_helper');
        $this->load->helper('thumbs_helper');
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $equipe = $this->session->userdata('physicaldeliveryofficename');
        $username = $this->session->userdata('username');
        $perfil_user = image_upload($username);
        $user = array(
            'username' => $username,
            'perfil_user' => $perfil_user);
        $score_mantis = $this->menu_model->score_mantis($username);
        $servicos = $this->menu_model->top_servicos(date_start(),date_end(),numero_equipe($equipe));
        $categoria = $this->menu_model->top_categoria(date_start(),date_end(),numero_equipe($equipe));
        $abertos = $this->menu_model->top_abertos(date_start(),date_end(),numero_equipe($equipe));
        $atribuidos = $this->menu_model->mantis_atribuito($username);
        // vd($status);
        $dados = array(
            'abertos'    => $score_mantis->ABERTOS,
            'impedidos'  => $score_mantis->IMPEDIDOS,
            'realizados' => $score_mantis->REALIZADOS,
            'servicos'   => $servicos,
            'categoria'  => $categoria,
            'chamados'   => $abertos,
            'atribuidos' => $atribuidos
        );
        $resolvidos = $this->resolvidos(date_start(),date_end(),numero_equipe($equipe));
        // $status = $this->status(date_start(),date_end(),numero_equipe($equipe));

        $css['headerinc'] = '
            <link href="'.base_url().'assets/pages/css/profile.css" rel="stylesheet" type="text/css" />';
        $script['script'] = '
            <script>
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.XYChart);
            // Add data
            chart.data = '.$resolvidos.';

            // Create axes
            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "USERNAME";
            categoryAxis.renderer.grid.template.opacity = 0;

            var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
            valueAxis.min = 0;
            valueAxis.renderer.grid.template.opacity = 0;
            valueAxis.renderer.ticks.template.strokeOpacity = 0.5;
            valueAxis.renderer.ticks.template.stroke = am4core.color("#495C43");
            valueAxis.renderer.ticks.template.length = 10;
            valueAxis.renderer.line.strokeOpacity = 0.5;
            valueAxis.renderer.baseGrid.disabled = true;
            valueAxis.renderer.minGridDistance = 30;

            // Create series
            function createSeries(field, name, cor) {
              var series = chart.series.push(new am4charts.ColumnSeries());
              series.dataFields.valueX = field;
              series.dataFields.categoryY = "USERNAME";
              series.stacked = true;
              series.name = name;
              series.fill = am4core.color(cor);
              series.stroke = series.fill;

              var labelBullet = series.bullets.push(new am4charts.LabelBullet());
              labelBullet.locationX = 0.5;
              labelBullet.label.text = "{valueX}";
              labelBullet.label.fill = am4core.color("#fff");
            }
            createSeries("IMEDIATO", "Imediato","#D91E18");//vermelho
            createSeries("URGENTE", "Urgente","#E87E04");//laranja
            createSeries("ALTA", "Alta","#f3c200");//amarelo
            createSeries("NORMAL", "Normal","#26C281");//verde
            //habilitar export em pdf img csv print ...
            chart.exporting.menu = new am4core.ExportMenu();

            // Add cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.lineX.opacity = 0;
            chart.cursor.lineY.opacity = 0;
            </script>


            <script>
            am4core.useTheme(am4themes_animated);

            var chart = am4core.create("chartPieDiv", am4charts.PieChart);

            chart.dataSource.url = "'.base_url().'menu/meu_perfil/status";
            chart.dataSource.parser = new am4core.JSONParser();
            chart.dataSource.parser.options.emptyAs = 0;

            var series = chart.series.push(new am4charts.PieSeries());
            series.dataFields.value = "QTD";
            series.dataFields.category = "STATUS_DESCRIPTION";
            // series.fill = am4charts.color("#FF0000")
            // series.stroke = series.fill;

            // this creates initial animation
            series.hiddenState.properties.opacity = 1;
            series.hiddenState.properties.endAngle = -90;
            series.hiddenState.properties.startAngle = -90;

            chart.legend = new am4charts.Legend();
            </script>
        ';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/amcharts4/core.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/amcharts4/charts.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/amcharts4/themes/animated.js" type="text/javascript"></script>
        ';

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Meu perfil</span>', 'dash/meu_perfil');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('menu/meu_perfil',$dados);
        $this->load->view('template/footer',$script);
    }

    public function configuracao() {
        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/pages/css/profile.css" rel="stylesheet" type="text/css" />
            <link href="'. base_url() .'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['script'] = '';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="'. base_url() .'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="'. base_url() .'assets/custom/menu/configuracao.js"></script>
            ';

        $username = $this->session->userdata('username');
        $id_user = $this->usuario_model->id_user($username);

        $cargos = $this->usuario_model->listar_cargo();
        $grupos = $this->usuario_model->listar_grupo();
        $voips = $this->voip_model->listar_ramal();
        $permissaos = $this->usuario_model->listar_permissao();
        $score_mantis = $this->menu_model->score_mantis($username);
        // vd($usuario->row());
        $data = array(
            'cargos' => $cargos,
            'grupos' => $grupos,
            'voips' => $voips,
            'permissaos' => $permissaos,

            'abertos' => $score_mantis->ABERTOS,
            'impedidos' => $score_mantis->IMPEDIDOS,
            'realizados' => $score_mantis->REALIZADOS
        );
        $perfil_user = image_upload($username);
        $user = array(
            'username' => $username,
            'perfil_user' => $perfil_user);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Meu perfil</span>', 'dash/meu_perfil');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('menu/configuracao', $data);
        $this->load->view('template/footer',$script);
    }


    public function ajuda() {
        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/pages/css/profile.css" rel="stylesheet" type="text/css" />';
        $script['script'] = '';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>';

        $username = $this->session->userdata('username');
        $perfil_user = image_upload($username);
        $user = array(
            'username' => $username,
            'perfil_user' => $perfil_user);
        $score_mantis = $this->menu_model->score_mantis($username);
        $dados = array(
            'abertos'    => $score_mantis->ABERTOS,
            'impedidos'  => $score_mantis->IMPEDIDOS,
            'realizados' => $score_mantis->REALIZADOS);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Meu perfil</span>', 'dash/meu_perfil');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('menu/ajuda', $dados);
        $this->load->view('template/footer',$script);
    }


    // public function resolvidos() {
    public function resolvidos($data_inicio,$data_fim,$equipe) {
        // $equipe = $this->session->userdata('physicaldeliveryofficename');
        $data = $this->menu_model->realizado_prioridade($data_inicio,$data_fim,$equipe);
        // $data = $this->menu_model->realizado_prioridade(date_start(),date_end(),numero_equipe($equipe));
        // $data = $this->menu_model->realizado_prioridade('01/04/2019','01/04/2019');
        // Variavel onde será guardada a informação
        $result = array();
        foreach ($data as $value) {
            $retorno = array(
                'USERNAME' => $value['USERNAME'],
                'IMEDIATO' => intval($value['IMEDIATO']),
                'URGENTE' => intval($value['URGENTE']),
                'ALTA' => intval($value['ALTA']),
                'NORMAL' => intval($value['NORMAL']),
                'TOTAL' => intval($value['TOTAL'])
            );
            array_push($result,$retorno);
        }
        return json_encode($result);
        // echo json_encode($result);
    }

    public function status() {
    // public function status($data_inicio,$data_fim,$equipe) {
        $equipe = $this->session->userdata('physicaldeliveryofficename');
            // $data = $this->menu_model->status_prioridade($data_inicio,$data_fim,$equipe);
            $data = $this->menu_model->status_prioridade(date_start(),date_end(),numero_equipe($equipe));
            // vd($data);
            $result = array();
            foreach ($data as $value) {
                $retorno = array(
                    'STATUS'             => $value['STATUS'],
                    'STATUS_DESCRIPTION' => $value['STATUS_DESCRIPTION'],
                    'QTD'                => intval($value['QTD'])
                );
                array_push($result,$retorno);
            }
            // return json_encode($result);
            echo json_encode($result);

    }

    public function enviar() {
        $username = $this->session->userdata('username');
        $upload = do_upload('file',$username);
        // if (is_array($thumb29)):
        if (is_array($upload) && $upload['file_name'] != ' '):
            create_thumb2($upload['file_name']);
            create_thumb2($upload['file_name'],29,29);
            set_msg('retorno','Imagem salva com sucesso.','sucesso');
            $this->configuracao();
        else:
            set_msg('retorno', $upload, 'erro');
            $this->configuracao();
        endif;
    }

    public function listar_usuarios() {
        $this->load->model('usuario_model');
        $username = $this->session->userdata('username');
        $id_user = $this->usuario_model->id_user($username);

        $usuario = $this->usuario_model->listar_usuarios($id_user->id_usuario);
        $telefone = $this->usuario_model->edit_usuario_telefone($id_user->id_usuario,1);
        $celular = $this->usuario_model->edit_usuario_telefone($id_user->id_usuario,2);

        $voip = $this->usuario_model->edit_usuario_telefone($id_user->id_usuario,4);
        $modulo = $this->usuario_model->listar_modulos($id_user->id_usuario);
        // vd($usuario->row()->nome_usuario);
        $data = array(
            'usuario'  => $usuario->row(),
            'telefone' => $telefone,
            'celular'  => $celular,
            'voip'     => $voip,
            'modulo'   => $modulo
        );
        // vd($data);
        echo json_encode($data);
    }



    public function month() {
        $data_incio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));
        echo 'início ' . date('d/m/Y',$data_incio);
        echo ' fim ' . date('d/m/Y',$data_fim);
        echo '<br>';

        $mes = '02';      // Mês desejado, pode ser por ser obtido por POST, GET, etc.
        $ano = date("Y"); // Ano atual
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!
        echo $ultimo_dia;
        echo date(' t');

        echo '<br>';
        echo date_end();
    }


}

/* End of file Meu_perfil.php */
/* Location: ./application/controllers/dash/Meu_perfil.php */