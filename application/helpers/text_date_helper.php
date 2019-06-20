<?php

    function text_date($value=''){
        $info = array_map('trim',explode(" ",$value));
                $segundo = 0;
                $minuto = 0;
                $hora = 0;
                $dia = 0;
            foreach ($info as $key => $value) {
                if(preg_match('/s$/', $value)){
                    $segundo = $value;
                    // echo "segundo".$segundo." ";
                }
                if(preg_match('/min$/', $value)){
                    $minuto = $value*60;
                    // echo $minuto." ";//3120
                }
                if(preg_match('/h$/',$value)){
                    $hora = $value*3600;
                    // echo $hora." ";//25200
                }
                if(preg_match('/d$/',$value)){
                    $dia = $value*86400;
                    // echo $dia." ";
                }
            }
                $timestamp = $dia+$hora+$minuto+$segundo;
                return $timestamp;
    }


 ?>