<?php

if ( ! function_exists('numero_equipe')){

    function numero_equipe($name) {
        switch ($name) {
            case 'CGRE-Produção':
                $equipe = 4041;
                return $equipe;
                break;
            case 'CGRE-InfraEstrutura':
                $equipe = 3861;
                return $equipe;
                break;
            case 'CGRE-Rede':
                $equipe = 3921;
                return $equipe;
                break;
            case 'CGPS':
                $equipe = '341,4161';
                return $equipe;
                break;
            case 'CGDA-Banco':
                $equipe = 4001;
                return $equipe;
                break;
            case 'DTI-GERENTES':
                $equipe = '2342,3441';
                return $equipe;
                break;
            default:
                $equipe = '1921,3841';
                return $equipe;
                break;
        }
    }

}

 ?>