<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('usuario_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()) {
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
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/switch.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/perfil.js" type="text/javascript"></script>
        ';
        $script['script'] = '';


        $session['username'] = $this->session->userdata('username');
        $modal['modulos'] = $this->usuario_model->list_modulos();
        $data['membros'] = $this->usuario_model->listar_usuarios();

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Perfil</span>', '/usuarios/perfil');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/perfil');
        $this->load->view('modal/modal_form');
        $this->load->view('modal/modal_modulos',$modal);
        $this->load->view('modal/modal_membros',$data);

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
           $row[] = '<a href="javascript:void(0)" title="Modulo" onclick="membro_group('."'".$perfil->id_grupo."'".')"> Membros </a>';
           $row[] = '<a href="javascript:void(0)" title="Modulo" onclick="modulo_group('."'".$perfil->id_grupo."'".')"> Modulos </a>';

           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_perfil('."'".$perfil->id_grupo."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_perfil('."'".$perfil->id_grupo."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
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
      $id_modulos = $this->usuario_model->modulos_grupo($id);
      if($id_modulos == null){
        $row[] ="";
      } else{
          foreach ($id_modulos as $modulo) {
              $row[] = $modulo['id_modulo'];
          }
      }
      $data = array(
        'id_modulo' => $row,
        'id_grupo' => $id
        );
      echo json_encode($data);
    }

    public function perfil_membro($id) {
        $membros = $this->usuario_model->membros_grupo($id);
        $html = '';
        $count = 1;
        foreach ($membros->result() as $membro) {
            $button = '';
            if($count > 1){
                $button = '<button class="btn red remove" id="'.$count.'" type="button">
                            <i class="fa fa-times"></i>
                           </button>';
            } else {
                $button = '<button class="btn red remove" id="'.$count.'" type="button">
                            <i class="fa fa-times"></i>
                           </button>';
            }
            $html .= '<div class="col-md-offset-1 col-md-8" id="row'.$count.'">';
                $html .= '<div class="input-group">';
                    $html .= '<input class="form-control" name="membros_grupo[]" id="'.$membro->id_usuario.'" value="'.$membro->nome_usuario.'" disabled="" type="text">';
                    $html .= '<span class="input-group-btn">';
                            $html .= $button;
                    $html .= '</span>';
                $html .= '</div>';
            $html .= '</div>';
            $count++;
        }
        $output = array(
            'membro' => $html
        );
        echo json_encode($output);
    }

    public function membro_update() {

      $this->input->post('membros_group');

      $data = array(
        'id_grupo' => $this->input->post('id'),
        'membros' => $this->input->post('membros_group')
      );
      // $update = $this->unidade_model->update_membros($data);
      // echo json_encode(array("status" => TRUE));
      vd($data);
    }

    public function modulo_update() {
        $this->usuario_model->delete_modulos($this->input->post('grupo'));
        $modulos = $this->input->post('modulo');
        foreach ($modulos as $modulo) {
            $data = array(
                'id_grupo' => $this->input->post('grupo'),
                'id_modulo' => $modulo
            );
            $this->usuario_model->save_perfil($data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function perfil_add() {
       $this->perfil_validate();
       $data = array(
               'nome_grupo' => $this->input->post('nome'),
               'descricao_grupo' => $this->input->post('comentario'),
           );
       $this->usuario_model->save_perfil($data);
       echo json_encode(array("status" => TRUE));
    }

    public function perfil_delete($id){
       $this->usuario_model->delete_perfil($id);
       echo json_encode(array("status" => TRUE));
    }

    public function perfil_edit($id) {
       $data = $this->usuario_model->edit_perfil($id);
       echo json_encode($data);
    }

    public function perfil_update() {
       $this->perfil_validate();
       $data = array(
               'nome_grupo' => $this->input->post('nome'),
               'descricao_grupo' => $this->input->post('comentario'),
           );
       $this->usuario_model->update_perfil(array('id_grupo' => $this->input->post('id')), $data);
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