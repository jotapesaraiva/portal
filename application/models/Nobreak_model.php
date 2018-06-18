<?php defined('BASEPATH') OR exit('No direct script access aloowed');

Class Nobreak_model extends CI_Model {

    //model construct function
    public function __construct() {
        parent::__construct();

    }
    // Insert registration data in database
    public function consulta_nbk1() {
        $portalm_db = $this->load->database('portalmoni',true);

        $portalm_db->select('*');
        $portalm_db->from('tbl_temp_nobreak1');
        $portalm_db->where('((outros_temp) <>0)');
        $portalm_db->order_by('ID', 'DESC');
        $portalm_db->limit(1);
        $query = $portalm_db->get();
        return $query->row();
       // "SELECT * FROM tbl_temp_nobreak1 WHERE ((outros_temp) <>0) ORDER BY ID DESC LIMIT 1 ";
    }

    public function consulta_nbk2() {
        $portalm_db = $this->load->database('portalmoni',true);

        $portalm_db->select('*');
        $portalm_db->from('tbl_temp_nobreak2');
        $portalm_db->where('((outros_temp) <> 0)');
        $portalm_db->order_by('ID', 'DESC');
        $portalm_db->limit(1);
        $query = $portalm_db->get();
        return $query->row();
        //"SELECT * FROM tbl_temp_nobreak2 WHERE ((outros_temp) <>0) ORDER BY ID DESC LIMIT 1 ";
    }


    public function querys_nbk($nobreak) {
        switch ($nobreak) {
            case 'Primario':
            return "SELECT date_format(hora, '%H.%i') as hora,
                    avg(ent_freq) As frequencia,
                    avg(ent_ten_rs) as tensao_r_s,
                    avg(ent_ten_st) as tensao_s_t,
                    avg(ent_ten_tr) as tensao_t_r,
                    avg(sai_pot_apa_tot) As potencia,
                    avg(sai_cor_r) as corrente_r,
                    avg(sai_cor_s) as corrente_s,
                    avg(sai_cor_t) as corrente_t,
                    avg(ent_fat_pot) as entrada_pot
                 FROM tbl_temp_nobreak1
                 WHERE data = '?' GROUP BY hour(hora),minute(hora)";
                break;
            case 'Secundario':
            return "SELECT hora,
                    avg(ent_freq) As frequencia,
                    avg(ent_ten_rs) as tensao_r_s,
                    avg(ent_ten_st) as tensao_s_t,
                    avg(ent_ten_tr) as tensao_t_r,
                    avg(sai_pot_apa_tot) As potencia,
                    avg(sai_cor_r) as corrente_r,
                    avg(sai_cor_s) as corrente_s,
                    avg(sai_cor_t) as corrente_t,
                    avg(ent_fat_pot) as entrada_pot
                 FROM tbl_temp_nobreak2
                 WHERE data = '?' GROUP BY hour(hora),minute(hora)";
                break;
            case 'Mensal_Primario':
            return "SELECT hora, data,
                    avg(ent_freq) As frequencia,
                    avg(ent_ten_rs) as tensao_r_s,
                    avg(ent_ten_st) as tensao_s_t,
                    avg(ent_ten_tr) as tensao_t_r,
                    avg(sai_pot_apa_tot) As potencia,
                    avg(sai_cor_r) as corrente_r,
                    avg(sai_cor_s) as corrente_s,
                    avg(sai_cor_t) as corrente_t,
                    avg(ent_fat_pot) as entrada_pot
                FROM tbl_temp_nobreak1
                WHERE month(data) = '?'
                AND year(data) = '2016' GROUP BY day(data), hour(hora)";
                break;
            case 'Mensal_Secundario':
            return "SELECT hora, data,
                    avg(ent_freq) As frequencia,
                    avg(ent_ten_rs) as tensao_r_s,
                    avg(ent_ten_st) as tensao_s_t,
                    avg(ent_ten_tr) as tensao_t_r,
                    avg(sai_pot_apa_tot) As potencia,
                    avg(sai_cor_r) as corrente_r,
                    avg(sai_cor_s) as corrente_s,
                    avg(sai_cor_t) as corrente_t,
                    avg(ent_fat_pot) as entrada_pot
                FROM tbl_temp_nobreak2
                WHERE month(data) = '?'
                AND year(data) = '2016' GROUP BY day(data), hour(hora)";
                break;
            default:
                return "erro";
                break;
        }
    }

    public function query_nobreak() {
        $portalm_db = $this->load->database('portalmoni',true);
       return $portalm_db->query("SELECT date_format(hora, '%H.%i') AS hora,
        avg(ent_freq) AS frequencia,
        avg(ent_ten_rs) AS tensao_r_s,
        avg(ent_ten_st) AS tensao_s_t,
        avg(ent_ten_tr) AS tensao_t_r,
        avg(sai_pot_apa_tot) AS potencia,
        avg(sai_cor_r) AS corrente_r,
        avg(sai_cor_s) AS corrente_s,
        avg(sai_cor_t) AS corrente_t,
        avg(ent_fat_pot) AS entrada_pot
     FROM tbl_temp_nobreak1
     WHERE data = '2018-06-18' GROUP BY hour(hora), minute(hora)");
    }
/*     $querys_nbk = array(
     'Primario' =>
         "SELECT date_format(hora, '%H.%i') as hora,
            avg(ent_freq) As frequencia,
            avg(ent_ten_rs) as tensao_r_s,
            avg(ent_ten_st) as tensao_s_t,
            avg(ent_ten_tr) as tensao_t_r,
            avg(sai_pot_apa_tot) As potencia,
            avg(sai_cor_r) as corrente_r,
            avg(sai_cor_s) as corrente_s,
            avg(sai_cor_t) as corrente_t,
            avg(ent_fat_pot) as entrada_pot
         FROM tbl_temp_nobreak1
         WHERE data = '?' GROUP BY hour(hora),minute(hora)",
     'Secundario' =>
         "SELECT hora,
            avg(ent_freq) As frequencia,
            avg(ent_ten_rs) as tensao_r_s,
            avg(ent_ten_st) as tensao_s_t,
            avg(ent_ten_tr) as tensao_t_r,
            avg(sai_pot_apa_tot) As potencia,
            avg(sai_cor_r) as corrente_r,
            avg(sai_cor_s) as corrente_s,
            avg(sai_cor_t) as corrente_t,
            avg(ent_fat_pot) as entrada_pot
         FROM tbl_temp_nobreak2
         WHERE data = '?' GROUP BY hour(hora),minute(hora)",
     'Mensal_Primario' =>
         "SELECT hora, data,
            avg(ent_freq) As frequencia,
            avg(ent_ten_rs) as tensao_r_s,
            avg(ent_ten_st) as tensao_s_t,
            avg(ent_ten_tr) as tensao_t_r,
            avg(sai_pot_apa_tot) As potencia,
            avg(sai_cor_r) as corrente_r,
            avg(sai_cor_s) as corrente_s,
            avg(sai_cor_t) as corrente_t,
            avg(ent_fat_pot) as entrada_pot
        FROM tbl_temp_nobreak1
        WHERE month(data) = '?'
        AND year(data) = '2016' GROUP BY day(data), hour(hora)",
     'Mensal_Secundario' =>
         "SELECT hora, data,
            avg(ent_freq) As frequencia,
            avg(ent_ten_rs) as tensao_r_s,
            avg(ent_ten_st) as tensao_s_t,
            avg(ent_ten_tr) as tensao_t_r,
            avg(sai_pot_apa_tot) As potencia,
            avg(sai_cor_r) as corrente_r,
            avg(sai_cor_s) as corrente_s,
            avg(sai_cor_t) as corrente_t,
            avg(ent_fat_pot) as entrada_pot
        FROM tbl_temp_nobreak2
        WHERE month(data) = '?'
        AND year(data) = '2016' GROUP BY day(data), hour(hora)"
     );*/

    public function consulta_banco($consulta){
        $portalm_db = $this->load->database('portalm',true);
         //global $con;
         //$array_dados = array();
         //$resultado = mysqli_query($con,$consulta);
         $query = $portalm_db->query($consulta);
         //$resultado = $portalm_db->get();
         // while($linha = mysqli_fetch_assoc($resultado)){
         //    array_push($array_dados,$linha);
         // }
         // foreach($resultado->result_array() as $row){
         //     echo $row;
         // }
         return $query->result_array();
    }

      public function get_nobreak($data,$nobreak,$variavel,$passo=5){
            //global $querys_nbk;
            $array_nobreak = array();
            $hora = array();
            $pot_ap_tot = array();
            $frequencia = array();
            $busca = str_replace("?",$data,$this->querys_nbk($nobreak));
            $linha = $this->consulta_banco($busca);
            $unidades = array('frequencia' => 'Hz', 'potencia' => 'KVA', 'Tensao' => 'V', 'Corrente' => 'A');

            for($i=0; $i < sizeof($linha) ; $i += $passo){
                $array_nobreak['hora'][$i] = $linha[$i]['hora'];
                $array_nobreak['frequencia'][$i] = $linha[$i]['frequencia'];
                $array_nobreak['potencia'][$i] = $linha[$i]['potencia'];
                $array_nobreak['Tensao'][$i] = $linha[$i]['tensao_r_s'];
                $array_nobreak['Tensao2'][$i] = $linha[$i]['tensao_s_t'];
                $array_nobreak['Tensao3'][$i] = $linha[$i]['tensao_t_r'];
                $array_nobreak['Corrente'][$i] = $linha[$i]['corrente_r'];
                $array_nobreak['Corrente2'][$i] = $linha[$i]['corrente_s'];
                $array_nobreak['Corrente3'][$i] = $linha[$i]['corrente_t'];
                $array_nobreak['entrada_pot'][$i] = $linha[$i]['entrada_pot'];
            }
            $array_saida = array('dados' => $array_nobreak, 'unidade' => $unidades[$variavel]);
            return $array_saida;
       }
}