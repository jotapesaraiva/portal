<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

    public function index(){
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/usuarios/usuario_cargo.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Usuários</span>', '/usuarios;');
        $this->breadcrumbs->push('<span>Cargo</span>', '/usuarios/cargo');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('usuarios/cargos');
        $this->load->view('modal/modal_form');
        // $this->load->view('modal/modal_delete');
        $this->load->view('template/footer',$script);
    }

    public function cargo_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $cargos = $this->usuario_model->listar_cargo();

       $data = array();

       foreach($cargos->result() as $cargo) {
           $row = array();
           $row[] = $cargo->id_cargo;
           $row[] = $cargo->nome_cargo;
           $row[] = $cargo->comentario_cargo;
           if(acesso_super_admin()):
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$cargo->id_cargo."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$cargo->id_cargo."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           else:
           $row[] = 'Sem permissão';
           endif;
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $cargos->num_rows(),
           "recordsFiltered" => $cargos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function cargo_add(){
       $this->cargo_validate();
       $data = array(
               'nome_cargo' => $this->input->post('nome'),
               'comentario_cargo' => $this->input->post('comentario'),
           );
       $insert = $this->usuario_model->save_cargo($data);
       echo json_encode(array("status" => TRUE));
    }

    public function cargo_edit($id){
       $data = $this->usuario_model->edit_cargo($id);
       echo json_encode($data);
    }

    public function cargo_update(){
       $this->cargo_validate();
       $data = array(
               'nome_cargo' => $this->input->post('nome'),
               'comentario_cargo' => $this->input->post('comentario'),
           );
       $this->usuario_model->update_cargo(array('id_cargo' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function cargo_delete($id){
       $this->usuario_model->delete_cargo($id);
       echo json_encode(array("status" => TRUE));
    }

    private function cargo_validate() {
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




/* End of file Cargo.php */
/* Location: ./application/controllers/Cargo.php */
