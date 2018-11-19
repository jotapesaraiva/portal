<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        // esta_logado();
        $this->load->model('voucher_model');
    }

    public function index() {
        $curr_year = date('Y');
        $curr_mes = date('n');
        if($this->input->post('ano')) {
            $nano = $this->input->post('ano');
            $data['nano'] = $nano;
        } else {
            $nano = date('Y');
            $data['nano'] = date('Y');
        }

        if($this->input->post('mes')){
            $nmes = $this->input->post('mes');
            $data['nmes'] = $nmes;
            $data['mes'] = dataEmPortugues($nmes);
        } else {
            $nmes = $curr_mes;
            $data['nmes'] = date('n');
            $data['mes'] = dataEmPortugues(date('n'));
        }

        $this->output->enable_profiler(true);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/senhas.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gerências</span>', '/gerencias');
        $this->breadcrumbs->push('<span>Voucher</span>', '/gerencias/voucher');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $data['historico'] = $this->table_historico($nmes,$nano,0);

        $this->load->view('gerencias/voucher', $data);

        $this->load->view('template/footer', $script);
    }


    public function table_historico($mes,$ano,$funcionario){
        $historico = $this->voucher_model->historico_voucher($mes,$ano,$funcionario);
        $html = "";
        foreach ($historico->result() as $linha) {

            $html.="<tr>";
            $html.="    <td>".$linha['id_historico']."</td>";
            $html.="    <td>".$linha['data']."</td>";
            $html.="    <td>".utf8_encode($linha['usuario_nome'])."</td>";
            $html.="    <td>".$linha['voucher']."</td>";
            $html.="    <td>R$ ".str_replace(".",",",$linha['valor'])."</td>";
            $html.="    <td>".$linha['motorista']."</td>";
            $html.="    <td>".$linha['observacao']."</td>";

            $html.="    <td>";
            $html.="        <div class='btn-group'>";
            $html.="        <a class='btn btn-link dropdown-toggle' data-toggle='dropdown' href='#'><span class='caret'></span></a>";
            $html.="        <ul class='dropdown-menu'>";
                    if($_SESSION['usuario_id']==$linha['usuario_id']):
            $html.="            <a href=><i class='icon-pencil'></i> Editar</a>";
            $html.="            <a href=><i class='icon-trash'></i> Deletar</a>";
                    else:
            $html.="            Somente o usuário que<br>cadastrou o voucher<br>pode alterar ou excluir.";
                    endif;
            $html.="        </ul>";
            $html.="        </div>";
            $html.="    </td>";
            $html.="</tr>";
        }
        return $html;
    }


    public function historico_add() {
        $this->acesso_validate();
        $data = array(
            'usuario_id' => $this->input->post('usuraio_id'),
            'motorista_id' => $this->input->post('motorista_id'),
            'voucher' => $this->input->post('voucher'),
            'data' => $this->input->post('data'),
            'valor' => base64_encode($this->input->post('valor')),
            'observacao' => $this->input->post('observacao')
        );
        $this->acessos_model->save_acesso($data);
        echo json_encode(array("status" => TRUE));
    }

    public function historico_update() {
        $this->acesso_validate();
        $data = array(
            'usuario_id' => $this->input->post('usuraio_id'),
            'motorista_id' => $this->input->post('motorista_id'),
            'voucher' => $this->input->post('voucher'),
            'data' => $this->input->post('data'),
            'valor' => base64_encode($this->input->post('valor')),
            'observacao' => $this->input->post('observacao')
        );
        $this->acessos_model->update_acesso(array('id_historico' => $this->input->post('id_historico')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function historico_edit($id) {
        $data = $this->acessos_model->edit_acesso($id);
        echo json_encode($data);
    }

    public function historico_delete($id) {
        $this->acessos_model->delete_acesso($id);
        echo json_encode(array("status" => TRUE));
    }

    private function historico_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('voucher') == '') {
            $data['inputerror'][] = 'voucher';
            $data['error_string'][] = 'Insira o numero do voucher';
            $data['status'] = FALSE;
        }

        if($this->input->post('data') == '') {
            $data['inputerror'][] = 'data';
            $data['error_string'][] = 'Selecione a data da corrida';
            $data['status'] = FALSE;
        }

        if($this->input->post('valor') == '') {
            $data['inputerror'][] = 'valor';
            $data['error_string'][] = 'Insira o valor da corrida';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Voucher.php */
/* Location: ./application/controllers/gerencias/Voucher.php */