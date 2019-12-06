<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nobreak extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
    }

    public function index() {
        $car = '';
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
        $api = new ZabbixApi($api_url, $api_user, $api_pass);
        // Set Defaults

        $hosts = $api->hostGet(array(
              'output'=> array('hostid','name','status'),
          // 'output'=> 'extend',
          'sortfield' => 'name',
              // 'selectGroups'=> 'extend',
          'selectInterfaces' => array('ip'),
          // 'selectInventory' => array('location_lat','location_lon'),
          'groupids' => array(21)//21- novo zabbix(nobreak)//34 - antigo zabbix(Power UPS)
        ));
        // vd($hosts);
          foreach ($hosts as $host) {
              // $host_id[] = $host->hostid;
            $hostid = $host->hostid;
            $itens =  $api->itemGet(array(
                'output' => 'extend',
                'hostids' => $hostid,
                'search' => array( 'name' => 'Temperatura')
            ));
            $umidades =  $api->itemGet(array(
                'output' => 'extend',
                'hostids' => $hostid,
                'search' => array('name' => 'umidade')
            ));
            $cargas =  $api->itemGet(array(
                'output' => 'extend',
                'hostids' => $hostid,
                'search' => array('name' => 'Carga Atual (%)')
            ));
             $hostname = $host->name;
             $hoststatus = $host->status;
              foreach ($itens as $item) {
                 $temperatura = $item->prevvalue;
                 if($temperatura > 25.00) {
                    $flag = "red";
                 } else {
                    $flag ="green";
                 }
              }
              foreach ($umidades as $umidade) {
                 $umi = $umidade->prevvalue;
              }
              foreach ($cargas as $carga) {
                 $car = $carga->prevvalue;
              }
                  $result = array(
                    'id'          => $hostid,
                    'name'        => $hostname,
                    'status'      => $hoststatus,
                    'temperatura' => trim($temperatura,0),
                    'umidade'     => trim($umi,0),
                    'carga'       => trim($car,0)."%",
                    'flag'        => $flag
                  );
                  //inserir todos os alertas no mesmo array
                  array_push($retorno,$result);
          }
          //passar para tabela server via json.
          echo json_encode($retorno);
    }

}

/* End of file Nobreak.php */
/* Location: ./application/controllers/dash/Nobreak.php */