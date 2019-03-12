<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ativos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('ativos_model');
        $this->load->model('usuario_model');
    }

    public function index() {


        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '';
        $script['footerinc'] = '<script src="' . base_url() . 'assets/custom/ativos.js" type="text/javascript"></script>';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');
        $grupos = $this->usuario_model->listar_grupo();
        $tecnicos = $this->usuario_model->resp_tecnico();
        $modal = array(
            'grupos' => $grupos,
            'tecnicos' => $tecnicos
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
            $row[] = $ativos['nome_ativo'];
            $row[] = $ativos['localizacao_ativo'];
            $row[] = $ativos['numero_serie_ativo'];
            $row[] = $ativos['modelo_ativo'];
            $row[] = $ativos['fabricante_ativo'];
            $row[] = $ativos['tipo_ativo'];
            $row[] = $ativos['id_grupo'];
            $row[] = $ativos['id_tecnico'];
            $row[] = $ativos['patrimonio_ativo'];
            $row[] = $ativos['id_contrato'];
            $row[] = $ativos['id_fornecedor'];
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
        $this->fornecedor_validate();
        $data = array(
            'nome_ativo' => $this->input->post('nome'),
            'localizacao_ativo' => $this->input->post('localizacao'),
            'numero_serie_ativo' => $this->input->post('numero_serie'),
            'modelo_ativo' => $this->input->post('modelo'),
            'fabricante_ativo' => $this->input->post('fabricante'),
            'id_grupo' => $this->input->post('grupo'),
            'id_tecnico' => $this->input->post('tecnico'),
            'patrimonio_ativo' => $this->input->post('patrimonio'),
            'id_contrato' => $this->input->post('contrato'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->ativos_model->save_ativos($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ativos_edit($id) {
        $ativo = $this->ativos_model->edit_ativo($id);
        echo json_encode($ativos);
    }

    public function ativos_view($id)
    {
        # code...
    }

    public function ativos_update()
    {
        $this->fornecedor_validate();
        $data = array(
            'nome_ativo' => $this->input->post('nome'),
            'localizacao_ativo' => $this->input->post('localizacao'),
            'numero_serie_ativo' => $this->input->post('numero_serie'),
            'modelo_ativo' => $this->input->post('modelo'),
            'fabricante_ativo' => $this->input->post('fabricante'),
            'id_grupo' => $this->input->post('grupo'),
            'id_tecnico' => $this->input->post('tecnico'),
            'patrimonio_ativo' => $this->input->post('patrimonio'),
            'id_contrato' => $this->input->post('contrato'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->ativos_model->update_ativo($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ativos_delete($id)
    {
        $this->ativos_model->delete_ativo($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ativos_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('servico') == '') {
            $data['inputerror'][] = 'servico';
            $data['error_string'][] = 'O campo tipo de servico é obrigatorio';
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