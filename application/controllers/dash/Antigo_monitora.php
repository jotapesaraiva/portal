<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigo_monitora extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('backups_model');
    }

    public function index() {
        $result ="";
        $retorno = array();
        $monitoras = $this->backups_model->monitora();
        // vd($monitoras);
        foreach ($monitoras as $monitora) {
            $descricao = $monitora['DESC_ALERTA'];
            $origem = $monitora['ORIGEM'];
            $metrica = $monitora['METRICA_ATUAL'];
            $plano = $monitora['PLANO_ACAO'];
            $tipo = $monitora['TIPO_ALERTA'];
            $responsavel = $monitora['RESPONSAVEL'];
            $acionamento = $monitora['ACIONAMENTO'];
            $interromper = $monitora['INTERROMPER'];
            $servico = $monitora['DESC_SERVICO'];
            $adicional = $monitora['INFO_ADICIONAL'];

            $result = array(
              'data_completa' => date("Y-m-d H:i:s"),
              'descricao' => $descricao,
              'origem' => $origem,
              'metrica' => $metrica,
              'plano' => $plano,
              'tipo' => $tipo,
              'responsavel' => $responsavel,
              'acionamento' => $acionamento,
              'interromper' => $interromper,
              'servico' => $servico,
              'adicional' => $adicional,
              'mantis' => "0"
            );

            // $consulta = $this->backups_model->alerta_repetido($descricao,$origem);

            // if($consulta[0]['quantidade'] == 0){
            //   $inserir = array(
            //     'data_inicio' => date("Y-m-d H:i:s"),
            //     'data_fim' => "0",
            //     'descricao' => $descricao,
            //     'origem' => $origem,
            //     'metrica' => $metrica,
            //     'plano' => $plano,
            //     'tipo' => $tipo,
            //     'responsavel' => $responsavel,
            //     'acionamento' => $acionamento,
            //     'interromper' => $interromper,
            //     'servico' => $servico,
            //     'adicional' => $adicional,
            //     'email' => "0",
            //     'mantis' => "0"
            //   );
            //   $this->backups_model->inserir_alerta($inserir);
            // } else {
            //   $update = array(
            //     'data_fim' => date("Y-m-d H:i:s"),
            //     'alerta' => $metrica,
            //     'responsavel' => $responsavel,
            //     'detalhe' => $plano
            //   )
            //   $this->backups_model->update_alerta($consulta[0]['id'],$update);
            // }

            array_push($retorno,$result);
        }
        echo json_encode($retorno);
    }

    public function teste() {
      $consulta = $this->backups_model->alerta_repetido('Falha na Carga SPED para o DW.','SYBASE');
      // $consulta = $this->backups_model->alerta_repetido('Parcelamento com pagamentos não processados/apropriados','PARCELAMENTO ou COTA UNICA');
      // vd($consulta);
    echo $consulta[0]['id'];
    }


// 478210
// 478209

}

/* End of file Antigo_monitora.php */
/* Location: ./application/controllers/dash/Antigo_monitora.php */