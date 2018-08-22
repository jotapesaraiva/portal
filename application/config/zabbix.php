<?php
defined('BASEPATH') OR exit('No direct script access allowed');

# API Info
$config['api_url'] = 'https://x-oc-zabbix.sefa.pa.ipa/zabbix/api_jsonrpc.php';
// $api_url = 'https://x-oc-zabbix.sefa.pa.ipa/zabbix/api_jsonrpc.php';
$config['api_user'] = 'zbx3';
// $api_user = 'joao.saraiva';
$config['api_pass'] = 'ISFaQGJiMXh4';
// $api_pass = 'MDVhZG1pbjE4';
# Time in milliseconds.  1000 = 1 second
$config['reload_time'] = 30000;
# path on web server
$config['context'] = '/zabbix-dash2';
# Host Group filter in Regex
// $host_group_filter = '/^Dash\//';
$config['host_group_filter'] = '/./';

/* End of file zabbix.php */
/* Location: ./application/config/zabbix.php */