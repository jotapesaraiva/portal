<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mantis_model extends CI_Model {

    // public function abrir($usuario,$projeto,$sevico,$detalhe,$categoria) {
    public function abrir() {
        $mantis = $this->load->database('monitora', true);
        // $sql = "BEGIN MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG(IN_NM_USUARIO => :IN_NM_USUARIO, IN_NM_PROJETO => :IN_NM_PROJETO,IN_RESUMO => :IN_RESUMO,IN_DESCRICAO => :IN_DESCRICAO,IN_CATEGORIA => :IN_CATEGORIA,OUT_NUMERO => :OUT_NUMERO); END;";
        $sql = "
        DECLARE
            NUM_CASO NUMBER;

            BEGIN MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG(
                IN_NM_USUARIO => 'joao.saraiva',
                IN_NM_PROJETO => 'Ambiente de Backup',
                IN_RESUMO => 'Falha de backup - TESTE',
                IN_DESCRICAO => '[Critical] From: VBDA@netsrv.sefa.pa.gov.br /usr  Time: 19-12-2018 19:48:13
[81:52]     /usr
    Not a valid mount point => aborting.

[Critical] From: VBDA@netsrv.sefa.pa.gov.br /var  Time: 19-12-2018 19:48:28
[81:52]     /var
    Not a valid mount point => aborting.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /  Time: 19-12-2018 19:48:43
    /dev
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /  Time: 19-12-2018 19:48:45
    /misc
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /  Time: 19-12-2018 19:48:45
    /net
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /  Time: 19-12-2018 19:48:45
    /opt
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /  Time: 19-12-2018 19:48:45
    /proc
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /  Time: 19-12-2018 19:48:45
    /sys
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-java-rep.sefa.pa.gov.br /var  Time: 19-12-2018 19:49:00
    /var/lib/nfs/rpc_pipefs
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.

[Warning] From: VBDA@x-oc-svn.sefa.pa.gov.br /var  Time: 19-12-2018 19:49:58
    /var/lib/nfs/rpc_pipefs
    Directory is a mount point to a different filesystem.
    Backed up as empty directory without extended attributes and ACLs.',
                IN_CATEGORIA => 'Relatório de Falha de Backup',
                OUT_NUMERO => NUM_CASO);

            DBMS_OUTPUT.PUT_LINE(NUM_CASO);

        END;";

        $stmt = oci_parse($mantis->conn_id,$sql);
        // oci_bind_by_name($stmt,':IN_NM_USUARIO',$params['usuario']);
        // oci_bind_by_name($stmt,':IN_NM_PROJETO',$params['projeto']);
        // oci_bind_by_name($stmt,':IN_RESUMO',$params['servico']);
        // oci_bind_by_name($stmt,':IN_DESCRICAO',$params['detalhe']);
        // oci_bind_by_name($stmt,':IN_CATEGORIA',$params['categoria']);
        // $result = oci_new_cursor($mantis->conn_id);
        // oci_bind_by_name($stmt,'NUM_CASO', $result, -1, OCI_B_CURSOR);
        // oci_bind_by_name($stmt,":OUT_NUMERO", $cursor,-1,OCI_B_CURSOR);
        // oci_error($stmt);
        oci_execute($stmt);
        // oci_execute($result);
        return $stmt;

       // foreach ($row as $item) {
       //        echo "-----" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "---";
       //    }

        // return $stmt;
        // oci_execute($out);
        // while ($data = oci_fetch_assoc($out)) {
        //     return $data;
        // }
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



    public function sysdate() {
        $mantis = $this->load->database('monitora', true);
        $sql = "select MAX(a.id) from mantis_bug_tb a
join mantis_project_tb b on a.project_id=b.id
join mantis_user_tb c on a.reporter_id=c.id
where c.username = 'joao.saraiva' and b.name='Ambiente de Backup' and a.summary='Falha de backup - TESTE' and a.category = 'Relatório de Falha de Backup'
and a.status not in ('80','90')";
        $stmt = oci_parse($mantis->conn_id,$sql);
            oci_execute($stmt);
            echo "<table border='1'>\n";
            while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";


    }
        // $query = $mantis->call_function('MANTIS.PKG_CASO_MANTIS.STP_RELT_CASO_PROJETO_CATEG',
        // $usuario,$projeto,$sevico,$detalhe,$categoria);
        // return $query->result_id;

}

/* End of file Mantis_model.php */
/* Location: ./application/models/Mantis_model.php */