<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_indisponivel extends CI_Controller {


    public function __construct() {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->load->model('zabbix_model');
        $this->load->model('backups_model');
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
        $result = "";
        $alert = array();
        $retorno = array();
        // connect to Zabbix Json API
        $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
        // Set Defaults

        // $this->zabbix_model->delete_zabbix_grc();

        $hosts = $api->hostGet(array(
            'output'=> array('hostid','name','status', 'description'),
            // 'output'=> 'extend',
            'sortfield' => 'name',
                // 'selectGroups'=> 'extend',
            'selectInterfaces' => array('ip'),
            'selectInventory' => array('location_lat','location_lon','vendor'),
            // 'selectInventory' => 'extend',
            'groupids' => array(19,18)
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
                        $tempo_fora = time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));
                        $data_alerta = date('Y-m-d H:i:s' ,$hostTriggers[$hostid][0]->lastchange);
                        $count = "0";

                        foreach ($hostTriggers[$hostid] as $event) {
                                $id = $event->triggerid;
                                $detalhe = $event->comments;
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
                        );
                        $this->zabbix_model->duplicate_zabbix_grc($save_db);

                        array_push($alert,$id);

                        $grc = $this->zabbix_model->list_grc_link($hostdesignacao);

                        foreach ($grc as $linha_grc) {
                            $ticket = $linha_grc['ticket'];
                            $posicionamento = $linha_grc['posicionamento'];
                            $designacao_update = array(
                                'ticket'         => $ticket,
                                'posicionamento' => $posicionamento
                            );
                            $this->zabbix_model->update_zabbix_grc($designacao_update,$hostdesignacao);
                        }

                    } else {
                        $duration = "00:00:00";
                        $priority = "up";
                    }
                }
            }

            $this->zabbix_model->delete_zabbix_grc($alert);
                    //
                    // echo "<pre>";
                    // echo $hostid."\n";
                    // echo $hostname."\n";
                    // echo $hostip."\n";
                    // echo $hostlat."\n";
                    // echo $hostlon."\n";
                    // echo $duration."\n";
                    // echo $priority."\n";
                    // echo $description."\n";
                    // echo $hostvendor."\n";
                    // echo "</pre>";
            $links_fora = $this->zabbix_model->select_zabbix_grc();

            foreach ($links_fora as $link) {
              $ticket   = $link['ticket'];
              $hostid   = $link['host_id'];
              $ip       = $link['ip'];
              $duration = $link['duration'];
              $vendor   = $link['vendor'];
              $servidor = $link['servidor'];
              if($link['mantis'] == 0){
                  $flag = 'class="danger"';
                  $mantis = '
                          <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar" title="Criar Mantis">
                              <i class="fa fa-plus"></i>
                          </a>';
              } else {
                  $status = $this->backups_model->mantis($link['mantis']);
                  $array_color = array(50 => "primary", 10 => " danger", 20 => "retorno", 40 => "autorizado", 30 => "impedido", 80 => "warning", 90 => "");
                  //10-novo-vermelho  20-retorno-vermelho escuro  30-impedido-roxo  40-autorizado-amarelo  50-atribuido-azul  80-realizado-laranja
                  $flag = '';
                  $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$link['mantis'].'" class = "label label-'. $array_color[$status->STATUS].'" target="_blank">'.$link['mantis'].'</a>';
              }
              $result = array(
                'ticket'   => $ticket,
                'hostid'   => $hostid,
                'ip'       => $ip,
                'duration' => $duration,
                'vendor'   => $vendor,
                'servidor' => $servidor,
                'flag'     => $flag,
                'mantis'   => $mantis
              );
              array_push($retorno,$result);
            }
            // echo json_encode($links_fora->result_array());
            echo json_encode($retorno);
    }

}

/* End of file Link_indisponivel.php */
/* Location: ./application/controllers/dash/Link_indisponivel.php */