<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('unidade_model');
        $this->load->model('link_model');
        $this->load->model('fornecedor_model');
        $this->load->model('voip_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            // $data = array('error_message' => 'Efetue o login para acessar o sistema');
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/logout');
        }
    }

    public function index(){
            $this->output->enable_profiler(FALSE);
            $script['footerinc'] = '
                <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
                <script src="' . base_url() . 'assets/custom/link_acesso.js" type="text/javascript"></script>
            ';
            $script['script'] = '';

            $css['headerinc'] = '
                <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
                <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

            $session['username'] = $this->session->userdata('username');

            $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
            $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
            $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
            $this->breadcrumbs->push('<span>Acesso</span>', '/sistema/consulta/acesso');

            $this->load->view('template/header',$css);
            $this->load->view('template/navbar',$session);
            $this->load->view('template/sidebar');

            $this->load->view('sistema/itens_consulta/acesso');
            $this->load->view('modal/modal_form');

            $this->load->view('template/footer',$script);
         }



     public function acesso_list(){
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $acessos = $this->link_model->listar_acesso();

        $data = array();

        foreach($acessos->result() as $acesso) {
            $row = array();
            $row[] = $acesso->id_tipo_acesso;
            $row[] = $acesso->nome_tipo_acesso;
            $row[] = $acesso->comentario_tipo_acesso;
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$acesso->id_tipo_acesso."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$acesso->id_tipo_acesso."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $acessos->num_rows(),
            "recordsFiltered" => $acessos->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
     }

     public function acesso_add(){
        $this->acesso_validate();
        $data = array(
                'nome_tipo_acesso' => $this->input->post('nome'),
                'comentario_tipo_acesso' => $this->input->post('comentario'),
            );
        $insert = $this->link_model->save_acesso($data);
        echo json_encode(array("status" => TRUE));
     }

     public function acesso_edit($id){
        $data = $this->link_model->edit_acesso($id);
        echo json_encode($data);
     }

     public function acesso_update(){
        $this->acesso_validate();
        $data = array(
                'nome_tipo_acesso' => $this->input->post('nome'),
                'comentario_tipo_acesso' => $this->input->post('comentario'),
            );
        $this->link_model->update_acesso(array('id_tipo_acesso' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
     }

     public function acesso_delete($id){
        $this->link_model->delete_acesso($id);
        echo json_encode(array("status" => TRUE));
     }

     private function acesso_validate() {
         $data = array();
         $data['error_string'] = array ();
         $data['inputerror'] = array ();
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

/* End of file Acesso.php */
/* Location: ./application/controllers/Acesso.php */