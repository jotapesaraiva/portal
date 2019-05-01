<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//seta um registro na tabela de auditoria
function auditoria($operacao, $obs, $query=TRUE){
    $CI =& get_instance();
    $CI->load->library('session');
    $CI->load->model('auditoria_model');
    $CI->load->database('default',true);
    // $CI->load->model('usuario_model');
    // if (esta_logado(FALSE)):
    $user_login = $CI->session->userdata('username');
    if (isset($user_login)):
        // $user_id = $CI->session->userdata('user_id');
        // $user_login = $CI->usuario_model->get_byid($user_id)->row()->login;
        // $user_login = $CI->session->userdata('username');
        $user_login;
    else:
         $user_login = 'Desconhecido';
    endif;
    if($query):
        $last_query = $CI->db->last_query();
    else:
        $last_query = ' ';
    endif;
    $dados = array(
        'usuario' => $user_login,
        'operacao' => $operacao,
        'query' => $last_query,
        'observacao' => $obs,
        );
    $CI->auditoria_model->do_insert($dados);
}
/* End of file auditoria_helper.php */
/* Location: ./application/helpers/auditoria_helper.php */
 ?>
