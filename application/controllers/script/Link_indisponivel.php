<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_indisponivel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        //this controller can only be called from the command line
        // if(!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->load->model('zabbix_model');
        $this->load->model('mantis_model');
        $this->load->model('link_model');
        $this->load->model('modulos_model');
        $this->load->helper('macros_helper');
    }

    public function index() {

        $modulo = $this->modulos_model->site_modulo('monitora');
        // vd($modulo[0]['status']);

        if($modulo[0]['status'] == 1) {

            // $this->output->enable_profiler(false);
            //Load config file
            $this->load->config('zabbix', TRUE);
            // Get breadcrumbs display options
            $api_url = $this->config->item('api_url', 'zabbix');
            $api_user = $this->config->item('api_user', 'zabbix');
            $api_pass = $this->config->item('api_pass', 'zabbix');
            $reload_time = $this->config->item('reload_time', 'zabbix');
            $host_group_filter = $this->config->item('host_group_filter', 'zabbix');
            $context = base_url() . 'assets';
            $result = "";
            $alert = array();
            $retorno = array();
            // connect to Zabbix Json API
            $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
            // Set Defaults

            $hosts = $api->hostGet(array(
                'output'=> array('hostid','name','status', 'description'),
                // 'output'=> 'extend',
                'sortfield' => 'name',
                    // 'selectGroups'=> 'extend',
                'selectInterfaces' => array('ip'),
                'selectInventory' => array('location_lat','location_lon','vendor'),
                // 'selectInventory' => 'extend',
                'groupids' => array(16)//16- novo zabbix(link Acesso) //19,18 - antigo zabbix(link terrestre,link satelite)
            ));
                foreach ($hosts as $host) {
                    $host_id[] = $host->hostid;
                }

                $triggers = $api->triggerGet(array(
                       'output' => 'extend',
                       // array(
                       //     'priority',
                       //     'description'),
                       'selectHosts' => array('hostid'),
                           'hostids' => $host_id,
                           'expandDescription' => 1,
                           'only_true' => 1,
                           'monitored' => 1,
                           'withLastEventUnacknowledged' => 1,
                        'sortfield' => array('lastchange', 'priority'),
                           'sortorder' => 'DESC',
                        'filter' => array(
                           'priority' => array('5'),
                           'value' => '1')
                   ));

            if($triggers==NULL){
                $alert ='0';
            } else {
                foreach($triggers as $trigger) {
                   foreach($trigger->hosts as $host) {
                       $hostTriggers[$host->hostid][] = $trigger;
                   }
                }
                foreach ($hosts as $host) {
                    $hostid = $host->hostid;
                    $hostname = $host->name;
                    $hoststatus = $host->status;
                    $hostdesignacao = $host->description;
                    $hostip = $host->interfaces[0]->ip;
                    if($host->inventory != NULL) {
                        $hostvendor = $host->inventory->vendor;
                        $hostlat = $host->inventory->location_lat;
                        $hostlon = $host->inventory->location_lon;
                    } else {
                        $hostvendor = "";
                        $hostlat = "";
                        $hostlon = "";
                    }

                    if($hoststatus == 0){
                        if (array_key_exists($hostid, $hostTriggers)) {
                             // echo $hostTriggers[$hostid][0]->lastchange;
                            $tempo_fora = time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));
                            $data_alerta = date('Y-m-d H:i:s' ,$hostTriggers[$hostid][0]->lastchange);
                            $count = "0";

                            foreach ($hostTriggers[$hostid] as $event) {
                                    $id = $event->triggerid;
                                    $detalhe = macros($event->comments);
                                if ($count++ <= 2 ) {
                                    $priority = $event->priority;
                                    $description = $event->description;
                                    // Remove hostname or host.name in description
                                    $search = array('{HOSTNAME}', '{HOST.NAME}');
                                    $description = str_replace($search, "", $description);
                                    // View
                                    // echo "<div class=\"description nok" . $priority ."\" title=\"" . $description . "\">" . $description . "</div>";
                                    $duration = $data_alerta;
                                    // $priority ="down";
                                } else {
                                    break;
                                }
                            }
                            $save_db = array(
                                'id' => $id,
                                'servidor' => $hostname,
                                'host_id' => $hostid,
                                'designacao' => $hostdesignacao,
                                'ip' => $hostip,
                                'servico' => $description,
                                'detalhe' => $detalhe,
                                'prioridade' => $priority,
                                'data_alerta' => $duration,
                                'data_ultima_verificacao' => date('Y-m-d H'),
                                'situacao' => 'PROBLEMA',
                                'vendor' => $hostvendor,
                                'duration' => $tempo_fora
                            );//salva os link fora na tabela zbx_link_fora.
                            $this->zabbix_model->duplicate_zabbix_grc($save_db);
                            print_r($save_db);
                            array_push($alert,$id);
                            //consulta na tabela ebt_grc
                            $grc = $this->zabbix_model->list_grc_link($hostdesignacao);
                            // print_r($grc);
                            foreach ($grc as $linha_grc) {
                                $designacao_update = array(
                                    'ticket'         => $linha_grc['ticket'],
                                    'posicionamento' => $linha_grc['posicionamento']
                                );// atualiza a tabela zbx_link_fora com o numero do ticket e o ultimo posicionamento do GRC
                                $this->zabbix_model->update_zabbix_grc($designacao_update,$hostdesignacao);
                            }

                        } else {
                            $duration = "00:00:00";
                            $priority = "up";
                        }
                    }
                }
            }


                // deleta todos que não estão alertando
                $this->zabbix_model->delete_zabbix_grc($alert);

                //consultar todos os alertas da tabela mnt_alertas no banco portal
                $alertas = $this->link_model->select_link_fora();
                // vd($alertas);
                foreach($alertas as $alerta){
                  //consultar todos os alertas da tabela bug_tb no banco mantis
                  $projetos = $this->mantis_model->mantis_projetos_producao();
                  // vd($projetos);
                  foreach ($projetos as $projeto) {
                    if("Problema de Link: ".$alerta['ticket']." - ".$alerta['servidor']."" == $projeto['RESUMO']){

                    // if("servidor {$alerta['servidor']} - servico {$alerta['servico']}" == $projeto['RESUMO']) {
                      echo "Problema de Link: ".$alerta['ticket']." - ".$alerta['servidor']." RESUMO:".$projeto['RESUMO']."<br>";
                        //update tabela com numeo mantis
                        $this->link_model->update_link_fora(array('id'=> $alerta['id']),array('mantis' => $projeto['NUMERO_CHAMADO']));
                    }else{
                      // echo "ERRADO: Problema de Link: ".$alerta['ticket']." - ".$alerta['servidor']." RESUMO:".$projeto['RESUMO']."<br>";
                    }
                  }
                }


        } else{
            echo "SCRIPT DESABILITADO NO BANCO DE DADOS";
        }
    }
}

/* End of file link_indisponivel.php */
/* Location: ./application/controllers/script/link_indisponivel.php */