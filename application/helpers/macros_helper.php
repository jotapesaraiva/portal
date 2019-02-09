<?php
if ( ! function_exists('macros')){
    function macros($string) {
        return str_replace(search_macro(),replace_macro(), $string);
    }
}

if ( ! function_exists('search_macro')){
    function search_macro(){
            $search = array(
                '{$EMAIL_CGDA}',
                '{$EMAIL_CGPS}',
                '{$EMAIL_GC}',
                '{$EMAIL_INFRA}',
                '{$EMAIL_PRODUCAO}',
                '{$EMAIL_REDES}',
                '{$HOST.IP}',
                '{$OBS1}',
                '{$PLANO_ACAO1}',
                '{$RAMAL_CGDA}',
                '{$RAMAL_GC}',
                '{$RAMAL_INFRA}',
                '{$RAMAL_PRODUCAO}',
                '{$RAMAL_REDES}',
                '{$RESP_CGDA}',
                '{$RESP_GC}',
                '{$RESP_INFRA}',
                '{$RESP_PRODUCAO}',
                '{$RESP_REDES}'
             );
        return $search;
    }
}
if ( ! function_exists('replace_macro')){
    function replace_macro(){
        $replace = array(
            'Email: grupo-dba-monitoramento@sefa.pa.gov.br',
            'Email: grupo-cgps-sustentacao@sefa.pa.gov.br',
            'Email: grupo-dti-gestao-configuracao@sefa.pa.gov.br',
            'Email: infra@sefa.pa.gov.br',
            'Email: producao@sefa.pa.gov.br',
            'Email: rede@sefa.pa.gov.br',
            '?????',
            'Observação: Fora do horário comercial registrar Mantis para a equipe da CGDA e acionar o SOBREAVISO.',
            'Plano de Ação: Registrar ocorrência e acionar a equipe responsável.',
            'Ramal: 4339',
            'Ramal: 4003',
            'Ramal: 4297',
            'Ramal: 4994/4984',
            'Ramal: 4446/4969/4354',
            'Equipe Responsável: CGDA',
            'Equipe Responsável: CGPS - Gestão de Configuração (Horário Comercial)',
            'Equipe Responsável: Infraestrutura de Redes',
            'Equipe Responsável: CGRE - Produção',
            'Equipe Responsável: CGRE');
        return $replace;
    }
}