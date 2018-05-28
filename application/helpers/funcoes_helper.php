<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Carrega um modulo do sistema devolvendo a tela solicitada
function load_modulo($modulo=NULL, $tela=NULL, $diretorio=NULL){
    $CI =& get_instance();
    if ($modulo!=NULL || $diretorio!=NULL) {
        return $CI->load->view("$diretorio/$modulo", array('tela'=>$tela), TRUE);
    } else {
        return FALSE;
    }
}

    //seta valores ao array  $tema da class sistema
function set_tema($prop, $valor, $replace=TRUE){
    $CI =& get_instance();
    $CI->load->library('sistema');
    if ($replace){
        $CI->sistema->tema[$prop] = $valor;
    }
    else{
        if (!isset($CI->sistema->tema[$prop])) $CI->sistema->tema[$prop] = '';
        $CI->sistema->tema[$prop] .= $valor;
    }
}

//retorna os valores do array $tema da classe sistema
function get_tema(){
    $CI =& get_instance();
    $CI->load->library('sistema');
    return $CI->sistema->tema;
}

//carrega um template passando o array $tema como paramentro
function load_template(){
    $CI =& get_instance();
    $CI->load->library('sistema');
    $CI->parser->parse($CI->sistema->tema['template'],  get_tema());
}


// funcão que printa e finaliza a execução.
function pr($valor){
    echo "<pre>";
    print_r($valor);
    echo "</pre>";
    die();
}

function vd($valor){
    echo "<pre>";
    var_dump($valor);
    echo "</pre>";
    die();
}


/**
* Converts bytes into human readable file size.
*
//* @param string $bytes
//* @return string human readable file size (2,87 Мб)
//* @author Mogilev Arseny
//* @url http://php.net/manual/pt_BR/function.filesize.php
*/
function FileSizeConvert($bytes) {
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT"  => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT"  => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT"  => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT"  => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT"  => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem) {
        if($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}