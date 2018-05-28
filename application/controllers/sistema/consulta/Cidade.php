<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('unidade_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }
    }

    public function index(){
           $this->output->enable_profiler(FALSE);
           $script['footerinc'] = '
               <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
               <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
               <script src="' . base_url() . 'assets/custom/localidade_cidade.js" type="text/javascript"></script>
           ';
           $script['script'] = '';

           $css['headerinc'] = '
               <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
               <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

           $session['username'] = $this->session->userdata('username');

           $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
           $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
           $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
           $this->breadcrumbs->push('<span>Cidade</span>', '/sistema/consulta/cidade');

           $this->load->view('template/header',$css);
           $this->load->view('template/navbar',$session);
           $this->load->view('template/sidebar');

           $this->load->view('sistema/itens_consulta/cidade');
           $this->load->view('modal/modal_form');

           $this->load->view('template/footer',$script);
        }

        public function cidade_list(){
           // Datatables Variables
           $draw = intval($this->input->get("draw"));
           $start = intval($this->input->get("start"));
           $length = intval($this->input->get("length"));

           $cidades = $this->unidade_model->listar_cidade();

           $data = array();

           foreach($cidades->result() as $cidade) {
               $row = array();
               $row[] = $cidade->id_cidade;
               $row[] = $cidade->nome_cidade;
               $row[] = $cidade->comentario_cidade;
               $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$cidade->id_cidade."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                         <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cidade->id_cidade."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
               $data[] = $row;
           }

           $output = array(
               "draw" => $draw,
               "recordsTotal" => $cidades->num_rows(),
               "recordsFiltered" => $cidades->num_rows(),
               "data" => $data,
           );
           echo json_encode($output);
        }

        public function cidade_add(){
           $this->cidade_validate();
           $data = array(
                   'nome_cidade' => $this->input->post('nome'),
                   'comentario_cidade' => $this->input->post('comentario'),
               );
           $insert = $this->unidade_model->save_cidade($data);
           echo json_encode(array("status" => TRUE));
        }

        public function cidade_edit($id){
           $data = $this->unidade_model->edit_cidade($id);
           echo json_encode($data);
        }

        public function cidade_update(){
           $this->cidade_validate();
           $data = array(
                   'nome_cidade' => $this->input->post('nome'),
                   'comentario_cidade' => $this->input->post('comentario'),
               );
           $this->unidade_model->update_cidade(array('id_cidade' => $this->input->post('id')), $data);
           echo json_encode(array("status" => TRUE));
        }

        public function cidade_delete($id){
           $this->unidade_model->delete_cidade($id);
           echo json_encode(array("status" => TRUE));
        }

        private function cidade_validate(){
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

/* End of file Cidade.php */
/* Location: ./application/controllers/Cidade.php */