<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function index()
    {

        $css['headerinc'] = '<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyABymwhvTD8qgfQ3g6iZBWyC_muA2qNU_o&v=3.exp&sensor=false&libraries=weather,places" type="text/javascript" ></script>';
        $script['script'] = '<script>$("#myAlert").fadeOut(4000);</script>';
        $script['footerinc'] = '
        <script src="'.base_url().'assets/custom/maps/teste.js" type="text/javascript"></script>';

        $username = $this->session->userdata('username');
        $user = array("username" => $username);

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('teste/mapa');
        $this->load->view('template/footer',$script);

    }

}

/* End of file mapa.php */
/* Location: ./application/controllers/dash/mapa.php */