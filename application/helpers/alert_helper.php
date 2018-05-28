<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//define uma mensagem para ser exibida na proxima tela carregada.
function set_msg($id='msgerro', $msg=NULL, $tipo='erro'){
    $CI =& get_instance();
    switch ($tipo):
        case 'erro':
            $CI->session->set_flashdata($id, '<div class="custom-alerts alert alert-danger fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'.$msg.'</div>');
            break;
        case 'sucesso':
            $CI->session->set_flashdata($id, '<div class="custom-alerts alert alert-success fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'.$msg.'</div>');
            break;
        case 'alerta':
            $CI->session->set_flashdata($id, '<div class="custom-alerts alert alert-warring fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'.$msg.'</div>');
            break;
        default:
            $CI->session->set_flashdata($id, '<div class="custom-alerts alert alert-info fade in" id="myAlert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>'.$msg.'</div>');
            break;
    endswitch;
}

//verifica se existe uma mensagem para ser exibida na tela atual.
function get_msg($id='msgerro', $printar=TRUE){
    $CI =& get_instance();
    if ($CI->session->flashdata($id)):
        if ($printar):
            echo $CI->session->flashdata($id);
            return TRUE;
        else:
            return $CI->session->flashdata($id);
        endif;
    endif;
    return FALSE;
}
/* End of file alert_helper.php */
/* Location: ./application/helpers/alert_helper.php */