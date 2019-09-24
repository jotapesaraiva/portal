<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('impressora_model');
        $this->load->helper('month_helper');
    }

    public function index()
    {
        $this->output->enable_profiler(FALSE);
        // $dados['data_inicio'] = date_start_dez();
        // $dados['data_fim'] = date('d-m-Y');

        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/impressora/consultar.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '
        <script src="'.base_url().'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>';
        $session['username'] = $this->session->userdata('username');
        $unidades = $this->unidade_model->listar_unidade();
        $dados = array("unidades" => $unidades, 'data_inicio' => date_start_dez(), 'data_fim' => date('d-m-Y'));

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Impressora</span>', 'impressora');
        $this->breadcrumbs->push('<span>Consulta</span>', '/consulta');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('impressora/consultar',$dados);
        // $this->load->view('modal/modal_impressora');

        $this->load->view('template/footer',$script);
    }

    public function datatable_list($datai,$dataf){
      // Datatables Variables
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $datainicio = date("Y-m-d H:i:s", strtotime($datai));
      $datafim = date("Y-m-d H:i:s", strtotime($dataf));

      $chamados = $this->impressora_model->list_printer($datainicio,$datafim);
      // $chamados = $this->impressora_model->list_printer('2019-09-16 10:00','2019-09-16 10:40:00');

      $data = array();
      foreach ($chamados->result_array() as $key => $value) {
          $row = array();
          $row[] = $value['id_impressora'];
          $row[] = anchor_popup('http://'.$value['ip'].'/cgi-bin/dynamic/printer/config/reports/devicestatistics.html',$value['ip']);
          $row[] = $value['location'];
          $row[] = $value['nome_unidade'];
          $row[] = $value['date'];
          $row[] = $value['serial_number'];
          $row[] = $value['toner'];
          $row[] = $value['drum_level'];
          $row[] = $value['count_page'];
          // if(acesso_admin()):
          // $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Editar" onclick="edit_printer('."'".$value['id_impressora']."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
          //           <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Deletar" onclick="delete_printer('."'".$value['id_impressora']."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
          // else:
          //    $row[] = 'Sem permissão';
          // endif;

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

    public function teste(){
      $chamados = $this->impressora_model->list_printer('2019-09-16 10:00:00','2019-09-16 10:40:00');
      vd($chamados);
    }

}

/* End of file consultar.php */
/* Location: ./application/controllers/impressora/consultar.php */