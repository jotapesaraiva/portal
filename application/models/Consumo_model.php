<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumo_model extends CI_Model {

    public function consumo_atual($interval=null){
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('max(periodo_final)')->from('tbl_ebt_consumo_banda');
        $subQuery = $portal_moni->get_compiled_select();
        if($interval == null){
            $portal_moni->select('*,date_format(periodo_final,"%d/%m/%Y %H:%m") as periodo_final');
            $portal_moni->from('tbl_ebt_consumo_banda');
            $portal_moni->where('periodo_final=('.$subQuery.')',null,FALSE);
            $portal_moni->order_by('Porcentagem','DESC');
            $portal_moni->limit(100,0);
        } else{
            $portal_moni->select('*,date_format(periodo_final,"%d/%m/%Y %H:%m") as periodo_final,
            ROUND(AVG(Porcentagem), 2)  as Porcentagem,
            ROUND(AVG(entrada_media), 2)  as entrada_media,
            ROUND(AVG(entrada_maxima), 2)  as entrada_maxima,
            ROUND(AVG(saida_media), 2)  as saida_media,
            ROUND(AVG(saida_maxima), 2)  as saida_maxima');
            $portal_moni->from('tbl_ebt_consumo_banda');
            $portal_moni->where('periodo_final between (DATE_SUB(('.$subQuery.'),INTERVAL '.$interval.' ))',null,FALSE);
            $portal_moni->where('('.$subQuery.')',null,FALSE);
            $portal_moni->group_by('localidade');
            $portal_moni->order_by('Porcentagem','DESC');
            $portal_moni->limit(100,0);
        }
        $query = $portal_moni->get();
        return $query;
    }
// select *,date_format(periodo_final,'%d/%m/%Y %H:%m') as periodo_final
//         from tbl_ebt_consumo_banda
//         where periodo_final=(
//             select max(periodo_final)
//             from tbl_ebt_consumo_banda )
//         ORDER BY Porcentagem DESC
//         LIMIT 0 , 100

    // select *,date_format(periodo_final,'%d/%m/%Y %H:%m') as periodo_final,
    //         ROUND(AVG(Porcentagem), 2)  as Porcentagem,
    //         ROUND(AVG(entrada_media), 2)  as entrada_media,
    //         ROUND(AVG(entrada_maxima), 2)  as entrada_maxima,
    //         ROUND(AVG(saida_media), 2)  as saida_media,
    //         ROUND(AVG(saida_maxima), 2)  as saida_maxima
    //         from tbl_ebt_consumo_banda
    //         WHERE periodo_final between (DATE_SUB((SELECT MAX(periodo_final)FROM tbl_ebt_consumo_banda ),INTERVAL 1 HOUR ))
    //         and (SELECT MAX(periodo_final) FROM tbl_ebt_consumo_banda )
    //         group by localidade
    //         ORDER BY Porcentagem DESC
    //         LIMIT 0,100

    public function consumo_unidade($unidade,$interval=null) {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('max(periodo_final)')->from('tbl_ebt_consumo_banda');
        $subQuery = $portal_moni->get_compiled_select();
        $portal_moni->select('*,date_format(periodo_final,"%d/%m/%Y %H:%m") as periodo_final, ROUND(AVG(Porcentagem), 2)  as Percent');
        $portal_moni->from('tbl_ebt_consumo_banda');
        if($interval == null){
            $portal_moni->where('periodo_final=('.$subQuery.')',null,FALSE);
        } else {
            $portal_moni->where('periodo_final between (DATE_SUB(('.$subQuery.'),INTERVAL '.$interval.' ))',null,FALSE);
            $portal_moni->where('('.$subQuery.')',null,FALSE);
        }
        $portal_moni->where('localidade',$unidade);
        $query = $portal_moni->get();
        return $query->row();
    }


    // select *,date_format(periodo_final,'%d/%m/%Y %H:%m') as periodo_final,
    // ROUND(AVG(Porcentagem), 2)  as Porcentagem
    // from tbl_ebt_consumo_banda
    // WHERE periodo_final between (DATE_SUB((SELECT MAX(periodo_final)FROM tbl_ebt_consumo_banda ),INTERVAL 1 HOUR ))
    // and (SELECT MAX(periodo_final) FROM tbl_ebt_consumo_banda )
    // and localidade = '".$unidade."'
    // group by localidade
    // ORDER BY Porcentagem DESC
    // LIMIT 0,100

}

/* End of file Consumo_banda.php */
/* Location: ./application/models/Consumo_banda.php */