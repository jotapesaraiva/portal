<?php
function dataPtBrParaMysql($dataPtBr) {
    $partes = explode("/", $dataPtBr);
    return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
}

function dataMysqlParaPtBr($dataMysql) {
    $data = new DateTime($dataMysql);
    return $data->format("d/m/Y");
}

function dataEmPortugues($nmes){
        if(($nmes)==1){
            $mes = "Janeiro";
        }elseif(($nmes)==2){
            $mes = "Fevereiro";
        }elseif(($nmes)==3){
            $mes = "Março";
        }elseif(($nmes)==4){
            $mes = "Abril";
        }elseif(($nmes)==5){
            $mes = "Maio";
        }elseif(($nmes)==6){
            $mes = "Junho";
        }elseif(($nmes)==7){
            $mes = "Julho";
        }elseif(($nmes)==8){
            $mes = "Agosto";
        }elseif(($nmes)==9){
            $mes = "Setembro";
        }elseif(($nmes)==10){
            $mes = "Outubro";
        }elseif(($nmes)==11){
            $mes = "Novembro";
        }elseif(($nmes)==12){
            $mes = "Dezembro";
        }else{
            $mes = "";
        }
        return $mes;
}


?>