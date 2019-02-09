<?php
//load ZabbixApi
	require_once 'lib/ZabbixApi.class.php';
	use ZabbixApi\ZabbixApi;
	try {
		// connect to Zabbix API
		 $api = new ZabbixApi('https://x-oc-zabbix.sefa.pa.ipa/zabbix/api_jsonrpc.php', 'zbx3', '!!Z@bb1xx');
#                $api = new ZabbixApi('https://10.3.1.189/zabbix/api_jsonrpc.php', 'zbx3', '!!Z@bb1xx');

		/* . . .  do your stuff here . . . */
		// get all graphs named "CPU"
		$cpuGraphs = $api->hostGet(array( // metodo host.get -> hostGet, history.get -> historyGet
					'output' => array('hostid', 'host'),//parametros do metodo
					'selectInterfaces' => array('interfaceid', 'ip'),
					'limit' => 50
					   ));
		//print graph ID with graph name
		foreach($cpuGraphs as $graph)
			printf("hostid:%d host:%s\n", $graph->hostid, $graph->host);

	} catch(Exception $e) {
		//Exception in ZabbixApi catched
		echo $e->getMessage();
	}

/* phpzabbixapi

https://github.com/confirm/PhpZabbixApi
user way building it yourself
*/
?>
