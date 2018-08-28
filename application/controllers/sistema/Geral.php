<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Geral extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->config('config');
        $this->load->model('link_model');
        $this->load->model('unidade_model');
        $this->load->model('voip_model');
        $this->load->model('telefonia_model');
        $this->load->library('Auth_AD');
        if($this->auth_ad->is_authenticated()){
            $username = $this->session->userdata('username');
        } else {
            // $data = array('error_message' => 'Efetue o login para acessar o sistema');
            set_msg('loginErro','Efetue o login para acessar o sistema','erro');
            redirect('auth/logout');
        }
    }
     public function index() {
        // $this->config();
        $base_site        = $this->config->item('base_url');
        $index_file       = $this->config->item('index_page');
        $uri_pro          = $this->config->item('uri_protocol');
        $default_language = $this->config->item('language');
        $charset          = $this->config->item('charset');
        $hook             = $this->config->item('enable_hooks');
        $extension_pre    = $this->config->item('subclass_prefix');
        $compose          = $this->config->item('composer_autoload');

        $log_threshold        = $this->config->item('log_threshold');
        $log_path             = $this->config->item('log_path');
        $log_file_extension   = $this->config->item('log_file_extension');
        $log_file_permissions = $this->config->item('log_file_permissions');
        $log_date_format      = $this->config->item('log_date_format');
        $error_views_path     = $this->config->item('error_views_path');

        $cache_path         = $this->config->item('cache_path');
        $cache_query_string = $this->config->item('cache_query_string');

        $sess_driver             = $this->config->item('sess_driver');
        $sess_cookie_name        = $this->config->item('sess_cookie_name');
        $sess_expiration         = $this->config->item('sess_expiration');
        $sess_save_path          = $this->config->item('sess_save_path');
        $sess_match_ip           = $this->config->item('sess_match_ip');
        $sess_time_to_update     = $this->config->item('sess_time_to_update');
        $sess_regenerate_destroy = $this->config->item('sess_regenerate_destroy');

        $cookie_prefix   = $this->config->item('cookie_prefix');
        $cookie_domain   = $this->config->item('cookie_domain');
        $cookie_path     = $this->config->item('cookie_path');
        $cookie_secure   = $this->config->item('cookie_secure');
        $cookie_httponly = $this->config->item('cookie_httponly');

        $csrf_protection   =  $this->config->item('$csrf_protection');
        $csrf_token_name   =  $this->config->item('$csrf_token_name');
        $csrf_cookie_name  =  $this->config->item('$csrf_cookie_name');
        $csrf_expire       =  $this->config->item('$csrf_expire');
        $csrf_regenerate   =  $this->config->item('$csrf_regenerate');
        $csrf_exclude_uris =  $this->config->item('$csrf_exclude_uris');

        $standardize_newlines = $this->config->item('standardize_newlines');
        $global_xss_filtering = $this->config->item('global_xss_filtering');
        $encryption_key       = $this->config->item('encryption_key');
        $compress_output      = $this->config->item('compress_output');

        $time_reference      = $this->config->item('time_reference');
        $rewrite_short_tags  = $this->config->item('rewrite_short_tags');
        $proxy_ips           = $this->config->item('proxy_ips');
        $allow_get_array     = $this->config->item('allow_get_array');
        $permitted_uri_chars = $this->config->item('permitted_uri_chars');

        $enable_query_strings = $this->config->item('enable_query_strings');
        $controller_trigger   = $this->config->item('controller_trigger');
        $function_trigger     = $this->config->item('function_trigger');
        $directory_trigger    = $this->config->item('directory_trigger');

        $css['headerinc']    = '';
        $script['footerinc'] = '';
        $script['script']    = '';
        $dados = array(
            'base_site'        => $base_site,
            'index_file'       => $index_file,
            'uri_pro'          => $uri_pro,
            'default_language' => $default_language,
            'charset'          => $charset,
            'hook'             => $hook,
            'extension_pre'    => $extension_pre,
            'compose'          => $compose,

            'log_threshold'        => $log_threshold,
            'log_path'             => $log_path,
            'log_file_extension'   => $log_file_extension,
            'log_file_permissions' => $log_file_permissions,
            'log_date_format'      => $log_date_format,
            'error_views_path'     => $error_views_path,

            'cache_path'         => $cache_path,
            'cache_query_string' => $cache_query_string,

            'sess_driver'             => $sess_driver,
            'sess_cookie_name'        => $sess_cookie_name,
            'sess_expiration'         => $sess_expiration,
            'sess_save_path'          => $sess_save_path,
            'sess_match_ip'           => $sess_match_ip,
            'sess_time_to_update'     => $sess_time_to_update,
            'sess_regenerate_destroy' => $sess_regenerate_destroy,

            'cookie_prefix'   => $cookie_prefix,
            'cookie_domain'   => $cookie_domain,
            'cookie_path '    => $cookie_path,
            'cookie_secure'   => $cookie_secure,
            'cookie_httponly' => $cookie_httponly,

            'csrf_protection'   => $csrf_protection,
            'csrf_token_name'   => $csrf_token_name,
            'csrf_cookie_name'  => $csrf_cookie_name,
            'csrf_expire'       => $csrf_expire,
            'csrf_regenerate'   => $csrf_regenerate,
            'csrf_exclude_uris' => $csrf_exclude_uris,

           ' standardize_newlines' => $standardize_newlines,
           ' global_xss_filtering' => $global_xss_filtering,
           ' encryption_key'       => $encryption_key,
           ' compress_output'      => $compress_output,

           'time_reference'      => $time_reference,
           'rewrite_short_tags'  => $rewrite_short_tags,
           'proxy_ips'           => $proxy_ips,
           'allow_get_array'     => $allow_get_array,
           'permitted_uri_chars' => $permitted_uri_chars,

           'enable_query_strings' => $enable_query_strings,
           'controller_trigger'   => $controller_trigger,
           'function_trigger'     => $function_trigger,
           'directory_trigger'    => $directory_trigger,

        );
        $session['username'] = $this->session->userdata('username');

        $this->breadcrumbs->unshift('<i class="icon-home"></i> Home', 'portal');
        $this->breadcrumbs->push('<span>Sitema</span>', '/sistema;');
        $this->breadcrumbs->push('<span>Geral</span>', '/sistema/geral');

        $this->load->view('template/header',$css);
        $this->load->view('template/navbar',$session);
        $this->load->view('template/sidebar');

        $this->load->view('sistema/geral',$dados);

        $this->load->view('template/footer',$script);
     }
}

/* End of file Geral.php */
/* Location: ./application/controllers/sistema/Geral.php */