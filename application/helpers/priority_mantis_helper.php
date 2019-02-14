<?php
if ( ! function_exists('priority_mantis')){
    function priority_mantis($color) {
        $array_color = array(
            30 => "success",//normal-verde
            40 => "autorizado",//alta-amarelo
            50 => "warning",//urgente-laranja
            60 => "danger"//imediato-vermelho
        );
        return $array_color[$color];
    }
}

if ( ! function_exists('priority_name')){
    function priority_name($name) {
        $array_name = array(
            30 => "normal",//normal-verde
            40 => "alta",//alta-amarelo
            50 => "urgente",//urgente-laranja
            60 => "imediato"//imediato-vermelho
        );
        return $array_name[$name];
    }
}