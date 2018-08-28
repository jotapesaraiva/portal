<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('usuario_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
          // $data = array('error_message' => 'Efetue o login para acessar o sistema');
          set_msg('loginErro','Efetue o login para acessar o sistema','erro');
          redirect('auth/logout');
        }
    }

    public function index() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/modulos.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Modulos</span>', '/usuarios/modulos');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/modulos');
        $this->load->view('modal/modal_form');

        $this->load->view('template/footer',$script);
    }


    public function modulo_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $modulos = $this->usuario_model->listar_modulo();

       $data = array();

       foreach($modulos->result() as $modulo) {
           $row = array();
           $row[] = $modulo->id_modulo;
           $row[] = $modulo->nome_modulo;
           $row[] = $modulo->descricao_modulo;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$modulo->id_modulo."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$modulo->id_modulo."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $modulos->num_rows(),
           "recordsFiltered" => $modulos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function modulo_add(){
       //$this->_validate();
       $data = array(
               'nome_modulo' => $this->input->post('nome'),
               'descricao_modulo' => $this->input->post('comentario'),
           );
       $insert = $this->usuario_model->save_modulo($data);
       echo json_encode(array("status" => TRUE));
    }

    public function modulo_edit($id) {
       $data = $this->usuario_model->edit_modulo($id);
       echo json_encode($data);
    }

    public function modulo_update() {
       //$this->_validate();
       $data = array(
               'nome_modulo' => $this->input->post('nome'),
               'descricao_modulo' => $this->input->post('comentario'),
           );
       $this->usuario_model->update_modulo(array('id_modulo' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function modulo_delete($id) {
       $this->usuario_model->delete_modulo($id);
       echo json_encode(array("status" => TRUE));
    }

    private function modulo_validate() {
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

/* End of file Modulos.php */
/* Location: ./application/controllers/usuarios/Modulos.php */