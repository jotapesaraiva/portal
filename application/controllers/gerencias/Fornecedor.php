<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('fornecedor_model');
        $this->load->model('telefonia_model');
        $this->load->model('contato_model');
        $this->load->model('servico_model');
        $this->load->model('voip_model');
        $this->load->library('breadcrumbs');
        $this->load->library('Auth_AD');
        $this->load->helper('funcoes');
        if($this->auth_ad->is_authenticated()){
          $username = $this->session->userdata('username');
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
            <script src="' . base_url() . 'assets/custom/fornecedor.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
        ';
        $script['script'] = '
            <script src="' . base_url() . 'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $fornecedores = $this->fornecedor_model->listar_fornecedor();
        $servicos = $this->servico_model->listar_servico();
        $dados = array("servicos" => $servicos, "fornecedores" => $fornecedores);
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Fornecedor</span>', '/gerencias/fornecedor');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/fornecedor');
        $this->load->view('modal/modal_fornecedor',$dados);
        $this->load->view('modal/modal_fornecedor_view');


        $this->load->view('template/footer',$script);
    }


    public function fornecedor_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $fornecedores = $this->fornecedor_model->listar_fornecedor();

       $data = array();

       foreach($fornecedores->result() as $fornecedor) {
           $row = array();
           // $row[] = $fornecedor->id_fornecedor;
           $row[] = $fornecedor->nome_fornecedor;
           $row[] = $fornecedor->website_fornecedor;
           $row[] = $fornecedor->email_fornecedor;
           // $row[] = $fornecedor->endereco_fornecedor;
           $telefones = $this->fornecedor_model->listar_fornecedor_telefone($fornecedor->id_fornecedor);
           if($telefones == null){
              $row[] = "";
           } else {
             // $tel = array();
             $tel = '';
             foreach($telefones->result() as $telefone){
              // $tel[] = $telefone->numero_telefone;
              $tel .= $telefone->numero_telefone. "<br>" ;
             }
           $row[] = trim($tel);
           }
           // $celulars = $this->fornecedor_model->listar_fornecedor_celular($fornecedor->id_fornecedor);
           // if($celulars == null){
           //  $row[] = "";
           // } else {
           //   // $cel = array();
           //   $cel = '';
           //   foreach($celulars->result() as $celular){
           //    $cel .= $celular->numero_telefone."<br>";
           //   }
           //   $row[] = $cel;
           // }
           $row[] = $fornecedor->nome_servico;
           // $row[] = $fornecedor->comentario_fornecedor;
           if ($fornecedor->status_fornecedor == '1'){
            $row[] = '<span class="label label-sm label-info"> Ativo. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Desativado. </span>';
           }
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Editar" onclick="edit_person('."'".$fornecedor->id_fornecedor."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Deletar" onclick="delete_person('."'".$fornecedor->id_fornecedor."'".')"><i class="glyphicon glyphicon-trash"></i></a>
                     <a class="btn blue btn-outline sbold" href="javascript:void(0)" title="Info" onclick="view_person('."'".$fornecedor->id_fornecedor."'".')"><i class="glyphicon glyphicon-info-sign"></i></a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $fornecedores->num_rows(),
           "recordsFiltered" => $fornecedores->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function fornecedor_add(){
       $this->fornecedor_validate();
       if($this->input->post('status') == 'on') {
         $status = '1';
       } else {
         $status = '0';
       }

       $data = array(
               'nome_fornecedor' => $this->input->post('nome_fornecedor'),
               'email_fornecedor' => $this->input->post('email'),
               'endereco_fornecedor' => $this->input->post('endereco'),
               'website_fornecedor' => $this->input->post('website'),
               'id_servico' => $this->input->post('servico'),
               'comentario_fornecedor' => $this->input->post('comentario'),
               'status_fornecedor' => $status,
               //'contatos' => $this->input->post('contato'),
           );
       //var_dump($data);
       $insert = $this->fornecedor_model->save_fornecedor($data);
       // foreach para percorre o array do input e criar o values do insert correto
       //var_dump($this->input->post('telefone'));
       if(!empty($this->input->post('telefone'))) {
         foreach ($this->input->post('telefone') as $tel) {
           if(!empty($tel)) {
             $telefone = array (
                 'numero_telefone' => $tel,
                 'id_tipo_categoria_telefone' => 1,
             );
             $id_telefone = $this->telefonia_model->salvar_telefone($telefone);
             //var_dump($telefone);
             $fornecedor_telefone = array (
               'id_telefone' => $id_telefone,
               'id_fornecedor' =>  $insert,
             );
             $this->fornecedor_model->salvar_fornecedor_telefone($fornecedor_telefone);
             //var_dump($contato_telefone);
           }
         }
       }
       // foreach para percorre o array do input e criar o values do insert correto
       //var_dump($this->input->post('celular'));
       if(!empty($this->input->post('celular'))) {
         foreach($this->input->post('celular') as $cel) {
           if(!empty($cel)){
             $celular = array (
                'numero_telefone' => $cel,
                'id_tipo_categoria_telefone' => 2,
             );
             $id_celular = $this->telefonia_model->salvar_telefone($celular);
             // var_dump($celular);
             $fornecedor_celular = array (
               'id_telefone' => $id_celular,
               'id_fornecedor' =>  $insert,
             );
             $this->fornecedor_model->salvar_fornecedor_telefone($fornecedor_celular);
             // var_dump($contato_celular);
           }
         }
       }
       echo json_encode(array("status" => TRUE));
    }

    public function fornecedor_edit($id) {
       $fornecedor = $this->fornecedor_model->edit_fornecedor($id);
       $telefone = $this->fornecedor_model->edit_fornecedor_telefone($id);
       $celular = $this->fornecedor_model->edit_fornecedor_celular($id);

       $data = array(
        'fornecedor' => $fornecedor,
        'telefone'   => $telefone,
        'celular'    => $celular);
       echo json_encode($data);
    }

    public function fornecedor_view($id) {
       $fornecedor = $this->fornecedor_model->edit_fornecedor($id);
       $telefone = $this->fornecedor_model->listar_fornecedor_telefone($id);
       $celular = $this->fornecedor_model->listar_fornecedor_celular($id);
       $contatos = $this->fornecedor_model->listar_contatos($id);
       $contato = array();
       foreach ($contatos->result() as $cont) {
       if($cont->id_contato == null) {
           $row = array(
               'id_contato'       => '',
               'nome_contato'     => '',
               'email_contato'    => '',
               'telefone_contato' => '',
               'celular_contato'  => ''
           );
        } else {
           $celulares = $this->contato_model->edit_contato_phone($cont->id_contato,2);
           if($celulares == null) {
               $cel = "";
           } else {
                 $cel = "";
                 // vd($celulares);
                 foreach($celulares as $cell) {
                  $cel .= $cell->numero_telefone. ', ';
                 }
           }
           $telefones = $this->contato_model->edit_contato_phone($cont->id_contato,1);
           if($telefones == null) {
               $tel = "";
           } else {
                 $tel = "";
                 // vd($telefones);
                 foreach($telefones as $telef) {
                  $tel .= $telef->numero_telefone. ', ';
                 }
           }
               $row = array(
                   'id_contato'       => $cont->id_contato,
                   'nome_contato'     => $cont->nome_contato,
                   'email_contato'    => $cont->email_contato,
                   'telefone_contato' => $tel,
                   'celular_contato'  => $cel
               );
            }
         $contato[] = $row;
        }

       $data = array(
          'fornecedor' => $fornecedor,
          'telefone'   => $telefone->result_array(),
          'celular'    => $celular->result_array(),
          'contato'   => $contato
        );
       echo json_encode($data);
       // vd($telefone->result_array());
    }

    public function listar_fornecedor(){
        $data = $this->fornecedor_model->listar_fornecedor();
        echo json_encode($data->result());
    }

    public function fornecedor_update(){
       $this->fornecedor_validate();

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
                          'id_fornecedor' => $this->input->post('id'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' => $this->input->post('id_telefone')[$i]), $telefone_where);
                 $this->fornecedor_model->update_fornecedor_telefone(array ($this->input->post('id')), $telefone_dados);
                 } else {
                    $id_telefone = $this->telefonia_model->salvar_telefone($telefone_where);
                    $fornecedor_telefone = array (
                          'id_telefone' => $id_telefone,
                          'id_fornecedor' =>  $this->input->post('id'),
                    );
                    $this->fornecedor_model->salvar_fornecedor_telefone($fornecedor_telefone);
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
                          'id_fornecedor' => $this->input->post('id'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' =>  $this->input->post('id_celular')[$i]), $celular_where);
                 $this->fornecedor_model->update_fornecedor_telefone(array ($this->input->post('id')), $celular_dados);
                 } else {
                    $id_celular = $this->telefonia_model->salvar_telefone($celular_where);
                    $fornecedor_telefone = array (
                          'id_telefone' => $id_celular,
                          'id_fornecedor' =>  $this->input->post('id'),
                    );
                    $this->fornecedor_model->salvar_fornecedor_telefone($fornecedor_telefone);
              }
          } else {
           // echo "array com value vazio";
          }
        }
       }

       if($this->input->post('status') == 'on') {
         $status = '1';
       } else {
         $status = '0';
       }

       $data = array(
               'nome_fornecedor' => $this->input->post('nome_fornecedor'),
               'website_fornecedor' => $this->input->post('website'),
               'email_fornecedor' => $this->input->post('email'),
               'endereco_fornecedor' => $this->input->post('endereco'),
               'id_servico' => $this->input->post('servico'),
               'comentario_fornecedor' => $this->input->post('comentario'),
               'status_fornecedor' => $status,
           );
       $this->fornecedor_model->update_fornecedor(array('id_fornecedor' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function fornecedor_delete($id) {
       $this->fornecedor_model->delete_fornecedor_telefone($id);
       $this->fornecedor_model->delete_fornecedor($id);
       $telefones = $this->fornecedor_model->listar_fornecedor_telefone($id);
       foreach($telefones->result() as $telefone){
         $this->telefonia_model->delete_telefone($telefone->id_telefone);
       }
       echo json_encode(array("status" => TRUE));
    }

    public function fornecedor_telefone_delete($id_telefone,$id_fornecedor) {
      $this->fornecedor_model->delete_fornecedor_telefone($id_fornecedor);
      $this->telefonia_model->delete_telefone($id_telefone);
      echo json_encode(array("status" => TRUE));
    }


    private function fornecedor_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome_fornecedor') == '') {
            $data['inputerror'][] = 'nome_fornecedor';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('endereco') == '') {
            $data['inputerror'][] = 'endereco';
            $data['error_string'][] = 'O campo endereco é obrigatorio';
            $data['status'] = FALSE;
        }

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
/* End of file Fornecedor.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp46865/var/www/html/portal/frontend/controllers/Fornecedor.php */