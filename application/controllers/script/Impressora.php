<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impressora extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        include APPPATH . 'third_party/snmp-printer/library/Kohut/SNMP/Printer.php';
        $this->load->model('impressora_model');
    }

    public function index() {
        // $ip = '10.3.0.15';
        // $ip = '10.3.8.17';
        $lista = $this->impressora_model->select_printer();
        // vd($lista->result_array());
        foreach ($lista->result_array() as $value) {
            if($this->pinga($value['ip'],'80') == true){
                try{
                    // $printer = new Kohut_SNMP_Printer($ip);
                    $printer = new Kohut_SNMP_Printer($value['ip']);
                    $update_db = array();
                    $insert_db = array();

                        if ($printer->isColorPrinter()){
                            $color = 'color printer';
                            $toner = 'Cyan Toner:'.round($printer->getCyanTonerLevel(), 2).'% '.
                                     'Magenta Toner:'.round($printer->getMagentaTonerLevel(), 2).'% '.
                                     'Yellow Toner:'.round($printer->getYellowTonerLevel(), 2).'%';
                            $drum_level = 'Fotocondutor ciano: '.$printer->getDrumLevel().'% '.
                                          'Fotocondutor magenta: '.$printer->getDrumLevel().'% '.
                                          'Fotocondutor amarelo: '.$printer->getDrumLevel().'% '.
                                          'Fotocondutor preto: '.$printer->getDrumLevel().'% '.
                                          'Kit de manutenção de 160K: '.$printer->getDrumLevel().' '.
                                          'Kit de manutenção de 320K: '.$printer->getDrumLevel().' '.
                                          'Kit de manutenção de 480K: '.$printer->getDrumLevel();
                        } elseif ($printer->isMonoPrinter()){
                            $color = 'mono printer';
                            $toner = 'Blanck Toner:'. round($printer->getBlackTonerLevel(), 2).'%';
                            $drum_level = 'kit fc:'.$printer->getDrumLevel().'% '.
                                          'kit manutenção:'.$printer->getDrumLevel().'%';
                        }

                    $save_array = array (
                        'location' => $printer->getlocation(),
                        'date' => date("Y-m-d H:i:s"),
                        'type' => $color,//mono ou color
                        'factory' => $printer->getFactoryId(),// lexmark x860 x466 x646
                        'vendor' => $printer->getVendorName(),
                        'serial_number' => $printer->getSerialNumber(),
                        'toner' => $toner,
                        'drum_level' => $drum_level,
                        'count_page' => $printer->getNumberOfPrintedPapers(),
                        'id_impressora' => $value['id_impressora']
                    );
                    $update_array = array(
                        'location' => $printer->getlocation(),
                        'serial_number' => $printer->getSerialNumber(),
                        'model' => $printer->getFactoryId(),
                        'type' => $color,
                    );
                    array_push($insert_db,$save_array);
                    array_push($update_db,$update_array);
                    echo "<br>";
                    echo $value['ip']." Online";
                    echo "<br>";
                    // echo $value['ip'];
                    // echo "<br>";
                    // echo "########Coleta de dados printer OK###########";
                    $this->impressora_model->insert_printer($save_array);
                    // echo "<br>";
                    // echo "#########Atualização cadastro printer OK##########";
                    // echo "<br>";
                    // pr($update_array);
                    $this->impressora_model->update_printer(array('serial_number' => $printer->getSerialNumber()),$update_array);
                } catch(Kohut_SNMP_Exception $e) {
                    echo 'SNMP Error: ' . $e->getMessage();
                }

            } else{
                echo "<br>";
                echo $value['ip']." Offline";
                echo "<br>";
            }
        }
        // pr($insert_db);
        // pr($update_db);

    }


    public function pinga($IP,$PORTA) {
        $IPAddress = $IP;
        $Port = $PORTA;
        $fp=@fsockopen ($IPAddress,$Port, $errno, $errstr,(float)0.5);
        if(!$fp) {
            // return print("<font color='#FF3333'><b>Offline</b></font>");
            return false;
        } else {
            // return print("<font color='#336600'><b>Online</b></font>");
            return true;
            fclose($fp);
        }
    }

}

/* End of file Impressora.php */
/* Location: ./application/controllers/script/Impressora.php */