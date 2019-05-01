<?php defined('BASEPATH') OR exit('No direct script access allowed');
    //verifica se o usuario esta logado no sistema
if ( ! function_exists('esta_logado')){
    function esta_logado(){
        $CI =& get_instance();
        $CI->load->library('session');
        if($CI->auth_ad->is_authenticated()) {
            if($CI->auth_ad->level_access($CI->uri->segment(2),$CI->session->userdata('physicaldeliveryofficename'))){
                $username = $CI->session->userdata('username');
                return TRUE;
            } else {
                set_msg('loginErro','Você não tem acesso a esse modulo.','erro');
                redirect('auth/login');
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

if ( ! function_exists('image_upload')) {
    function image_upload($name) {
        $CI =& get_instance();
        $CI->load->helper('file');
        $name = str_replace(".", "_", $name);
        $thumbinfo = get_file_info('./uploads/'.$name.'.jpg');
        if ($thumbinfo != FALSE):
            $retorno = base_url('uploads/'.$name.'.jpg');
        else:
            $retorno = base_url('uploads/no-image.jpg');
        endif;
        return $retorno;
    }
}

if ( ! function_exists('thumbnail_upload')) {
    function thumbnail_upload($name) {
        $CI =& get_instance();
        $CI->load->helper('file');
        $name = str_replace(".", "_", $name);
        $thumbinfo = get_file_info('./uploads/thumbs/29x29_'.$name.'_thumb.jpg');
        if ($thumbinfo != FALSE):
            $retorno = base_url('uploads/thumbs/29x29_'.$name.'_thumb.jpg');
        else:
            $retorno = base_url('uploads/thumbs/no-image.jpg');
        endif;
        return $retorno;
    }

}
/* End of file accessControl_helper.php */
/* Location: ./application/helpers/accessControl_helper.php */