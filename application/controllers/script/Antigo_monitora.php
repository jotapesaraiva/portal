<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antigo_monitora extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //this controller can only be called from the command line
        // if(!$this->input->is_cli_request()) show_error('Direct access is not allowed');
        $this->load->model('modulos_model');
        $this->load->model('monitora_model');
        $this->load->model('mantis_model');

        // is_cli() OR show_404(); // If cronjob !
        //Do your magic here
    }

    public function index() {

        $modulo = $this->modulos_model->site_modulo('monitora');
        // vd($modulo[0]['status']);

        if($modulo[0]['status'] == 1) {
            $result ="";
            $retorno = array();
            $monitoras = $this->monitora_model->monitora();
            // vd($monitoras);
            foreach ($monitoras as $monitora) {
                $desc_alerta    = $monitora['DESC_ALERTA'];
                $origem         = $monitora['ORIGEM'];
                $metrica_atual  = $monitora['METRICA_ATUAL'];
                $plano_acao     = $monitora['PLANO_ACAO'];
                $tipo_alerta    = $monitora['TIPO_ALERTA'];
                $responsavel    = $monitora['RESPONSAVEL'];
                $acionamento    = $monitora['ACIONAMENTO'];
                $interromper    = $monitora['INTERROMPER'];
                $desc_servico   = $monitora['DESC_SERVICO'];
                $info_adicional = $monitora['INFO_ADICIONAL'];

                $result = array(
                  'data_inicio'    => date("Y-m-d H:i:s"),//OK
                  'data_fim'       => date("Y-m-d H:i:s"),//OK
                  'desc_alerta'    => $desc_alerta,//OK servico
                  'origem'         => $origem,//OK servidor
                  'metrica_atual'  => $metrica_atual,//OK alerta
                  'plano_acao'     => $plano_acao,//OK detalhe
                  'tipo_alerta'    => $tipo_alerta,//OK tipo
                  'responsavel'    => $responsavel,//OK
                  'acionamento'    => $acionamento,//OK
                  'interromper'    => $interromper,//OK
                  'desc_servico'   => $desc_servico, //alerta
                  'info_adicional' => $info_adicional,//OK
                  'email_enviados' => "0",//OK
                  'mantis'         => "0"//OK
                );
                echo $desc_alerta."<br>";
                echo $origem."<br>";

                $consulta = $this->monitora_model->alerta_repetido($monitora['DESC_ALERTA'],$monitora['ORIGEM']);
                // echo $consulta[0]['quantidade'];
                if($consulta[0]['quantidade'] == 0){
                  $this->monitora_model->insert_mnt_alerta($result);
                  echo "Insert <br>";
                  echo "  ";
                //   pr($result);
                } else {
                  //consultar todos os alertas da tabela mnt_alertas no banco portal
                  $alertas = $this->monitora_model->select_mnt_alerta();
                  // vd($alertas);
                  foreach($alertas as $alerta){
                    //consultar todos os alertas da tabela bug_tb no banco mantis
                    $projetos = $this->mantis_model->mantis_projetos();
                    // vd($projetos);
                    foreach ($projetos as $projeto) {
                      if("servidor {$alerta['origem']} - servico {$alerta['desc_alerta']}" == $projeto['RESUMO']){
                      // if($projeto['resumo'] == $alertas['desc_alerta']){
                          //update tabela com numeo mantis
                          $this->monitora_model->update_mnt_alerta(array('id'=> $alerta['id']),array('mantis' => $projeto['NUMERO_CHAMADO']));
                      }
                    }
                  }

                  $where = array(
                    'desc_alerta'    => $desc_alerta,
                    'data_fim' => date("Y-m-d H:i:s"),
                    'metrica_atual' => $metrica_atual,
                    'info_adicional' => $info_adicional
                  );
                  $this->monitora_model->update_mnt_alerta(array('id' => $consulta[0]['id']),$where);
                  echo "Update <br>";
                  echo "  ";
                //   pr($result);
                }
                // inserir todos os alertas no mesmo array
                // array_push($retorno,$result);
            }
            // echo json_encode($retorno);
        } else {
            echo "SCRIPT DESABILITADO NO BANCO DE DADOS";
        }
    }
}
/* End of file Antigo_monitora.php */
/* Location: ./application/controllers/script/Antigo_monitora.php */