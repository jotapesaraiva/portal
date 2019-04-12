<?php

    function date_start() {
        //retorna a data inicio da mes atual
         return date('d/m/Y', mktime(0, 0, 0, date('m') , 1 , date('Y')));
    }

    function date_end() {
        //retorno a data final do mes atual
       return date('d/m/Y', mktime(23, 59, 59, date('m'), date("t"), date('Y')));
    }


 ?>