<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
        $this->load->model('ativos_model');
        $this->load->model('fornecedor_model');
        $this->load->model('contratos_model');
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/custom/gestao/contratos.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '
            <script src="'.base_url().'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $session['username'] = $this->session->userdata('username');
        $fornecedores = $this->fornecedor_model->listar_fornecedor();
        $tipos = $this->contratos_model->listar_tipo();

        $modal = array(
            'fornecedores' => $fornecedores,
            'tipos' => $tipos );

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gestão</span>', '/gestao');
        $this->breadcrumbs->push('<span>Contratos</span>', '/gestao/contratos');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('gestao/contratos');
        $this->load->view('modal/modal_contratos', $modal);

        $this->load->view('template/footer', $script);
    }

    public function contratos_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $contratos = $this->contratos_model->listar_contratos();
        // vd($contratos);
        $data = array();
        foreach ($contratos->result_array() as $contrato) {
            $row = array();
            $row[] = $contrato['nome_contrato'];
            $row[] = $contrato['numero_contrato'];
            $row[] = $contrato['nome_tipo_contrato'];
            $row[] = date( 'd/m/Y', strtotime($contrato['data_inicio_contrato']));
            $row[] = date( 'd/m/Y', strtotime($contrato['data_fim_contrato']));
            $row[] = $contrato['duracao_contrato'].' Anos';
            $row[] = $contrato['aviso_contrato'].' Meses';
            if ($contrato['renovacao_contrato'] == '1'){
             $row[] = '<span class="label label-sm label-info"> Sim. </span>';
            } else {
             $row[] = '<span class="label label-sm label-danger"> Não. </span>';
            }
            $row[] = $contrato['nome_fornecedor'];
            if(acesso_admin()):
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_contrato('."'".$contrato['id_contrato']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_contrato('."'".$contrato['id_contrato']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            else:
            $row[] = 'Sem permissão';
            endif;
            $data[] = $row;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $contratos->num_rows(),
            "recordsFiltered" => $contratos->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function contratos_add() {
        $this->contratos_validate();
        if($this->input->post('renovacao') == 'on') {
          $status = '1';
        } else {
          $status = '0';
        }
        $duracao = $this->duracao($this->input->post('data_inicio'),$this->input->post('data_fim'));
        $data = array(
            'nome_contrato' => $this->input->post('nome'),
            'id_tipo_contrato' => $this->input->post('tipo'),
            'numero_contrato' => $this->input->post('numero'),
            'data_inicio_contrato' => date('Y-m-d', strtotime($this->input->post('data_inicio'))),
            'data_fim_contrato' => date('Y-m-d', strtotime($this->input->post('data_fim'))),
            'duracao_contrato' => $duracao,
            'renovacao_contrato' => $status,
            'aviso_contrato' => $this->input->post('aviso'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->contratos_model->save_contrato($data);
        echo json_encode(array("status" => TRUE));
    }

    public function contratos_edit($id) {
        $contrato = $this->contratos_model->listar_contratos($id);
        echo json_encode($contrato->result_array());
    }

    public function contratos_update() {
        $this->contratos_validate();
        if($this->input->post('renovacao') == 'on') {
          $status = '1';
        } else {
          $status = '0';
        }
        $duracao = $this->duracao($this->input->post('data_inicio'),$this->input->post('data_fim'));
        $data = array(
            'nome_contrato' => $this->input->post('nome'),
            'id_tipo_contrato' => $this->input->post('tipo'),
            'numero_contrato' => $this->input->post('numero'),
            'data_inicio_contrato' => date('Y-m-d', strtotime($this->input->post('data_inicio'))),
            'data_fim_contrato' => date('Y-m-d', strtotime($this->input->post('data_fim'))),
            'duracao_contrato' => $duracao,
            'renovacao_contrato' => $status,
            'aviso_contrato' => $this->input->post('aviso'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->contratos_model->update_contrato(array('id_contrato' => $this->input->post('id_contrato')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function contrato_delete($id) {
        $this->contratos_model->delete_contrato($id);
        echo json_encode(array("status" => TRUE));
    }

    public function contratos_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('tipo') == '') {
            $data['inputerror'][] = 'tipo';
            $data['error_string'][] = 'O campo tipo é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('numero') == '') {
            $data['inputerror'][] = 'numero';
            $data['error_string'][] = 'O campo numero é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('data_inicio') == '') {
            $data['inputerror'][] = 'data';
            $data['error_string'][] = 'O campo data inicio é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('data_fim') == '') {
            $data['inputerror'][] = 'data';
            $data['error_string'][] = 'O campo data fim é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('duracao') == '') {
            $data['inputerror'][] = 'duracao';
            $data['error_string'][] = 'O campo duração é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('aviso') == '') {
            $data['inputerror'][] = 'aviso';
            $data['error_string'][] = 'O campo aviso é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('fornecedor') == '') {
            $data['inputerror'][] = 'fornecedor';
            $data['error_string'][] = 'O campo fornecedor é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function duracao($datai,$dataf){
        // Usa a função strtotime() e pega o timestamp das duas datas:
        // $time_inicial = strtotime($datai);
        // $time_final = strtotime($dataf);
        $ano_inicial = date('Y',strtotime($datai));
        $ano_final = date('Y',strtotime($dataf));
        // Calcula a diferença de segundos entre as duas datas:
        // $diferenca = $time_final - $time_inicial; // 19522800 segundos
        $diferenca = $ano_final - $ano_inicial; // 19522800 segundos
        // Calcula a diferença de dias
        // $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
        // Exibe uma mensagem de resultado:
        // echo $dias;
        return $diferenca;
        // echo "A diferença entre as datas ".$data_inicial." e ".$data_final." é de <strong>".$dias."</strong> dias";
    }
}

/* End of file Contratos.php */
/* Location: ./application/controllers/gestao/Contratos.php */