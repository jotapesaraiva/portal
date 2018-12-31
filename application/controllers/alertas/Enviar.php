<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enviar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('zabbix_model');
        $this->load->model('backups_model');
        $this->load->model('mantis_model');
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

    public function server($id) {
        $detalhes = $this->zabbix_model->select_zabbix_server($id);
        foreach ($detalhes as $detalhe) {
            $dados['status'] = $detalhe['servidor'];
            $dados['plano'] = $detalhe['detalhe'];
            $dados['mode'] = $detalhe['ip'];
            $dados['inicio_chamado'] = date('d/m/Y H:i' ,strtotime($detalhe['data_alerta']));
        }
        $dados['projetos'] = $this->select_option($this->mantis_model->equipes_mantis());

        $dados['form'] = "server";

        $script['footerinc'] = '';
        $script['script'] = '
        <script src="'.base_url().'assets/custom/menu/menu_mantis.js" type="text/javascript"></script>
        ';
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


    public function link($id) {
        $detalhes = $this->zabbix_model->select_zabbix_link($id);
        foreach ($detalhes as $detalhe) {
            $dados['status'] = 'Problema de Link: '.$detalhe['ticket'].' - '.$detalhe['servidor'].' ';
            $dados['plano'] = $detalhe['detalhe'];
            $dados['mode'] = $detalhe['ip'];
            $dados['log'] = $detalhe['posicionamento'];
            $dados['ticket'] = $detalhe['ticket'];
            $dados['inicio_chamado'] = date('d/m/Y H:i' ,strtotime($detalhe['data_alerta']));
        }
        $dados['projeto'] = "Chamado de Link";
        $dados['categoria'] = "DADOS";
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
        $dados['projeto'] = "Ambiente de Backup";
        $dados['categoria'] = "Relatório de Falha de Backup";
        $dados['form'] = "backup";

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
        if($this->input->post('log') == null){
            $detalhe = 'sem log';
        } else {
            $detalhe = $this->input->post('log');//descriçao do mantis
        }
        $params = array(
        'usuario' => $this->session->userdata('username'),//nome do usuario
        'projeto' => $this->input->post('projeto'),//projeto mantis
        'servico' => $this->input->post('alerta'),//resumo do mantis
        'detalhe' => $detalhe,//descriçao do mantis
        'categoria' => $this->input->post('categoria')//categoria do projeto mantis
    );
        //load da procedore passando as variaveis e armazenando em uma variavel
        $this->mantis_model->abrir_mantis($params);
        $resultado = $this->mantis_model->select_num_mantis($params);
        //atualizo a tabela do backup ou zabbix com o numero do mantis
        $this->backups_model->update_num_mantis(array('mantis' => $resultado), array('session_id' => $this->input->post('sessao')));
        //retorno para dashboard
        redirect('welcome');
    }

    public function abrir_mantis_link() {
        $this->load->model('mantis_model');
        //puxar os valores do input e armazenar numa variavel
        if($this->input->post('log') == null){
            $detalhe = 'sem log';
        } else {
            $detalhe = $this->input->post('log');//descriçao do mantis
        }
        $params = array(
        'usuario' => $this->session->userdata('username'),//nome do usuario
        'projeto' => $this->input->post('projeto'),//projeto mantis
        'servico' => $this->input->post('alerta'),//resumo do mantis
        'detalhe' => $detalhe,//descriçao do mantis
        'categoria' => $this->input->post('categoria'),//categoria do projeto mantis
        'ticket' => $this->input->post('ticket'), //ticket campo personalizado
        'inicio_chamado' => strtotime(str_replace('/', '-',$this->input->post('inicio_chamado'))) //inicio chamado campo personalizado
    );
        // vd($params);
        //load da procedore passando as variaveis e armazenando em uma variavel
        $this->mantis_model->abrir_mantis_link($params);
        $resultado = $this->mantis_model->select_num_mantis($params);
        //atualizo a tabela do backup ou zabbix com o numero do mantis
        $this->zabbix_model->update_num_mantis(array('mantis' => $resultado), array('ip' => $this->input->post('mode')));
        //retorno para dashboard
        redirect('welcome');
    }



    public function select_option($dados) {
        $html = "";
        foreach ($dados as $dado) {
            $html .= "<option value='".$dado['ID']."' >".$dado['NAME']."</option>";
        }
        return $html;
    }

    public function projeto($id) {
        $projetos = $this->mantis_model->projetos_mantis($id);
        echo json_encode($projetos);
    }

    public function categoria($id) {
        $projetos = $this->mantis_model->categorias_mantis($id);
        echo json_encode($projetos);
    }
}

/* End of file Enviar.php */
/* Location: ./application/controllers/alertas/Enviar.php */