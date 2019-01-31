<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enviar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('zabbix_model');
        $this->load->model('backups_model');
        $this->load->model('mantis_model');
        $this->load->model('monitora_model');
    }

    public function index($dados) {
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

    public function monitora($id) {
        $alertas = $this->monitora_model->select_mnt($id);
        foreach ($alertas as $alerta) {
            $dados['id'] = $alerta['id'];
            $dados['alerta'] = $alerta['desc_alerta'].' ';

            $dados['detalhe'] = $alerta['desc_alerta']."
                                \nOrigem: ".$alerta['origem']."
                                \nMetrica: ".$alerta['metrica_atual']."
                                \nPlano de ação: ".$alerta['plano_acao']."
                                \nResponsavel: ".$alerta['responsavel']."
                                \nAcionamento: ".$alerta['acionamento']."
                                \nPode Interromper: ".$alerta['interromper']."
                                \nDescrição de Serviço: ".$alerta['desc_servico']."
                                \nInformação Adicional:".$alerta['info_adicional'];
        }
        $dados['projetos'] = $this->select_option(
            $projetos = array(
                            array('ID' => '1','NAME' => 'CGDA'),
                            array('ID' => '2','NAME' => 'CGPS - Sustentação'),
                            array('ID' => '3','NAME' => 'CGPS - Gestão de Configuração'),
                            array('ID' => '4','NAME' => 'CGPS - Projeto/Manu. Assistida'),
                            array('ID' => '5','NAME' => 'CGRE - Rede'),
                            array('ID' => '6','NAME' => 'CGRE - Infra')
                        ));
        $dados['form'] = "modelo_cprojeto";
        $dados['tabela'] = "mnt_alertas";

        $this->index($dados);
    }

    public function server($id) {
        $detalhes = $this->zabbix_model->select_zabbix_server($id);
        $dados['id'] = $detalhes->id;
        $dados['alerta'] = "Alerta: ".$detalhes->servico;
        $dados['detalhe'] = "Alerta: ".$detalhes->servico."
        \nServidor: ".$detalhes->servidor."
        \nIP:".$detalhes->ip."
        \n".$detalhes->detalhe."
        \nInicio do Chamado:".date('d/m/Y H:i' ,strtotime($detalhes->data_alerta));
        $dados['projetos'] = $this->select_option(
            $projetos = array(
                            array('ID' => '1','NAME' => 'CGDA'),
                            array('ID' => '2','NAME' => 'CGPS - Sustentação'),
                            array('ID' => '3','NAME' => 'CGPS - Gestão de Configuração'),
                            array('ID' => '4','NAME' => 'CGPS - Projeto/Manu. Assistida'),
                            array('ID' => '5','NAME' => 'CGRE - Rede'),
                            array('ID' => '6','NAME' => 'CGRE - Infra')
                        ));
        $dados['form'] = "modelo_cprojeto";
        $dados['tabela'] = "zbx_server_fora";

        $this->index($dados);
    }

    public function link($id) {
        $detalhes = $this->zabbix_model->select_zabbix_link($id);
        foreach ($detalhes as $detalhe) {
            $dados['id'] = $detalhe['id'];
            $dados['alerta'] = 'Problema de Link: '.$detalhe['ticket'].' - '.$detalhe['servidor'].' ';

            $dados['detalhe'] = "Link: ".$detalhe['servidor']."
            \nIP: ".$detalhe['ip']."
            \n".$detalhe['detalhe']."
            \nUltimo Posicionamento: ".$detalhe['posicionamento'];

            $dados['ticket'] = $detalhe['ticket'];
            $dados['inicio_chamado'] = date('d/m/Y H:i' ,strtotime($detalhe['data_alerta']));
        }
        $dados['projeto'] = "7";
        $dados['form'] = "link";
        $dados['tabela'] = "zbx_link_fora";

        $this->index($dados);
    }

    public function backup($id) {
        $detalhes = $this->backups_model->select_backup($id);
        foreach ($detalhes as $detalhe) {
            $dados['id'] = $detalhe['id'];
            $dados['alerta'] = "Backup ".$detalhe['status'] ." - ".$detalhe['specification'];
            $dados['detalhe'] = "Backup: ".$detalhe['specification']."
Sessão: ".$detalhe['session_id']."
Modo: ".$detalhe['mode']."
\nEquipe Responsável: CGRE - Produção.
Plano de Ação: Analisar os log da session ".$detalhe['session_id'].".
Email: operadores@sefa.pa.gov.br
Ramal: 4994/4984
\nLogo de Erro: ".$detalhe['erro_backup'];
        }
        $dados['projeto'] = "8";
        $dados['form'] = "modelo_sprojeto";
        $dados['tabela'] = "dp_backups";

        $this->index($dados);
    }

    public function abrir_mantis() {
        $this->load->model('mantis_model');
        //puxar os valores do input e armazenar numa variavel
        switch ($this->input->post('projeto')) {
            case '1'://CGDA
                $projeto   = 'Monitoramento';
                $categoria = 'Acionamento';
                $procedore = 'STP_RELT_PROJETO_CATEG_CGDA';
                $parametros = '';
                $table = $this->input->post('tabela');
                break;
            case '2'://CGPS - Sustentação
                $projeto   = 'Sustentação';
                $categoria = 'Alertas de Produção';
                $procedore = 'STP_RELT_CASO_DEMANDAS_CGPS';
                $parametros = "IN_CF_TIPO_DEMAND => 'Manutenção Corretiva',
                               IN_CF_SOLICITANTE => 'Equipe de Produção',";
                $table =$this->input->post('tabela');
                break;
            case '3'://CGPS - Gestão de Configuração
                $projeto   = 'Infraestrutura';
                $categoria = 'Análise';
                $procedore = 'STP_RELT_CASO_DEMANDAS_CONFIG';
                $parametros = "IN_CF_ESCOPO => 'Sustentação/Produção',
                               IN_CF_NOAMBIENTE => 'Produção',
                               IN_CF_APLICACOES => '',";
                $table =$this->input->post('tabela');
                break;
            case '4'://CGPS - Proj. Manu. Assistida
                $projeto   = 'Projetos/Man.Assistida';
                $categoria = 'Alertas de Produção';
                $procedore = 'STP_RELT_CASO_DEMANDAS_CGPS';
                $parametros = "IN_CF_TIPO_DEMAND => 'Manutenção Corretiva',
                               IN_CF_SOLICITANTE => 'Equipe de Produção',";
                $table =$this->input->post('tabela');
                break;
            case '5'://CGRE - Rede
                $projeto   = 'Suporte a Servidores';
                $categoria = 'Verificar servidor';
                $procedore = 'STP_RELT_CASO_PROJETO_CATEG';
                $parametros = '';
                $table =$this->input->post('tabela');
                break;
            case '6'://CGRE - Infra
                $projeto   = 'Equipamentos de Rede';
                $categoria = 'No-Break Servidores';
                $procedore = '';
                $parametros = '';
                $table =$this->input->post('tabela');
                break;
            case '7'://CGRE - Produção link
                $projeto   = 'Chamado de Link';
                $categoria = 'DADOS';
                $procedore = 'STP_RELT_CASO_DEMANDAS_LINK';
                $parametros = "IN_CF_TICKET => '".$this->input->post('ticket')."',
                               IN_CF_INICIO_CHAMADO => '".strtotime(str_replace("/", "-",$this->input->post("inicio_chamado")))."',";
                $table =$this->input->post('tabela');
                break;
            case '8'://CGRE - Produção Backup
                $projeto   = 'Ambiente de Backup';
                $categoria = 'Relatório de Falha de Backup';
                $procedore = 'STP_RELT_CASO_PROJETO_CATEG';
                $parametros = '';
                $table =$this->input->post('tabela');
                break;
            default://CGRE - Produção
                $projeto   = 'Ambiente de Backup';//Chamado de Link
                $categoria = 'Relatório de Falha de Backup';//DADOS
                $procedore ='STP_RELT_CASO_PROJETO_CATEG';
                $parametros = '';
                $table =$this->input->post('tabela');
                break;
        }

        $params = array(
            'usuario'   => $this->session->userdata('username'),//nome do usuario
            'projeto'   => $projeto,//projeto mantis
            'categoria' => $categoria,//categoria do projeto mantis
            'servico'   => $this->input->post('alerta'),//resumo do mantis
            'detalhe'   => $this->input->post('detalhe')//descriçao do mantis
        );
        // vd($params);
        //load da procedore passando as variaveis e armazenando em uma variavel
        $this->mantis_model->abrir_mantis_teste($params,$procedore,$parametros);
        $resultado = $this->mantis_model->select_num_mantis($params);
        //atualizo a tabela do backup ou zabbix com o numero do mantis
        $this->mantis_model->update_num_mantis($table,array('mantis' => $resultado), array('id' => $this->input->post('id')));
        //retorno para dashboard
        redirect('welcome');
    }

    public function select_option($dados) {
        $html = "";
        foreach ($dados as $key => $dado) {
            $html .= "<option value='".$dado['ID']."' >".$dado['NAME']."</option>";
        }
        return $html;
    }

//###########################################################TESTE######################################################

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