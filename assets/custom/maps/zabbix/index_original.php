<?php
//load ZabbixApi
	require_once 'lib/ZabbixApi.class.php';
	use ZabbixApi\ZabbixApi;

	try {
		// connect to Zabbix API
		$api = new ZabbixApi('https://x-oc-zabbix.sefa.pa.ipa/zabbix/api_jsonrpc.php', 'zbx3', '!!Z@bb1xx');

		/* . . .  do your stuff here . . . */
		// get all graphs named "CPU"
		$cpuGraphs = $api->graphGet(array(
					'output' => 'extend',
					'search' => array('name' => 'CPU')
					   ));
		//print graph ID with graph name
		foreach($cpuGraphs as $graph)
			printf("id:%d name:%s\n", $graph->graphid, $graph-name);

	} catch(Exception $e) {
		//Exception in ZabbixApi catched
		echo $e->getMessage();
	}
?>


