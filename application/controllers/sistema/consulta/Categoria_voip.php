<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_voip extends CI_Controller {

  public function __construct() {
      parent::__construct();
      $this->load->model('voip_model');
      $this->load->model('telefonia_model');
      $this->load->model('unidade_model');
      $this->load->library('Auth_AD');
      esta_logado();
  }

    public function index(){
       $this->output->enable_profiler(FALSE);
       $script['footerinc'] = '
           <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/custom/voip_categoria.js" type="text/javascript"></script>
       ';
       $script['script'] = '';

       $css['headerinc'] = '
           <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
           <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

       $session['username'] = $this->session->userdata('username');

       $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
       $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
       $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
       $this->breadcrumbs->push('<span>Categoria voip</span>', '/sistema/consulta/categoria_voip');

       $this->load->view('template/header',$css);
       $this->load->view('template/navbar',$session);
       $this->load->view('template/sidebar');

       $this->load->view('sistema/itens_consulta/categoria_voip');
       $this->load->view('modal/modal_form');
       //$this->load->view('modal/modal_delete');

       $this->load->view('template/footer',$script);
    }

    public function categoria_voip_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $categorias = $this->voip_model->listar_categoria();

       $data = array();

       foreach($categorias->result() as $categoria) {
           $row = array();
           $row[] = $categoria->id_tipo_categoria_voip;
           $row[] = $categoria->nome_tipo_categoria_voip;
           $row[] = $categoria->comentario_tipo_categoria_voip;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$categoria->id_tipo_categoria_voip."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$categoria->id_tipo_categoria_voip."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
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

    public function categoria_voip_add(){
       //$this->_validate();
       $data = array(
               'nome_tipo_categoria_voip' => $this->input->post('nome'),
               'comentario_tipo_categoria_voip' => $this->input->post('comentario'),
           );
       $insert = $this->voip_model->save_categoria($data);
       echo json_encode(array("status" => TRUE));
    }

    public function categoria_voip_edit($id){
       $data = $this->voip_model->edit_categoria($id);
       echo json_encode($data);
    }

    public function categoria_voip_update(){
       //$this->_validate();
       $data = array(
               'nome_tipo_categoria_voip' => $this->input->post('nome'),
               'comentario_tipo_categoria_voip' => $this->input->post('comentario'),
           );
       $this->voip_model->update_categoria(array('id_tipo_categoria_voip' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function categoria_voip_delete($id){
       $this->voip_model->delete_categoria($id);
       echo json_encode(array("status" => TRUE));
    }

    private function categoria_voip_validate() {
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

/* End of file Categoria_voip.php */
/* Location: ./application/controllers/Categoria_voip.php */