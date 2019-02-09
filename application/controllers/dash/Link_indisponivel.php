<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Link_indisponivel extends CI_Controller {


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
            $result = "";
            $alert = array();
            $retorno = array();
            $links_fora = $this->zabbix_model->select_zabbix_grc();

            if($links_fora == null){
                $result = array(
                    'ticket'   => '.',
                    'hostid'   => '.',
                    'ip'       => '.',
                    'duration' => '.',
                    'vendor'   => ':)',
                    'servidor' => 'Nenhum alerta no momento',
                    'flag'     => '.',
                    'mantis'   => '.'
                );
                array_push($retorno,$result);
            } else {

            }

            //percorrer o array da consulta
            foreach ($links_fora as $link) {
                $ticket   = $link['ticket'];
                $hostid   = $link['host_id'];
                $ip       = $link['ip'];
                $duration = $link['duration'];
                $vendor   = $link['vendor'];
                $servidor = $link['servidor'];
                if($link['mantis'] == 0){ //verificar se já possui mantis
                    $flag = 'class="danger"';
                    $mantis = '
                            <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar/link/'.$hostid.'" title="Criar Mantis">
                                <i class="fa fa-plus"></i>
                            </a>';
                } else { //se não possui mantis
                    $status = $this->mantis_model->mantis($link['mantis']);
                    $flag = '';
                    $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$link['mantis'].'" class = "label label-'.color_mantis($status->STATUS).'" target="_blank">'.$link['mantis'].'</a>';
                }
                //criar um novo array para exibir no dashboard
                $result = array(
                  'ticket'   => $ticket,
                  'hostid'   => $hostid,
                  'ip'       => $ip,
                  'duration' => $duration,
                  'vendor'   => $vendor,
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

/* End of file Link_indisponivel.php */
/* Location: ./application/controllers/dash/Link_indisponivel.php */