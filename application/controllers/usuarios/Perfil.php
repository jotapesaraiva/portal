<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('usuario_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            if($this->auth_ad->level_access($this->uri->segment(2),$this->session->userdata('physicaldeliveryofficename'))){
                $username = $this->session->userdata('username');
            } else {
                set_msg('loginErro','Você não tem acesso a esse modulo.','erro');
                redirect('welcome');
            }
        } else {
          // $data = array('error_message' => 'Efetue o login para acessar o sistema');
          set_msg('loginErro','Efetue o login para acessar o sistema','erro');
          redirect('auth/login');
        }
    }

    public function index() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/perfil.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/switch.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');
        $modal['modulos'] = $this->usuario_model->list_modulos();

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Perfil</span>', '/usuarios/perfil');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/perfil');
        $this->load->view('modal/modal_modulos',$modal);
        $this->load->view('modal/modal_membros');

        $this->load->view('template/footer',$script);
    }

    public function teste() {
        // echo $this->uri->uri_string();
        // echo "<br>";
        // echo $this->uri->segment(2);
        // echo "<br>";
        // echo "<br>";
        // $membros = $this->usuario_model->modulos_grupo_nome('CGRE-Produção');
        // // vd($membros->result());
        // $mod = array();
        // foreach ($membros->result() as $mem) {
        //     // echo $mem->nome_modulo . "<br>";
        //     $mod[] = $mem->nome_modulo;
        // }
        // // vd($mod);
        // if (in_array($this->uri->segment(3), $mod)) {
        //     echo "acesso ok";
        // } else {
        //     echo "acesso negado <br>";
        // }
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/perfil.js" type="text/javascript"></script>';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Perfil</span>', '/usuarios/perfil');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        // $this->load->view('usuarios/perfil');
        $this->load->view('teste/checkbox');
        $this->load->view('modal/modal_form');

        $this->load->view('template/footer',$script);
    }

    public function perfil_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $perfils = $this->usuario_model->listar_grupo();

       $data = array();

       foreach($perfils->result() as $perfil) {
           $row = array();
           $row[] = $perfil->id_grupo;
           $row[] = $perfil->nome_grupo;
           // $membros = $this->usuario_model->membros_grupo($perfil->id_grupo);
           // if($membros == null){
           //      $row[] ="";
           // } else {
           //     $mem ='';
           //     foreach ($membros->result() as $membro) {
           //          $mem .= $membro->nome_usuario. '<br>';
           //      }
           //     $row[] = $mem;
           // }
           $row[] = '<a href="javascript:void(0)" title="Modulo" onclick="membro_group('."'".$perfil->id_grupo."'".')"> Membros </a>';
           $row[] = '<a href="javascript:void(0)" title="Modulo" onclick="modulo_group('."'".$perfil->id_grupo."'".')"> Modulos </a>';
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$perfil->id_grupo."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$perfil->id_grupo."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $perfils->num_rows(),
           "recordsFiltered" => $perfils->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function perfil_modulo($id) {
      $modulo = $this->usuario_model->modulos_grupo($id);
      $membro = $this->usuario_model->membros_grupo($id);
      // if($modulos == null){
      //      $row[]="";
      // } else {
      //     $mod = '';
      //     foreach($modulos->result() as $modulo){
      //          $mod .= $modulo->nome_modulo. '<br>';
      //      }
      //     $row[] = $mod;
      // }
      // vd($modulos);
      $data = array(
        'modulo' => $modulo,
        'membro' => $membro->result()
      );
      echo json_encode($data);
    }

    public function perfil_add(){
       //$this->_validate();
       $data = array(
               'nome_perfil' => $this->input->post('nome'),
               'comentario_perfil' => $this->input->post('comentario'),
           );
       $insert = $this->usuario_model->save_perfil($data);
       echo json_encode(array("status" => TRUE));
    }

    public function perfil_edit($id){
       $data = $this->usuario_model->edit_perfil($id);
       echo json_encode($data);
    }

    public function perfil_update(){
       //$this->_validate();
       $data = array(
               'nome_perfil' => $this->input->post('nome'),
               'comentario_perfil' => $this->input->post('comentario'),
           );
       $this->usuario_model->update_perfil(array('id_perfil' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function perfil_delete($id){
       $this->usuario_model->delete_perfil($id);
       echo json_encode(array("status" => TRUE));
    }

    private function perfil_validate() {
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

/* End of file Perfil.php */
/* Location: ./application/controllers/usuarios/Perfil.php */