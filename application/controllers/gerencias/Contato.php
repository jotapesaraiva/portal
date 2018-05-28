<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

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
      $this->load->helper('site_helper');
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
          <script src="' . base_url() . 'assets/custom/contato.js" type="text/javascript"></script>
          <script src="' . base_url() . 'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
          <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
      ';
      $script['script'] = '
      <script src="' . base_url() . 'assets/custom/form-input-mask.js" type="text/javascript"></script>';

      $css['headerinc'] = '
          <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
          <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
          <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $telefone = $this->telefonia_model->listar_telefone();//"telefone" => $telefone,
        $celular = $this->telefonia_model->listar_celular();//"celular" => $celular
        $fornecedores = $this->fornecedor_model->listar_fornecedor();
        $dados = array("fornecedores" => $fornecedores);
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Contatos</span>', '/gerencias/contato');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/contatos');
        $this->load->view('modal/modal_contatos',$dados);
        //$this->load->view('modal/modal_delete');

        $this->load->view('template/footer',$script);
    }

    public function contato_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $contatos = $this->contato_model->listar_contato();

       $data = array();

       foreach($contatos->result() as $contato) {
           $row = array();
           $row[] = $contato->id_contato;
           $row[] = $contato->nome_contato;
           $row[] = $contato->email_contato;
           $row[] = $contato->cargo_contato;
           $telefones = $this->contato_model->listar_contato_telefone($contato->id_contato);
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
           $celulars = $this->contato_model->listar_contato_celular($contato->id_contato);
           if($celulars == null){
            $row[] = "";
           } else {
             // $cel = array();
             $cel = '';
             foreach($celulars->result() as $celular){
              $cel .= $celular->numero_telefone."<br>";
             }
             $row[] = $cel;
           }
           $row[] = $contato->nome_fornecedor;
           $row[] = $contato->comentario_contato;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" id="update" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$contato->id_contato."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$contato->id_contato."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $contatos->num_rows(),
           "recordsFiltered" => $contatos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function contato_add() {

       $this->contato_validate();

       $data = array (
               'nome_contato' => $this->input->post('nome'),
               'email_contato' => $this->input->post('email'),
               'cargo_contato' => $this->input->post('cargo'),
               'id_fornecedor' => $this->input->post('fornecedor'),
               'comentario_contato' => $this->input->post('comentario'),
       );
       $insert = $this->contato_model->save_contato($data);

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
            $contato_telefone = array (
              'id_telefone' => $id_telefone,
              'id_contato' =>  $insert,
            );
            $this->contato_model->salvar_contato_telefone($contato_telefone);
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
            $contato_celular = array (
              'id_telefone' => $id_celular,
              'id_contato' =>  $insert,
            );
            $this->contato_model->salvar_contato_telefone($contato_celular);
            // var_dump($contato_celular);
          }
        }
      }
       echo json_encode(array ("status" => TRUE));
    }

    public function contato_edit($id) {
       $contato = $this->contato_model->edit_contato($id);

       $telefone = $this->contato_model->edit_contato_telefone($id);

       $celular = $this->contato_model->edit_contato_celular($id);

       $data = array('contato' => $contato, 'telefone' => $telefone, 'celular' => $celular);
       echo json_encode($data);
    }

    public function contato_update() {
        $this->contato_validate();
        // $this->output->enable_profiler(FALSE);
        //#######################CELULAR##########################//
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
                          'id_contato' => $this->input->post('id'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' => $this->input->post('id_telefone')[$i]), $telefone_where);
                 $this->contato_model->update_contato_telefone(array ($this->input->post('id')), $telefone_dados);
                 } else {
                    $id_telefone = $this->telefonia_model->salvar_telefone($telefone_where);
                    $contato_telefone = array (
                          'id_telefone' => $id_telefone,
                          'id_contato' =>  $this->input->post('id'),
                    );
                    $this->contato_model->salvar_contato_telefone($contato_telefone);
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
                          'id_contato' => $this->input->post('id'),
                    );
                 $this->telefonia_model->update_telefone(array ('id_telefone' =>  $this->input->post('id_celular')[$i]), $celular_where);
                 $this->contato_model->update_contato_telefone(array ($this->input->post('id')), $celular_dados);
                 } else {
                    $id_celular = $this->telefonia_model->salvar_telefone($celular_where);
                    $contato_telefone = array (
                          'id_telefone' => $id_celular,
                          'id_contato' =>  $this->input->post('id'),
                    );
                    $this->contato_model->salvar_contato_telefone($contato_telefone);
              }
          } else {
           // echo "array com value vazio";
          }
        }
       }

       $data = array (
                       'nome_contato' => $this->input->post('nome'),
                       'email_contato' => $this->input->post('email'),
                       'cargo_contato' => $this->input->post('cargo'),
                       'id_fornecedor' => $this->input->post('fornecedor'),
                       'comentario_contato' => $this->input->post('comentario'),
           );
      $this->contato_model->update_contato(array('id_contato' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function contato_delete($id) {
      $this->contato_model->delete_contato_telefone($id);
      $this->contato_model->delete_contato($id);
      $telefones = $this->contato_model->listar_contato_telefone($id);
      foreach($telefones->result() as $telefone){
        $this->telefonia_model->delete_telefone($telefone->id_telefone);
      }
      echo json_encode(array("status" => TRUE));
    }

    public function contato_telefone_delete($id_telefone,$id_contato) {
      $this->contato_model->delete_contato_telefone($id_contato);
      $this->telefonia_model->delete_telefone($id_telefone);
      echo json_encode(array("status" => TRUE));
    }

    private function contato_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('fornecedor') == '') {
            $data['inputerror'][] = 'fornecedor';
            $data['error_string'][] = 'Selecione uma empresa';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Contato.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp45079/var/www/html/portal/frontend/controllers/Contato.php */