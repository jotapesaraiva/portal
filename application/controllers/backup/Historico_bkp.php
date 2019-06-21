<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_bkp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/historico_bkp.js" type="text/javascript"></script>';
        $script['script'] = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Backup</span>', 'backup');
        $this->breadcrumbs->push('<span>Histórico</span>', '/backup/historico');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('backup/historico');

        $this->load->view('template/footer',$script);

    }

    public function dados_copiados($session_id,$specification) {
        $this->output->enable_profiler(TRUE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/backup/historico.js" type="text/javascript"></script>';
        $script['script'] = "

        <script>
        $('thead tr th',tbody tr td).css({'fonte-size' : '11px !important'});
        </script>
        ";
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

        $this->load->view('backup/dados_copiados.php', $data);

        $this->load->view('template/footer',$script);
    }

    public function table_data($session_id) {
        $id_session = str_replace('_','/',$session_id);
        $descbkp = shell_exec("/opt/omni/bin/./omnirpt -tab -report session_objects -session ".$id_session." 2>&1 &");
        $html = "";
        $linhasdescbkp = explode("\n", $descbkp);
        $tamanho = sizeof($linhasdescbkp);//conta a quantidade de linhas
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

    public function datatable_list() {
        // Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $history = $this->historico_model->history();
        $data = array();
        foreach ($history->result_array() as $key => $value) {
            $row = array();

            $row[] = $key+1;
            $row[] = $value['daytime'];
            $row[] = $this->statusBackup($value['status']);
            $row[] = anchor_popup(base_url("backup/historico_bkp/dados_copiados/".str_replace('/','_',$value['session_id'])."/".$value['specification'].""), utf8_encode($value['specification']));
            $row[] = utf8_encode($value['session_id']);
            $row[] = utf8_encode($value['mode']);
            $row[] = utf8_encode($value['session_type']);
            $row[] = utf8_encode($value['start_time']);
            $row[] = utf8_encode($value['duration']);
            $row[] = utf8_encode($value['files']);
            $row[] = str_replace(".",",",$this->velocidade($value['gb_written'],$value['duration']))." MB/s";
            $row[] = str_replace(".",",",$value['gb_written'])." GB";
            $row[] = $this->mantisBackup($value['mantis']);
            $data[] = $row;
        }
        $output = array (
            "draw"            => $draw,
            "recordsTotal"    => $history->num_rows(),
            "recordsFiltered" => $history->num_rows(),
            "data"            => $data,
        );
        echo json_encode($output);
    }

    public function statusBackup($value) {
        switch ($value) {
            case 'Completed':
                return "<td> <img border='0' src='".base_url('/assets/custom/img/completed.gif')."'> <span class='label label-sm label-success'</span> Completo </td>\n";
                break;
            case 'Completed/Errors':
                return "<td> <img border='0' src='".base_url('/assets/custom/img/completed_errors.gif')."'> <span class='label label-sm label-warning'</span> Com Erros </td>\n";
                break;
            case 'Completed/Failures':
                return "<td><img border='0' src='".base_url('/assets/custom/img/completed_failures.gif')."'><span class='label label-sm label-warning'</span> Com Falhas </td>\n";
                break;
            case 'Failed':
                return "<td><img border='0' src='".base_url('/assets/custom/img/failed.gif')."'><span class='label label-sm label-danger'</span> Falhou </td>\n";
                break;
            default://Aborted
               return "<td><img border='0' src='".base_url('/assets/custom/img/aborted.gif')."'><span class='label label-sm label-danger'</span> Abortou </td>\n";
                break;
        }
    }

    public function mantisBackup($value) {
        if($value == '0'){
            return 0;
        } else{
            return  anchor_popup('http://intranet2.sefa.pa.gov.br/mantis/view.php?id='.$value.'', $value);
        }
    }

    public function velocidade($tamanho,$duracao) {
        $duracao = (substr($duracao,0,2) * 3600) + (substr($duracao,3,2) * 60);
        if($tamanho == '0' || $duracao == '0' || ($tamanho =='0' AND $duracao == '0')):
            return 0;
        else:
            return number_format(($tamanho*1024/$duracao),2);
        endif;
    }

    public function teste(){
        $duracao = '02:00:00';
        $tamanho = '1362.39';
        echo $this->velocidade($tamanho,$duracao);
    }

}

/* End of file Historico.php */
/* Location: ./application/controllers/backup/Historico.php */