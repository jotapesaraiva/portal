<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaborador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
        $this->load->model('colaborador_model');
    }

    public function index() {
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/gestao/colaborador.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');
        $unidades = $this->unidade_model->listar_unidade();
        $colaboradores = $this->colaborador_model->listar_usuario();
        $dados = array("unidades" => $unidades, "colaboradores" => $colaboradores);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gestão</span>', '/gestao');
        $this->breadcrumbs->push('<span>Servidor</span>', '/gestao/colaborador');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('gestao/colaborador');
        $this->load->view('modal/modal_colaborador', $dados);

        $this->load->view('template/footer',$script);
    }

    public function colaborador_list() {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $colaboradores = $this->colaborador_model->listar_unidade_usuario();

    $data = array();

    foreach($colaboradores->result() as $colaborador) {
       $row = array();
       $row[] = $colaborador->nome_usuario;
       $unidades = $this->colaborador_model->listar_unidade($colaborador->id_usuario);
       if($unidades == null){
          $row[] = "";
       } else {
         $Unidade = '';
         foreach($unidades->result() as $unidade) {
            $Unidade .= $unidade->nome_unidade. '<br>';
         }
         $row[] = $Unidade;
       }
       if(acesso_admin()):
       $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$colaborador->id_usuario."','".$colaborador->id_unidade."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                 <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$colaborador->id_usuario."','".$colaborador->id_unidade."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
        else:
            $row[] = 'Sem permissão';
        endif;
       $data[] = $row;
    }

    $output = array(
       "draw" => $draw,
       "recordsTotal" => $colaboradores->num_rows(),
       "recordsFiltered" => $colaboradores->num_rows(),
       "data" => $data,
    );
    echo json_encode($output);
    }
// Função que adiciona um colaborador a varias unidades
    public function colaborador_add(){
        $this->colaborador_validate();
        $unidades = $this->input->post('unidade');
        foreach ($unidades as $unidade) {
            $data = array(
               'id_usuario' => $this->input->post('nome'),
               'id_unidade' => $unidade,
            );
            // var_dump($data);
            $insert = $this->colaborador_model->save_colaborador($data);
        }
        echo json_encode(array("status" => TRUE));
        set_msg("msgOk", "Colaborador inserido com sucesso !!!","info");
    }

    public function colaborador_edit($id_colaborador) {
        $id_unidades = $this->colaborador_model->edit_unidade_colaborador($id_colaborador);
        foreach ($id_unidades as $id_unidade) {
            $unidade[] = $id_unidade['id_unidade'];
        }
        $id_usuario = $id_colaborador;
        $data = array(
          'id_unidade' => $unidade,
          'id_usuario' => $id_usuario
        );
        echo json_encode($data);
    }

    public function colaborador_update() {
        $this->colaborador_validate();
        $this->tecnico_model->delete_all($this->input->post('nome'));
        $unidades = $this->input->post('unidade');
        foreach ($unidades as $unidade) {
            $data = array(
               'id_usuario' => $this->input->post('nome'),
               'id_unidade' => $unidade,
            );
            $this->colaborador_model->save_colaborador($data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function colaborador_delete($id_colaborador) {
        $this->tecnico_model->delete_all($id_colaborador);
        set_msg("msgOk", "Colaborador deletado com sucesso !!!","info");
        echo json_encode(array("status" => TRUE));
    }

    private function colaborador_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo técnico é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('unidade') == '') {
            $data['inputerror'][] = 'unidade';
            $data['error_string'][] = 'O campo unidade é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file colaborador.php */
/* Location: ./application/controllers/colaborador.php */