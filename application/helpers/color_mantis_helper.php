<?php
if ( ! function_exists('color_mantis')){
    function color_mantis($color) {
        $array_color = array(
            50 => "primary",//atribuido-azul
            10 => "danger",//novo-vermelho
            20 => "retorno",//retorno-vermelho escuro
            40 => "autorizado",//autorizado-amarelo
            30 => "impedido",//impedido-roxo
            80 => "success",//realizado-laranja
            90 => "default",//indeferido cinza
            60 => "warning"//resolvido- verde green-meadow  green-haze
        );
        return $array_color[$color];
    }
}
