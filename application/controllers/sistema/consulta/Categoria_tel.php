<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_tel extends CI_Controller {

  public function __construct() {
      parent::__construct();
      esta_logado();
  }

    public function index(){
       $this->output->enable_profiler(FALSE);
       $css['headerinc'] = '
           <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
           <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
       $script['script'] = '';

       $script['footerinc'] = '
           <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/custom/sistema/categoria_telefonia.js" type="text/javascript"></script>
       ';
       $session['username'] = $this->session->userdata('username');

       $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
       $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
       $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
       $this->breadcrumbs->push('<span>Categoria telefone</span>', '/sistema/consulta/categoria_tel');

       $this->load->view('template/header',$css);
       $this->load->view('template/navbar',$session);
       $this->load->view('template/sidebar');

       $this->load->view('sistema/itens_consulta/categoria_tel');
       $this->load->view('modal/modal_form');

       $this->load->view('template/footer',$script);
    }

    public function categoria_list() {
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $categorias = $this->telefonia_model->listar_categoria();

       $data = array();

       foreach($categorias->result() as $categoria) {
           $row = array();
           $row[] = $categoria->id_tipo_categoria_telefone;
           $row[] = $categoria->nome_tipo_categoria_telefone;
           $row[] = $categoria->comentario_tipo_categoria_telefone;
           if(acesso_super_admin()):
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$categoria->id_tipo_categoria_telefone."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$categoria->id_tipo_categoria_telefone."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           else:
           $row[] = 'Sem permissão';
           endif;
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $categorias->num_rows(),
           "recordsFiltered" => $categorias->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function categoria_add() {
       $this->categoria_tel_validate();
       $data = array(
               'nome_tipo_categoria_telefone' => $this->input->post('nome'),
               'comentario_tipo_categoria_telefone' => $this->input->post('comentario'),
           );
       $insert = $this->telefonia_model->save_categoria($data);
       echo json_encode(array("status" => TRUE));
    }

    public function categoria_edit($id) {
       $data = $this->telefonia_model->edit_categoria($id);
       echo json_encode($data);
    }

    public function categoria_update() {
       $this->categoria_tel_validate();
       $data = array(
               'nome_tipo_categoria_telefone' => $this->input->post('nome'),
               'comentario_tipo_categoria_telefone' => $this->input->post('comentario'),
           );
       $this->telefonia_model->update_categoria(array('id_tipo_categoria_telefone' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function categoria_delete($id) {
       $this->telefonia_model->delete_categoria($id);
       echo json_encode(array("status" => TRUE));
    }

    private function categoria_tel_validate() {
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

/* End of file Categoria_tel.php */
/* Location: ./application/controllers/Categoria_tel.php */