<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarefas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here

        $this->load->model('usuario_model');
        $this->load->model('tarefas_model');
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
            <script src="'.base_url().'assets/custom/agendamento/tarefas.js" type="text/javascript"></script>
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
        $this->breadcrumbs->push('<span>Agendamento</span>', '/agendamento');
        $this->breadcrumbs->push('<span>Tarefas</span>', '/agendamento/tarefas');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('agendamento/tarefas');
        $this->load->view('modal/modal_tarefas', $modal);

        $this->load->view('template/footer', $script);
    }

    public function tarefas_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $tarefas = $this->tarefas_model->listar_tarefas();
        // vd($contratos);
        $data = array();
        foreach ($tarefas->result_array() as $tarefa) {
            $row = array();
            $row[] = $tarefa['id'];
            $row[] = $tarefa['nome_tarefas'];
            $row[] = $tarefa['mensagem_tarefas'];
            $row[] = date( 'd/m/Y H:i', strtotime($tarefa['data_inicio_tarefas']));
            $row[] = date( 'd/m/Y H:i', strtotime($tarefa['data_fim_tarefas']));
            $row[] = $tarefa['nome_grupo']; //responsavel
            $row[] = anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$tarefa['mantis_solicitado'].'', $tarefa['mantis_solicitado']);
            $row[] = anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$tarefa['mantis'].'', $tarefa['mantis']);
            if(acesso_admin()):
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_tarefas('."'".$tarefa['id']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_tarefas('."'".$tarefa['id']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            else:
                 $row[] = 'Sem permissão';
            endif;
            $data[] = $row;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $tarefas->num_rows(),
            "recordsFiltered" => $tarefas->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function tarefas_add() {
        $this->tarefas_validate();
        $data = array(
            'nome_tarefas' => $this->input->post('nome'),
            'mensagem_tarefas' => $this->input->post('mensagem'),
            'data_inicio_tarefas' => date('Y-m-d H:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_tarefas' => date('Y-m-d H:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis' => $this->input->post('mantis')
         );
        $this->tarefas_model->save_tarefas($data);
        echo json_encode(array("status" => TRUE));
    }

    public function tarefas_edit($id) {
        $tarefas = $this->tarefas_model->listar_tarefas($id);
        $resultado = $tarefas->row();
        $retorno = array(
            'id' => $resultado->id,
            'nome_tarefas' => $resultado->nome_tarefas,
            'mensagem_tarefas' => $resultado->mensagem_tarefas,
            'data_inicio_tarefas' => date('d-m-Y H:i', strtotime($resultado->data_inicio_tarefas)),
            'data_fim_tarefas' => date('d-m-Y H:i', strtotime($resultado->data_fim_tarefas)),
            'id_grupo' => $resultado->id_grupo,
            'mantis_solicitado' => $resultado->mantis_solicitado,
            'mantis' => $resultado->mantis
        );
        echo json_encode($retorno);
    }

    public function tarefas_update() {
        $this->tarefas_validate();
        $data = array(
            'nome_tarefas' => $this->input->post('nome'),
            'mensagem_tarefas' => $this->input->post('mensagem'),
            'data_inicio_tarefas' => date('Y-m-d H:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_tarefas' => date('Y-m-d H:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis' => $this->input->post('mantis')
         );
        $this->tarefas_model->update_tarefas(array('id' => $this->input->post('id')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function tarefas_delete($id) {
        $this->tarefas_model->delete_tarefas($id);
        echo json_encode(array("status" => TRUE));
    }

    public function tarefas_validate() {
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

}

/* End of file Agendamento.php */
/* Location: ./application/controllers/gerencias/Agendamento.php */