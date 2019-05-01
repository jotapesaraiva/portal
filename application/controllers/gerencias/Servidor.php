<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servidor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
            ';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/gerencias/servidor.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $session['username'] = $this->session->userdata('username');
        $unidades = $this->unidade_model->listar_unidade();
        $servidors = $this->servidor_model->listar_usuario();
        $dados = array("unidades" => $unidades, "servidors" => $servidors);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Servidor</span>', '/gerencias/servidor');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/servidor');
        $this->load->view('modal/modal_servidor', $dados);

        $this->load->view('template/footer',$script);
    }

    public function servidor_list() {
    // Datatables Variables
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $servidors = $this->servidor_model->listar_unidade_usuario();

    $data = array();

    foreach($servidors->result() as $servidor) {
       $row = array();
       $row[] = $servidor->nome_usuario;
       $unidades = $this->servidor_model->listar_unidade($servidor->id_usuario);
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
       $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$servidor->id_usuario."','".$servidor->id_unidade."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                 <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$servidor->id_usuario."','".$servidor->id_unidade."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
        else:
            $row[] = 'Sem permissão';
        endif;
       $data[] = $row;
    }

    $output = array(
       "draw" => $draw,
       "recordsTotal" => $servidors->num_rows(),
       "recordsFiltered" => $servidors->num_rows(),
       "data" => $data,
    );
    echo json_encode($output);
    }
// Função que adiciona um servidor a varias unidades
    public function servidor_add(){
        $this->servidor_validate();
        $unidades = $this->input->post('unidade');
        foreach ($unidades as $unidade) {
            $data = array(
               'id_usuario' => $this->input->post('nome'),
               'id_unidade' => $unidade,
            );
            // var_dump($data);
            $insert = $this->servidor_model->save_servidor($data);
        }
        echo json_encode(array("status" => TRUE));
        set_msg("msgOk", "Servidor inserido com sucesso !!!","info");
    }

    public function servidor_edit($id_servidor) {
        $id_unidades = $this->tecnico_model->edit_unidade_tecnico($id_servidor);
        foreach ($id_unidades as $id_unidade) {
            $unidade[] = $id_unidade['id_unidade'];
        }
        $id_usuario = $id_servidor;
        $data = array(
          'id_unidade' => $unidade,
          'id_usuario' => $id_usuario
        );
        echo json_encode($data);
    }

    public function servidor_update() {
        $this->servidor_validate();
        $this->tecnico_model->delete_all($this->input->post('nome'));
        $unidades = $this->input->post('unidade');
        foreach ($unidades as $unidade) {
            $data = array(
               'id_usuario' => $this->input->post('nome'),
               'id_unidade' => $unidade,
            );
            $this->servidor_model->save_servidor($data);
        }
        echo json_encode(array("status" => TRUE));
    }

    public function servidor_delete($id_servidor) {
        $this->tecnico_model->delete_all($id_servidor);
        set_msg("msgOk", "Servidor deletado com sucesso !!!","info");
        echo json_encode(array("status" => TRUE));
    }

    private function servidor_validate() {
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

/* End of file Servidor.php */
/* Location: ./application/controllers/Servidor.php */