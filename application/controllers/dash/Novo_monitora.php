<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novo_monitora extends CI_Controller {

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
          $monitora = $this->zabbix_model->list_zabbix_monitora();
          // vd($monitora);
          if($monitora == null){
            $result = array(
              'trigger_id'    => '.',
              'resumo'    => '.',
              'aplicacao' => '.',
              'duration'  => '.',
              'servico'   => 'Nenhum alerta no momento',
              'metrica'   => ':)',
              'flag'      => '.',
              'mantis'    => '.'
            );
            array_push($retorno,$result);
            // vd($retorno);
          } else {
          // vd($monitora);
          //percorrer o array da consulta
          foreach ($monitora as $monitora) {
              $hostid    = $monitora['id'];
              $resumo    = $monitora['servico'];
              $aplicacao = anchor('http://zabbix.sefa.pa.gov.br/zabbix/search.php?search='.$monitora['host_id'].'', $monitora['application_name']);
              $metrica   = $monitora['item_value'];
              $duration  = $monitora['duration'];
              if($monitora['mantis'] == 0){ //verificar se já possui mantis
                  $flag   = 'class="danger"';
                  $mantis = ' <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar/server/'.$hostid.'" title="Criar Mantis">
                                  <i class="fa fa-plus"></i>
                              </a>';
              } else { //se não possui mantis
                  $status = $this->mantis_model->mantis($monitora['mantis']);
                  $flag   = '';
                  $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$monitora['mantis'].'" class = "label label-'.color_mantis($status->STATUS).'" target="_blank">'.$monitora['mantis'].'</a>';
              }
              //criar um novo array para exibir no dashboard
              $result = array(
                'trigger_id'    => $hostid,
                'resumo'    => $resumo,
                'aplicacao' => $aplicacao,
                'metrica'   => $metrica,
                'duration'  => $duration,
                'flag'      => $flag,
                'mantis'    => $mantis
              );
              //inserir todos os alertas no mesmo array
              array_push($retorno,$result);
            }
          //passar para tabela monitora via json.
          }
          echo json_encode($retorno);
    }

}

/* End of file Novo_monitora.php */
/* Location: ./application/controllers/dash/Novo_monitora.php */