<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->library('crontab');
        // include APPPATH . 'third_party/cronjob/application/models/Crontab.php';
    }


    public function old()
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

    public function add()
    {
        // $this->crontab = new Crontab();

        if(!empty($this->input->post('minute')) ) $this->crontab->onMinute($this->input->post('minute'));
        if(!empty($this->input->post('hour')) ) $this->crontab->onHour($this->input->post('hour'));
        if(!empty($this->input->post('month')) ) $this->crontab->onMonth($this->input->post('month'));
        if(!empty($this->input->post('dayweek')) ) $this->crontab->onDayOfWeek($this->input->post('dayweek'));
        if(!empty($this->input->post('daymonth')) ) $this->crontab->onDayOfMonth($this->input->post('daymonth'));
        if(!empty($this->input->post('command')) ) $this->crontab->doJob($this->input->post('command'));

        if($this->crontab->activate()) {
            echo json_encode($this->crontab);
        } else {
            echo false;
        }
    }

    public function deletejob()
    {
        // $this->crontab = new Crontab();
        $this->crontab->deleteJob($this->input->post('jobid'));
    }

    public function deleteall()
    {
        // $this->crontab = new Crontab();
        $this->crontab->deleteAllJobs();
    }

    public function edit_job()
    {
        $this->crontab->editJob('0');
        // echo "teste final";
    }


    public function index()
    {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '';
        $script['script'] = '';
        $css['headerinc'] = '';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>CronJob</span>', '/sistema/cronjob');
        $this->breadcrumbs->push('<span>Teste</span>', '/sistema/cronjob/teste');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('sistema/cronjob');

        $this->load->view('template/footer',$script);

    }

}

/* End of file Cronjob.php */
/* Location: ./application/controllers/sistema/Cronjob.php */