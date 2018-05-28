<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('voip_model');
        $this->load->model('telefonia_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/login');
        }

    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/usuarios_lista.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>

        ';
        $script['script'] = '
        <script src="' . base_url() . 'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');
        $usuarios = $this->auth_ad->get_all_users();
        $permissaos = $this->usuario_model->listar_permissao();
        $cargos = $this->usuario_model->listar_cargo();
        $voips = $this->voip_model->listar_ramal();

        $dados = array('permissaos' => $permissaos, 'cargos' => $cargos, 'usuarios' => $usuarios,'voips' => $voips);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Lista de usuários</span>', '/usuarios/lista');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/listar_usuarios');
        $this->load->view('modal/modal_usuarios',$dados);

        $this->load->view('template/footer',$script);
    }

    public function listar_usuarios() {
          $entries = $this->auth_ad->get_all_users();
          echo json_encode($entries);
    }

    public function usuarios_list() {
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $usuarios = $this->usuario_model->listar_usuarios();

       $data = array();

       foreach($usuarios->result() as $usuario) {
           $row = array();
           $row[] = $usuario->id_usuario;
           $row[] = $usuario->nome_usuario;
           $row[] = $usuario->login_usuario;
           $row[] = $usuario->email_usuario;
           //$row[] = $usuario->sobreaviso_usuario;
           if ($usuario->sobreaviso_usuario == '1') {
            $row[] = '<span class="label label-sm label-info"> Sim. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Não. </span>';
           }
           $row[] = $usuario->nome_permissao;
           $row[] = $usuario->nome_cargo;
           $row[] = $usuario->celula_equipe;
           if ($usuario->status_usuario == '1') {
            $row[] = '<span class="label label-sm label-info"> Ativo. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Desativado. </span>';
           }
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$usuario->id_usuario."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$usuario->id_usuario."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $usuarios->num_rows(),
           "recordsFiltered" => $usuarios->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function usuarios_add() {
      $this->usuarios_validate();

      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('sobreaviso') == 'on') {
        $sobreaviso = '1';
      } else {
        $sobreaviso = '0';
      }

       $data = array(
               'nome_usuario'       => $this->input->post('nome'),
               'login_usuario'      => $this->input->post('login'),
               'email_usuario'      => $this->input->post('email'),
               'celula_equipe'      => $this->input->post('equipe'),
               'senha_usuario'      => $this->input->post('senha'),
               'sobreaviso_usuario' => $sobreaviso,
               'status_usuario'     => $status,
               'id_permissao'          => $this->input->post('permissao'),
               'id_cargo'           => $this->input->post('cargo')
           );
       $insert = $this->usuario_model->save_usuario($data);

       if(!empty($this->input->post('telefone'))) {
         foreach ($this->input->post('telefone') as $tel) {
           if(!empty($tel)) {
             $telefone = array (
                             'numero_telefone'            => $tel,
                             'id_tipo_categoria_telefone' => 1,
                         );
             $id_telefone = $this->telefonia_model->salvar_telefone($telefone);
             $usuario_telefone = array (
                                   'id_telefone' => $id_telefone,
                                   'id_usuario'  =>  $insert,
                                 );
             $this->usuario_model->salvar_usuario_telefone($usuario_telefone);
           }
         }
       }

       if(!empty($this->input->post('celular[]'))) {
         foreach($this->input->post('celular[]') as $cel) {
           if(!empty($cel)){
             $celular = array (
                'numero_telefone' => $cel,
                'id_tipo_categoria_telefone' => 2,
             );
             $id_celular = $this->telefonia_model->salvar_telefone($celular);
             $usuario_celular = array (
               'id_telefone' => $id_celular,
               'id_usuario' =>  $insert,
             );
             $this->usuario_model->salvar_usuario_telefone($usuario_celular);
           }
         }
       }
       echo json_encode(array("status" => TRUE));
    }

    public function usuarios_edit($id) {
       $usuario = $this->usuario_model->edit_usuario($id);

       $telefone = $this->usuario_model->edit_usuario_telefone($id,1);

       $celular = $this->usuario_model->edit_usuario_telefone($id,2);

       $data = array('usuario' => $usuario, 'telefone' => $telefone, 'celular' => $celular);
       echo json_encode($data);
    }

    public function usuarios_update() {
       $this->usuarios_validate();
      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('sobreaviso') == 'on') {
        $sobreaviso = '1';
      } else {
        $sobreaviso = '0';
      }

       $data = array(
              'nome_usuario'       => $this->input->post('nome'),
              'login_usuario'      => $this->input->post('login'),
              'email_usuario'      => $this->input->post('email'),
              'celula_equipe'      => $this->input->post('equipe'),
              'senha_usuario'      => $this->input->post('senha'),
              'sobreaviso_usuario' => $sobreaviso,
              'status_usuario'     => $status,
              'id_permissao'          => $this->input->post('permissao'),
              'id_cargo'           => $this->input->post('cargo')
           );
       $this->usuario_model->update_usuario(array('id_usuario' => $this->input->post('id_usuario')), $data);

        //#######################TELEFONE##########################//
        if(!empty($this->input->post('telefone'))) {
           for($i = 0; $i < count($this->input->post('telefone')); $i++) {
              if(!empty($this->input->post('telefone')[$i])) {
                 $telefone_where = array (
                           'numero_telefone' => $this->input->post('telefone')[$i],
                           'id_tipo_categoria_telefone' => 1,
                 );
                 if($this->input->post('id_telefone')[$i] != "") {
                    $telefone_dados = array (
                          'id_telefone' => $this->input->post('id_telefone')[$i],
                          'id_usuario' => $this->input->post('id_usuario'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' => $this->input->post('id_telefone')[$i]), $telefone_where);
                 $this->usuario_model->update_usuario_telefone(array ($this->input->post('id')), $telefone_dados);
                 } else {
                    $id_telefone = $this->telefonia_model->salvar_telefone($telefone_where);
                    $usuario_telefone = array (
                          'id_telefone' => $id_telefone,
                          'id_usuario' =>  $this->input->post('id_usuario'),
                    );
                    $this->usuario_model->salvar_usuario_telefone($usuario_telefone);
                    }
              } else {
               // echo "array com value vazio";
              }
           }
       }
       //#######################CELULAR##########################//
       if(!empty($this->input->post('celular'))) {
          for($i = 0; $i < count($this->input->post('celular')); $i++) {
              if(!empty($this->input->post('celular')[$i])) {
                 $celular_where = array (
                           'numero_telefone' => $this->input->post('celular')[$i],
                           'id_tipo_categoria_telefone' => 2,
                 );
                 if($this->input->post('id_celular')[$i] != "") {
                    $celular_dados = array (
                          'id_telefone' => $this->input->post('id_celular')[$i],
                          'id_usuario' => $this->input->post('id_usuario'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' =>  $this->input->post('id_celular')[$i]), $celular_where);
                 $this->usuario_model->update_usuario_telefone(array ($this->input->post('id')), $celular_dados);
                 } else {
                    $id_celular = $this->telefonia_model->salvar_telefone($celular_where);
                    $usuario_telefone = array (
                          'id_telefone' => $id_celular,
                          'id_usuario' =>  $this->input->post('id_usuario'),
                    );
                    $this->usuario_model->salvar_usuario_telefone($usuario_telefone);
              }
          } else {
           // echo "array com value vazio";
          }
        }
       }

       echo json_encode(array("status" => TRUE));
    }

    public function usuarios_delete($id) {

      $this->usuario_model->delete_usuario_telefone($id);
      $this->usuario_model->delete_usuario($id);
      $telefones = $this->usuario_model->listar_usuario_telefone($id);
      foreach($telefones->result() as $telefone) {
        $this->telefonia_model->delete_telefone($telefone->id_telefone);
      }

       $this->usuario_model->delete_usuario($id);
       echo json_encode(array("status" => TRUE));
    }

    private function usuarios_validate() {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;

            if($this->input->post('nome') == '') {
                $data['inputerror'][] = 'nome';
                $data['error_string'][] = 'O campo nome é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('email') == '') {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = 'O campo email é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('login') == '') {
                $data['inputerror'][] = 'login';
                $data['error_string'][] = 'O campo login é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('permissao') == '') {
                $data['inputerror'][] = 'permissao';
                $data['error_string'][] = 'O campo permissao é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('cargo') == '') {
                $data['inputerror'][] = 'cargo';
                $data['error_string'][] = 'O campo cargo é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('equipe') == '') {
                $data['inputerror'][] = 'equipe';
                $data['error_string'][] = 'O campo celula/equipe é obrigatorio';
                $data['status'] = FALSE;
            }

            if($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }

}