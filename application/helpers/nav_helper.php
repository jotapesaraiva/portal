<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('active_directory')) {
    function active_directory($controller) {
        $CI =& get_instance();
        $directory = $CI->router->fetch_directory();
        return ($directory == $controller) ? 'active open' : '';
    }
}

if ( ! function_exists('active_class')) {
    function active_class($controller) {
        $CI =& get_instance();
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? 'active open' : '';
    }
}

if ( ! function_exists('active_method')) {
    function active_method($controller) {
        $CI =& get_instance();
        $method = $CI->router->fetch_method();
        return ($method == $controller) ? 'active open' : '';
    }
}




if ( ! function_exists('span_class')) {
    function span_class($controller){
        $CI =& get_instance();
        $class = $CI->router->fetch_class();
        return ($class == $controller) ? '<span class="selected"></span>' : '';
    }
}

if ( ! function_exists('span_method')) {
    function span_method($controller){
        $CI =& get_instance();
        $method = $CI->router->fetch_method();
        return ($method == $controller) ? '<span class="selected"></span>' : '';
    }
}



if ( ! function_exists('active_segment')) {
    function active_segment($segmento,$name){
        $CI =& get_instance();
        $method = $CI->uri->segment($segmento);
        return ($method == $name) ? 'active open' : '';
    }
}


if ( ! function_exists('span_segment')) {
    function span_segment($segmento,$name){
        $CI =& get_instance();
        $method = $CI->uri->segment($segmento);
        return ($method == $name) ? '<span class="selected"></span>' : '';
    }
}