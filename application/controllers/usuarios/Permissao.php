<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissao extends CI_Controller {

  public function __construct() {
    parent::__construct();
    esta_logado();
  }

  public function index() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/usuario_permissao.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Permissão</span>', '/usuarios/permissao');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/permissao');
        $this->load->view('modal/modal_form');
        $this->load->view('modal/modal_delete');

        $this->load->view('template/footer',$script);
    }

    public function permissao_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $permissaos = $this->usuario_model->listar_permissao();

       $data = array();

       foreach($permissaos->result() as $permissao) {
           $row = array();
           $row[] = $permissao->id_permissao;
           $row[] = $permissao->nome_permissao;
           $row[] = $permissao->comentario_permissao;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$permissao->id_permissao."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$permissao->id_permissao."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $permissaos->num_rows(),
           "recordsFiltered" => $permissaos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function permissao_add(){
       //$this->_validate();
       $data = array(
               'nome_permissao' => $this->input->post('nome'),
               'comentario_permissao' => $this->input->post('comentario'),
           );
       $insert = $this->usuario_model->save_permissao($data);
       echo json_encode(array("status" => TRUE));
    }

    public function permissao_edit($id){
       $data = $this->usuario_model->edit_permissao($id);
       echo json_encode($data);
    }

    public function permissao_update(){
       //$this->_validate();
       $data = array(
               'nome_permissao' => $this->input->post('nome'),
               'comentario_permissao' => $this->input->post('comentario'),
           );
       $this->usuario_model->update_permissao(array('id_permissao' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function permissao_delete($id){
       $this->usuario_model->delete_permissao($id);
       echo json_encode(array("status" => TRUE));
    }

    private function permissao_validate() {
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

/* End of file permissao.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp05799/var/www/html/portal/frontend/controllers/permissao.php */