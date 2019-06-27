<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('crontab');
    }


    public function index()
    {
        // $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '';
        $script['script'] = '
        <script src="' . base_url() . 'assets/custom/sistema/cronjob.js" type="text/javascript"></script>';

        $css['headerinc'] = '';

        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>Cronjob</span>', '/sistema/cronjob');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('sistema/cronjob');
        $this->load->view('modal/modal_cronjob');

        $this->load->view('template/footer',$script);
    }

    public function active() {
        // $cron = new Crontab();
        $active = $this->crontab->listJobs();
        echo json_encode($active);
    }

    public function add($value='')
    {
        // $this->crontab = new Crontab();

        if(isset($_POST['minute']) && $_POST['minute'] != '') $this->crontab->onMinute($_POST['minute']);
        if(isset($_POST['hour']) && $_POST['hour'] != '') $this->crontab->onHour($_POST['hour']);
        if(isset($_POST['month']) && $_POST['month'] != '') $this->crontab->onMonth($_POST['month']);
        if(isset($_POST['dayweek']) && $_POST['dayweek'] != '') $this->crontab->onDayOfWeek($_POST['dayweek']);
        if(isset($_POST['daymonth']) && $_POST['daymonth'] != '') $this->crontab->onDayOfMonth($_POST['daymonth']);
        if(isset($_POST['command']) && $_POST['command'] != '') $this->crontab->doJob($_POST['command']);

        if($this->crontab->activate()) {
            echo json_encode($this->crontab);
        } else {
            echo false;
        }
    }

    public function deletejob($value='')
    {
        // $this->crontab = new Crontab();
        $this->crontab->deleteJob($_POST['jobid']);
    }

    public function deleteall()
    {
        // $this->crontab = new Crontab();
        $this->crontab->deleteAllJobs();
    }


}

/* End of file Cronjob.php */
/* Location: ./application/controllers/sistema/Cronjob.php */