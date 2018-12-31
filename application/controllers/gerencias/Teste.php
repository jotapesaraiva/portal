<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function index()
    {
        echo $this->router->directory;
        echo " ";
        echo $this->router->class;
        echo " ";
        echo $this->router->method;
                echo " ";
        echo $this->uri->segment(2);
    }

}

/* End of file Teste.php */
/* Location: ./application/controllers/gerencias/Teste.php */