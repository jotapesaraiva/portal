<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumo_model extends CI_Model {

    public function consumo_atual(){
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('*,date_format(periodo_final,"%d/%m/%Y %H:%m") as periodo_final');
        $portal_moni->from('tbl_ebt_consumo_banda');
        $portal_moni->where('periodo_final','select max(periodo_final from tbl_ebt_consumo_banda');
        $portal_moni->order_by('Porcentagem','DESC');
        // $portal_moni->limit(0,100);
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


}

/* End of file Consumo_banda.php */
/* Location: ./application/models/Consumo_banda.php */