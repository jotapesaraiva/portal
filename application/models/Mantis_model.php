<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantis_model extends CI_Model {

    public function abrir_mantis($params) {
        $mantis = $this->load->database('monitora', true);
        $sql = "
        DECLARE
            NUM_CASO NUMBER;
            BEGIN MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG(
                IN_NM_USUARIO => '".$params['usuario']."',
                IN_NM_PROJETO => '".$params['projeto']."',
                IN_RESUMO => '".$params['servico']."',
                IN_DESCRICAO => '".$params['detalhe']."',
                IN_CATEGORIA => '".$params['categoria']."',
                OUT_NUMERO => NUM_CASO);
            DBMS_OUTPUT.PUT_LINE(NUM_CASO);
        END;";

        $stmt = oci_parse($mantis->conn_id,$sql);

        oci_execute($stmt);

        return $stmt;
    }

    public function abrir_mantis_link($params) {
        $mantis = $this->load->database('monitora', true);
        $sql = "
        DECLARE
            NUM_CASO NUMBER;
            BEGIN MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_DEMANDAS_LINK(
                IN_NM_USUARIO => '".$params['usuario']."',
                IN_NM_PROJETO => '".$params['projeto']."',
                IN_RESUMO => '".$params['servico']."',
                IN_DESCRICAO => '".$params['detalhe']."',
                IN_CATEGORIA => '".$params['categoria']."',
                IN_CF_TICKET => '".$params['ticket']."',
                IN_CF_INICIO_CHAMADO => '".$params['inicio_chamado']."',
                OUT_NUMERO => NUM_CASO);
            DBMS_OUTPUT.PUT_LINE(NUM_CASO);
        END;";

        $stmt = oci_parse($mantis->conn_id,$sql);

        oci_execute($stmt);

        return $stmt;
    }

    public function abrir_teste($params) {
        $mantis = $this->load->database('monitora', true);
        $query = $mantis->stored_procedure('MANTIS.PKG_CASO_MANTIS', 'STP_RELT_CASO_PROJETO_CATEG', $params);
        return $query;
    }

    // public function teste()
    // {
    //     $mantis = $this->load->database('monitora', true);
    //     // $stid = oci_parse($mantis->conn_id, 'SELECT sysdate FROM dual');
    //     $stid = oci_parse($mantis->conn_id, "
    //         DECLARE
    //         NUM_CASO NUMBER;

    //         BEGIN MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG(
    //         IN_NM_USUARIO => 'joao.saraiva',
    //         IN_NM_PROJETO => 'Ambiente de Backup',
    //         IN_RESUMO => 'Falha de backup - TESTE',
    //         IN_DESCRICAO => 'decricao teste',
    //         IN_CATEGORIA => 'Relatório de Falha de Backup',
    //         OUT_NUMERO => NUM_CASO);
    //         DBMS_OUTPUT.PUT_LINE(NUM_CASO);
    //         END;

    //         ");
    //     oci_execute($stid);
    //     echo "<table border='1'>\n";
    //     while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    //         echo "<tr>\n";
    //         foreach ($row as $item) {
    //             echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    //         }
    //         echo "</tr>\n";
    //     }
    //     echo "</table>\n";
    // }

        // $sql = "
        // BEGIN
        //     MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG(
        //         IN_NM_USUARIO => :IN_NM_USUARIO,
        //         IN_NM_PROJETO => :IN_NM_PROJETO,
        //         IN_RESUMO     => :IN_RESUMO,
        //         IN_DESCRICAO  => :IN_DESCRICAO,
        //         IN_CATEGORIA  => :IN_CATEGORIA,
        //         OUT_NUMERO    => :OUT_NUMERO);
        // END;";

    public function teste($params) {
        $mantis = $this->load->database('monitora', true);
        $sql = "
        BEGIN
            MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG(
                :IN_NM_USUARIO,
                :IN_NM_PROJETO,
                :IN_RESUMO,
                :IN_DESCRICAO,
                :IN_CATEGORIA,
                :OUT_NUMERO);
        END;";
        $stmt = oci_parse($mantis->conn_id,$sql);

        oci_bind_by_name($stmt,':IN_NM_USUARIO',$params['usuario']);
        oci_bind_by_name($stmt,':IN_NM_PROJETO',$params['projeto']);
        oci_bind_by_name($stmt,':IN_RESUMO',$params['servico']);
        oci_bind_by_name($stmt,':IN_DESCRICAO',$params['detalhe']);
        oci_bind_by_name($stmt,':IN_CATEGORIA',$params['categoria']);

        $out = oci_new_cursor($mantis->conn_id);

        oci_bind_by_name($stmt,':OUT_NUMERO', $out, -1, OCI_B_CURSOR);
        // Execute the statement as in your first try
        oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);

        // and now, execute the cursor
        oci_execute($out);

        vd(oci_fetch_row($cursor));
        return $result;
    }


    public function oci8($params) {
        $mantis = $this->load->database('monitora', true);
        $query = $mantis->stored_procedure('MANTIS.PKG_CASO_MANTIS','STP_RELT_CASO_PROJETO_CATEG', $params);
        return $query;
    }



    public function select_num_mantis($params) {
        $mantis = $this->load->database('monitora', true);
        $sql = "select MAX(a.id) from mantis_bug_tb a
join mantis_project_tb b on a.project_id=b.id
join mantis_user_tb c on a.reporter_id=c.id
where c.username = '".$params['usuario']."' and b.name='".$params['projeto']."' and a.summary='".$params['servico']."' and a.category = '".$params['categoria']."'
and a.status not in ('80','90')";
        $stmt = oci_parse($mantis->conn_id,$sql);
            oci_execute($stmt, OCI_NO_AUTO_COMMIT);
            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                foreach ($row as $item) {
                    // echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    return $item;
                }
            }

    }

    public function equipes_mantis() {
        // $array = array();
        $mantis = $this->load->database('monitora', true);
        $sql = "SELECT A.ID, A.NAME from mantis.mantis_project_tb a left join mantis.mantis_project_hierarchy_tb b on a.id = b.child_id
        WHERE B.CHILD_ID IS NULL AND A.ENABLED = 1";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        // $nrows = oci_fetch_all($stmt, $res);
        // echo "$nrows rows fetched<br>\n";
        // var_dump($res);
        // oci_fetch_all($stmt, $res);//cria array apartir das colunas
        oci_fetch_all($stmt, $res,null, null, OCI_FETCHSTATEMENT_BY_ROW);//cria array apartir das linhas
        return $res;
        // while ($row = oci_fetch_array($stmt, OCI_ASSOC)) {
            // foreach ($row as $item) {
            //     array_push($array,$item);
            //     return $item;
            // }
        // }
    }

    public function projetos_mantis($id) {
        $mantis = $this->load->database('monitora', true);
        $sql = "SELECT A.ID, A.NAME from mantis.mantis_project_tb a left join mantis.mantis_project_hierarchy_tb b on a.id = b.child_id
                WHERE A.ENABLED = 1
                start with a.id = ".$id."
                connect by b.parent_id = prior a.id";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        oci_fetch_all($stmt,$equip,null,null,OCI_FETCHSTATEMENT_BY_ROW);
        return $equip;
    }


    public function categorias_mantis($id) {
        $mantis = $this->load->database('monitora', true);
        $sql = "SELECT * FROM MANTIS.MANTIS_PROJECT_CATEGORY_TB WHERE PROJECT_ID = ".$id;
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        oci_fetch_all($stmt,$catego,null,null,OCI_FETCHSTATEMENT_BY_ROW);
        return $catego;
    }

}

/* End of file Mantis_model.php */
/* Location: ./application/models/Mantis_model.php */