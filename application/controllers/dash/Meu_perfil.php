<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meu_perfil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('usuario_model');
    }

    public function index() {
        $this->output->enable_profiler(FALSE);

        $css['headerinc'] = '
            <link href="'.base_url().'assets/pages/css/profile.css" rel="stylesheet" type="text/css" />';
        $script['script'] = '';
        $script['footerinc'] = '';
        // $script['footerinc'] = '<script src="'.base_url().'assets/pages/scripts/profile.js" type="text/javascript"></script>';

        $username = $this->session->userdata('username');
        $user = array("username" => $username);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Meu perfil</span>', 'dash/meu_perfil');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/meu_perfil');
        $this->load->view('template/footer',$script);
    }

    public function configuracao() {
        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/pages/css/profile.css" rel="stylesheet" type="text/css" />';
        $script['script'] = '';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>';
        // $script['footerinc'] = '<script src="'.base_url().'assets/pages/scripts/profile.js" type="text/javascript"></script>';

        $username = $this->session->userdata('username');
        $id_user = $this->usuario_model->id_user($username);
        $usuario = $this->usuario_model->listar_usuarios($id_user->id_usuario);
        $telefone = $this->usuario_model->user_telefone($id_user->id_usuario,1);
        $celular = $this->usuario_model->user_telefone($id_user->id_usuario,2);
        $voip = $this->usuario_model->user_telefone($id_user->id_usuario,4);
        // vd($celular);
        $modulo = $this->usuario_model->listar_modulos($id_user->id_usuario);
        $data = array('usuario' => $usuario->row(), 'telefone' => $telefone, 'celular' => $celular, 'voip' => $voip, 'modulo' => $modulo);

        $user = array("username" => $username);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Meu perfil</span>', 'dash/meu_perfil');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/configuracao', $data);
        $this->load->view('template/footer',$script);
    }


    public function ajuda() {
        $css['headerinc'] = '
            <link href="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
            <link href="'.base_url().'assets/pages/css/profile.css" rel="stylesheet" type="text/css" />';
        $script['script'] = '';
        $script['footerinc'] = '
            <script src="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>';
        // $script['footerinc'] = '<script src="'.base_url().'assets/pages/scripts/profile.js" type="text/javascript"></script>';

        $username = $this->session->userdata('username');
        $user = array("username" => $username);

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Meu perfil</span>', 'dash/meu_perfil');


        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$user);
        $this->load->view('template/sidebar');
        $this->load->view('dashboard/ajuda');
        $this->load->view('template/footer',$script);
    }

}

/* End of file Meu_perfil.php */
/* Location: ./application/controllers/dash/Meu_perfil.php */