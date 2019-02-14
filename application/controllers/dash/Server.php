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
        $this->load->helper('color_mantis');
    }

    public function index() {
        $result ="";
        $alert = array();
        $retorno = array();
          //consultar novamente a tabela do banco zbx_server_fora
          $servers_fora = $this->zabbix_model->list_zabbix_server();
          // vd($servers_fora);
          if($servers_fora == null){
            $result = array(
              'hostid'   => '.',
              'ip'       => '.',
              'duration' => '.',
              'servico'   => 'Nenhum alerta no momento',
              'servidor' => ':)',
              'flag'     => '.',
              'mantis'   => '.'
            );
            array_push($retorno,$result);
            // vd($retorno);
          }else{
          // vd($servers_fora);
          //percorrer o array da consulta
          foreach ($servers_fora as $server) {
              $hostid   = $server['id'];
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
                  $flag = '';
                  $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$server['mantis'].'" class = "label label-'.color_mantis($status->STATUS).'" target="_blank">'.$server['mantis'].'</a>';
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
          }
          echo json_encode($retorno);
    }

}

/* End of file Server.php */
/* Location: ./application/controllers/dash/Server.php */