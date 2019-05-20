<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendamento extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here

        $this->load->model('usuario_model');
        $this->load->model('agendamento_model');
        $this->load->model('mantis_model');
        $this->load->helper('color_mantis');
        include APPPATH . 'third_party/zabbix/date_function.php';
    }

    public function index() {
        esta_logado();
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '

            <link href="'.base_url().'assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/custom/gerencias/agendamento.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '
            <script src="'.base_url().'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $session['username'] = $this->session->userdata('username');
        $grupos = $this->usuario_model->listar_grupo();

        $modal = array( 'grupos' => $grupos,);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Agendamento</span>', '/gerencias/agendamento');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/agendamento');
        $this->load->view('modal/modal_agendamento', $modal);

        $this->load->view('template/footer', $script);
    }

    public function agendamento_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $agendamentos = $this->agendamento_model->listar_agendamento();
        // vd($contratos);
        $data = array();
        foreach ($agendamentos->result_array() as $agendamento) {
            $row = array();
            $row[] = $agendamento['id'];
            $row[] = $agendamento['nome_agendamento'];
            $row[] = $agendamento['mensagem_agendamento'];
            $row[] = date( 'd/m/Y H:i', strtotime($agendamento['data_inicio_agendamento']));
            $row[] = date( 'd/m/Y H:i', strtotime($agendamento['data_fim_agendamento']));
            $row[] = $agendamento['nome_grupo']; //responsavel
            $row[] = anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$agendamento['mantis_solicitado'].'', $agendamento['mantis_solicitado']);
            $row[] = anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$agendamento['mantis'].'', $agendamento['mantis']);
            if(acesso_admin()):
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_agendamento('."'".$agendamento['id']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_agendamento('."'".$agendamento['id']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            else:
                 $row[] = 'Sem permissão';
            endif;
            $data[] = $row;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $agendamentos->num_rows(),
            "recordsFiltered" => $agendamentos->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function agendamento_add() {
        $this->agendamento_validate();
        $data = array(
            'nome_agendamento' => $this->input->post('nome'),
            'mensagem_agendamento' => $this->input->post('mensagem'),
            'data_inicio_agendamento' => date('Y-m-d H:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_agendamento' => date('Y-m-d H:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis' => $this->input->post('mantis')
         );
        $this->agendamento_model->save_agendamento($data);
        echo json_encode(array("status" => TRUE));
    }

    public function agendamento_edit($id) {
        $agendamento = $this->agendamento_model->listar_agendamento($id);
        $resultado = $agendamento->row();
        $retorno = array(
            'id' => $resultado->id,
            'nome_agendamento' => $resultado->nome_agendamento,
            'mensagem_agendamento' => $resultado->mensagem_agendamento,
            'data_inicio_agendamento' => date('d-m-Y H:i', strtotime($resultado->data_inicio_agendamento)),
            'data_fim_agendamento' => date('d-m-Y H:i', strtotime($resultado->data_fim_agendamento)),
            'id_grupo' => $resultado->id_grupo,
            'mantis_solicitado' => $resultado->mantis_solicitado,
            'mantis' => $resultado->mantis
        );
        echo json_encode($retorno);
    }

    public function agendamento_update() {
        $this->agendamento_validate();
        $data = array(
            'nome_agendamento' => $this->input->post('nome'),
            'mensagem_agendamento' => $this->input->post('mensagem'),
            'data_inicio_agendamento' => date('Y-m-d H:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_agendamento' => date('Y-m-d H:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis' => $this->input->post('mantis')
         );
        $this->agendamento_model->update_agendamento(array('id' => $this->input->post('id')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function agendamento_delete($id) {
        $this->agendamento_model->delete_agendamento($id);
        echo json_encode(array("status" => TRUE));
    }

    public function agendamento_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('mensagem') == '') {
            $data['inputerror'][] = 'mensagem';
            $data['error_string'][] = 'O campo mensagem é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('data_inicio') == '') {
            $data['inputerror'][] = 'data_inicio';
            $data['error_string'][] = 'O campo data inicio é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('data_fim') == '') {
            $data['inputerror'][] = 'data_fim';
            $data['error_string'][] = 'O campo data fim é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('grupo') == '') {
            $data['inputerror'][] = 'grupo';
            $data['error_string'][] = 'O campo grupo responsavel é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('mantis_solicitado') == '') {
            $data['inputerror'][] = 'mantis_solicitado';
            $data['error_string'][] = 'O campo mantis solicitado é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function alerta() {
        $result = $this->agendamento_model->select_alerta();
        // vd($result->result());
        echo $result->num_rows();
    }

    public function conteudo() {
        $resultado = array();
        $alertas = $this->agendamento_model->select_alerta();
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
                'title' => $alerta['nome_agendamento'],
                'post_user' => $alerta['nome_grupo'],
                'start_date' => $alerta['data_inicio_agendamento'],
                'stop_date' => $alerta['data_fim_agendamento'],
                'start_dc' => date('d/m/y H:i', strtotime($alerta['data_inicio_agendamento'])),
                'stop_dc' => date('d/m/y H:i', strtotime($alerta['data_fim_agendamento'])),
                'msg' => $alerta['mensagem_agendamento'],
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
}

/* End of file Agendamento.php */
/* Location: ./application/controllers/gerencias/Agendamento.php */