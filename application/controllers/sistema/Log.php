<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
         esta_logado();
    }

    public function index() {
        $css['headerinc']    = '
        <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="' . base_url() . 'assets/custom/log.js" type="text/javascript"></script>';
        $script['script']    = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>Log</span>', '/sistema/log');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('sistema/log', $this->log_view->showLogs());

        $this->load->view('template/footer',$script);
    }


    public function showLogs() {
        if($this->input->get("del")) {
            $this->log_view->deleteFiles(base64_decode($this->input->get("del")));
            redirect($this->uri->uri_string());
            return;
        }
        if($f = $this->input->get("dl")) {
            $this->log_view->downloadFile(base64_decode($f));
            return;
        }
        $fileName = ($this->input->get("f")) ? $this->input->get("f") : null;
        //get the log files from the log directory
        $files = $this->log_view->getFiles();
        if(!is_null($fileName)) {
            $currentFile = APPPATH . "/logs" . "/". base64_decode($fileName);
        }
        else if(is_null($fileName) && !empty($files)) {
            $currentFile = APPPATH . "/logs" . "/" . $files[0];
        }
        else {
            $data['logs'] = [];
            $data['files'] = [];
            $data['currentFile'] = "";
            return $this->load->view('sistema/log', $data);
        }
        $logs = $this->log_view->processLogs($this->log_view->getLogs($currentFile));
        $data['logs'] = $logs;
        $data['files'] =  $files;
        $data['currentFile'] = basename($currentFile);
        return $this->load->view('sistema/log', $data);
    }



}

/* End of file Log.php */
/* Location: ./application/controllers/sistema/Log.php */