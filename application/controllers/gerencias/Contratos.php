<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('ativos_model');
        $this->load->model('fornecedor_model');
        $this->load->model('contratos_model');
    }

    public function index() {

        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/custom/contratos.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>';
        $script['script'] = '
            <script src="' . base_url() . 'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>';

        $session['username'] = $this->session->userdata('username');
        $fornecedores = $this->fornecedor_model->listar_fornecedor();

        $modal = array( 'fornecedores' => $fornecedores );

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Contratos</span>', '/gerencias/contratos');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/contratos');
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
            $row[] = $contrato['tipo_contrato'];
            $row[] = $contrato['data_inicio_contrato'];
            $row[] = $contrato['duracao_contrato'];
            $row[] = $contrato['aviso_contrato'];
            $row[] = $contrato['renovacao_contrato'];//deve aparecer sim ou não
            $row[] = $contrato['id_fornecedor']; //deve aparecer o nome da empresa
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_contrato('."'".$contrato['id_contrato']."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_contrato('."'".$contrato['id_contrato']."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
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
        // $this->ativos_validate();
        $data = array(
            'nome_contrato' => $this->input->post('nome'),
            'tipo_contrato' => $this->input->post('tipo'),
            'numero_contrato' => $this->input->post('numero'),
            'data_inicio_contrato' => $this->input->post('data_inicio'),
            'duracao_contrato' => $this->input->post('duracao'),
            'renovacao_contrato' => $this->input->post('renovacao'),
            'aviso_contrato' => $this->input->post('aviso'),
            'id_fornecedor' => $this->input->post('fornecedor')
         );
        $this->contratos_model->save_contrato($data);
        echo json_encode(array("status" => TRUE));
    }

    public function contratos_edit($id) {
        $contrato = $this->contratos_model->edit_contrato($id);
        echo json_encode($contrato);
    }


}

/* End of file Contratos.php */
/* Location: ./application/controllers/gerencias/Contratos.php */