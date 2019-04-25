<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
        $this->load->model('voucher_model');
        $this->load->helper('date_helper');
    }

    public function index() {

        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
            ';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/gerencias/voucher.js" type="text/javascript"></script>
            ';
        $script['script'] = '
            <script src="' . base_url() . 'assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
        ';
        $session['username'] = $this->session->userdata('username');
        $modal['usuario'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Voucher</span>', '/gerencias/voucher');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('gerencias/voucher');
        $this->load->view('modal/modal_voucher', $modal);

        $this->load->view('template/footer', $script);
    }

    public function voucher_list(){
       // Datatables Variables
       $draw = intval($this->input->get("draw"));
       $start = intval($this->input->get("start"));
       $length = intval($this->input->get("length"));

       $historicos = $this->voucher_model->historico_voucher();

       $data = array();

       foreach($historicos->result() as $historico) {
           $row = array();
           $row[] = $historico->id_historico;
           $row[] = date( 'd/M/Y', strtotime($historico->data));
           $row[] = $historico->usuario;
           $row[] = $historico->voucher;
           $row[] = $historico->valor;
           $row[] = $historico->motorista;
           $row[] = $historico->prefixo;
           $row[] = $historico->observacao;
           $row[] = '<a class="btn yellow-mint btn-outline sbold" href="javascript:void(0)" title="Edit" onclick="edit_voucher('."'".$historico->id_historico."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar </a>
                     <a class="btn red-mint btn-outline sbold" href="javascript:void(0)" title="Hapus" onclick="delete_voucher('."'".$historico->id_historico."'".')"><i class="glyphicon glyphicon-trash"></i> Deletar </a>';
           $data[] = $row;
       }

       $output = array(
           "draw" => $draw,
           "recordsTotal" => $historicos->num_rows(),
           "recordsFiltered" => $historicos->num_rows(),
           "data" => $data,
       );
       echo json_encode($output);
    }

    public function voucher_add() {
        $this->historico_validate();
        // $format =  str_replace('/', '-', $this->input->post('data'));
        $data = array(
            'usuario' => $this->input->post('usuario'),
            'motorista' => $this->input->post('motorista'),
            'prefixo' => $this->input->post('prefixo'),
            'voucher' => $this->input->post('voucher'),
            'data' => date('Y-m-d', strtotime($this->input->post('data'))),//se o strtotime estiver separado por  '/' assumi o formato m/d/y se for por - assumi o formanto d-m-y
            'valor' => $this->input->post('valor'),
            'observacao' => $this->input->post('observacao')
        );
        // vd($data);
        $this->voucher_model->save_voucher($data);
        echo json_encode(array("status" => TRUE));
    }

    public function voucher_update() {
        $this->historico_validate();
        // $format =  str_replace('/', '-', $this->input->post('data'));
        $data = array(
            'usuario' => $this->input->post('usuario'),
            'motorista' => $this->input->post('motorista'),
            'prefixo' => $this->input->post('prefixo'),
            'voucher' => $this->input->post('voucher'),
            'data' => date('Y-m-d', strtotime($this->input->post('data'))),
            'valor' => $this->input->post('valor'),
            'observacao' => $this->input->post('observacao')
        );
        $this->voucher_model->update_voucher(array('id_historico' => $this->input->post('id_historico')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function voucher_edit($id) {
        $data = $this->voucher_model->edit_voucher($id);
            $date = array(
              'id_historico' => $data->id_historico,
              'usuario' => $data->usuario,
              'motorista' => $data->motorista,
              'prefixo' => $data->prefixo,
              'voucher' => $data->voucher,
              'data' => date('d-m-Y', strtotime($data->data)),
              'valor' => $data->valor,
              'observacao' => $data->observacao
            );
        echo json_encode($date);
    }

    public function voucher_delete($id) {
        $this->voucher_model->delete_voucher($id);
        echo json_encode(array("status" => TRUE));
    }

    private function historico_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('voucher') == '') {
            $data['inputerror'][] = 'voucher';
            $data['error_string'][] = 'Insira o numero do voucher';
            $data['status'] = FALSE;
        }

        if($this->input->post('motorista') == '') {
            $data['inputerror'][] = 'motorista';
            $data['error_string'][] = 'Selecione a motorista da corrida';
            $data['status'] = FALSE;
        }

        if($this->input->post('prefixo') == '') {
            $data['inputerror'][] = 'prefixo';
            $data['error_string'][] = 'Selecione a prefixo da corrida';
            $data['status'] = FALSE;
        }

        if($this->input->post('valor') == '') {
            $data['inputerror'][] = 'valor';
            $data['error_string'][] = 'Insira o valor da corrida';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function teste()
    {
      $teste = strtotime("now");
      datePtBr($teste);
    }

}

/* End of file Voucher.php */
/* Location: ./application/controllers/gerencias/Voucher.php */