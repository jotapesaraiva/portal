<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consulta extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
    }

    public function index() {

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
                // 'output'             => array('hostid','name','status', 'description'),
                'output'          => 'extend',
                'sortfield'          => 'name',
                'selectGroups'    => 'extend',
                // 'selectInterfaces'   => array('ip'),
                // 'selectInventory'    => array('location_lat','location_lon','vendor'),
                // 'selectInventory' => 'extend',
                // 'groupids'           => array(16)//16- novo zabbix(link Acesso) //19,18 - antigo zabbix(link terrestre,link satelite)
        ));

        // pr($hosts);

            foreach ($hosts as $host) {
                $host_id[] = $host->hostid;
            }

            $triggers = $api->triggerGet(array(
                       // 'output'                      => 'extend',
                       'output' => array(
                            'triggerid',
                            'priority',
                            'description'),
                       // 'selectGroups'    => 'extend',
                       'selectHosts'    => 'extend',
                       // 'selectHosts'                 => array('hosts'=> array('host')),
                       // 'hostids'                     => $host_id,
                       'expandComment'               => 1,
                       'expandDescription'           => 1,
                       // 'expandExpression'            => 1,
                       // 'only_true'                   => 1,
                       // 'monitored'                   => 1,
                       // 'withLastEventUnacknowledged' => 1,
                       'sortfield'                   => array('priority'),
                       'sortorder'                   => 'DESC',
                       'filter'                      => array(
                                          // 'priority' => array('5'), //tudo desastre
                                          'value'    => '1')
               ));

            pr($triggers);
    }

}

/* End of file Consulta.php */
/* Location: ./application/controllers/script/Consulta.php */