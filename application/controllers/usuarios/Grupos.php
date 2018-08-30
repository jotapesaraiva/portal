<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/grupos.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Grupos</span>', '/usuarios/grupos');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/grupos');
        $this->load->view('modal/modal_form');

        $this->load->view('template/footer',$script);
    }

    public function grupo_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $grupos = $this->usuario_model->listar_grupo();

       $data = array();

       foreach($grupos->result() as $grupo) {
           $row = array();
           $row[] = $grupo->id_grupo;
           $row[] = $grupo->nome_grupo;
           $row[] = $grupo->descricao_grupo;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$grupo->id_grupo."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$grupo->id_grupo."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $grupos->num_rows(),
           "recordsFiltered" => $grupos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function grupo_add(){
       //$this->_validate();
       $data = array(
               'nome_grupo' => $this->input->post('nome'),
               'descricao_grupo' => $this->input->post('comentario'),
           );
       $insert = $this->usuario_model->save_grupo($data);
       echo json_encode(array("status" => TRUE));
    }

    public function grupo_edit($id){
       $data = $this->usuario_model->edit_grupo($id);
       echo json_encode($data);
    }

    public function grupo_update(){
       //$this->_validate();
       $data = array(
               'nome_grupo' => $this->input->post('nome'),
               'descricao_grupo' => $this->input->post('comentario'),
           );
       $this->usuario_model->update_grupo(array('id_grupo' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function grupo_delete($id){
       $this->usuario_model->delete_grupo($id);
       echo json_encode(array("status" => TRUE));
    }

    private function grupo_validate() {
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

/* End of file Grupos.php */
/* Location: ./application/controllers/usuarios/Grupos.php */