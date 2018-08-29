<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamento_voip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('voip_model');
        $this->load->model('telefonia_model');
        $this->load->model('unidade_model');
        $this->load->library('Auth_AD');
        esta_logado();
    }

    public function index(){
       $this->output->enable_profiler(FALSE);
       $script['footerinc'] = '
           <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/custom/voip_equipamento.js" type="text/javascript"></script>
       ';
       $script['script'] = '';

       $css['headerinc'] = '
           <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
           <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

       $session['username'] = $this->session->userdata('username');

       $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
       $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
       $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
       $this->breadcrumbs->push('<span>Equipamento VoIP</span>', '/sistema/consulta/equipamento_voip');

       $this->load->view('template/header',$css);
       $this->load->view('template/navbar',$session);
       $this->load->view('template/sidebar');

       $this->load->view('sistema/itens_consulta/equipamento');
       $this->load->view('modal/modal_form');

       $this->load->view('template/footer',$script);
    }

    public function equipamento_voip_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $equipamentos = $this->voip_model->listar_equipamento();

       $data = array();

       foreach($equipamentos->result() as $equipamento) {
           $row = array();
           $row[] = $equipamento->id_tipo_equipamento_voip;
           $row[] = $equipamento->nome_tipo_equipamento_voip;
           $row[] = $equipamento->comentario_tipo_equipamento_voip;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$equipamento->id_tipo_equipamento_voip."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$equipamento->id_tipo_equipamento_voip."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $equipamentos->num_rows(),
           "recordsFiltered" => $equipamentos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function equipamento_voip_add(){
       $this->equipamento_voip_validate();
       $data = array(
               'nome_tipo_equipamento_voip' => $this->input->post('nome'),
               'comentario_tipo_equipamento_voip' => $this->input->post('comentario'),
           );
       $insert = $this->voip_model->save_equipamento($data);
       echo json_encode(array("status" => TRUE));
    }

    public function equipamento_voip_edit($id){
       $data = $this->voip_model->edit_equipamento($id);
       echo json_encode($data);
    }

    public function equipamento_voip_update(){
       $this->equipamento_voip_validate();
       $data = array(
               'nome_tipo_equipamento_voip' => $this->input->post('nome'),
               'comentario_tipo_equipamento_voip' => $this->input->post('comentario'),
           );
       $this->voip_model->update_equipamento(array('id_tipo_equipamento_voip' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function equipamento_voip_delete($id){
       $this->voip_model->delete_equipamento($id);
       echo json_encode(array("status" => TRUE));
    }
    private function equipamento_voip_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Equipamento_voip.php */
/* Location: ./application/controllers/Equipamento_voip.php */