<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastrar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('impressora_model');
    }


    public function index()
    {
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
            <script src="' . base_url() . 'assets/custom/impressora/cadastrar.js" type="text/javascript"></script>';
        $script['script'] = '';
        $session['username'] = $this->session->userdata('username');
        $unidades = $this->unidade_model->listar_unidade();
        $dados = array("unidades" => $unidades);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Impressora</span>', 'impressora');
        $this->breadcrumbs->push('<span>Cadastrar</span>', '/cadastrar');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('impressora/cadastrar',$dados);
        $this->load->view('modal/modal_impressora');

        $this->load->view('template/footer',$script);
    }

    // public function datatable_list($datai,$dataf){
    public function datatable_list() {
      // Datatables Variables
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      // $chamados = $this->impressora_model->list_printer($datai,$dataf);
      $chamados = $this->impressora_model->select_printer();

      $data = array();
      foreach ($chamados->result_array() as $key => $value) {
          $row = array();
          $row[] = $value['id_impressora'];
          $row[] = anchor_popup('http://'.$value['ip'].'/cgi-bin/dynamic/printer/config/reports/devicestatistics.html',$value['ip']);
          $row[] = $value['location'];
          $row[] = $value['serial_number'];
          $row[] = $value['model'];
          $row[] = $value['type'];
          $row[] = $value['nome_unidade'];
          if(acesso_admin()):
          $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Editar" onclick="edit_printer('."'".$value['id_impressora']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Deletar" onclick="delete_printer('."'".$value['id_impressora']."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
          else:
             $row[] = 'Sem permissão';
          endif;

          $data[] = $row;
      }
          $output = array (
              "draw"            => $draw,
              "recordsTotal"    => $chamados->num_rows(),
              "recordsFiltered" => $chamados->num_rows(),
              "data"            => $data,
          );
          echo json_encode($output);
    }

    public function printer_add(){
       $this->printer_validate();
       $data = array(
               'ip' => $this->input->post('ip'),
               'location' => $this->input->post('location'),
               'serial_number' => $this->input->post('sn'),
               'model' => $this->input->post('model'),
               'type' => $this->input->post('type'),
               'id_unidade' => $this->input->post('unidade'),
           );
       $insert = $this->impressora_model->save_printer($data);
       echo json_encode(array("status" => TRUE));
    }

    public function printer_edit($id){
       $data = $this->impressora_model->edit_printer($id);
       echo json_encode($data);
    }

    public function printer_update(){
       $this->printer_validate();
       $data = array(
               'ip' => $this->input->post('ip'),
               'location' => $this->input->post('location'),
               'serial_number' => $this->input->post('sn'),
               'model' => $this->input->post('model'),
               'type' => $this->input->post('type'),
               'id_unidade' => $this->input->post('unidade'),
           );
       $this->impressora_model->update_printer(array('id_impressora' => $this->input->post('id_impressora')), $data);
       echo json_encode(array("status" => TRUE));
    }

    public function printer_delete($id){
       $this->impressora_model->delete_printer($id);
       echo json_encode(array("status" => TRUE));
    }

    private function printer_validate() {
        $data = array();
        $data['error_string'] = array ();
        $data['inputerror'] = array ();
        $data['status'] = TRUE;

        if($this->input->post('ip') == '') {
            $data['inputerror'][] = 'ip';
            $data['error_string'][] = 'O campo ip é obrigatorio';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }


    public function teste(){
      $chamados = $this->impressora_model->list_printer('2019-09-16 10:00:00','2019-09-16 10:40:00');
      vd($chamados);
    }

}

/* End of file Cadastrar.php */
/* Location: ./application/controllers/impressora/Cadastrar.php */