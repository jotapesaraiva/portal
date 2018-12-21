<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backups_falhos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('backups_model');
    }

    public function index() {
        $result ="";
        $retorno = array();
        $falhos = $this->backups_model->falhos();

        foreach ($falhos as $falho) {
            if($falho['mantis'] == 0) {
                $status_mantis = 0;
                $flag = 'class="danger"';
                $mantis = '
                        <a class="btn blue btn-outline sbold" href="'.base_url().'alertas/enviar/backup/'.$falho['id'].'" title="Criar Mantis">
                            <i class="fa fa-plus"></i>
                        </a>';
            } else {
                $flag = '';
                $row = $this->backups_model->mantis($falho['mantis']);
                $status_mantis = $row->STATUS;
                $array_color = array(50 => "primary", 10 => " danger", 20 => "retorno", 40 => "autorizado", 30 => "impedido", 80 => "warning", 90 => "");
                // $mantis = $falho['mantis'];
                $mantis = '<a href="http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$falho['mantis'].'" class = "label label-'. $array_color[$status_mantis].'" target="_blank">'.$falho['mantis'].'</a>';
            }

            if($status_mantis != '80' AND $status_mantis != '90') {
                $data   = $falho['session_id'];
                $inicio = $falho['start_time'];
                $status = $falho['status'];
                $backup = $falho['specification'];

                // echo "<pre>";
                // echo $data ." ";
                // echo $inicio." ";
                // echo $status." ";
                // echo $backup." ";
                // echo $mantis." ";
                // echo $status_mantis;
                // echo "</pre>";
                $result = array(
                  'data' => $data,
                  'inicio' => $inicio,
                  'status' => $status,
                  'backup' => $backup,
                  'flag'   => $flag,
                  'mantis' => $mantis
                );
                array_push($retorno,$result);
            }

        }
        // echo vd ($falhos);
        echo json_encode($retorno);
    }


    public function teste() {
        $mantis = $this->backups_model->abertura();
        vd($mantis);
        // $mantis = $this->backups_model->mantis();
        // vd($mantis);
        // echo $mantis->status;
    }

}

/* End of file backups_falhos.php */
/* Location: ./application/controllers/dash/backups_falhos.php */