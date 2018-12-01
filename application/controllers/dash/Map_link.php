<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map_link extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->load->model('zabbix_model');
    }

    public function index() {

      // $this->output->cache(1);

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
        $result ="";
        $retorno = array();
        try {
              // connect to Zabbix Json API
            $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
            // Set Defaults
            $api->setDefaultParams(array('output' => 'extend',));

            // $groupids = array(19,18);

            $groups = $api->hostgroupGet(array(
                   'output' => array('name'),
                   'selectHosts' => array(
                           'flags',
                           'hostid',
                           'name',
                           'maintenance_status'),
                   'real_hosts ' => 1,
                   'groupids' => array(19,18),
            #       'with_monitored_triggers' => 1,
                   'sortfield' => 'name'
                ));

            foreach($groups as $group) {
               $groupIds[] = $group->groupid;
            }

            $triggers = $api->triggerGet(array(
                   'output' => array(
                       'priority',
                       'description'),
                   'selectHosts' => array('hostid'),
                       'groupids' => $groupIds,
                       'expandDescription' => 1,
                       'only_true' => 1,
                       'monitored' => 1,
                       'withLastEventUnacknowledged' => 1,
                       // 'sortfield' => 'priority',
                       'sortfield' => array('lastchange', 'priority'),
                       'sortorder' => 'DESC',
                       'filter' => array('priority' => array('5'),'value' => '1' , '')
               ));

            foreach($triggers as $trigger) {
               foreach($trigger->hosts as $host) {
                   $hostTriggers[$host->hostid][] = $trigger;
               }
            }
            // verifica se o array não foi criado. caso não tenha seta a variavel vazio.
            if(!isset($hostTriggers)){
                $hostTriggers = "";
            }
            // echo '[';
            foreach($groups as $group) {
                $groupname = $group->name; //nome dos grupos.
                $hosts = $group->hosts;
                //ordena o array do menor para o maior ou em ordem alfabetica.
                usort($hosts, function ($a, $b) {
                    if ($a->name == $b) return 0;
                    return ($a->name < $b->name ? -1 : 1);
                });

                if ($hosts) {
                    // print all host IDs
                    foreach($hosts as $host) {
                        // $result += count($host);
                        // // echo $result;
                        // if($result == 1 ){
                        //   echo ' ';
                        // } else {
                        //   echo ',';
                        // }
                        // Check if host is not disabled, we don't want them! -- exibi só os ativos
                        if ($host->flags == "0") {

                            $hostid = $host->hostid;
                            $hostname = $host->name;
                            $maintenance = $host->maintenance_status; // item que verifica se o host está em manutenção.

                            $hosts_interface = $api->hostinterfaceGet(array(
                              'output'=> 'extend',
                              'filter' => array('hostid' => $hostid)
                            ));

                            $ip = $hosts_interface[0]->ip;

                            $hosts_invetory = $api->hostGet(array(
                              'output' => 'extend',
                              'filter' => array('hostid' => $hostid),
                              'sortfield' => 'name',
                              'selectInventory' => array('location_lat','location_lon')
                            ));
                            // echo '{"id": "'.$hostid.'",';
                            // echo '"nome": "'.$hostname.'",';
                            // echo '"ip": "'.$ip.'",';

                            foreach ($hosts_invetory as $hosti) {
                              if($hosti->inventory != NULL){
                                  // echo '"latitude": "'.$latitude = $hosti->inventory->location_lat.'",';
                                  // echo '"longitude": "'.$longitude = $hosti->inventory->location_lon.'",';
                                $latitude = $hosti->inventory->location_lat;
                                $longitude = $hosti->inventory->location_lon;
                              } else {
                                  // echo '"latitude": "0.861958",';
                                  // echo '"longitude": "-52.452953",';
                                  $latitude = "";
                                  $longitude = "";
                              }
                            }
                            // if($hostTriggers != NULL){
                              if ( array_key_exists($hostid, $hostTriggers)) {
                                // Highest Priority error
                                $hostboxprio = $hostTriggers[$hostid][0]->priority;
                                // $age=time_elapsed_string(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange), true);
                                $tempo_fora=time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));

                                // echo '"duration": "'.$tempo_fora.'",';
                                $count = "0";
                                foreach ($hostTriggers[$hostid] as $event) {
                                    if ($count++ <= 2 ) {
                                        // $priority = $event->priority;
                                        // echo '"type": "down"}';
                                        $priority = "down";
                                    } else {
                                        break;
                                    }
                                }
                              } else {
                                // echo '"duration": "00:00:00",';
                                // echo '"type": "up"}';
                                $tempo_fora = "00:00:00";
                                $priority = "up";
                              } // fim o if $host->flags -- verifica se o link está ativo
                        // }
                        }
                        $result = array(
                          'id' => $hostid,
                          'name' => $hostname,
                          'ip' => $ip,
                          'latitude' => $latitude,
                          'longitude' => $longitude,
                          'duration' => $tempo_fora,
                          'type' => $priority
                        );
                        array_push($retorno,$result);
                    }//fim do foreach $hosts
                } //fim do if $host -- verifica se ele existe
                // echo ']';
            }// fim do foreach $groups

        } catch(Exception $e) {
            //Exception in ZabbixApi catched
            echo $e->getMessage();
        }
                echo json_encode($retorno);

    }

}

/* End of file Map_link.php */
/* Location: ./application/controllers/dash/Map_link.php */