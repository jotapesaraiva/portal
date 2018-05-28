<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localidades extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //Do your magic here
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
            redirect('auth/login');
        }
    }

    public function index() {

    }

    public function unidades() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/localidade_unidades.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $unidades = $this->unidade_model->listar_unidade();
        $expedientes = $this->unidade_model->listar_expediente();
        $cidades = $this->unidade_model->listar_cidade();
        //$servidores = $this->usuarios_model->listar_servidores(); "servidores" => $servidores,
        //$tecnicos = $this->usuarios_model->listar_tecnicos(); "tecnicos" => $tecnicos,
        $links =  $this->link_model->listar_link();
        $voips = $this->voip_model->listar_ramal();
        $dados = array("unidades" => $unidades, "expedientes" => $expedientes, "cidades" => $cidades, "links" => $links, "voips" => $voips);
        $session['username'] = $this->session->userdata('username');
        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('localidades/unidades');
        $this->load->view('modal/modal_unidade', $dados);

        $this->load->view('template/footer',$script);
    }

    public function unidades_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $unidades = $this->unidade_model->listar_unidade();

       $data = array();

       foreach($unidades->result() as $unidade) {
           $row = array();
           $row[] = $unidade->id_unidade;
           $row[] = anchor('edit_person('."'".$unidade->id_unidade."'".')', $unidade->nome_unidade, 'attributes');
           $row[] = $unidade->endereco_unidade;
           $row[] = $unidade->nome_cidade;
           $row[] = $unidade->nome_expediente;
           $telefones = $this->unidade_model->listar_unidade_telefone($unidade->id_unidade,1);
           if($telefones == null){
              $row[] = "";
           } else {
             $tel = array();
             foreach($telefones->result() as $telefone){
              $tel[] = $telefone->numero_telefone;
             }
           $row[] = $tel;
           }
           $voips = $this->unidade_model->listar_unidade_telefone($unidade->id_unidade,4);
           if($voips == null){
            $row[] = "";
           } else {
             $VoIP = array();
             foreach($voips->result() as $voip){
              $VoIP[] = substr($voip->numero_telefone,-4);
             }
             $row[] = $VoIP;
           }
           $links = $this->unidade_model->listar_link($unidade->id_unidade);
           if($links == null){
              $row[] = "";
           } else {
             $Link = array();
             foreach($links->result() as $link){
              $Link[] = $link->nome_link;
             }
           $row[] = $Link;
           }
           // $row[] = $tecnicos;
           // $row[] = $servidores;
           if ($unidade->status_unidade == '1'){
            $row[] = '<span class="label label-sm label-info"> Ativo. </span>';
           } else {
            $row[] = '<span class="label label-sm label-danger"> Desativado. </span>';
           }
           $unidade->status_unidade;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$unidade->id_unidade."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$unidade->id_unidade."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array (
           "draw" => $draw,
           "recordsTotal" => $unidades->num_rows(),
           "recordsFiltered" => $unidades->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function unidades_add() {
      $this->unidades_validate();

      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('unidade') == '') {
        $id_unidade_responsavel = NULL;
      }

       $data = array (
               'nome_unidade' => $this->input->post('nome'),
               'endereco_unidade' => $this->input->post('endereco'),
               'id_unidade_responsavel' => $id_unidade_responsavel,
               'status_unidade' => $status,
               'id_cidade' => $this->input->post('cidade'),
               'id_expediente' => $this->input->post('expediente'),
               'comentario_unidade' => $this->input->post('comentario'),
           );
       $insert = $this->unidade_model->save_unidade($data);
       echo json_encode(array("status" => TRUE));
    }

    public function unidades_edit($id) {
       $data = $this->unidade_model->edit_unidade($id);
       echo json_encode($data);
    }

    public function unidades_update() {
       //$this->_validate();
      if($this->input->post('status') == 'on') {
        $status = '1';
      } else {
        $status = '0';
      }
      if($this->input->post('unidade') == ''){
        $id_unidade_responsavel = NULL;
      }

       $data = array(
               'nome_unidade' => $this->input->post('nome'),
               'endereco_unidade' => $this->input->post('endereco'),
               'id_unidade_responsavel' => $id_unidade_responsavel,
               'status_unidade' => $status,
               'id_cidade' => $this->input->post('cidade'),
               'id_expediente' => $this->input->post('expediente'),
               'comentario_unidade' => $this->input->post('comentario'),
           );
       $this->unidade_model->update_unidade(array('id_unidade' => $this->input->post('id_unidade')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function unidades_delete($id){
       $this->unidade_model->delete_unidade($id);
       echo json_encode(array("status" => TRUE));
    }

    public function listar_voip() {
       $data = $this->voip_model->listar_ramal();
       echo json_encode($data->result());
    }
    public function listar_link() {
      $data =  $this->unidade_model->listar_link();
      echo json_encode($data->result());
    }

    private function unidades_validate(){
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;

            if($this->input->post('nome') == '') {
                $data['inputerror'][] = 'nome';
                $data['error_string'][] = 'O campo nome é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('endereco') == '') {
                $data['inputerror'][] = 'endereco';
                $data['error_string'][] = 'O campo endereço é obrigatorio';
                $data['status'] = FALSE;
            }

            if($this->input->post('cidade') == '') {
                $data['inputerror'][] = 'cidade';
                $data['error_string'][] = 'Selecione uma cidade';
                $data['status'] = FALSE;
            }

            if($this->input->post('expediente') == '') {
                $data['inputerror'][] = 'expediente';
                $data['error_string'][] = 'Selecione um horário';
                $data['status'] = FALSE;
            }

            if($data['status'] === FALSE)
            {
                echo json_encode($data);
                exit();
            }
        }

    //
    //=============================================================================================================================================================
    //

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
       //$this->_validate();
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
       //$this->_validate();
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

//
//=============================================================================================================================================================
//

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
   //$this->_validate();
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
   //$this->_validate();
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

}
/* End of file Localidades.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp31205/var/www/html/portal/frontend/controllers/Localidades.php */