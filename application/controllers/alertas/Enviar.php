<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enviar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('zabbix_model');
        $this->load->model('backups_model');
    }

    public function index() {
        $script['footerinc'] = '';
        $script['script'] = '';
        $css['headerinc'] = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Dashboard</span>', '/welcome');
        // $this->breadcrumbs->push('<span>Unidades</span>', '/localidades/unidades');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('alertas/enviar');

        $this->load->view('template/footer', $script);
    }


    public function link($id) {
        $detalhes = $this->zabbix_model->select_link($id);
        //abrir mantis

        //update o numero do mantis na tabela backups_model
        //enviar email
        //retorno dashboard

    }

    public function backup($id) {
        $detalhes = $this->backups_model->select_backup($id);
        foreach ($detalhes as $detalhe) {
            $dados['mode'] = $detalhe['mode'];
            $dados['status'] = "Backup ".$detalhe['status'] ." - ".$detalhe['specification'];
            $dados['sessao'] = $detalhe['session_id'];
            $dados['log'] = $detalhe['erro_backup'];
        }
        // $output = shell_exec("/opt/omni/bin/omnirpt -report dl_info | grep -E 'DIARIO|SEMANA|MENSAL|ANUAL' | grep -v _ANUAL | grep -v EXTRA | awk {'print $3'} | sort");
        // $dados['jobs'] = preg_split("#[\r\n]+#", $output);
        $dados['plano'] = "Analisar os log da session ".  $dados['sessao']. " caso seja necessario abrir mantis para equipe responsavel e relacionar com esse mantis.";
        $dados['form'] = "link";

        $script['footerinc'] = '';
        $script['script'] = '';
        $css['headerinc'] = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Dashboard</span>', '/welcome');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $this->load->view('alertas/enviar', $dados);

        $this->load->view('template/footer', $script);

    }

    public function abrir_mantis() {
        $this->load->model('mantis_model');
        //puxar os valores do input e armazenar numa variavel
        $params = array(
        'usuario' => $this->session->userdata('username'),//nome do usuario
        'projeto' => $this->input->post('alerta'),//projeto mantis
        'servico' => $this->input->post('alerta'),//resumo do mantis
        'detalhe' => $this->input->post('alerta'),//descriçao do mantis
        'categoria' => $this->input->post('alerta')//categoria do projeto mantis
    );
        //load da procedore passando as variaveis e armazenando em uma variavel
        $this->mantis_model->abrir_mantis($params);
        $resultado = $this->mantis_model->select_num_mantis($params);
        //atualizo a tabela do backup ou zabbix com o numero do mantis
        $this->backups_model->insert_num_mantis($resultado,$session_id);
        //retorno para dashboard
        redirect('portal/welcome');

    }

}

/* End of file Enviar.php */
/* Location: ./application/controllers/alertas/Enviar.php */