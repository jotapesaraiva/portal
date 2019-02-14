<?php
if ( ! function_exists('color_mantis')){
    function color_mantis($color) {
        $array_color = array(
            15 => "analise",//analise-
            10 => "novo",//novo-vermelho
            50 => "atribuido",//atribuido-azul
            20 => "retorno",//retorno-vermelho escuro
            40 => "autorizado",//autorizado-amarelo
            45 => "notificado",//notificado-amarelo
            30 => "impedido",//impedido-roxo
            70 => "inconcluso",//inconcluso-
            80 => "resolvido",//realizado-laranja
            90 => "indeferido",//indeferido cinza
            60 => "realizado"//resolvido- verde green-meadow  green-haze
        );
        return $array_color[$color];
    }
}
