<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alertas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('usuario_model');
        $this->load->model('alertas_model');
        $this->load->model('mantis_model');
        $this->load->helper('color_mantis');
        include APPPATH . 'third_party/zabbix/date_function.php';
    }

    public function index() {
        $resultado = array();
        $alertas = $this->alertas_model->select_alerta();
        foreach ($alertas->result_array() as $alerta) {
            if($alerta['mantis'] == 0) {
                $flag = 'class="danger"';
                $mantis = ' <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar/agendamento/'.$alerta['id'].'" title="Criar Mantis">
                                <i class="fa fa-plus"></i>
                            </a>';
            } else {
                $status = $this->mantis_model->mantis($alerta['mantis']);
                $flag = '';
                $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id=
                '.$alerta['mantis'].'" class = "label label-'.color_mantis('30').'" target="_blank">
                '.$alerta['mantis'].'</a>';
            }
            $result = array(
                'flag'     => $flag,
                'id' => $alerta['id'],
                'title' => $alerta['nome_tarefas'],
                'post_user' => $alerta['nome_grupo'],
                'start_date' => $alerta['data_inicio_tarefas'],
                'stop_date' => $alerta['data_fim_tarefas'],
                'start_dc' => date('d/m/y H:i', strtotime($alerta['data_inicio_tarefas'])),
                'stop_dc' => date('d/m/y H:i', strtotime($alerta['data_fim_tarefas'])),
                'msg' => $alerta['mensagem_tarefas'],
                'mantis'   => $mantis
            );
            array_push($resultado, $result);
        }
        echo json_encode($resultado);
    }

    public function table_agendamento_alerta(){
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '';
        $script['footerinc'] = '<script src="'.base_url().'assets/custom/dashboard/alerta_agendamento.js" type="text/javascript"></script>';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Agendamento Alerta</span>', '/gerencias/agendamento_alerta');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/table_agendamento_alerta');

        $this->load->view('template/footer', $script);
    }

    public function alerta() {
        $result = $this->alertas_model->select_alerta();
        // vd($result->result());
        echo $result->num_rows();
    }

}

/* End of file Alertas.php */
/* Location: ./application/controllers/agendamento/Alertas.php */