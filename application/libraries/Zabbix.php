<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Zabbix {

    public function __construct() {
        $this->ci =& get_instance();
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->ci->load->model('zabbix_model');
        //Load config file
        $this->ci->load->config('zabbix', TRUE);
        // Get breadcrumbs display options
        $api_url = $this->ci->config->item('api_url', 'zabbix');
        $api_user = $this->ci->config->item('api_user', 'zabbix');
        $api_pass = $this->ci->config->item('api_pass', 'zabbix');
        $reload_time = $this->ci->config->item('reload_time', 'zabbix');
        $host_group_filter = $this->ci->config->item('host_group_filter', 'zabbix');
    }

    public function init($grupos,$visao) {
        $result ="";
        $hosts = array();
        $triggers = array();
        $retorno = array();
        // connect to Zabbix Json API
        $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
        $group = $grupos;
        $view = $visao

        $hosts = $api->hostGet(array(
            'output'=> array('hostid','name','status'),
            'sortfield' => 'name',
            // 'selectGroups'=> 'extend',
            'selectInterfaces' => array('ip'),
            'selectInventory' => array('location_lat','location_lon'),
            'groupids' => $group
        ));

          foreach ($hosts as $host) {
              $host_id[] = $host->hostid;
          }

          $triggers = $api->triggerGet(array(
                 'output' => array(
                     'priority',
                     'description',
                     'comments'),
                 'selectHosts' => array('hostid'),
                     'hostids' => $host_id,
                     'expandDescription' => 1,
                     'only_true' => 1,
                     'monitored' => 1,
                     'withLastEventUnacknowledged' => 1,
                  'sortfield' => array('lastchange', 'priority'),
                     'sortorder' => 'DESC',
                  'filter' => array(
                     'priority' => array('4','5'),
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
              $hostip = $host->interfaces[0]->ip;
              if($host->inventory != NULL){
                  $hostlat = $host->inventory->location_lat;
                  $hostlon = $host->inventory->location_lon;
              } else{
                  $hostlat = "";
                  $hostlon = "";
              }

              if($hoststatus == 0){
                  if (array_key_exists($hostid, $hostTriggers)) {
                      $tempo_fora=time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));
                      $detalhe = $hostTriggers[$hostid][0]->comments;
                      $count = "0";
                      foreach ($hostTriggers[$hostid] as $event) {
                          if ($count++ <= 2 ) {
                              $priority = $event->priority;
                              $description = $event->description;
                              // Remove hostname or host.name in description
                              $search = array('{HOSTNAME}', '{HOST.NAME}');
                              $description = str_replace($search, "", $description);
                              // View
                              // echo "<div class=\"description nok" . $priority ."\" title=\"" . $description . "\">" . $description . "</div>";
                              $duration = $tempo_fora;
                              $priority ="down";

                          } else {
                              break;
                          }
                      }
                      // echo "<pre>";
                      // echo $hostid."\n";
                      // echo $hostname."\n";
                      // echo $hostip."\n";
                      // // echo $hostlat."\n";
                      // // echo $hostlon."\n";
                      // echo $detalhe."\n";
                      // echo $duration."\n";
                      // echo $priority."\n";
                      // echo $description."\n";
                      // echo "</pre>";
                    if($view=='simple'){
                          $result = array(
                            'id' => $hostid,
                            'name' => $hostname,
                            'ip' => $hostip,
                            'latitude' => $hostlat,
                            'longitude' => $hostlon,
                            'detalhe' =>$detalhe,
                            'duration' => $duration,
                            'type' => $priority,
                            'description' => $description
                          );
                          array_push($retorno,$result);
                    }
                  } else {
                      $description ="";
                      $duration = "00:00:00";
                      $priority = "up";
                  }
                  if($view=='full'){
                        $result = array(
                          'id' => $hostid,
                          'name' => $hostname,
                          'ip' => $hostip,
                          'latitude' => $hostlat,
                          'longitude' => $hostlon,
                          'detalhe' =>$detalhe,
                          'duration' => $duration,
                          'type' => $priority,
                          'description' => $description
                        );
                        array_push($retorno,$result);
                  }
              }
          }
          return json_encode($retorno);

    }
}

/* End of file Zabbix.php */
/* Location: ./application/libraries/Zabbix.php */