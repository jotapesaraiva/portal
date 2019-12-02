<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fechamento_model extends CI_Model {

    public function monitora($data)
    {
        $this->db->select('*');
        $this->db->from('mnt_alertas');
        $this->db->where('data_fim >= "'.$data.'"');
        $this->db->where('tipo_alerta <> "Informativo"');
        $this->db->order_by('data_fim', 'desc');
        $query = $this->db->get();
        $result = "";
        foreach ($query->result_array() as $key => $value) {
          $result .= $value['mantis']." ".$value['desc_alerta']."\n";
        }
        return $result;
    }
    public function backup($dia,$hora)
    {
        $this->db->select('*');
        $this->db->from('dp_backups');
        $this->db->where('`status` <> "Completed"');
        $this->db->where('session_type', 'Backup');
        $this->db->where('day_time', $dia);
        $this->db->where('start_time >="'.$hora.'"');
        $query = $this->db->get();
        $result = "";
        foreach ($query->result_array() as $key => $value) {
          $result .= $value['mantis']." ".$value['session_id']." ".$value['specification']."\n";
        }
        return $result;
    }
    public function link()
    {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query('
        SELECT mb.id                 as mantis,
               mb.summary            as resumo,
               cf2.value             as ticket,
               cf1.value             as provedor,
               mb.date_submitted     as dt_abertura,
               bs.status_description as situacao
          from mantis_bug_tb mb
         inner join mantis_bug_status_tb bs
            on bs.status = mb.status
         inner join mantis_custom_field_string_tb cf1
            on cf1.bug_id = mb.id
         inner join mantis_custom_field_string_tb cf2
            on cf2.bug_id = mb.id
         where mb.project_id = 521
           and mb.status not in (60, 80, 90, 70)
           and cf1.field_id = 3901
           and cf2.field_id = 361
         order by mb.date_submitted asc');
        $result = "";
        foreach ($query->result_array() as $key => $value) {
          $result .= $value['MANTIS']." ".$value['TICKET']." ".$value['RESUMO']."\n";
        }

        return $result;
    }
    public function servidores()
    {
      $query = $this->db->get('zbx_server_fora');
      $result = "";
      foreach ($query->result_array() as $key => $value) {
        $result .= $value['mantis']." ".$value['servico']." ".$value['servidor']."\n";
      }
      return $result;
    }
    //DEMANDAS REALIZADAS PELA EQUIPE DURANTE O TURNO
    public function mantisRealizado() {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
          SELECT mb.id                 as mantis,
                 mb.summary            as resumo,
                 mb.date_submitted     as dt_abertura,
                 bs.status_description as situacao
            from mantis_bug_tb mb
           inner join mantis_user_tb mu
              on mb.handler_id = mu.id
           inner join mantis_bug_status_tb bs
              on bs.status = mb.status
           where mu.username in ('glefson.franco',
                                 'gilberto.balieiro',
                                 'patrese.monteiro',
                                 'mauricio.brasil',
                                 'niellen.souza',
                                 'bruna.araujo',
                                 'cleyvison.matos',
                                 'sergio.filho',
                                 'joao.saraiva')
          --   and mb.project_id not in (521)
             and mb.status in (60, 80, 70)
             and (mb.date_submitted > (select sysdate - interval '6' hour from dual))
           order by mb.date_submitted asc");
        $result = "";
        foreach ($query->result_array() as $key => $value) {
          $result .= $value['MANTIS']." ".$value['RESUMO']. "\n";
        }
        return $result;
    }
    //CHAMADOS PENDENTES NO TURNO
    public function mantisPendentes() {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
              SELECT mb.id                 as mantis,
                     mb.summary            as resumo,
                     mb.date_submitted     as dt_abertura,
                     bs.status_description as situacao
                from mantis_bug_tb mb
               inner join mantis_user_tb mu
                  on mb.handler_id = mu.id
               inner join mantis_bug_status_tb bs
                  on bs.status = mb.status
               where mu.username in ('glefson.franco',
                                     'gilberto.balieiro',
                                     'patrese.monteiro',
                                     'mauricio.brasil',
                                     'niellen.souza',
                                     'bruna.araujo',
                                     'cleyvison.matos',
                                     'sergio.filho',
                                     'joao.saraiva')
              --   and mb.project_id not in (521)
                 and mb.status not in (60, 80, 70,90)
                 and (mb.date_submitted > (select sysdate - interval '6' hour from dual))
               order by mb.date_submitted asc");
        $result = "";
        $result = "\n";
        foreach ($query->result_array() as $key => $value) {
          $result .= $value['MANTIS']." ".$value['RESUMO']. "\n";
        }
        return $result;
    }
    public function simplesNacional()
    {
        $portal_m = $this->load->database('mantis',true);
        $query = $portal_m->query("
        SELECT mb.id             AS mantis,
               mb.summary        AS resumo,
               mb.date_submitted AS dt_abertura
          FROM mantis_bug_tb mb
         WHERE mb.project_id = 4044
           AND mb.category = 'Simples Nacional'
           AND mb.status IN (10, 20, 40, 50, 30)
         ORDER BY mb.date_submitted ASC");
        $result = "";
        foreach ($query->result_array() as $key => $value) {
          $result .= $value['MANTIS']." ".$value['RESUMO']."\n";
        }
         return $result;
    }
}

/* End of file Fechamento_model.php */
/* Location: ./application/models/Fechamento_model.php */