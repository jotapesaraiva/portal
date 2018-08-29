<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_bkp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->helper('url');
        $this->load->model('historico_model');
        $this->load->library('Auth_AD');
        esta_logado();
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/historico.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Histórico</span>', '/backup/historico');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $data['historico'] = $this->table_history();

        $this->load->view('backup/historico', $data);

        $this->load->view('template/footer',$script);

    }

    public function dados_copiados($session_id,$specification) {
        $this->output->enable_profiler(TRUE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/historico.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Histórico</span>', '/backup/historico');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $data['session_id'] = $session_id;
        $data['specification'] = $specification;
        $data['dataCopy'] = $this->table_data($session_id);

        $this->load->view('backup/filesystem.php', $data);

        $this->load->view('template/footer',$script);
    }

    public function teste() {
        $historico = $this->historico_model->history();
        vd($historico);
    }

    public function table_history() {

        $historicos = $this->historico_model->history();
        $contador = 1;
        $html = "";
        foreach ($historicos as $historico) {
                // $id_session = $historico['session_id'];
                $id_session = str_replace('/','_',$historico['session_id']);
                $mantis = $historico['mantis'];

                $tamanhoemmega = $historico['gb_written'] * 1024;
                $duracaoemsegundos = ((substr($historico['duration'],0,2) * 3600) + (substr($historico['duration'],3,2) * 60));
                if($tamanhoemmega == '0') {
                    $velocidadenaoformatada = '0';
                } else if($duracaoemsegundos == '0'){
                    $velocidadenaoformatada = '0';
                } else if($tamanhoemmega =='0'AND $duracaoemsegundos == '0'){
                    $velocidadenaoformatada = '0';
                } else{
                    $velocidadenaoformatada = $tamanhoemmega / $duracaoemsegundos;
                }
                $velocidade = number_format($velocidadenaoformatada,2);

                $html .= "<tr>\n";
                // $html .= "  <td>".$contador++."</td>\n";

                $html .= "<td>".utf8_encode($historico['day_time'])."</td>\n";
            if($historico['status']=="Completed") {
                $html .= "<td><img border='0' src='".base_url('/assets/custom/img/completed.gif')."'><span class='label label-sm label-success'</span> Completo </td>\n";
            } else if($historico['status']=="Completed/Errors") {
                $html .= "<td><img border = '0'0 src='".base_url('/assets/custom/img/completed_errors.gif')."'><span class='label label-sm label-warning'</span> Com Erros </td>\n";
            } else if($historico['status']=="Completed/Failures") {
                $html .= "<td><img border='0' src='".base_url('/assets/custom/img/completed_failures.gif')."'><span class='label label-sm label-warning'</span> Com Falhas </td>\n";
            } else if($historico['status']=="Failed") {
                $html .= "<td><img border='0' src='".base_url('/assets/custom/img/failed.gif')."'><span class='label label-sm label-danger'</span> Falhou </td>\n";
            } else if($historico['status']=="Aborted") {
                $html .= "<td><img border='0' src='".base_url('/assets/custom/img/aborted.gif')."'><span class='label label-sm label-danger'</span> Abortou </td>\n";
            }
                // $html .= "<td><a href='/?m=analise&f=backup&a=dados_copiados_bkp&aux=".$historico['session_id']."&aux2=".$historico['specification']."'target='_self''</a>".utf8_encode($historico['specification'])."</td>\n";
                $html .= "<td>".anchor_popup(base_url("backup/historico/dados_copiados/". $id_session ."/".$historico['specification'].""),"".utf8_encode($historico['specification'])."")."</td>\n";
                $html .= "<td>".utf8_encode($historico['session_id'])."</td>\n";
                $html .= "<td>".utf8_encode($historico['mode'])."</td>\n";
                $html .= "<td>".utf8_encode($historico['session_type'])."</td>\n";
                $html .= "<td>".utf8_encode($historico['start_time'])."</td>\n";
                $html .= "<td>".utf8_encode($historico['duration'])."</td>\n";
                $html .= "<td>".utf8_encode($historico['files'])."</td>\n";
                $html .= "<td>".str_replace(".",",",$velocidade)." MB/s</td>\n";
                $html .= "<td>".(str_replace(".",",",$historico['gb_written']))." GB</td>\n";
                //$html .= "<td>".utf8_encode(implode('<br>',explode("[",$historico['erro_backup'])))."</td>\n";
                $html .= "<td>".$historico['providencia_backup']."</td>\n";
            if($historico['mantis'] == 0) {
                $html .= ("<td>".$historico['mantis']."</td>");
            } else {
                $html .= "<td><a href='http://intranet2.sefa.pa.gov.br/mantis/view.php?id=".$historico['mantis']."' target='_blank''>".$historico['mantis']."</a></td>";
            }
            if($mantis=="0") {
                $html .= ("<td>-</td>");
            } else {
                $html .= ("<td>+</td>");
 /*               $conexao_oracle=AbrirConexaoOracle();
                $s = oci_parse($conexao_oracle, "SELECT s.status_description
                                                  FROM mantis.mantis_bug_tb b
                                                  JOIN mantis.mantis_bug_status_tb s
                                                    ON b.status = s.status
                                                 WHERE b.id = ".$mantis."
                ");
                oci_execute($s, OCI_NO_AUTO_COMMIT);
                while ($historic2 = oci_fetch_array($s, OCI_ASSOC)) {
                    $status_mantis =  $historic2['STATUS_DESCRIPTION'];
                    if($status_mantis=="resolvido") {
                        $html .= ("<td><i class='icon icon-color icon-check'></i></td>");
                    } else {
                        $html .= ("<td><i class='icon icon-color icon-cancel'></i></td></tr>");
                    }
                }*/
            }
            $html .= "</tr>\n";
        }
        return $html;
    }

    public function table_data($session_id) {
        $id_session = str_replace('_','/',$session_id);
        $descbkp = shell_exec("/opt/omni/bin/./omnirpt -tab -report session_objects -session ".$id_session." 2>&1 &");
        $html = "";
        $linhasdescbkp = explode("\n", $descbkp);
        $tamanho = sizeof($linhasdescbkp);
        for ($i = 7;  $i < $tamanho - 1; $i++) {
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
        return $html;
    }
}

/* End of file Historico.php */
/* Location: ./application/controllers/backup/Historico.php */