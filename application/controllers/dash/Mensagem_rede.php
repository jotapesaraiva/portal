<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem_rede extends CI_Controller {

    public function __construct(){
        parent::__construct();
        //MODEL - Consulta Banco de dados
        $this->load->model('mensagem_rede_model','msg_model');
        $this->load->model('mantis_model');
        /* Load form helper */
        $this->load->helper(array('form', 'url'));
        /* Load form validation library */
        $this->load->library('form_validation');
    }

    public function index()
    {

    }

    public function conteudo() {
        $resultado = $this->msg_model->select_old();
        echo json_encode($resultado->result());
    }

    public function alerta() {
        $result = $this->msg_model->consulta_old();
        echo $result->num_rows();
    }

    public function copiar($id)
    {
        $css['headerinc']    =' <link href="'.base_url().'assets/custom/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">
                                <link href="'.base_url().'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />';
        $script['footerinc'] = '<script src="'.base_url().'assets/custom/bootstrap-select/dist/js/bootstrap-select.js"></script>
                                <script src="'.base_url().'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>';
        $script['script']    = '';

        $result              = $this->msg_model->select_id($id);
        $subject             = $result->ps;
        $pattern_popup       = "/POPUP|Popup|popup|PopUp|pop-up|pop up|POP UP/";
        if(preg_match($pattern_popup, $subject)){
            $tipo[] = 1;
        } else {
            $tipo[] = '';
        }
        $pattern_ts          = "/TS|ts|t.s.|t.s|siat|SIAT|Siat/";
        if(preg_match($pattern_ts, $subject)){
            $tipo[] = 2;
        } else {
            $tipo[] = '';
        }
        $pattern_login       = "/login|Login|LOGIN/";
        if(preg_match($pattern_login, $subject)){
            $tipo[] = 3;
        } else {
            $tipo[] = '';
        }

        $dados = array(
            "result"     => $result,
            "tipo"       => $tipo,
            "titulo"     => '',
            "assinatura" => '',
            "operador"   => $this->session->userdata('username'),
            "meios"       => $this->msg_model->meio_new()
        );
        // pr($dados);
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Mensagem de Rede</span>', 'mensagem_rede');
        $this->breadcrumbs->push('<span>Copiar</span>', '/mensagem_rede/copiar');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('msg/copiar',$dados);

        $this->load->view('template/footer',$script);

    }

    public function abrir_mantis()
    {
        /* Set validation rule for name field in the form */
        $this->form_validation->set_rules('usuario', 'Usuário', 'required');//, array('required' => '<span class="required" aria-required="true"> * </span>'));
        $this->form_validation->set_rules('avaliador', 'Avaliador', 'required');//, array('required' => '<span class="required" aria-required="true"> * </span>'));
        $this->form_validation->set_rules('titulo', 'Título', 'required');//,  array('required' => '<span class="required" aria-required="true"> * </span>'));
        $this->form_validation->set_rules('assinatura', 'Assinatura', 'required');//,  array('required' => '<span class="required" aria-required="true"> * </span>'));
        $this->form_validation->set_error_delimiters('<span class="required" aria-required="true">', '</span>');
        if ($this->form_validation->run('turno') == FALSE) {
          $this->copiar($this->input->post('id'));
        } else {
            //###############Abertura do Mantis################
            $mensagem = '';
            if (in_array('1', $this->input->post('tipo[]'))) {
                $mensagem .= 'PopUp ';
            }
            if (in_array('2', $this->input->post('tipo[]'))) {
                $mensagem .= ' T.S. ';
            }
            if (in_array('3', $this->input->post('tipo[]'))) {
                $mensagem .= ' Login';
            }

            $destinatario = '';
            if (in_array('1', $this->input->post('meio[]'))) {
                $destinatario .= 'DTI ';
            }
            if (in_array('2', $this->input->post('meio[]'))) {
                $destinatario .= ' TS ';
            }
            if (in_array('3', $this->input->post('meio[]'))) {
                $destinatario .= ' Órgão Central';
            }
            if (in_array('4', $this->input->post('meio[]'))) {
                $destinatario .= ' Central de Serviço Gentil ';
            }
            if (in_array('5', $this->input->post('meio[]'))) {
                $destinatario .= ' EFAZ';
            }
            if (in_array('6', $this->input->post('meio[]'))) {
                $destinatario .= ' DIPAT';
            }
            if (in_array('7', $this->input->post('meio[]'))) {
                $destinatario .= ' CERAT Marituba';
            }
            if (in_array('8', $this->input->post('meio[]'))) {
                $destinatario .= ' TODA-SEFA';
            }
            if (in_array('9', $this->input->post('meio[]'))) {
                $destinatario .= ' TESTE';
            }
            $detalhe = '
            '.$this->input->post('titulo').'
            '.$this->input->post('conteudo').'
            '.$this->input->post('assinatura').'

            #############################################################################
            Exibir de '.$this->input->post('datai').' até '.$this->input->post('dataf').'
            Tipo da mensagem: '.$mensagem.'
            Para a '. $destinatario.' ';
            $params = array(
                'usuario'   => $this->session->userdata('username'),//nome do usuario
                'projeto'   => 'Administração de Ambiente',//projeto mantis
                'categoria' => 'Mensagem de Rede',//categoria do projeto mantis
                'servico'   => $this->input->post('titulo').' - '.$this->input->post('avaliador'),//resumo do mantis
                'detalhe'   => $detalhe//descriçao do mantis
            );
            $procedore = 'STP_RELT_CASO_PROJETO_CATEG';
            $parametros = '';
            // vd($params);
            $this->mantis_model->abrir_mantis_teste($params,$procedore,$parametros);

            //###############Inserindo no Novo Mensagem de rede################
            $tipo = $this->input->post('tipo[]');
            $tiposem = implode("", $tipo);
            $ip = $this->input->post('meio[]');
            $ipsem = implode("", $ip);
            if($this->input->post('imediato') == null){
                $imediato = 0;
            }else{
                $imediato = 1;
            }

            $this->input->post('ip[]');
            $dados = array(
                'titulo'            => $this->input->post('titulo'),
                'mensagem'          => $this->input->post('conteudo'),
                'assinatura'        => $this->input->post('assinatura'),
                'observacao'        => $this->input->post('obs'),
                'data_inicio'       => $this->input->post('datai').':00',
                'data_final'          => $this->input->post('dataf').':00',
                'ip'                => $ipsem,
                'tipo'              => $tiposem,
                'usuario_post'      => $this->input->post('usuario'),
                'data_post'         => date('Y-m-d H:i:s'),
                'usuario_avaliador' => $this->input->post('avaliador'),
                'data_avaliada'     => date('Y-m-d H:i:s'),
                'status'            => '2', //Status 2 autorizada
                'imediata'          => $imediato
            );
            $this->msg_model->insert_new($dados);

            //##########Atualizado status no Velho Mensagem de rede############

            $dados = array(
                'received_user' => $this->input->post('operador'),
                'status' => '3'//0->pendente;1->encaminhada; 2->reprovada;3->Atendida
            );
            $this->msg_model->update_old(array('id' => $this->input->post('id')),$dados);
            //redireciona para a pagina inicial.
            redirect('dashboard/producao');
        }

    }

    public function teste()
    {
        $result = $this->msg_model->meio_new();
        vd($result);

    }
}

/* End of file Mensagem_rede.php */
/* Location: ./application/controllers/dash/Mensagem_rede.php */