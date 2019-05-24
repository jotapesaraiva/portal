<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manutencao extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here

        $this->load->model('usuario_model');
        $this->load->model('manutencao_model');
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
            <script src="'.base_url().'assets/custom/agendamento/manutencao.js" type="text/javascript"></script>
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
        $this->breadcrumbs->push('<span>Manutenção</span>', '/agendamento/manutencao');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('agendamento/manutencao');
        $this->load->view('modal/modal_manutencao', $modal);

        $this->load->view('template/footer', $script);
    }

    public function manutencao_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $manutencoes = $this->manutencao_model->listar_manutencao();
        // vd($contratos);
        $data = array();
        foreach ($manutencoes->result_array() as $manutencao) {
            $row = array();
            $row[] = $manutencao['id'];
            $row[] = $manutencao['nome_manutencao'];
            $row[] = $manutencao['mensagem_manutencao'];
            $row[] = date( 'd/m/Y H:i', strtotime($manutencao['data_inicio_manutencao']));
            $row[] = date( 'd/m/Y H:i', strtotime($manutencao['data_fim_manutencao']));
            $row[] = $manutencao['nome_grupo']; //responsavel
            $row[] = anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$manutencao['mantis_solicitado'].'', $manutencao['mantis_solicitado']);
            $row[] = anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$manutencao['mantis'].'', $manutencao['mantis']);
            if(acesso_admin()):
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_manutencao('."'".$manutencao['id']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_manutencao('."'".$manutencao['id']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            else:
                 $row[] = 'Sem permissão';
            endif;
            $data[] = $row;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $manutencoes->num_rows(),
            "recordsFiltered" => $manutencoes->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function manutencao_add() {
        $this->manutencao_validate();
        $data = array(
            'nome_manutencao' => $this->input->post('nome'),
            'mensagem_manutencao' => $this->input->post('mensagem'),
            'data_inicio_manutencao' => date('Y-m-d H:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_manutencao' => date('Y-m-d H:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis' => $this->input->post('mantis')
         );
        $this->manutencao_model->save_manutencao($data);
        echo json_encode(array("status" => TRUE));
    }

    public function manutencao_edit($id) {
        $manutencao = $this->manutencao_model->listar_manutencao($id);
        $resultado = $manutencao->row();
        $retorno = array(
            'id' => $resultado->id,
            'nome_manutencao' => $resultado->nome_manutencao,
            'mensagem_manutencao' => $resultado->mensagem_manutencao,
            'data_inicio_manutencao' => date('d-m-Y H:i', strtotime($resultado->data_inicio_manutencao)),
            'data_fim_manutencao' => date('d-m-Y H:i', strtotime($resultado->data_fim_manutencao)),
            'id_grupo' => $resultado->id_grupo,
            'mantis_solicitado' => $resultado->mantis_solicitado,
            'mantis' => $resultado->mantis
        );
        echo json_encode($retorno);
    }

    public function manutencao_update() {
        $this->tarefas_validate();
        $data = array(
            'nome_manutencao' => $this->input->post('nome'),
            'mensagem_manutencao' => $this->input->post('mensagem'),
            'data_inicio_manutencao' => date('Y-m-d H:i:s', strtotime($this->input->post('data_inicio'))),
            'data_fim_manutencao' => date('Y-m-d H:i:s', strtotime($this->input->post('data_fim'))),
            'id_grupo' => $this->input->post('grupo'),
            'mantis_solicitado' => $this->input->post('mantis_solicitado'),
            'mantis' => $this->input->post('mantis')
         );
        $this->manutencao_model->update_manutencao(array('id' => $this->input->post('id')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function manutencao_delete($id) {
        $this->manutencao_model->delete_manutencao($id);
        echo json_encode(array("status" => TRUE));
    }

    public function manutencao_validate() {
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