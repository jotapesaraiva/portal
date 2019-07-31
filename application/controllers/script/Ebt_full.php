<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebt_full extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('zabbix_model');
        $this->load->model('modulos_model');
        $this->load->helper("text_date");
    }
                //'http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_situacao72h.php?csv_output=1&pt_output=off&pt_id_tabela_csv=tickets&vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8='
                //http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_action_consultar_tickets.php?verificapost=951&modo_consulta=1&id_ticket=&protocolo=&criterio_evento=1&id_status%255B%255D=2&equipamento_afetado_text=&id_operadora=&data_dia=30&data_mes=07&data_ano=2019&rd_data_hora=3&dataDe_dia=01&dataDe_mes=07&dataDe_ano=2019&dataDe_hora=00&dataDe_minuto=01&dataAte_dia=30&dataAte_mes=07&dataAte_ano=2019&dataAte_hora=12&dataAte_minuto=01&id_tipo%255B%255D=1&gpa=&vulto=&elemento_gerenciavel=&id_nota_externa=&centro_afetado_text=&link_afetado_text=&uf_text=&falha_atendimento=2&prazo_sla=&csv_output=1&pt_output=off&pt_id_tabela_csv=tickets&vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=' -O /opt/script/embratel/tickets/exports/export_php_full".$data.".csv");

    public function index() {
        $modulo = $this->modulos_model->site_modulo('monitora');

        if($modulo[0]['status'] == 1) {
            $data = date('d-m-Y.H:i:s');
            shell_exec("wget -o /opt/script/embratel/tickets/logdownload_php_full.txt 'http://webebt04.embratel.com.br/PORTALGRCTST/troubleticket/tkt_action_consultar_tickets.php?verificapost=951&modo_consulta=1&id_ticket=&protocolo=&criterio_evento=1&id_status%255B%255D=2&equipamento_afetado_text=&equipamento_afetado%255B%255D=afgo_uecomt_afgo&equipamento_afetado%255B%255D=afu_oeat_afu&equipamento_afetado%255B%255D=bacs_uecomt_bacs&equipamento_afetado%255B%255D=bcn_oeat_bcn&equipamento_afetado%255B%255D=bcn_uecomt_bcn&equipamento_afetado%255B%255D=bgn_oeat_bgn&equipamento_afetado%255B%255D=blm_cecomt_porto&equipamento_afetado%255B%255D=blm_core_1&equipamento_afetado%255B%255D=blm_core_2&equipamento_afetado%255B%255D=blm_gk_1&equipamento_afetado%255B%255D=blm_gk_2&equipamento_afetado%255B%255D=blm_sopf_cppnf&equipamento_afetado%255B%255D=blm_uecomt_aeroporto&equipamento_afetado%255B%255D=blm_uecomt_cais&equipamento_afetado%255B%255D=blm_uecomt_correios&equipamento_afetado%255B%255D=blm_uecomt_porto_sec&equipamento_afetado%255B%255D=blm_uecomt_pratinha&equipamento_afetado%255B%255D=brv_cerat_brv&equipamento_afetado%255B%255D=chia_cecomt_chia&equipamento_afetado%255B%255D=chia_cecomt_gurupi_b&equipamento_afetado%255B%255D=c_internet_usarios&equipamento_afetado%255B%255D=cir_cecomt_cir&equipamento_afetado%255B%255D=cme_oeat_cme&equipamento_afetado%255B%255D=cpc_oeat_cpc&equipamento_afetado%255B%255D=cyh_uecomt_cyh&equipamento_afetado%255B%255D=deu_cecomt_deu&equipamento_afetado%255B%255D=edra_oeat_edra&equipamento_afetado%255B%255D=iab_oeat_iab&equipamento_afetado%255B%255D=jun_oeat_jun&equipamento_afetado%255B%255D=mba_cecomt_mba&equipamento_afetado%255B%255D=mba_uecomt_frcarajas&equipamento_afetado%255B%255D=mng_oeat_mng&equipamento_afetado%255B%255D=npso_cecomt_npso&equipamento_afetado%255B%255D=npso_oeat_npso&equipamento_afetado%255B%255D=nvrp_oeat_nvrp&equipamento_afetado%255B%255D=ois_oeat_ois&equipamento_afetado%255B%255D=orgao_central_int2&equipamento_afetado%255B%255D=por_oeat_por&equipamento_afetado%255B%255D=rdo_cerat_rdo&equipamento_afetado%255B%255D=rnp_oeat_rnp&equipamento_afetado%255B%255D=saf_uecomt_saf&equipamento_afetado%255B%255D=sas_oeat_sas&equipamento_afetado%255B%255D=sgu_uecomt_sgu&equipamento_afetado%255B%255D=sgz_oeat_sgz&equipamento_afetado%255B%255D=sgz_uecomt_sgz&equipamento_afetado%255B%255D=sip_oeat_sip&equipamento_afetado%255B%255D=smg_oeat_smg&equipamento_afetado%255B%255D=srm_cerat_srm&equipamento_afetado%255B%255D=sxu_oeat_sxu&equipamento_afetado%255B%255D=tca_oeat_tca&equipamento_afetado%255B%255D=tla_oeat_tla&equipamento_afetado%255B%255D=tou_oeat_tou&equipamento_afetado%255B%255D=vgi_oeat_vgi&equipamento_afetado%255B%255D=xga_oeat_xga&equipamento_afetado%255B%255D=xga_uecomt_pontao&id_operadora=&data_dia=31&data_mes=07&data_ano=2019&rd_data_hora=3&dataDe_dia=01&dataDe_mes=07&dataDe_ano=2019&dataDe_hora=00&dataDe_minuto=00&dataAte_dia=31&dataAte_mes=07&dataAte_ano=2019&dataAte_hora=23&dataAte_minuto=59&id_tipo%255B%255D=1&gpa=&vulto=&elemento_gerenciavel=&id_nota_externa=&centro_afetado_text=&link_afetado_text=&uf_text=&falha_atendimento=2&prazo_sla=&csv_output=1&pt_output=off&pt_id_tabela_csv=tickets&vcontacle=44j5+A0CKaiKEZKgf5bMeVZfqsvrl0AJ4teFsjZMZi/b4=ZS8ec8e/xbFOxpBipHMZ&vlogin=44vvmukhQGO39kGXjMmIMpE5FQV9pRxF4VmouSLb1DRyw=X9FM11Jt0L8=' -O /opt/script/embratel/tickets/exports/export_php_full".$data.".csv");
            shell_exec("chmod 777 /opt/script/embratel/tickets/exports/export_php_full".$data.".csv");
            // sleep(10);//delay de 5 segundos
            shell_exec("cat /opt/script/embratel/tickets/exports/export_php_full".$data.".csv | sed '1d' > /opt/script/embratel/tickets/exports/temp_full.csv");
            $file = fopen("/opt/script/embratel/tickets/exports/temp_full.csv", "r");

            $insert = array();
            while (($info = fgetcsv($file, 10000, ',', '"')) !== FALSE) {
                $info = array_map("utf8_encode", $info); //added
                $csv = array(
                    'data_atual'       => date("Y-m-d H:i:s",strtotime($data)),
                    'ticket'           => $info['0'],
                    'rec'              => $info['1'],
                    'tempo_operadora'  => text_date($info['2']),
                    'tempo_cliente'    => text_date($info['3']),
                    'duracao_total'    => text_date($info['4']),
                    'duracao_zbx'      => '',
                    'sla'              => $info['5'],
                    'contregressivo'   => $info['6'],
                    'equipamento'      => $info['7'],
                    'designacao'       => $info['8'],
                    'abertura'         => date("Y-m-d H:i:s",strtotime($info['9'])),
                    'atualizacao'      => date("Y-m-d H:i:s",strtotime($info['10'])),
                    'rede'             => $info['11'],
                    'status'           => $info['12'],
                    'local'            => $info['13'],
                    'uf'               => $info['14'],
                    'centro'           => $info['15'],
                    'sintoma'          => $info['16'],
                    'causa'            => $info['17'],
                    'responsabilidade' => $info['18'],
                    'posicionamento'   => $info['19'],
                    'proativo'         => $info['20'],
                    'protocolo'        => $info['21'],
                    'operadora'        => $info['22'],
                );
                array_push($insert, $csv);
                //verifica se o ticket existe
                $ticket_existe = $this->zabbix_model->select_ebt_grc($info['0']);
                if($ticket_existe->num_rows() == 0 ){//se não existe inserir
                    $this->zabbix_model->insert_ebt_grc($csv);
                    echo "Insert".$info['7']."<br>";
                } else {//se existe update
                    $this->zabbix_model->update_ebt_grc(array('ticket' => $info['0']),$csv);
                    echo "Update".$info['7']."<br>";
                }
            }
            // vd($insert);
            fclose($file);
        } else{
            echo "SCRIPT DESABILITADO NO BANCO DE DADOS";
        }
    }

}

/* End of file EbtFull.php */
/* Location: ./application/controllers/script/EbtFull.php */