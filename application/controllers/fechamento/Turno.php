<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turno extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('fechamento_model');
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '<link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">';
        $script['footerinc'] = '<script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>';
        $script['script'] = '<script src="' . base_url() . 'assets/custom/fechamento/turno.js" type="text/javascript"></script>';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Fechamento</span>', 'fechamento');
        $this->breadcrumbs->push('<span>turno</span>', '/fechamento/turno');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $data = date('Y-m-d h:i:s', strtotime(" -30 minutes"));
        $dia = date('Y-m-d');
        $hora = date('h:i:s', strtotime(" -30 minutes"));
        $atividadeEquipevidade = $this->fechamento_model->mantisPendentes();
        $atividadeEquipevidade .= $this->fechamento_model->mantisRealizado();

        $dados = array(
            'monitora'        => $this->fechamento_model->monitora($data),
            'backup'          => $this->fechamento_model->backup($dia,$hora),
            'link'            => $this->fechamento_model->link(),
            'servidores'        => $this->fechamento_model->servidores(),
            'simplesNacional' => $this->fechamento_model->simplesNacional(),
            'atividadeEquipe' => $atividadeEquipevidade,
            'obs'             => ''
        );

        $this->load->view('fechamento/turno',$dados);
        $this->load->view('template/footer', $script);
    }

    public function abrir_mantis() {
        /* Load form helper */
        $this->load->helper(array('form', 'url'));
        /* Load form validation library */
        $this->load->library('form_validation');
        /* Set validation rule for name field in the form */
        $this->form_validation->set_rules('turno', 'Turno', 'required');//, array('required' => '<span class="required" aria-required="true"> * </span>'));
        $this->form_validation->set_rules('ar_nobreak', 'Ar-Condicionado', 'required');//,  array('required' => '<span class="required" aria-required="true"> * </span>'));
        $this->form_validation->set_error_delimiters('<span class="required" aria-required="true">', '</span>');
        if ($this->form_validation->run('turno') == FALSE) {
          $this->index();
            // vd('passou aqui !!!');
            // $erro = array('mensagens' => validation_errors());
            // $this->load->view('fechamento/turno', $erro);
        } else {
           $this->load->model('mantis_model');
           if($this->input->post('ar_cpd') == 'on') {
             $ar_cpd = 'OK';
           } else {
             $ar_cpd = 'NOK';
           }

           if($this->input->post('led') == 'on') {
             $led = 'OK';
           } else {
             $led = 'NOK';
           }
           $detalhe = '
           ===================== CPD ==================
           Ar condicionado: '.$ar_cpd.'
           Temperatura: '.$this->input->post('temperatura_cpd').'
           Umidade: '.$this->input->post('umidade_cpd').'
           Led\'s: '.$led.'

           ============== SALA de NOBREAK =============
           Ar condicionado: '.$this->input->post('ar_nobrek').'
           === Nobreak 01 ===
           Temperatura: '.$this->input->post('temperatura_nobreak02').'
           Umidade: '.$this->input->post('umidade_nobreak01').'
           Baterias: '.$this->input->post('bateria01').'
           === Nobreak 02 ===
           Temperatura: '.$this->input->post('temperatura_nobreak02').'
           Umidade: '.$this->input->post('umidade_nobreak02').'
           Baterias: '.$this->input->post('bateria02').'
           =================== LINKs ==================
           '.$this->input->post('links').'
           ================= MONITORA =================
           '.$this->input->post('monitora').'
           ================= SERVIDORES ===============
           '.$this->input->post('servidores').'
           ================== BACKUPS =================
           '.$this->input->post('backups').'
           ============= SIMPLES NACIONAL =============
           '.$this->input->post('simplesNacional').'
           ============= Atividades Equipe ============
           '.$this->input->post('atividadesEquipe').'
           ==================== OBS ===================
           '.$this->input->post('obs').'
           ';

           $params = array(
               'usuario'   => $this->session->userdata('username'),//nome do usuario
               'projeto'   => 'Administração de Ambiente',//projeto mantis
               'categoria' => 'Data Center',//categoria do projeto mantis
               'servico'   => 'Fechamento do Turno - '.$this->input->post('turno'),//resumo do mantis
               'detalhe'   => $detalhe//descriçao do mantis
           );
           $procedore = 'STP_RELT_CASO_PROJETO_CATEG';
           $parametros = '';
           $this->mantis_model->abrir_mantis_teste($params,$procedore,$parametros);
           redirect('dashboard/producao');
        }


    }


    public function teste()
    {
        $diahora = date('Y-m-d h:i:s', strtotime(" -30 minutes"));
        // $dia = date('Y-m-d');
        $dia = '2019-11-20';
        $hora = date('h:i:s', strtotime(" -30 minutes"));
        $data = $this->fechamento_model->servidores();
        // $data .= $this->fechamento_model->mantisPendentes();
        vd($data);
        // echo $data;
        // $data = $this->fechamento_model->backup($dia,$hora);
        // $data = $this->fechamento_model->monitora($diahora);
        // $data['simplesNacional'] = $this->fechamento_model->simplesNacional();

    }

}

/* End of file Turno.php */
/* Location: ./application/controllers/fechamento/Turno.php */