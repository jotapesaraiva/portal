<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Velocidade extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

    public function index(){
        // $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/sistema/link_velocidade.js" type="text/javascript"></script>
        ';
        $script['script'] = '';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
        $this->breadcrumbs->push('<span>Velocidade</span>', '/sistema/consulta/velocidade');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('sistema/itens_consulta/velocidade');
        $this->load->view('modal/modal_form');
        //$this->load->view('modal/modal_delete');

        $this->load->view('template/footer',$script);
     }

     public function velocidade_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $velocidades = $this->link_model->listar_velocidade();

        $data = array();

        foreach($velocidades->result() as $velocidade) {
            $row = array();
            $row[] = $velocidade->id_tipo_velocidade;
            $row[] = $velocidade->nome_tipo_velocidade;
            $row[] = $velocidade->comentario_tipo_velocidade;
            if(acesso_super_admin()):
            $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$velocidade->id_tipo_velocidade."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                      <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$velocidade->id_tipo_velocidade."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
            else:
            $row[] = 'Sem permissão';
            endif;
            $data[] = $row;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $velocidades->num_rows(),
            "recordsFiltered" => $velocidades->num_rows(),
            "data" => $data,
        );
        echo json_encode($output);
     }

     public function velocidade_add() {
        $this->velocidade_validate();
        $data = array(
                'nome_tipo_velocidade' => $this->input->post('nome'),
                'comentario_tipo_velocidade' => $this->input->post('comentario'),
            );
        $insert = $this->link_model->save_velocidade($data);
        echo json_encode(array("status" => TRUE));
     }

     public function velocidade_edit($id){
        $data = $this->link_model->edit_velocidade($id);
        echo json_encode($data);
     }

     public function velocidade_update() {
        $this->velocidade_validate();
        $data = array(
                'nome_tipo_velocidade' => $this->input->post('nome'),
                'comentario_tipo_velocidade' => $this->input->post('comentario'),
            );
        $this->link_model->update_velocidade(array('id_tipo_velocidade' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
     }

     public function velocidade_delete($id) {
        $this->link_model->delete_velocidade($id);
        echo json_encode(array("status" => TRUE));
     }

     private function velocidade_validate() {
         $data = array();
         $data['error_string'] = array ();
         $data['inputerror'] = array ();
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

/* End of file Velocidade.php */
/* Location: ./application/controllers/Velocidade.php */