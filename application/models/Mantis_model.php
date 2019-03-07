<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantis_model extends CI_Model {

    public function mantis($mantis) {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query('
            SELECT status
              FROM mantis_bug_tb b
             WHERE b.id = '.$mantis);
        // echo $portal_ora->last_query();
        return $query->row();
    }

    public function abrir_mantis_teste($params,$procedore,$personalizado) {
        $mantis = $this->load->database('monitora', true);
        $sql = "DECLARE
                    NUM_CASO NUMBER;
                    BEGIN MANTIS.PKG_CASO_MANTIS.".$procedore."(
                        IN_NM_USUARIO => '".$params['usuario']."',
                        IN_NM_PROJETO => '".$params['projeto']."',
                        IN_RESUMO => '".$params['servico']."',
                        IN_DESCRICAO => '".$params['detalhe']."',
                        IN_CATEGORIA => '".$params['categoria']."',
                        ".$personalizado."
                        OUT_NUMERO => NUM_CASO);
                    DBMS_OUTPUT.PUT_LINE(NUM_CASO);
                END;";
        $stmt = oci_parse($mantis->conn_id,$sql);
        // vd($sql);
        oci_execute($stmt);
        return $stmt;
    }

    public function abrir_mantis($params) {
        $mantis = $this->load->database('monitora', true);
        $sql = "DECLARE
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


    public function select_num_mantis($params) {
        $mantis = $this->load->database('monitora', true);
        $sql = "SELECT MAX(a.id)
                FROM mantis_bug_tb a
                JOIN mantis_project_tb b ON a.project_id=b.id
                JOIN mantis_user_tb c ON a.reporter_id=c.id
                WHERE c.username = '".$params['usuario']."'
                AND b.name='".$params['projeto']."'
                AND a.summary='".$params['servico']."'
                AND a.category = '".$params['categoria']."'
                AND a.status not in ('80','90')";
        $stmt = oci_parse($mantis->conn_id,$sql);
            oci_execute($stmt, OCI_NO_AUTO_COMMIT);
            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                foreach ($row as $item) {
                    // echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    return $item;
                }
            }

    }

    public function update_num_mantis($table,$num,$session_id) {
        $portal = $this->load->database('default',true);
        $portal->update($table, $num, $session_id);
        // echo $portal->last_query();
        return $portal->affected_rows();
    }
    public function equipes_mantis() {
        // $array = array();
        $mantis = $this->load->database('monitora', true);
        $sql = "SELECT A.ID, A.NAME
                FROM mantis.mantis_project_tb a
                LEFT JOIN mantis.mantis_project_hierarchy_tb b ON a.id = b.child_id
                WHERE B.CHILD_ID IS NULL
                AND A.ENABLED = 1";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        // $nrows = oci_fetch_all($stmt, $res);//retorna o numero de ocorrencias
        // echo "$nrows rows fetched<br>\n";
        // var_dump($res);
        // oci_fetch_all($stmt, $res);//cria array apartir das colunas
        oci_fetch_all($stmt, $res,null, null, OCI_FETCHSTATEMENT_BY_ROW);//cria array apartir das linhas

        return $res;
    }

    public function mantis_projetos() {
        $mantis = $this->load->database('mantis', true);
        $sql = "select b.id numero_chamado, b.summary resumo,
                case when b.project_id = 4006 then 'Monitoramento'
                        when b.project_id = 1502 then 'Sustentação'
                        when b.project_id = 4121 then 'Projetos/Man.Assistida'
                        when b.project_id = 4041 then 'CGRE - Produção'
                        when b.project_id = 3922 then 'Suporte a Servidores'

                   end projeto
                from mantis.mantis_bug_tb b
                where b.status not in (60,80,90)
                and b.project_id in (4006,1502,4121,4041,3922)

                ORDER BY numero_chamado DESC";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        oci_fetch_all($stmt,$equip,null,null,OCI_FETCHSTATEMENT_BY_ROW);
        return $equip;
    }


    public function mantis_projetos_producao() {
        $mantis = $this->load->database('mantis', true);
        $sql = "      SELECT id numero_chamado,mcfs.value as ticket, summary as resumo, project_id
                        FROM mantis_bug_tb mb
                        INNER JOIN mantis_custom_field_string_tb mcfs ON (mcfs.bug_id = mb.id AND mcfs.field_id = 361)
                        WHERE status not in (60, 80, 90)
                        AND PROJECT_ID in (
                            SELECT A.ID
                            FROM mantis_project_tb a
                            LEFT JOIN mantis_project_hierarchy_tb b ON a.id = b.child_id
                            WHERE A.ENABLED = 1 start
                            with a.id = 4041 connect by b.parent_id = prior a.id)
                        AND extract(month from DATE_SUBMITTED) = extract(month from sysdate)
                        ORDER BY numero_chamado DESC";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        oci_fetch_all($stmt,$equip,null,null,OCI_FETCHSTATEMENT_BY_ROW);
        return $equip;
    }

    public function projetos_mantis($id) {
        $mantis = $this->load->database('monitora', true);
        $sql = "SELECT A.ID, A.NAME
                FROM mantis.mantis_project_tb a
                LEFT JOIN mantis.mantis_project_hierarchy_tb b ON a.id = b.child_id
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

    public function widget_mantis($flag,$equipe) {
        $sql = "";
        $mantis = $this->load->database('mantis', true);
        if($flag == 'quantidade'){
           $sql .= "SELECT COUNT(MBT.ID) as Qtd_Mantis ";
        } else {
          $sql .=  "SELECT MBT.id, MUT.USERNAME as
          RELATOR, MUT2.USERNAME as ATRIBUIDO, MBT.summary, MBT.date_submitted, MBT.status, round(SYSDATE - MBT.LAST_UPDATED) as ultima_atualizacao ";
        }
       $sql .= "FROM mantis_bug_tb MBT ";
       if($flag == 'quantidade'){
            $sql .= "JOIN mantis_bug_status_tb MBS ON MBT.status = MBS.STATUS ";
       } else {
            $sql .= "LEFT JOIN mantis_user_tb MUT on MBT.reporter_id = MUT.id
            LEFT JOIN mantis_user_tb MUT2 on MBT.handler_id = MUT2.id ";
       }
         $sql .= "
         where MBT.PROJECT_ID in (SELECT A.ID FROM mantis_project_tb a
            LEFT JOIN mantis_project_hierarchy_tb b ON a.id = b.child_id
            WHERE A.ENABLED = 1";
        switch ($equipe) {
            case 'CGRE-Produção':
                $sql .= "start with a.id = 4041 connect by b.parent_id = prior a.id) ";
                break;
            case 'CGRE-InfraEstrutura':
                $sql .= "start with a.id = 3861 connect by b.parent_id = prior a.id)";
                break;
            case 'CGRE-Rede':
                $sql .= "start with a.id = 1992 connect by b.parent_id = prior a.id)";
                break;
            case 'CGPS':
                $sql .= "start with a.id in(341,4161) connect by b.parent_id = prior a.id)";
                break;
            case 'CGDA-Banco':
                $sql .= "start with a.id = 4001 connect by b.parent_id = prior a.id)";
                break;
            case 'DTI-GERENTES':
                $sql .= "start with a.id in(2342,3441) connect by b.parent_id = prior a.id)";
                break;
            default:
                $sql .= "start with a.id in(1921,3841) connect by b.parent_id = prior a.id)";
                break;
        }
        if ($flag == 'quantidade') {
            $sql .= "AND MBT.status = 10 ";
        } else {
            $sql .=  "AND MBT.status not in (60, 90, 80) ";
        }
        $sql .= "AND extract(month from MBT.DATE_SUBMITTED) = extract(month from sysdate)";
        if ($flag == 'chamados'){
            $sql .= " ORDER BY MBT.date_submitted DESC";
        }
        // vd($sql);
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        oci_fetch_all($stmt,$catego,null,null,OCI_FETCHSTATEMENT_BY_ROW);
        // oci_fetch_all($stmt,$catego,null,null,OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);
        // oci_fetch_all($stmt,$catego);
        return $catego;
        // $stmt = oci_parse($mantis->conn_id,$sql);
        //     oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        //     while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //         foreach ($row as $item) {
        //             // echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        //             return $item;
        //         }
        //     }
    }


    public function graf_resolvido_d(){
        $mantis = $this->load->database('monitora', true);
        $sql = "
        SELECT p.username AS usuario, TO_DATE(b.last_updated, 'dd/mm/yy') AS data, count(*) AS qtd
        FROM mantis.mantis_bug_tb b
        JOIN mantis.mantis_user_tb p ON b.handler_id = p.id
        WHERE b.project_id IN (
                SELECT A.ID
                  FROM mantis_project_tb a
                  LEFT JOIN mantis_project_hierarchy_tb b
                    ON a.id = b.child_id
                 WHERE A.ENABLED = 1
                 start WITH a.id = 341
                connect by b.parent_id = prior a.id
        )
        AND b.status IN (80, 60, 90, 45, 70)
        AND b.last_updated BETWEEN SYSDATE-7 AND SYSDATE
        GROUP BY p.username, TO_DATE(b.last_updated, 'dd/mm/yy')  ORDER BY TO_DATE(b.last_updated, 'dd/mm/yy') ASC

                    ";
        $stmt = oci_parse($mantis->conn_id,$sql);
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        // oci_fetch_all($stmt,$equip,null,null,OCI_FETCHSTATEMENT_BY_ROW);
        // oci_fetch_all($stmt,$equip);
        oci_fetch_all($stmt,$equip,null,null,OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);
        return $equip;
    }











//######################################################Procedure para adicionar anotação no mantis###########################################################
    // BEGIN
    //   MANTIS.PKG_CASO_MANTIS.STP_ADICIONAR_ANOTACAO(IN_ID_CASO    => '0587631',
    //                                                 IN_NM_USUARIO => 'joao.saraiva',
    //                                                 IN_ANOTACAO   => 'Chamado aberto no Mantis');
    // END;


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
    //         END;");
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
        $sql = "BEGIN
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
        oci_execute($stmt, OCI_NO_AUTO_COMMIT);
        // and now, execute the cursor
        oci_execute($out);

        return $out;
    }
}
/* End of file Mantis_model.php */
/* Location: ./application/models/Mantis_model.php */