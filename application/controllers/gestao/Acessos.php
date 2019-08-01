<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acessos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //Do your magic here
        esta_logado();
    }

    public function index() {
        $this->output->enable_profiler(FALSE);
        $script['footerinc'] = '
            <script src="' . base_url() . 'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
            <script src="' . base_url() . 'assets/custom/gestao/senhas.js" type="text/javascript"></script>';
        $script['script'] = '';
        $css['headerinc'] = '
            <link href="' . base_url() . 'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
            <link href="' . base_url() . 'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Gestão</span>', '/gestao');
        $this->breadcrumbs->push('<span>Acessos</span>', '/gestao/acessos');

        $this->load->view('template/header', $css);
        $this->load->view('template/navbar', $session);
        $this->load->view('template/sidebar');

        $data['servidor'] = $this->table_servidor();
        $data['servico'] = $this->table_servico();

        $this->load->view('gestao/acessos', $data);
        $this->load->view('modal/modal_acessos');

        $this->load->view('template/footer', $script);

    }

    public function teste() {
        $servidor =  $this->acessos_model->servidor_acesso();
        vd($servidor->result());
    }

    public function table_servidor() {
        $servidores = $this->acessos_model->servidor_acesso();
        $html = "";
        foreach ($servidores->result() as $servidor) {
            $html .= "<tr>\n";
            $html .= "  <td>".$servidor->id."</td>\n";
            $html .= "  <td>".$servidor->nome."</td>\n";
            $html .= "  <td>".$servidor->ip_servidor."</td>\n";
            $html .= "  <td>".$servidor->responsavel."</td>\n";
            $html .= "  <td>".$servidor->usuario."</td>\n";
            $html .= "  <td>
                            <input id=password-field-".$servidor->id." class='form-control' type='password' value='".base64_decode($servidor->senha)."'>
                        </td>\n";
            if(acesso_admin()):
            $html .= "  <td>
                            <a class='btn blue btn-outline sbold toggle-password' title='Exibir' toggle='#password-field-".$servidor->id."'>
                                <i class='fa fa-fw fa-eye field-icon '></i> Exibir
                            </a>
                            <a class='btn yellow-mint btn-outline sbold' href='javascript:void(0)' title='Edit' onclick='edit_acesso(".$servidor->id.")'>
                                <i class='glyphicon glyphicon-pencil'></i> Editar
                            </a>
                            <a class='btn red-mint btn-outline sbold' href='javascript:void(0)' title='Deletar' onclick='delete_acesso(".$servidor->id.")'>
                                <i class='glyphicon glyphicon-trash'></i> Deletar
                            </a>
                        </td>\n";
            else:
                $html .= "<td>Sem permissão</td>\n";
            endif;
            $html .= "</tr>\n";
        }
        return $html;
    }

    public function table_servico() {
        $servidores = $this->acessos_model->servico_acesso();
        $html = "";
        foreach ($servidores->result() as $servidor) {
            $html .= "<tr>\n";
            $html .= "  <td>".$servidor->id."</td>\n";
            $html .= "  <td>".$servidor->nome."</td>\n";
            $html .= "  <td>".$servidor->ip_servidor."</td>\n";
            $html .= "  <td>".$servidor->responsavel."</td>\n";
            $html .= "  <td>".$servidor->usuario."</td>\n";
            $html .= "  <td>
                            <input id=password-field-".$servidor->id." class='form-control' type='password' value='".base64_decode($servidor->senha)."'>
                        </td>\n";
            if(acesso_admin()):
            $html .= "  <td>
                            <a class='btn blue btn-outline sbold toggle-password' title='Exibir' toggle='#password-field-".$servidor->id."'>
                                <i class='fa fa-fw fa-eye field-icon '></i> Exibir
                            </a>
                            <a class='btn yellow-mint btn-outline sbold' href='javascript:void(0)' title='Edit' onclick='edit_acesso(".$servidor->id.")'>
                                <i class='glyphicon glyphicon-pencil'></i> Editar
                            </a>
                            <a class='btn red-mint btn-outline sbold' href='javascript:void(0)' title='Deletar' onclick='delete_acesso(".$servidor->id.")'>
                                <i class='glyphicon glyphicon-trash'></i> Deletar
                            </a>
                        </td>\n";
            else:
                $html .= "<td>Sem permissão</td>\n";
            endif;
            $html .= "</tr>\n";
        }
        return $html;
    }

    public function acesso_add() {
        $this->acesso_validate();
        $data = array(
            'nome' => $this->input->post('nome'),
            'ip_servidor' => $this->input->post('acesso'),
            'responsavel' => $this->input->post('responsavel'),
            'usuario' => $this->input->post('usuario'),
            'senha' => base64_encode($this->input->post('senha')),
            'tipo' => $this->input->post('tipo')
        );
        $this->acessos_model->save_acesso($data);
        echo json_encode(array("status" => TRUE));
    }

    public function acesso_update() {
        $this->acesso_validate();
        $data = array(
            'nome' => $this->input->post('nome'),
            'ip_servidor' => $this->input->post('acesso'),
            'responsavel' => $this->input->post('responsavel'),
            'usuario' => $this->input->post('usuario'),
            'senha' => base64_encode($this->input->post('senha')),
            'tipo' => $this->input->post('tipo')
        );
        $this->acessos_model->update_acesso(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function acesso_edit($id) {
        $data = $this->acessos_model->edit_acesso($id);
        echo json_encode($data);
    }

    public function acesso_delete($id) {
        $this->acessos_model->delete_acesso($id);
        echo json_encode(array("status" => TRUE));
    }

    private function acesso_validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nome') == '') {
            $data['inputerror'][] = 'nome';
            $data['error_string'][] = 'O campo nome é obrigatorio';
            $data['status'] = FALSE;
        }

        if($this->input->post('acesso') == '') {
            $data['inputerror'][] = 'acesso';
            $data['error_string'][] = 'Selecione uma empresa';
            $data['status'] = FALSE;
        }

        if($this->input->post('responsavel') == '') {
            $data['inputerror'][] = 'responsavel';
            $data['error_string'][] = 'Selecione uma empresa';
            $data['status'] = FALSE;
        }

        if($this->input->post('usuario') == '') {
            $data['inputerror'][] = 'usuario';
            $data['error_string'][] = 'Selecione uma empresa';
            $data['status'] = FALSE;
        }

        if($this->input->post('senha') == '') {
            $data['inputerror'][] = 'senha';
            $data['error_string'][] = 'Selecione uma empresa';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

/* End of file Acessos.php */
/* Location: ./application/controllers/gestao/Acessos.php */