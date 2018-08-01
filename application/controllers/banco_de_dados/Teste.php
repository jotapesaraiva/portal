<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

    public function index()
    {
        $this->load->helper('date');

        $date = "2009-06-15";
        $data = "23/07/2018";
        $shortdate = setDate($date, 'short'); //# returns '06 / 15 / 2009 - 9:32AM'
        $longdate = setDate($date, 'long'); //# returns 'June 15, 2009 - 9:32AM'
        $notime = setDate($date, 'notime'); //# returns '06 / 15 / 2009'
        $teste = setDate($data, 'teste'); //# returns '06 / 15 / 2009'
        $meu_time = dataMysqlParaPtBr($date);
        // $meu_time2 = dataPtBrParaMysql($date);

        echo date("m") .",". (date("d")+1) .",". date("Y") ."<br>"; //$tomorrow
        echo date("m")-1 .",". date("d") .",". date("Y") ."<br>"; //$lastmonth
        echo date("m") .",". date("d") .",". (date("Y")+1) ."<br>"; //$nextyear

        echo $date. "<br>";
        echo $shortdate. "<br>";
        echo $longdate. "<br>";
        echo $notime. "<br>";
        echo $meu_time. "<br>";
        echo $teste. "<br>";

        // echo $meu_time2. "<br>";

    }

}

/* End of file Teste.php */
/* Location: ./application/controllers/banco_de_dados/Teste.php */