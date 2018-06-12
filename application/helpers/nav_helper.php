<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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