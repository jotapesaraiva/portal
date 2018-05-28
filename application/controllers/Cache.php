<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cache extends CI_Controller {


    public function index() {
        // $this->load->view('login');
        // echo "base url " .base_url(). "<br>";
        // echo "site url " .site_url(). "<br>";
        // echo "current url " .current_url(). "<br>";
        // echo "uri string " .uri_string(). "<br>";
        // echo "index page " .index_page(). "<br>";
        // echo "config " .$_SERVER['HTTP_HOST']. "<br>";
        // echo 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>';
        $this->load->view('teste/teste');
    }

    public function clear_path_cache($uri) {
        $CI =& get_instance();
    $path = $CI->config->item('cache_path');

        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $uri =  $CI->config->item('base_url').
        $CI->config->item('index_page').
        $uri;
    $cache_path .= md5($uri);

        return @unlink($cache_path);
    }

    /**
     * Clears all cache from the cache directory
     */
    public function clear_all_cache() {
    $CI =& get_instance();
    $path = $CI->config->item('cache_path');

        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $handle = opendir($cache_path);
        while (($file = readdir($handle))!== FALSE)
        {
            //Leave the directory protection alone
            if ($file != '.htaccess' && $file != 'index.html')
            {
               @unlink($cache_path.'/'.$file);
            }
        }
        closedir($handle);
    }



}

/* End of file Cache.php */
/* Location: ./application/controllers/Cache.php */