<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embratel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('zabbix_model');
        $this->load->model('modulos_model');
    }

    public function index() {
        $modulo = $this->modulos_model->site_modulo('monitora');

        if($modulo[0]['status'] == 1) {
            $data = date('d-m-Y.H:i:s');
            shell_exec("wget -o /opt/script/embratel/tickets/logdownload_php.txt 'http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_situacao72h.php?csv_output=1&pt_output=off&pt_id_tabela_csv=tickets&vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=' -O /opt/script/embratel/tickets/exports/export_php".$data.".csv");
            shell_exec("chmod 777 /opt/script/embratel/tickets/exports/export_php".$data.".csv");
            // sleep(10);//delay de 5 segundos
            shell_exec("cat /opt/script/embratel/tickets/exports/export_php".$data.".csv | sed '1d' > /opt/script/embratel/tickets/exports/temp.csv");
            $file = fopen("/opt/script/embratel/tickets/exports/temp.csv", "r");
            // $insert = array();
            while (($info = fgetcsv($file, 10000, ',', '"')) !== FALSE) {
                $info = array_map("utf8_encode", $info); //added
                $csv = array(
                    'data_atual' => date("Y-m-d H:i:s",strtotime($data)),
                    'ticket' => $info['0'],
                    'rec' => $info['1'],
                    'tempo_operadora' => $info['2'],
                    'tempo_cliente' => $info['3'],
                    'duracao_total' => $info['4'],
                    'sla' => $info['5'],
                    'contregressivo' => $info['6'],
                    'equipamento' => $info['7'],
                    'designacao' => $info['8'],
                    'abertura' => date("Y-m-d H:i:s",strtotime($info['9'])),
                    'atualizacao' => date("Y-m-d H:i:s",strtotime($info['10'])),
                    'rede' => $info['11'],
                    'status' => $info['12'],
                    'local' => $info['13'],
                    'uf' => $info['14'],
                    'centro' => $info['15'],
                    'sintoma' => $info['16'],
                    'causa' => $info['17'],
                    'responsabilidade' => $info['18'],
                    'posicionamento' => $info['19'],
                    'proativo' => $info['20'],
                    'protocolo' => $info['21'],
                    'operadora' => $info['22']
                );
                // array_push($insert, $csv);
                //verifica se o ticket existe
                $ticket_existe = $this->zabbix_model->select_ebt_grc($info['0']);
                if($ticket_existe == 0 ){//se não existe inserir
                    $this->zabbix_model->insert_ebt_grc($csv);
                    echo "Insert".$info['7']."<br>";
                } else {//se existe update
                    $this->zabbix_model->update_ebt_grc(array('ticket' => $info['0']),$csv);
                    echo "Update".$info['7']."<br>";
                }
                // $num = count ($info);
                // $line = "";
                // echo "<pre>";
                    // for ($c=0; $c < $num; $c++) {
                    //     // output data
                    //    // echo "$info[$c]";
                    // $line .= $info[$c];
                    // }
                    // echo $line;
                    // echo "</pre>";
                // echo "<pre>";
                // var_dump($info);
                // echo "</pre>";

            }
            fclose($file);
        } else{
            echo "SCRIPT DESABILITADO NO BANCO DE DADOS";
        }
    }

}

/* End of file Embratel.php */
/* Location: ./application/controllers/script/Embratel.php */