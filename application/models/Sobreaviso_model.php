<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobreaviso_model extends CI_Model {

    public function select() {
        $sobreaviso = $this->load->database('sobreaviso',true);
        $query = $sobreaviso->query("
        SELECT s.idescala, s.dia, s.inicio, s.fim, u.nome, e.celula, s.equipe_idequipe, group_concat(t.telefone) AS telefone
        FROM escala_atual s
        JOIN usuario u ON u.idusuario=s.usuario_idusuario
        JOIN equipe e ON e.idequipe=s.equipe_idequipe
        join telefone_usuario t ON s.usuario_idusuario = t.usuario_idusuario
        WHERE s.inicio BETWEEN CONCAT( CURDATE(),' ', '00:00:00') AND CONCAT( CURDATE(),' ', '23:59:59')
        GROUP BY s.usuario_idusuario");
        // echo $sobreaviso->last_query();
        return $query;
    }


}

/* End of file Sobreaviso_model.php */
/* Location: ./application/models/Sobreaviso_model.php */