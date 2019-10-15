<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novo_monitora extends CI_Controller {

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
  }

  public function index() {

    $modulo = $this->modulos_model->site_modulo('monitora');

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
          'output'=> array('hostid','name','status'),// 'output'=> 'extend',
          'sortfield' => 'name',
          // 'selectGroups'=> 'extend',
          'selectInterfaces' => array('ip'),
          // 'selectInventory' => array('location_lat','location_lon'),
          'groupids' => array(26) //20,18,2,15,17 - novo zabbix (Serviços Externos)
      ));

      foreach ($hosts as $host) {
          $host_id[] = $host->hostid;
      //       $hostid = $host->hostid;
      }

      $triggers = $api->triggerGet(array(
          'output' => 'extend',
                 'output'                      => array('priority', 'description','comments'),
                 'selectHosts'                 => array('hostid'),
                 'hostids'                     => $host_id,
                 // 'itemids'   => '30943',
                 'expandComment'               => 1, //expande as macros no comentario
                 'expandDescription'           => 1, //expande as macros no descrição
                 'expandExpression'            => 1, //expande as macros no expressão
                 'only_true'                   => 1, // exibi somente trigger que tiverem com status de problema.
                 'monitored'                   => 1, //exibi somente trigger ativados que pertencem a hosts monitorados e contêm apenas itens ativados.
                 'skipDependent'               => 1, // não exibir se o alerta tiver regra de dependencia.
                 'active'                      => 1, // exibi somente trigger ativados que pertencem aos hosts monitorados.
                 'withLastEventUnacknowledged' => 1,
                 'sortfield'                   => array('lastchange', 'priority'),
                 'sortorder'                   => 'DESC',
                 'filter'                      => array(
                                    'priority' => array('4','5'),//desastre -5, alta -4
                                    'value'    => '1')
         ));
          // vd($triggers);
        if($triggers==NULL){
            $alert = '0';
        } else {
          foreach($triggers as $trigger) {
            foreach($trigger->hosts as $host) {
                 $hostTriggers[$host->hostid][] = $trigger;
            }
          }
          foreach ($hosts as $host) {
            $hostid = $host->hostid;
            $hoststatus = $host->status;

            if($hoststatus == 0) {
              // var_dump(array_key_exists($hostid, $hostTriggers));
              if (array_key_exists($hostid, $hostTriggers)) {
              // vd($hostTriggers[$hostid][0]->lastchange);
              //
                $itens =  $api->itemGet(array(
                    'output' => array('itemid','name','prevvalue','description'),//'output' => 'extend',
                    'hostids' => $hostid
                    // 'search' => array( 'name' => 'Temperatura' )
                ));
                foreach ($itens as $item) {
                  $item_id = $item->itemid;
                  $item_name = $item->name;
                  $item_value = $item->prevvalue;
                  $applications = $api->applicationGet(array(
                         'output' => array('name'), // 'output'=> 'extend',
                         'itemids' => $item_id,
                         'sortfield' => 'name'
                  ));
                  foreach ($applications as $application) {
                      $application_name = $application->name;
                  }
                  $item_description = $item->description;
                }
                $count = "0";
                foreach ($hostTriggers[$hostid] as $event) {
                  $tempo_fora=time_elapsed_string(date('Y-m-d H:i:s', $event->lastchange),true);
                  $data_alerta = date('Y-m-d H:i:s' ,$event->lastchange);
                  $detalhe = $event->comments;
                  $id = $event->triggerid;
                  if ($count++ <= 10 ) {
                    $priority = $event->priority;
                    $description = $event->description;
                    // Remove hostname or host.name in description
                    $search = array('{HOSTNAME}', '{HOST.NAME}');
                    $description = str_replace($search, "", $description);
                    // View
                    // echo "<div class=\"description nok" . $priority ."\" title=\"" . $description . "\">" . $description . "</div>";
                    $duration = $data_alerta;
                    // $priority ="down";
                  } else {
                    break;
                  }
                  $save_db = array(
                    'id' => $id,//OK
                    'host_id' => $hostid,//OK
                    'servico' => $description,//OK
                    'detalhe' => $detalhe,//
                    'data_alerta' => $duration,
                    'data_ultima_verificacao' => date('Y-m-d H'),
                    'duration' => $tempo_fora,
                    'priority' => $priority,//OK
                    'item_name' => $item_name,
                    'item_value' => $item_value,
                    'application_name' => $application_name,
                    'item_description' => $item_description,
                    'alert' => 1
                  );
                  print_r($save_db);
                  array_push($alert,$id);
                  //salvar os servidores fora no banco zbx_server_fora
                  $this->zabbix_model->duplicate_zabbix_monitora($save_db);
                }
              } else {
                $description ="";
                $duration = "00:00:00";
                $priority = "up";
              }
            }
          }
        }
        //deleta todos que não estão alertando
        // vd($alert);
        $this->zabbix_model->update_zabbix_monitora($alert);
        //consultar todos os alertas da tabela mnt_alertas no banco portal
        $alertas = $this->zabbix_model->select_monitora();
        // vd($alertas);
        foreach($alertas as $alerta) {
          //consultar todos os alertas da tabela bug_tb no banco mantis
          $projetos = $this->mantis_model->mantis_projetos();
          // vd($projetos);
          foreach ($projetos as $projeto) {
            // echo "<br>ZABBIX:".$alerta['servico']." MANTIS:".$projeto['RESUMO']."<br>";
            switch (trim($projeto['RESUMO'])) {
                case $alerta['servico']:
                    echo "<br>ZABBIX => ".$alerta['servico']." MANTIS => ".$projeto['RESUMO']."<br>";
                    $this->zabbix_model->update_monitora(array('id'=> $alerta['id']),array('mantis' => $projeto['NUMERO_CHAMADO']));
                    break;
                case 'Alerta: '.$alerta['servico']:
                    echo "<br>ZABBIX => ".$alerta['servico']." MANTIS => ".$projeto['RESUMO']."<br>";
                    $this->zabbix_model->update_monitora(array('id'=> $alerta['id']),array('mantis' => $projeto['NUMERO_CHAMADO']));
                    break;
                default:
                    // echo "ERRADO ZABBIX => ".$alerta['servico']." MANTIS:".$projeto['RESUMO']."<br>";
                    break;
            }
          }
        }

      } else {
          echo "SCRIPT DESABILITADO NO BANCO DE DADOS";
      }
  }

  public function alertando()
  {
      $alertas = $this->zabbix_model->select_monitora();
      vd($alertas);
  }

}

/* End of file Novo_monitora.php */
/* Location: ./application/controllers/script/Novo_monitora.php */