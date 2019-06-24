<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index()
    {
        $report_status = shell_exec("/opt/omni/bin/./omnirpt -report session_flow -timeframe 24 24 -html 2>&1 &");
        $report_tratado = implode("\n", array_slice(explode("\n", $report_status), 14));
        echo $report_tratado;
    }

    public function teste()
    {
        $scpt_dataprotector_monitor = shell_exec('/opt/omni/bin/./omnistat -detail');

        if ($scpt_dataprotector_monitor == "No currently running sessions."){
        echo "sabe de nada inocente";
        }

        else {
        echo "tem algo rodando";
        /*echo $scpt_dataprotector_monitor;
        $teste1 = substr($scpt_dataprotector_monitor, 12);*/
        }
    }

    public function tabela()
    {
    $session_id = '2019/06/21-4';
$html= "";
        $descbkp = shell_exec("/opt/omni/bin/./omnirpt -tab -report session_objects -session ".$session_id." 2>&1 &");
        $linhasdescbkp = explode("\n", $descbkp);
            $tamanho = sizeof($linhasdescbkp);
            for ($i = 7;  $i < $tamanho - 1; $i++) {
                $html .= "<tr>\n";
                $camposdescbkp = explode("\t", $linhasdescbkp[$i]);
                $tamanhointerno = sizeof($camposdescbkp);
                for ($j = 0;  $j < $tamanhointerno; $j++) {
                    if(($j == 7)||($j == 9)){
                        //N�o faz nada
                    } else {
                        $html .= "<td>".$camposdescbkp[$j]."</td>\n";
                    }
                }
                $html .= "</tr>\n";
            }
            echo $html;
    }

}

/* End of file Backup.php */
/* Location: ./application/controllers/script/Backup.php */