<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zabbix_grc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->load->model('zabbix_model');
    }

    public function index() {
        $this->output->enable_profiler(false);
        //Load config file
        $this->load->config('zabbix', TRUE);
        // Get breadcrumbs display options
        $api_url = $this->config->item('api_url', 'zabbix');
        $api_user = $this->config->item('api_user', 'zabbix');
        $api_pass = $this->config->item('api_pass', 'zabbix');
        $reload_time = $this->config->item('reload_time', 'zabbix');
        $host_group_filter = $this->config->item('host_group_filter', 'zabbix');
        $context = base_url() . 'assets';
        try {
          // connect to Zabbix Json API

        $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));

        $triggers = $api->triggerGet(array(
                'host',
                'only_true'                   => 1,
                'skipDependent'               => 1,
                'monitored'                   => 1,
                'active'                      => 1,
                'output'                      => 'extend',
                'expandDescription'           => 1,
                'selectHosts'                 => 'name',
                'withLastEventUnacknowledged' => 1,
                'sortfield'                   => 'priority',
                'sortorder'                   => 'DESC',
                'expandComment'               => 1,
                'expandDescription'           => 1,
                'expandComment'               => 1,
                'selectHosts'                 => array('hostname'),
                'filter'                      => array('priority' => array('5'),'value' => '1' , '')
          ));
        $alertas_atuais = "'0'";
        $this->zabbix_model->delete_zabbix_grc();
        foreach($triggers as $trigger){
            $alertas_atuais .= ",'$trigger->triggerid'";
             // echo $alertas_atuais;
            if (strpos($trigger->description, 'Link') !== false) {

                $host_id = $trigger->hosts[0]->hostid;
                $hosts   = $api->hostGet(array(
                    'output' => 'extend',
                    'filter' => array('hostid' => $host_id)
                ));

                $hosts_interface = $api->hostinterfaceGet(array(
                    'output' => 'extend',
                    'filter' => array('hostid' => $host_id)
                ));
                $data_alerta   = date('Y-m-d H:i:s' ,$trigger->lastchange);
                $data_atual_br = date('Y-m-d H');
                echo $hosts[0]->name;
                $dados_alerta = array(
                        'id'                      => $trigger->triggerid,//id da trigger no zabbix
                        'host_id'                 => $hosts[0]->hostid,//id do host no zabbix
                        'servidor'                => $hosts[0]->name, //host
                        'servico'                 => $trigger->description, //designação
                        'detalhe'                 => $trigger->comments, // plano de açao
                        'prioridade'              => $trigger->priority,//nivel de prioridade
                        'data_alerta'             => $data_alerta,//
                        'data_ultima_verificacao' => $data_atual_br,
                        'situacao'                => 'PROBLEMA',
                        'ip'                      => $hosts_interface[0]->ip,
                        'designacao'              => $hosts[0]->description
                 );
                 echo "<pre>";
                 var_dump($dados_alerta);
                 echo "</pre>";
                        $this->zabbix_model->save_zabbix_grc($dados_alerta);
                 // $this->zabbix_model->replace_zabbix_grc($dados_alerta);

                // mysqli_query($con, "INSERT INTO tab_alertas_zabbix_link (id,host_id,servidor,servico,detalhe,prioridade,data_alerta,data_ultima_verificacao,situacao,ip,designacao)
                //                     VALUES
                //                     ('".$dados_alerta['id_alerta']."','".$dados_alerta['host_id']."', '".$dados_alerta['host']."', '".utf8_decode($dados_alerta['descricao'])."', '".utf8_decode($dados_alerta['plano_acao'])."',
                //                      '".$dados_alerta['prioridade']."', '".$dados_alerta['data_alerta']."', '".$dados_alerta['data_ultima_verificacao']."',
                //                      '".$dados_alerta['situacao']."','".$dados_alerta['ip']."','".$dados_alerta['designacao']."'
                //                     ) ON DUPLICATE KEY UPDATE data_ultima_verificacao = '".$dados_alerta['data_ultima_verificacao']."';");
                        }
        }

        echo $alertas_atuais;

        // $delete = $this->zabbix_model->delete_zabbix_grc($alertas_atuais);

        $alertas = $this->zabbix_model->list_zabbix_grc();
        $html1 = "";
        foreach ($alertas->result_array() as $linha) {
            //Desnecessario o zabbix já possui um campo que mostra o tempo que o link ficou fora.
            $data_alerta_tratada = new DateTime($linha['data_alerta']);
            $hora_atual = new DateTime();
            $tempo_alerta = $data_alerta_tratada->diff($hora_atual);
            $tempo_alerta = $tempo_alerta->d."d ".$tempo_alerta->h."h ".$tempo_alerta->i."m ".$tempo_alerta->s."s ";

            // $prioridade = ($linha['prioridade'] == '4') ? 'Alta' : 'Desastre';
            // $alerta = $linha['servico'];
            $localidade = utf8_decode($linha['servidor']);
            // echo $localidade;
            if (strpos('PRD',$localidade) !== false) {
                $empresa = explode(" - ",$localidade);
            } else {
                $empresa = " ";
            }

            $mantis = ($linha['mantis']!='0') ? "<a href='http://intranet2.sefa.pa.gov.br/mantis/view.php?id=".$linha['mantis']."' target='_blank'>".$linha['mantis']." </a>" : "<a href='/?m=index&f=links_zabbix&a=alterar&aux=Indisponibilidade de Link&id=".htmlentities($linha['id'], ENT_QUOTES, 'ISO-8859-1')."'  style='color: rgb(0,0,255)'><font color='374E9E' ><button id='loc_botao_inserir'  class='btn btn-primary'>+</button> </font></a>";
            // vd($localidade);
            $grc = $this->zabbix_model->list_grc_link($linha['designacao']);
            // vd($grc);
            foreach ($grc as $linha_grc) {
                $designacao_update = array(
                    'ticket'         => $linha_grc['ticket'],
                    'posicionamento' => $linha_grc['posicionamento']
                );

                $this->zabbix_model->update_zabbix_grc($designacao_update,$linha['designacao']);
            }
            $html1 .= " <tr>\n
                            <td>
                                <a href='http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_listarhistorico.php?vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=&id_ticket=".htmlentities($linha['ticket'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank' title='Ultima Posicao: ".htmlentities($linha['posicionamento'], ENT_QUOTES, 'ISO-8859-1')."' style='color: rgb(0,0,255)'><font color='374E9E' >".htmlentities($linha['ticket'], ENT_QUOTES, 'ISO-8859-1')." </font></a>
                            </td>\n
                            <td>
                                <a class='".($empresa=='PRD' ? 'label label-novo' : 'label label-info' )."' href='http://x-oc-zabbix.sefa.pa.ipa/zabbix/latest.php?filter_set=1&hostids[]=".htmlentities($linha['host_id'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank'  style='color: rgb(0,0,255);font-size:15px'><font color='WHITE' >".htmlentities($localidade, ENT_QUOTES, 'ISO-8859-1')." </font></a>
                            </td>\n
                            <td>
                                <a href='http://portal-monitoramento.sefa.pa.gov.br/index/links_ping.php?ip=".htmlentities($linha['ip'], ENT_QUOTES, 'ISO-8859-1')."' target='_blank' title='Ping' style='color: rgb(0,0,255)'><font color='374E9E' >".htmlentities($linha['ip'], ENT_QUOTES, 'ISO-8859-1')." </font></a>
                            </td>\n
                            <td>".$tempo_alerta."</td>\n
                            <td>".$mantis."</td>\n
                        </tr>\n";
        }

          if($html1=='') {
            echo json_encode("
                <tr>
                    <td>N&atilde;o h&aacute; Alertas no momento</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>");
          } else {
            echo json_encode($html1);
          }

        }
        catch(Exception $e) {
            //Exception in ZabbixApi catched
            echo $e->getMessage();
        }

    }

}

/* End of file Zabbix_grc.php */
/* Location: ./application/controllers/dash/Zabbix_grc.php */