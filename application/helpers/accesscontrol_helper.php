<?php defined('BASEPATH') OR exit('No direct script access allowed');
    //verifica se o usuario esta logado no sistema
if ( ! function_exists('esta_logado')){
    function esta_logado(){
        $CI =& get_instance();
        $CI->load->library('session');
        if($CI->auth_ad->is_authenticated()) {
            if($CI->auth_ad->level_access($CI->uri->segment(2),$CI->session->userdata('physicaldeliveryofficename'))){
                $username = $CI->session->userdata('username');
            } else {
                set_msg('loginErro','Você não tem acesso a esse modulo.','erro');
                redirect('welcome');
            }
        } else {
          // $data = array('error_message' => 'Efetue o login para acessar o sistema');
          set_msg('loginErro','Efetue o login para acessar o sistema','erro');
          redirect('auth/logout');
        }
    }
}


if ( ! function_exists('minhas_tarefas')){
    function minhas_tarefas() {
        $CI =& get_instance();
        $CI->load->library('session');
        $CI->load->model('menu_model');
        $tarefas = $CI->menu_model->minhas_tarefas($CI->session->userdata('username'));
        return $tarefas->TAREFAS;
    }
}


/* End of file accessControl_helper.php */
/* Location: ./application/helpers/accessControl_helper.php */