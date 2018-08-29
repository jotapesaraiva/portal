<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expediente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('unidade_model');
        $this->load->model('link_model');
        $this->load->model('fornecedor_model');
        $this->load->model('telefonia_model');
        $this->load->model('voip_model');
        $this->load->library('Auth_AD');
        esta_logado();
    }

    public function index() {
           $this->output->enable_profiler(FALSE);
           $script['footerinc'] = '
               <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
               <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
               <script src="' . base_url() . 'assets/custom/localidade_expediente.js" type="text/javascript"></script>
           ';
           $script['script'] = '';

           $css['headerinc'] = '
               <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
               <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

           $session['username'] = $this->session->userdata('username');

           $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
           $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
           $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
           $this->breadcrumbs->push('<span>Expediente</span>', '/sistema/consulta/expediente');

           $this->load->view('template/header',$css);
           $this->load->view('template/navbar',$session);
           $this->load->view('template/sidebar');

           $this->load->view('sistema/itens_consulta/expediente');
           $this->load->view('modal/modal_form');

           $this->load->view('template/footer',$script);
        }

        public function expediente_list(){
           // Datatables Variables
           $draw = intval($this->input->get("draw"));
           $start = intval($this->input->get("start"));
           $length = intval($this->input->get("length"));

           $expedientes = $this->unidade_model->listar_expediente();

           $data = array();

           foreach($expedientes->result() as $expediente) {
               $row = array();
               $row[] = $expediente->id_expediente;
               $row[] = $expediente->nome_expediente;
               $row[] = $expediente->comentario_expediente;
               $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$expediente->id_expediente."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                         <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$expediente->id_expediente."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
               $data[] = $row;
           }

           $output = array(
               "draw" => $draw,
               "recordsTotal" => $expedientes->num_rows(),
               "recordsFiltered" => $expedientes->num_rows(),
               "data" => $data,
           );
           echo json_encode($output);
        }

        public function expediente_add(){
           $this->expediente_validate();
           $data = array(
                   'nome_expediente' => $this->input->post('nome'),
                   'comentario_expediente' => $this->input->post('comentario'),
               );
           $insert = $this->unidade_model->save_expediente($data);
           echo json_encode(array("status" => TRUE));
        }

        public function expediente_edit($id){
           $data = $this->unidade_model->edit_expediente($id);
           echo json_encode($data);
        }

        public function expediente_update(){
           $this->expediente_validate();
           $data = array(
                   'nome_expediente' => $this->input->post('nome'),
                   'comentario_expediente' => $this->input->post('comentario'),
               );
           $this->unidade_model->update_expediente(array('id_expediente' => $this->input->post('id')), $data);
           echo json_encode(array("status" => TRUE));
        }

        public function expediente_delete($id){
           $this->unidade_model->delete_expediente($id);
           echo json_encode(array("status" => TRUE));
        }

        private function expediente_validate(){
                $data = array();
                $data['error_string'] = array();
                $data['inputerror'] = array();
                $data['status'] = TRUE;

                if($this->input->post('nome') == '') {
                    $data['inputerror'][] = 'nome';
                    $data['error_string'][] = 'O campo nome é obrigatorio';
                    $data['status'] = FALSE;
                }

                if($data['status'] === FALSE)
                {
                    echo json_encode($data);
                    exit();
                }
            }

}

/* End of file Expediente.php */
/* Location: ./application/controllers/Expediente.php */