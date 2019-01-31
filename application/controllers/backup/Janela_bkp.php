<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dhtmlx\Connector\SchedulerConnector;
use Dhtmlx\Connector\OptionsConnector;

class Janela_bkp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
    }

    public function index() {
        $script['footerinc'] = '';
        $script['script'] = '';
        $css['headerinc'] = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Janela de Backup</span>', '/backup/janela_bkp');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/janela_bkp');

        $this->load->view('template/footer',$script);
    }

    public function data() {
        // Mysql
        $teste = $this->load->database('portalmoni',TRUE);

        $list = new OptionsConnector($teste, "PHPCI");
            /* //Teste para saber esta conectando.
        if($list){
            echo "Conexão Estabelecida!";
        }
        else{
            echo "Erro ao Conectar: " . $erro['message'];
        }
        */
        //$list->render_table("types","typeid","typeid(value),name(label)");
        $list->render_table("SELECT DISTINCT specification value,
                              specification label
                  FROM tbl_dp_backups
                  WHERE specification NOT LIKE '%TESTE%'
                  AND specification <> 'Interactive'
                  AND specification NOT LIKE '%OLD%'
                  AND specification NOT LIKE '%EXTRA%'
                  AND specification NOT LIKE '%DD'
                  AND specification NOT LIKE 'FRONT_%'
                  AND specification <> 'DEFAULT'
                  AND specification NOT LIKE '%\_0'
                  AND specification NOT LIKE '%\_1'
                  AND day_time between (NOW() - interval 1 month) and NOW()","specification","specification(value),specification(label)");

        $scheduler = new SchedulerConnector($teste, "PHPCI");
            /* //Teste para saber esta conectando.
        if($scheduler){
            echo "Conexão Estabelecida!";
        }
        else{
            echo "Erro ao Conectar: " . $erro['message'];
        }
        */
        $scheduler->set_options("backup_list", $list);
        //$scheduler->render_table("tevents","event_id","start_date,end_date,event_name,type");
        $scheduler->render_table("SELECT                       id,
                                            specification AS text,
                          TIMESTAMP(day_time, start_time) AS start_date,
     TIMESTAMP(TIMESTAMP(day_time, start_time),`duration`) AS end_date,
                                                 duration AS duracao,
                                                    media AS media,
                                               gb_written AS tamanho,
                                                             status,
                                                             mode,
                                                             queuing,
                                                             files,
                                                             session_id,
                                                   'true' AS readonly
                 FROM tbl_dp_backups
                WHERE specification NOT LIKE '%TESTE%'
                  AND specification NOT LIKE '%OLD%'
                  AND specification NOT LIKE '%EXTRA%'
                  AND specification NOT LIKE '%DD'
                  AND specification <> 'Interactive'
                  AND specification <> 'DEFAULT'
                  AND specification <> 'FRONT_ITINGA_02'
                  AND specification <> 'FRONT_ITINGA_01'
                  AND specification NOT LIKE '%\_0'
                  AND specification NOT LIKE '%\_1'
                  AND day_time between (NOW() - interval 1 year) and NOW()","id","start_date,end_date,text,duracao,media,tamanho,status,mode,queuing,files,session_id,readonly");


        // $scheduler->render();
    }

    public function teste() {
        $teste = $this->load->database('teste', true);

        $scheduler = new SchedulerConnector($teste, "PHPCI");
        $scheduler->configure("scheduler_events", "event_id", "start_date, end_date, event_name");
        $scheduler->render();
    }

    public function janela() {
        // echo "teste";
        $this->load->view("backup/dhtmlx");
    }

}

/* End of file Janela_bkp.php */
/* Location: ./application/controllers/backup/Janela_bkp.php */