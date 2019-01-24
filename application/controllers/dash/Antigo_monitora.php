<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigo_monitora extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('mantis_model');
        $this->load->model('monitora_model');
        include APPPATH . 'third_party/zabbix/date_function.php';
    }

    public function index() {
        $result ="";
        $retorno = array();
        $alertas = $this->monitora_model->select_mnt_alerta();
        // vd($alertas);
        foreach ($alertas as $alerta) {
            $id = $alerta['id'];
            $descricao = $alerta['desc_alerta'];
            $origem = $alerta['origem'];
            $metrica = $alerta['metrica_atual'];
            $data_inicio = strtotime($alerta['data_inicio']);
            $data_fim = strtotime($alerta['data_fim']);
            // vd($alerta['mantis']);
            // $mantis = $alerta['mantis'];
            if($alerta['mantis'] == 0) { //verificar se já possui mantis
                $flag = 'class="danger"';
                $mantis = ' <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar/monitora/'.$id.'" title="Criar Mantis">
                                <i class="fa fa-plus"></i>
                            </a>';
            } else { //se não possui mantis
                $status = $this->mantis_model->mantis($alerta['mantis']);
                $array_color = array(50 => "primary", 10 => "danger", 20 => "retorno", 40 => "autorizado", 30 => "impedido", 80 => "warning", 90 => "", 60 => "");
                //10-novo-vermelho  20-retorno-vermelho escuro  30-impedido-roxo  40-autorizado-amarelo  50-atribuido-azul  80-realizado-laranja
                $flag = '';
                $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id=
                '.$alerta['mantis'].'" class = "label label-'.$array_color[$status->STATUS].'" target="_blank">
                '.$alerta['mantis'].'</a>';
            }
            //criar um novo array para exibir no dashboard
            $dash = array(
              'id'   => $id,
              'descricao' => $descricao,
              'origem' => $origem,
              'metrica'   => $metrica,
              'data_completa' => time2string(time()-strtotime(date('Y-m-d H:i:s', $data_inicio))),
              'flag'     => $flag,
              'mantis'   => $mantis
            );
            // inserir todos os alertas no mesmo array
            array_push($retorno,$dash);
        }
        echo json_encode($retorno);
    }
}

/* End of file Antigo_monitora.php */
/* Location: ./application/controllers/dash/Antigo_monitora.php */