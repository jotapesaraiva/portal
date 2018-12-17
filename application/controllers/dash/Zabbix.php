<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zabbix extends CI_Controller {

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
        // $context = base_url() . 'assets';
        $result ="";
        $retorno = array();
        // connect to Zabbix Json API
        $api = new ZabbixApi($api_url, $api_user, base64_decode($api_pass));
        // Set Defaults

        $hosts = $api->hostGet(array(
              'output'=> array('hostid','name','status'),
          // 'output'=> 'extend',
          'sortfield' => 'name',
              // 'selectGroups'=> 'extend',
          'selectInterfaces' => array('ip'),
          // 'selectInventory' => array('location_lat','location_lon'),
          'groupids' => array(35)
        ));
        // echo vd($hosts);
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
           // vd($triggers);
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
              // vd($hosts);
              if($hoststatus == 0) {
                  if (array_key_exists($hostid, $hostTriggers)) {
                      $detalhe = $hostTriggers[$hostid][0]->comments;
                      $count = "0";
                      foreach ($hostTriggers[$hostid] as $event) {
                          if ($count++ <= 5 ) {
                              $tempo_fora=time2string(time()-strtotime(date('Y-m-d H:i:s', $event->lastchange)));
                              $priority = $event->priority;
                              $description = $event->description;
                              // Remove hostname or host.name in description
                              $search = array('{HOSTNAME}', '{HOST.NAME}');
                              $description = str_replace($search, "", $description);
                              // View
                              // echo "<div class=\"description nok" . $priority ."\" title=\"" . $description . "\">" . $description . "</div>";
                              $duration = $tempo_fora;
                              $priority ="down";
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
                              $result = array(
                                'id' => $hostid,
                                'name' => $hostname,
                                'ip' => $hostip,
                                // 'latitude' => $hostlat,
                                // 'longitude' => $hostlon,
                                'detalhe' =>$detalhe,
                                'duration' => $duration,
                                'type' => $priority,
                                'description' => $description
                              );
                              array_push($retorno,$result);
                          } else {
                              break;
                          }
                      }

                  } else {
                      $description ="";
                      $duration = "00:00:00";
                      $priority = "up";
                  }

              }
          }
          echo json_encode($retorno);

    }

}

/* End of file Monitora.php */
/* Location: ./application/controllers/dash/Monitora.php */