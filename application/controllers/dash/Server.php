<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/zabbix/ZabbixApiAbstract.class.php';
        include APPPATH . 'third_party/zabbix/ZabbixApi.class.php';
        include APPPATH . 'third_party/zabbix/date_function.php';
        $this->load->model('zabbix_model');
        $this->load->model('mantis_model');
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
          'groupids' => array(8,11,14,21,31)
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

              if($hoststatus == 0){
                  if (array_key_exists($hostid, $hostTriggers)) {
                      $tempo_fora=time2string(time()-strtotime(date('Y-m-d H:i:s', $hostTriggers[$hostid][0]->lastchange)));
                      $data_alerta = date('Y-m-d H:i:s' ,$hostTriggers[$hostid][0]->lastchange);
                      $detalhe = $hostTriggers[$hostid][0]->comments;
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
                              $save_db = array(
                                'id' => $id,
                                'host_id' => $hostid,
                                'servidor' => $hostname,
                                'servico' => $description,
                                'detalhe' => $detalhe,
                                'data_alerta' => $duration,
                                'data_ultima_verificacao' => date('Y-m-d H'),
                                'ip' => $hostip,
                                'mantis' => '0',
                                'duration' => $tempo_fora
                              );
                              array_push($alert,$id);
                              //salvar os servidores fora no banco zbx_server_fora
                              $this->zabbix_model->duplicate_zabbix_server($save_db);
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
          //deleta todos que não estão alertando
          $this->zabbix_model->delete_zabbix_server($alert);
          //consultar novamente a tabela do banco zbx_server_fora
          $servers_fora = $this->zabbix_model->list_zabbix_server();

          // vd($servers_fora);
          //percorrer o array da consulta
          foreach ($servers_fora as $server) {
              $hostid   = $server['host_id'];
              $ip       = $server['ip'];
              $duration = $server['duration'];
              $servico   = $server['servico'];
              $servidor = $server['servidor'];
              if($server['mantis'] == 0){ //verificar se já possui mantis
                  $flag = 'class="danger"';
                  $mantis = ' <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar/server/'.$hostid.'" title="Criar Mantis">
                                  <i class="fa fa-plus"></i>
                              </a>';
              } else { //se não possui mantis
                  $status = $this->mantis_model->mantis($server['mantis']);
                  $array_color = array(50 => "primary", 10 => "danger", 20 => "retorno", 40 => "autorizado", 30 => "impedido", 80 => "warning", 90 => "");
                  //10-novo-vermelho  20-retorno-vermelho escuro  30-impedido-roxo  40-autorizado-amarelo  50-atribuido-azul  80-realizado-laranja
                  $flag = '';
                  $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$server['mantis'].'" class = "label label-'. $array_color[$status->STATUS].'" target="_blank">'.$server['mantis'].'</a>';
              }
              //criar um novo array para exibir no dashboard
              $result = array(
                'hostid'   => $hostid,
                'ip'       => $ip,
                'duration' => $duration,
                'servico'   => $servico,
                'servidor' => $servidor,
                'flag'     => $flag,
                'mantis'   => $mantis
              );
              //inserir todos os alertas no mesmo array
              array_push($retorno,$result);
            }
          //passar para tabela server via json.
          echo json_encode($retorno);

    }

}

/* End of file Server.php */
/* Location: ./application/controllers/dash/Server.php */