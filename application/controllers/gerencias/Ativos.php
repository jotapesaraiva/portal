<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('ativos_model');
        $this->load->model('usuario_model');
        $this->load->model('fornecedor_model');
        $this->load->model('contratos_model');
    }

    public function index() {

        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '<link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/custom/gerencias/ativos.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');
        $grupos = $this->usuario_model->listar_grupo();
        $tecnicos = $this->usuario_model->resp_tecnico();
        $fornecedores = $this->fornecedor_model->listar_fornecedor();
        $contratos = $this->contratos_model->listar_contratos();
        $tipos = $this->ativos_model->listar_tipo();

        $modal = array(
            'grupos' => $grupos,
            'tecnicos' => $tecnicos,
            'fornecedores' => $fornecedores,
            'contratos' => $contratos,
            'tipos' => $tipos
        );

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Ativos</span>', '/gerencias/Ativos');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/ativos');
        $this->load->view('modal/modal_ativos', $modal);

        $this->load->view('template/footer', $script);

    }

    public function ativos_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $ativos = $this->ativos_model->listar_ativos();
        $data = array();
        foreach ($ativos->result_array() as $ativo) {
            $row = array();
            $row[] = $ativo['nome_ativo'];
            $row[] = $ativo['localizacao_ativo'];
            $row[] = $ativo['numero_serie_ativo'];
            $row[] = $ativo['modelo_ativo'];
            $row[] = $ativo['fabricante_ativo'];
            $row[] = $ativo['nome_tipo_ativo'];
            $row[] = $ativo['nome_grupo'];
            $row[] = $ativo['login_usuario'];
            $row[] = $ativo['patrimonio_ativo'];
            $row[] = $ativo['numero_contrato'];
            $row[] = $ativo['nome_fornecedor'];
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_ativo('."'".$ativo['id_ativo']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_ativo('."'".$ativo['id_ativo']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $ativos->num_rows(),
            "recordsFiltered" => $ativos->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ativos_add() {
        $this->ativos_validate();
        $data = array(
            'nome_ativo' => $this->input->post('nome'),
            'localizacao_ativo' => $this->input->post('localizacao'),
            'numero_serie_ativo' => $this->input->post('numero_serie'),
            'modelo_ativo' => $this->input->post('modelo'),
            'fabricante_ativo' => $this->input->post('fabricante'),
            'id_tipo_ativo' => $this->input->post('tipo'),
            'id_grupo' => $this->input->post('grupo'),
            'id_usuario' => $this->input->post('tecnico'),
            'patrimonio_ativo' => $this->input->post('patrimonio'),
            'id_contrato' => $this->input->post('contrato'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->ativos_model->save_ativo($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ativos_edit($id) {
        $ativo = $this->ativos_model->listar_ativos($id);
        echo json_encode($ativo->result_array());
    }

    public function ativos_view($id) {
        # code...
    }

    public function ativos_update() {
        $this->ativos_validate();
        $data = array(
            'nome_ativo' => $this->input->post('nome'),
            'localizacao_ativo' => $this->input->post('localizacao'),
            'numero_serie_ativo' => $this->input->post('numero_serie'),
            'modelo_ativo' => $this->input->post('modelo'),
            'fabricante_ativo' => $this->input->post('fabricante'),
            'id_tipo_ativo' => $this->input->post('tipo'),
            'id_grupo' => $this->input->post('grupo'),
            'id_usuario' => $this->input->post('tecnico'),
            'patrimonio_ativo' => $this->input->post('patrimonio'),
            'id_contrato' => $this->input->post('contrato'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->ativos_model->update_ativo(array('id_ativo' => $this->input->post('id_ativo')),$data);
        echo json_encode(array("status" => TRUE));
    }

    public function ativos_delete($id) {
        $this->ativos_model->delete_ativo($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ativos_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('numero_serie') == '') {
            $data['inputerror'][] = 'numero_serie';
            $data['error_string'][] = 'O campo numero de serie é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('patrimonio') == '') {
            $data['inputerror'][] = 'patrimonio';
            $data['error_string'][] = 'O campo patrimonio é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Ativos.php */
/* Location: ./application/controllers/gerencias/Ativos.php */