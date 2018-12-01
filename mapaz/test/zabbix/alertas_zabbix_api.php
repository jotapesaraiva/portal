<?php

	require 'lib/php/ZabbixApiAbstract.class.php';
	require 'lib/php/ZabbixApi.class.php';
	require 'date_function.php';

		$result ="";
		$retorno = array();
		// try {
		// connect to Zabbix Json API
		    $api = new ZabbixApi('https://x-oc-zabbix.sefa.pa.ipa/zabbix/api_jsonrpc.php', 'zbx3', '!!Z@bb1xx');
		// Set Defaults
		//     $api->setDefaultParams(array('output' => 'extend',));

		    $hosts = $api->hostGet(array(
              'output'=> array('hostid','name','status'),
		      // 'output'=> 'extend',
		      'sortfield' => 'name',
              // 'selectGroups'=> 'extend',
		      'selectInterfaces' => array('ip'),
		      'selectInventory' => array('location_lat','location_lon'),
		      'groupids' => array(19,18)
		    ));

            foreach ($hosts as $host) {
                $host_id[] = $host->hostid;
            }

            $triggers = $api->triggerGet(array(
                   'output' => array(
                       'priority',
                       'description'),
                   'selectHosts' => array('hostid'),
                       // 'groupids' => $groupIds,
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
                        $count = "0";
                        foreach ($hostTriggers[$hostid] as $event) {
                            if ($count++ <= 2 ) {
                                // $priority = $event->priority;
                                // $description = $event->description;
                                $duration = $tempo_fora;
                                $priority ="down";

                            } else {
                                break;
                            }
                        }
                    } else {
                        $duration = "00:00:00";
                        $priority = "up";
                    }
                    $result = array(
                      'id' => $hostid,
                      'name' => $hostname,
                      'ip' => $hostip,
                      'latitude' => $hostlat,
                      'longitude' => $hostlon,
                      'duration' => $duration,
                      'type' => $priority
                    );
                    array_push($retorno,$result);
      //       echo "<pre>";
      //       echo $hostid."\n";
      //       echo $hostname."\n";
      //       echo $hostip."\n";
      //       echo $hostlat."\n";
      //       echo $hostlon."\n";
      //       echo $duration."\n";
      //       echo $priority."\n";
		    // echo "</pre>";
                }
            }
            echo json_encode($retorno);

?>
