<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    function acesso_admin() {
        $CI =& get_instance();
        $CI->load->model('usuario_model');
        $user_login = $CI->session->userdata('username');
        $permissao = $CI->usuario_model->permissao($user_login)->row()->id_permissao;
        if($permissao > 1):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    function acesso_super_admin() {
        $CI =& get_instance();
        $CI->load->model('usuario_model');
        $user_login = $CI->session->userdata('username');
        $permissao = $CI->usuario_model->permissao($user_login)->row()->id_permissao;
        if($permissao == 3):
            return TRUE;
        else:
            return FALSE;
        endif;
    }


/* End of file level_access_helper.php */
/* Location: ./application/helpers/level_access_helper.php */
?>