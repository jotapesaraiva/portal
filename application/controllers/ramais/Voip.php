<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('voip_model');
        $this->load->model('telefonia_model');
        $this->load->model('unidade_model');
        $this->load->library('Auth_AD');
        esta_logado();
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/voip_ramal.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/jquery-mask-plugin-master/dist/jquery.mask.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';

        $script['script'] = '
            <script src="' . base_url() . 'assets/custom/form-input-mask.js" type="text/javascript"></script>';

        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

        $session['username'] = $this->session->userdata('username');
        $unidades = $this->unidade_model->listar_unidade();
        $categorias = $this->voip_model->listar_categoria();
        $contextos = $this->voip_model->listar_contexto();
        $equipamentos = $this->voip_model->listar_equipamento();
        $numeros = $this->telefonia_model->listar_telefone();
        $dados = array( 'numeros' => $numeros, 'equipamentos' => $equipamentos, 'contextos' => $contextos, 'categorias' => $categorias, 'unidades' => $unidades);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Ramais</span>', '/ramais');
        $this->breadcrumbs->push('<span>VoIP</span>', '/ramais/voip');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('ramais/voip');
        $this->load->view('modal/modal_ramal',$dados);

        $this->load->view('template/footer',$script);
    }


    public function ramal_voip_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $ramais = $this->voip_model->listar_ramal();

       $data = array();

       foreach($ramais->result() as $ramal) {
           $row = array();
           $row[] = $ramal->id_telefone_voip;
           $row[] = $ramal->nome_unidade;
           $row[] = $ramal->numero_telefone;
           $row[] = $ramal->ip_telefone_voip;
           $row[] = $ramal->descricao_telefone_voip;
           $row[] = $ramal->nome_tipo_equipamento_voip;
           $row[] = $ramal->nome_tipo_categoria_voip;
           $row[] = $ramal->nome_tipo_contexto_voip;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$ramal->id_telefone_voip."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$ramal->id_telefone_voip."','".$ramal->id_telefone."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $ramais->num_rows(),
           "recordsFiltered" => $ramais->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function ramal_voip_add(){
       $this->ramal_voip_validate();
       $telefone = array(
            'numero_telefone' => $this->input->post('voip'),
            'id_tipo_categoria_telefone' => 4,
       );
       //inseri os dados no tabela tbl_telefone e retorna o id.
       $id_telefone = $this->telefonia_model->save_telefone($telefone);

       $data = array(
            'ip_telefone_voip' => $this->input->post('ip'),
            'descricao_telefone_voip' => $this->input->post('descricao'),
            'id_telefone' => $id_telefone,
            'id_tipo_categoria_voip' => $this->input->post('categoria'),
            'id_tipo_equipamento_voip' => $this->input->post('equipamento'),
            'id_tipo_contexto_voip' => $this->input->post('contexto'),
        );
       $this->voip_model->save_ramal($data);

       $unidade = array(
            'id_unidade' => $this->input->post('unidade'),
            'id_telefone' => $id_telefone,
       );
       $this->unidade_model->salvar_unidade_telefone($unidade);

       echo json_encode(array("status" => TRUE));
    }

    public function ramal_voip_edit($id){
       $data = $this->voip_model->edit_ramal($id);
       echo json_encode($data);
    }

    public function ramal_voip_update() {
      // $this->output->enable_profiler(FALSE);
      $this->ramal_voip_validate();
      $telefone = array(
       'numero_telefone' => $this->input->post('voip'),
       'id_tipo_categoria_telefone' => 4,
      );
      $update_telefone = $this->telefonia_model->update_telefone(array('id_telefone' => $this->input->post('id_telefone')), $telefone);

      $unidade = array(
        'id_unidade' => $this->input->post('unidade'),
        'id_telefone' => $this->input->post('id_telefone'),
      );
      $update_unidade = $this->unidade_model->update_unidade_telefone(array('id_telefone' => $this->input->post('id_telefone')), $unidade);

/*   $update =
   if($update){}
      else{echo json_encode(array("status" => FALSE));}*/
       $voip = array(
            'ip_telefone_voip' => $this->input->post('ip'),
            'descricao_telefone_voip' => $this->input->post('descricao'),
            'id_telefone' => $this->input->post('id_telefone'),
            'id_tipo_categoria_voip' => $this->input->post('categoria'),
            'id_tipo_equipamento_voip' => $this->input->post('equipamento'),
            'id_tipo_contexto_voip' => $this->input->post('contexto'),
           );
       $update_data = $this->voip_model->update_ramal(array('id_telefone_voip' => $this->input->post('id_telefone_voip')), $voip);
       if($update_telefone == 1 | $update_unidade == 1 | $update_data == 1) {
          $data = 1;
          echo json_encode(array("status" => TRUE));
       }

    }

    public function ramal_voip_delete($id_telefone_voip,$id_telefone) {
      $this->voip_model->delete_unidade_telefone($id_telefone);
      $this->voip_model->delete_ramal($id_telefone_voip);
      $this->telefonia_model->delete_telefone($id_telefone);
      echo json_encode(array("status" => TRUE));
    }

    private function ramal_voip_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('unidade') == '') {
            $data['inputerror'][] = 'unidade';
            $data['error_string'][] = 'O campo nome é unidade';
            $data['status'] = FALSE;
        }

        if($this->input->post('voip') == '') {
            $data['inputerror'][] = 'voip';
            $data['error_string'][] = 'O campo voip é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('equipamento') == '') {
            $data['inputerror'][] = 'equipamento';
            $data['error_string'][] = 'O campo equipamento é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('categoria') == '') {
            $data['inputerror'][] = 'categoria';
            $data['error_string'][] = 'O campo categoria é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('contexto') == '') {
            $data['inputerror'][] = 'contexto';
            $data['error_string'][] = 'O campo contexto é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
/* End of file Voip.php */
/* Location: .//C/Users/joao.saraiva/AppData/Local/Temp/scp52966/var/www/html/portal/frontend/controllers/Voip.php */