<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendamento extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('usuario_model');
        $this->load->model('agendamento_model');
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/custom/agendamento.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '
            <script src="'.base_url().'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>';

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
            $row[] = $agendamento['nome_agendamento'];
            $row[] = $agendamento['mensagem_agendamento'];
            $row[] = date( 'd/M/Y h:i:s', strtotime($agendamento['data_inicio_agendamento']));
            $row[] = date( 'd/M/Y h:i:s', strtotime($agendamento['data_fim_agendamento']));
            $row[] = $agendamento['nome_grupo']; //responsavel
            $row[] = $agendamento['mantis_solicitado'];
            $row[] = $agendamento['mantis_notificado'];

            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_agendamento('."'".$agendamento['id_agendamento']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_agendamento('."'".$agendamento['id_agendamento']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
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
            'data_inicio_agendamento' => date('Y-m-d h:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_agendamento' => date('Y-m-d h:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis_notificado' => $this->input->post('mantis_notificado')
         );
        $this->agendamento_model->save_agendamento($data);
        echo json_encode(array("status" => TRUE));
    }

    public function agendamento_edit($id) {
        $agendamento = $this->agendamento_model->listar_agendamento($id);
        echo json_encode($agendamento->result_array());
    }

    public function agendamento_update() {
        $this->agendamento_validate();
        $data = array(
            'nome_agendamento' => $this->input->post('nome'),
            'mensagem_agendamento' => $this->input->post('mensagem'),
            'data_inicio_agendamento' => date('Y-m-d h:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_agendamento' => date('Y-m-d h:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis_notificado' => $this->input->post('mantis_notificado')
         );
        $this->agendamento_model->update_agendamento(array('id_agendamento' => $this->input->post('id_agendamento')),$data);
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
        $this->load->model('mensagem_rede_model');
        $result = $this->mensagem_rede_model->consulta();
        // vd($result->result());
        echo $result->num_rows();
    }

    public function conteudo() {
        $resultado = array();
        echo json_encode($resultado);
    }

}

/* End of file Agendamento.php */
/* Location: ./application/controllers/gerencias/Agendamento.php */