<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        $this->load->model('email_model');
        $this->load->library('highcharts');

    }

    public function index() {

        $array_meses3 = array(01 =>"Janeiro",02=>"Fevereiro",03=>"Março",04=>"Abril",05=>"Maio",6=>"Junho",7=>"Julho",8=>"Agosto",9=>"Setembro",10=>"Outubro",11=>"Novembro",12=>"Dezembro");
        $mes = date("m");       // Mês desejado, pode ser por ser obtido por POST, GET, etc.
        $ano = '2016';//date("Y");       // Ano atual
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano)); // Mágica, plim!
        $data_consulta = $ano.'-'.$mes.'-'.$ultimo_dia;
        // $mes_coleta = (isset($_POST['mes']) ? $_POST['mes'] : $mes);
        $mes_coleta = $mes;
        /*if($mes_coleta <= 0){
            $mes_coleta = 12;
            $nano = $ano-1;

            $array_dados = $this->getDados($mes_coleta, $nano);
            $array_total = $this->somaMesAtual($mes_coleta,$nano);
        }
        else{*/

            $array_dados = $this->get_dados($mes_coleta, $ano);
            $array_total = $this->somaMesAtual($mes_coleta,$ano);
            $email_recebido = number_format(($array_total['total_in']/$array_total['total'])*100,2);
            $email_enviado = number_format(($array_total['total_out']/$array_total['total'])*100,2);
            $spam = number_format(($array_total['total_spam']/$array_total['total'])*100,2);
            $data = array(
                'array_dados'    => $array_dados,
                'array_total'    => $array_total,
                'email_recebido' => $email_recebido,
                'email_enviado'  => $email_enviado,
                'spam'           => $spam
            );
        // }
        $script['footerinc'] = '
        <script src="' . base_url() . 'assets/global/plugins/highcharts/js/highcharts.js"></script>';
        $script['script']    = '';
        $css['headerinc']    = '';
        $session['username'] = $this->session->userdata('username');

        $this->highcharts->set_title('Fluxo de E-mails de Entrada e Saida no mes de '. $array_meses3[intval($mes_coleta)] .'', '');
        $this->highcharts->set_axis_titles('', 'Qtd. Email');

        $xAxis['categories'] = $array_dados['data_coleta'];
        $this->highcharts->set_xAxis($xAxis);

        $serie['data']                   = $array_dados['qtd_in'];
        $serie['name']                   = 'Qtd. Emails Entrada';
        $serie['type']                   = 'spline';
        $serie['tooltip']['valueSuffix'] = ' Emails';
        $this->highcharts->set_serie($serie);

        $serie2['data']                   = $array_dados['qtd_out'];
        $serie2['name']                   = 'Qtd. Emails Saida';
        $serie2['type']                   = 'spline';
        $serie2['tooltip']['valueSuffix'] = ' Emails';
        $this->highcharts->set_serie($serie2);

        $serie3['data']                   = $array_dados['qtd_spam'];
        $serie3['name']                   = 'Quantidade SPAM';
        $serie3['type']                   = 'spline';
        $serie3['tooltip']['valueSuffix'] = ' E-mails SPAM';
        $this->highcharts->set_serie($serie3);

        $data['charts'] = $this->highcharts->render();

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('email/email', $data);

        $this->load->view('template/footer',$script);
    }

    public function entrada_saida(){

    }

    public function somaMesAtual($mes,$ano) {
        $linha = $this->email_model->indicador_email($mes,$ano);
        $array_saida = array(
            "total_in"   => $linha['total_in'],
            "total_out"  => $linha['total_out'],
            "total_spam" => $linha['total_spam'],
            "total"      => array_sum($linha)
        );
        return $array_saida;
    }

    public function get_dados($mes,$ano) {
        $consulta_banco = $this->email_model->consulta_banco($mes,$ano);
        $array_email = array();
        for($i=0; $i < sizeof($consulta_banco) ; $i++) {
            $dia = explode("-",$consulta_banco[$i]['data_coleta']);
            $array_email['data_coleta'][$i] = intval($dia[2]);
            $array_email['qtd_in'][$i]      = intval($consulta_banco[$i]['qtd_in']);
            $array_email['qtd_out'][$i]     = intval($consulta_banco[$i]['qtd_out']);
            $array_email['size_in'][$i]     = $consulta_banco[$i]['size_in'];
            $array_email['size_out'][$i]    = $consulta_banco[$i]['size_out'];
            $array_email['qtd_spam'][$i]    = intval($consulta_banco[$i]['qtd_spam']);
        }
        return $array_email;
        // echo json_encode($array_email);
        // vd($array_email);
    }


}

/* End of file Email.php */
/* Location: ./application/controllers/Email.php */