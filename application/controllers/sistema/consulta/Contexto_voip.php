<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contexto_voip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        esta_logado();
    }

    public function index(){
       $this->output->enable_profiler(FALSE);
       $script['footerinc'] = '
           <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
           <script src="' . base_url() . 'assets/custom/sistema/voip_contexto.js" type="text/javascript"></script>
       ';
       $script['script'] = '';

       $css['headerinc'] = '
           <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
           <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

       $session['username'] = $this->session->userdata('username');

       $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
       $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
       $this->breadcrumbs->push('<span>Consulta</span>', '/sistema/consulta');
       $this->breadcrumbs->push('<span>Contexto VoIP</span>', '/sistema/consulta/contexto_voip');

       $this->load->view('template/header',$css);
       $this->load->view('template/navbar',$session);
       $this->load->view('template/sidebar');

       $this->load->view('sistema/itens_consulta/contexto');
       $this->load->view('modal/modal_form');

       $this->load->view('template/footer',$script);
    }

    public function contexto_voip_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $contextos = $this->voip_model->listar_contexto();

       $data = array();

       foreach($contextos->result() as $contexto) {
           $row = array();
           $row[] = $contexto->id_tipo_contexto_voip;
           $row[] = $contexto->nome_tipo_contexto_voip;
           $row[] = $contexto->comentario_tipo_contexto_voip;
           if(acesso_super_admin()):
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$contexto->id_tipo_contexto_voip."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$contexto->id_tipo_contexto_voip."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           else:
           $row[] = 'Sem permissão';
           endif;
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $contextos->num_rows(),
           "recordsFiltered" => $contextos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function contexto_voip_add(){
       $this->contexto_voip_validate();
       $data = array(
               'nome_tipo_contexto_voip' => $this->input->post('nome'),
               'comentario_tipo_contexto_voip' => $this->input->post('comentario'),
           );
       $insert = $this->voip_model->save_contexto($data);
       echo json_encode(array("status" => TRUE));
    }

    public function contexto_voip_edit($id){
       $data = $this->voip_model->edit_contexto($id);
       echo json_encode($data);
    }

    public function contexto_voip_update(){
       $this->contexto_voip_validate();
       $data = array(
               'nome_tipo_contexto_voip' => $this->input->post('nome'),
               'comentario_tipo_contexto_voip' => $this->input->post('comentario'),
           );
       $this->voip_model->update_contexto(array('id_tipo_contexto_voip' => $this->input->post('id')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function contexto_voip_delete($id){
       $this->voip_model->delete_contexto($id);
       echo json_encode(array("status" => TRUE));
    }

    private function contexto_voip_validate() {
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

/* End of file Contexto_voip.php */
/* Location: ./application/controllers/Contexto.php */