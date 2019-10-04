<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('email_model');
    }

    public function index()
    {
        $in_mxhero = $this->email_model->select_mxhero('in');

            $array_in = array(
                'data_coleta' => $in_mxhero['data_coleta'],
                'qtd_in' => $in_mxhero['qtd'],
                'size_in' => $in_mxhero['size']
            );

            $this->email_model->insert_mxhero($array_in);
            echo "insert in na tabela";
            echo "<br>";

        $out_mxhero = $this->email_model->select_mxhero('out');

            $array_out = array(
                'qtd_out' => $out_mxhero['qtd'],
                'size_out' => $out_mxhero['size']
            );

            $this->email_model->update_mxhero(array('data_coleta' => $out_mxhero['data_coleta']),$array_out);
            echo "insert out na tabela";
            echo "<br>";

        $spam_mxhero = $this->email_model->select_spam_mxhero();

            $array_spam = array(
                'qtd_spam' => $spam_mxhero['total']
            );

            $this->email_model->update_mxhero(array('data_coleta' => $spam_mxhero['data_coleta']),$array_spam);
            echo "insert spam na tabela";
            echo "<br>";
    }


    public function coleta()
    {
        $in_mxhero = $this->email_model->select_mxhero_date('in');

            $array_in = array(
                'data_coleta' => $in_mxhero['data_coleta'],
                'qtd_in' => $in_mxhero['qtd'],
                'size_in' => $in_mxhero['size']
            );

            $this->email_model->insert_mxhero($array_in);
            echo "insert in na tabela";
            echo "<br>";

        $out_mxhero = $this->email_model->select_mxhero_date('out');

            $array_out = array(
                'qtd_out' => $out_mxhero['qtd'],
                'size_out' => $out_mxhero['size']
            );

            $this->email_model->update_mxhero(array('data_coleta' => $out_mxhero['data_coleta']),$array_out);
            echo "insert out na tabela";
            echo "<br>";

        $spam_mxhero = $this->email_model->select_spam_mxhero_date();

            $array_spam = array(
                'qtd_spam' => $spam_mxhero['total']
            );

            $this->email_model->update_mxhero(array('data_coleta' => $spam_mxhero['data_coleta']),$array_spam);
            echo "insert spam na tabela";
            echo "<br>";
    }

    public function teste() {
        // $banco = $this->email_model->somaMesAtual('09', '2019');
        // $banco  =  $this->email_model->select_mxhero_date('in');
        $banco  =  $this->email_model->select_mx();
        vd($banco);
        // echo $banco['data_coleta'];
        // echo json_encode($banco);
    }
}

/* End of file Email.php */
/* Location: ./application/controllers/script/Email.php */