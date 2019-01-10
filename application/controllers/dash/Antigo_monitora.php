<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigo_monitora extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('mantis_model');
    }

    public function index() {
        $result ="";
        $retorno = array();
        $monitoras = $this->mantis_model->monitora();
        // vd($monitoras);
        // foreach ($monitoras as $monitora) {
        //     $desc_alerta    = $monitora['DESC_ALERTA'];
        //     $origem         = $monitora['ORIGEM'];
        //     $metrica_atual  = $monitora['METRICA_ATUAL'];
        //     $plano_acao     = $monitora['PLANO_ACAO'];
        //     $tipo_alerta    = $monitora['TIPO_ALERTA'];
        //     $responsavel    = $monitora['RESPONSAVEL'];
        //     $acionamento    = $monitora['ACIONAMENTO'];
        //     $interromper    = $monitora['INTERROMPER'];
        //     $desc_servico   = $monitora['DESC_SERVICO'];
        //     $info_adicional = $monitora['INFO_ADICIONAL'];

        //     $result = array(
        //       'data_inicio'    => date("Y-m-d H:i:s"),//OK
        //       'data_fim'       => date("Y-m-d H:i:s"),//OK
        //       'desc_alerta'    => $desc_alerta,//OK servico
        //       'origem'         => $origem,//OK servidor
        //       'metrica_atual'  => $metrica_atual,//OK alerta
        //       'plano_acao'     => $plano_acao,//OK detalhe
        //       'tipo_alerta'    => $tipo_alerta,//OK tipo
        //       'responsavel'    => $responsavel,//OK
        //       'acionamento'    => $acionamento,//OK
        //       'interromper'    => $interromper,//OK
        //       'desc_servico'   => $desc_servico, //alerta
        //       'info_adicional' => $info_adicional,//OK
        //       'email_enviados' => "0",//OK
        //       'mantis'         => "0"//OK
        //     );
        //     $consulta = $this->mantis_model->alerta_repetido($desc_alerta,$origem);

        //     if($consulta[0]['quantidade'] == 0){
        //       $this->mantis_model->insert_mnt_alerta($result);
        //     } else {
        //       $update = array(
        //         'data_fim' => date("Y-m-d H:i:s"),
        //         'metrica_atual' => $metrica_atual,
        //         'info_adicional' => $info_adicional
        //       );
        //       $this->mantis_model->update_mnt_alerta(array('id' => $consulta[0]['id']),$update);
        //     }
        // }

          $alertas = $this->mantis_model->select_mnt_alerta();
          // vd($alertas);
          foreach ($alertas as $alerta) {
            $id = $alerta['id'];
            $descricao = $alerta['desc_alerta'];
            $origem = $alerta['origem'];
            $metrica = $alerta['desc_servico'];
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
                $status = $this->backups_model->mantis($alerta['mantis']);
                $array_color = array(50 => "primary", 10 => "danger", 20 => "retorno", 40 => "autorizado", 30 => "impedido", 80 => "warning", 90 => "");
                //10-novo-vermelho  20-retorno-vermelho escuro  30-impedido-roxo  40-autorizado-amarelo  50-atribuido-azul  80-realizado-laranja
                $flag = '';
                $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$alerta['mantis'].'" class = "label label-'. $array_color[$status->STATUS].'" target="_blank">'.$alerta['mantis'].'</a>';
            }
            //criar um novo array para exibir no dashboard
            $dash = array(
              'id'   => $id,
              'descricao' => $descricao,
              'origem' => $origem,
              'metrica'   => $metrica,
              'data_completa' => '',
              'flag'     => $flag,
              'mantis'   => $mantis
            );
            // inserir todos os alertas no mesmo array
            array_push($retorno,$dash);
          }
        echo json_encode($retorno);
    }

    public function teste() {
      $consulta = $this->mantis_model->alerta_repetido('Falha na Carga SPED para o DW.','SYBASE');
      // $consulta = $this->mantis_model->alerta_repetido('Parcelamento com pagamentos não processados/apropriados','PARCELAMENTO ou COTA UNICA');
      vd($consulta);
    // echo $consulta[0]['id'];
    }

}

/* End of file Antigo_monitora.php */
/* Location: ./application/controllers/dash/Antigo_monitora.php */