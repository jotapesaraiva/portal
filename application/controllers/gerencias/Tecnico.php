<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tecnico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
      $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        ';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/gerencias/tecnico.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');
        $unidades = $this->unidade_model->listar_unidade();
        $tecnicos = $this->tecnico_model->listar_usuario();
        $dados = array("unidades" => $unidades, "tecnicos" => $tecnicos);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Tecnicos</span>', '/gerencias/tecnico');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/tecnico');
        $this->load->view('modal/modal_tecnico', $dados);

        $this->load->view('template/footer',$script);
    }

    public function tecnico_list() {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $tecnicos = $this->tecnico_model->listar_unidade_usuario();

    $data = array();

    foreach($tecnicos->result() as $tecnico) {
       $row = array();
       // $row[] = $tecnico->id_usuario;
       $row[] = $tecnico->nome_usuario;
       $unidades = $this->tecnico_model->listar_unidade($tecnico->id_usuario);
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
          $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$tecnico->id_usuario."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                    <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$tecnico->id_usuario."','".$tecnico->id_unidade."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
       else:
          $row[] = 'Sem permissão';
       endif;
       $data[] = $row;
    }

    $output = array(
       "draw" => $draw,
       "recordsTotal" => $tecnicos->num_rows(),
       "recordsFiltered" => $tecnicos->num_rows(),
       "data" => $data,
    );
    echo json_encode($output);
    }
// Função que adiciona um tecnico a varias unidades
    public function tecnico_add() {
        $this->tecnico_validate();
        $unidades = $this->input->post('unidade');
        foreach ($unidades as $unidade) {
            $data = array(
               'id_usuario' => $this->input->post('nome'),
               'id_unidade' => $unidade,
            );
            $insert = $this->tecnico_model->save_tecnico($data);
        }
        echo json_encode(array("status" => TRUE));
        set_msg("msgOk", "Tecnico inserido com sucesso !!!","info");
    }

    public function tecnico_edit($id_tecnico) {

        $id_unidades = $this->tecnico_model->edit_unidade_tecnico($id_tecnico);
        foreach ($id_unidades as $id_unidade) {
          $unidade[] = $id_unidade['id_unidade'];
        }
        $id_usuario = $id_tecnico;
        $data = array(
          'id_unidade' => $unidade,
          'id_usuario' => $id_usuario
        );
        echo json_encode($data);
        // vd($id_unidades);
    }

    public function tecnico_update() {
        $this->tecnico_validate();
        $this->tecnico_model->delete_all($this->input->post('nome'));
        $unidades = $this->input->post('unidade');
        foreach ($unidades as $unidade) {
            $data = array(
               'id_usuario' => $this->input->post('nome'),
               'id_unidade' => $unidade,
            );
            $this->tecnico_model->save_tecnico($data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function tecnico_delete($id_tecnico) {
        // $this->output->enable_profiler(TRUE);
        $this->tecnico_model->delete_all($id_tecnico);
        set_msg("msgOk", "Tecnico deletado com sucesso !!!","info");
        echo json_encode(array("status" => TRUE));
    }

    private function tecnico_validate() {
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

/* End of file Tecnico.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp33524/var/www/html/portal/frontend/controllers/Tecnico.php */