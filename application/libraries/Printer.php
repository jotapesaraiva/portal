<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer
{
    protected $CI;

    public function __construct()
    {
        $CI =& get_instance();
        include APPPATH . 'third_party/snmp-printer/library/Kohut/SNMP/Printer.php';
        $CI->load->model('impressora_model');
    }

    public function coletar($ip) {

        if($this->pinga($ip,'80')) {
            try {
                $snmp = new Kohut_SNMP_Printer($ip);
                $update_db = array();
                $insert_db = array();
                $id_impressora = $CI->impressora_model->select_id($snmp->getSerialNumber());

                    if ($snmp->isColorPrinter()) {
                        $color = 'Color printer';
                        $toner = 'Cyan Toner:'.round($snmp->getCyanTonerLevel(), 2).'% '.
                                 'Magenta Toner:'.round($snmp->getMagentaTonerLevel(), 2).'% '.
                                 'Yellow Toner:'.round($snmp->getYellowTonerLevel(), 2).'%';
                        $drum_level = 'Fotocondutor ciano: '.$snmp->getDrumLevel().'% '.
                                      'Fotocondutor magenta: '.$snmp->getDrumLevel().'% '.
                                      'Fotocondutor amarelo: '.$snmp->getDrumLevel().'% '.
                                      'Fotocondutor preto: '.$snmp->getDrumLevel().'% '.
                                      'Kit de manutenção de 160K: '.$snmp->getDrumLevel().' '.
                                      'Kit de manutenção de 320K: '.$snmp->getDrumLevel().' '.
                                      'Kit de manutenção de 480K: '.$snmp->getDrumLevel();
                        $count_page = 'Color:'.$snmp->getNumberOfPrintedPapersColor().' '.
                                      'Mono: '.$snmp->getNumberOfPrintedPapers();
                    } elseif ($snmp->isMonoPrinter()) {
                        $color = 'Mono printer';
                        $toner = 'Toner Level:'. round($snmp->getBlackTonerLevel(), 2).'%';
                        $drum_level = 'kit fc:'.$snmp->getDrumLevel().'% '.
                                      'kit manutenção:'.$snmp->getDrumLevel().'%';
                        $count_page = $snmp->getNumberOfPrintedPapers();
                    }

                $save_array = array (
                    'location' => $snmp->getlocation(),
                    'date' => date("Y-m-d H:i:s"),
                    'type' => $color,//mono ou color
                    'factory' => $snmp->getFactoryId(),// lexmark x860 x466 x646
                    'vendor' => $snmp->getVendorName(),
                    'serial_number' => $snmp->getSerialNumber(),
                    'toner' => $toner,
                    'drum_level' => $drum_level,
                    'count_page' => $count_page,
                    'id_impressora' => $value['id_impressora']
                );
                $update_array = array (
                    'location' => $snmp->getlocation(),
                    'serial_number' => $snmp->getSerialNumber(),
                    'model' => $snmp->getFactoryId(),
                    'type' => $color,
                );
                array_push($insert_db,$save_array);
                array_push($update_db,$update_array);
                echo "<br>";
                echo $ip." <font color='#336600'><b>Online</b></font>\n";
                echo "<br>";
    // echo "########Coleta de dados printer OK###########";
                $CI->impressora_model->insert_printer($save_array);
    // echo "#########Atualização cadastro printer OK##########";
                $CI->impressora_model->update_printer(array('serial_number' => $snmp->getSerialNumber()),$update_array);
            } catch(Kohut_SNMP_Exception $e) {
                echo 'SNMP Error: ' . $e->getMessage();
            }

        } else {
            echo "<br>";
            echo $ip." <font color='#FF3333'><b>Offline</b></font>\n";
            echo "<br>";
        }
        echo "Script finalizado.";
    }

    public function pinga($IPAddress,$Port) {

        $fp=@fsockopen($IPAddress,$Port, $errno, $errstr,2);
        if(!$fp) {
            echo $errstr;
            // return print("<font color='#FF3333'><b>Offline</b></font>".$errstr);
            return false;
        } else {
            @fclose($fp);
            // return print("<font color='#336600'><b>Online</b></font>");
            return true;
        }
    }


}

/* End of file Printer.php */
/* Location: ./application/libraries/Printer.php */