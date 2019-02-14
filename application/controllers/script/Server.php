<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        //this controller can only be called from the command line
        // if(!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        $this->load->model('modulos_model');
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->load->model('zabbix_model');
        $this->load->model('mantis_model');
        $this->load->model('server_model');
        $this->load->helper('macros_helper');
    }

    public function index() {

        $modulo = $this->modulos_model->site_modulo('monitora');
        // vd($modulo[0]['status']);

        if($modulo[0]['status'] == 1) {

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
            $alert = array();
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
              'groupids' => array(20,18,2,15,17,19) //20,18,2,15,17 - novo zabbix (servidores windows,linux,descentralizados,email,weblogic)
              //8,11,14,21,31 - antigo zabbix(servers windows, regionais, linux)
            ));

              foreach ($hosts as $host) {
                  $host_id[] = $host->hostid;
              }
              // vd($host_id);
              $alertas = $api->triggerGet(array(
                'output' => 'extend',
                // 'selectHosts' => 'extend'
              ));
              // vd($alertas);
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
          if($triggers==NULL){
                $alert = '0';
            }else{
              foreach($triggers as $trigger) {
                 foreach($trigger->hosts as $host) {
                     $hostTriggers[$host->hostid][] = $trigger;
                 }
              }
              // vd($hostTriggers);
              // vd($hosts);
              foreach ($hosts as $host) {
                  $hostid = $host->hostid;
                  $hostname = $host->name;
                  $hoststatus = $host->status;
                  $hostip = $host->interfaces[0]->ip;

                  if($hoststatus == 0){
                    // var_dump(array_key_exists($hostid, $hostTriggers));
                      if (array_key_exists($hostid, $hostTriggers)) {
                        // vd($hostTriggers[$hostid][0]->lastchange);
                          $tempo_fora=time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));
                          $data_alerta = date('Y-m-d H:i:s' ,$hostTriggers[$hostid][0]->lastchange);
                          $detalhe = macros($hostTriggers[$hostid][0]->comments);
                          $count = "0";
                          foreach ($hostTriggers[$hostid] as $event) {
                                  $id = $event->triggerid;
                              if ($count++ <= 5 ) {
                                  $priority = $event->priority;
                                  $description = $event->description;
                                  // Remove hostname or host.name in description
                                  $search = array('{HOSTNAME}', '{HOST.NAME}');
                                  $description = str_replace($search, "", $description);
                                  // View
                                  // echo "<div class=\"description nok" . $priority ."\" title=\"" . $description . "\">" . $description . "</div>";
                                  $duration = $data_alerta;
                                  $priority ="down";
                              } else {
                                  break;
                              }
                                $save_db = array(
                                  'id' => $id,
                                  'host_id' => $hostid,
                                  'servidor' => $hostname,
                                  'servico' => $description,
                                  'detalhe' => $detalhe,
                                  'data_alerta' => $duration,
                                  'data_ultima_verificacao' => date('Y-m-d H'),
                                  'ip' => $hostip,
                                  'duration' => $tempo_fora
                                );
                                print_r($save_db);
                                array_push($alert,$id);
                                //salvar os servidores fora no banco zbx_server_fora
                                $this->zabbix_model->duplicate_zabbix_server($save_db);
                          }
                      } else {
                          $description ="";
                          $duration = "00:00:00";
                          $priority = "up";
                      }
                  }
              }
}
              //consultar todos os alertas da tabela mnt_alertas no banco portal
              $alertas = $this->server_model->select_server_fora();
              // vd($alertas);
              foreach($alertas as $alerta){
                //consultar todos os alertas da tabela bug_tb no banco mantis
                $projetos = $this->mantis_model->mantis_projetos();
                // vd($projetos);
                foreach ($projetos as $projeto) {
                  if("servidor ".$alerta['servidor']." - servico ".$alerta['servico']."" == $projeto['RESUMO']){
                  // if("servidor {$alerta['servidor']} - servico {$alerta['servico']}" == $projeto['RESUMO']) {
                    echo "servidor ".$alerta['servidor']." - servico ".$alerta['servico']." RESUMO:".$projeto['RESUMO']."<br>";
                      //update tabela com numeo mantis
                      $this->server_model->update_server_fora(array('id'=> $alerta['id']),array('mantis' => $projeto['NUMERO_CHAMADO']));
                  } else {
                    // echo "ERRADO: servidor ".$alerta['servidor']." - servico ".$alerta['servico']." RESUMO:".$projeto['RESUMO']."<br>";
                  }
                }
              }
              // vd($alert);
              //deleta todos que não estão alertando
              $this->zabbix_model->delete_zabbix_server($alert);
          } else {
              echo "SCRIPT DESABILITADO NO BANCO DE DADOS";
          }
      }


      public function teste() {
        $unixtime = '0';
        // $unixtime = '1548355975';
        echo time2string(time()-strtotime(date('Y-m-d H:i:s', $unixtime)));

        // echo macros($string);
      }

}

/* End of file Server.php */
/* Location: ./application/controllers/script/Server.php */