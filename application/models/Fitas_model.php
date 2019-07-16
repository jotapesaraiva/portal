<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitas_model extends CI_Model {

    public function diario_library_cofre() {
        $this->db->select('Label , Location , Porcentagem, date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate');
        $this->db->from('dp_fitas');
        $this->db->like('Pool','LTO');
        $this->db->not_like('Pool','MENSAL');
        $this->db->where('Location !=','Cofre');
        $this->db->where('"ProtectionDate" >',date("d/m/Y"));
        $this->db->order_by('Porcentagem','DESC');
        // $this->db->limit(0,100);
        $query = $this->db->get();
        return $query;
    }

    public function diario_cofre_library(){
        $dataatual = date("Y-m-d");
        $timestamp = strtotime($dataatual . " + 1 month");
        $dataummes = date('Y-m-d', $timestamp);

        $this->db->select('*, date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate2');
        $this->db->from('dp_fitas');
        $this->db->where('Location','Cofre');
        $this->db->where('ProtectionDate !=','NULL');
        $this->db->like('Pool','LTO');
        $this->db->not_like('Pool','VTL');
        $this->db->not_like('Pool','MENSAL');
        $this->db->where('ProtectionDate <=', $dataummes);
        $this->db->order_by('Porcentagem','ASC');
        // $this->db->limit(0,100);
        $query = $this->db->get();
        return $query;
    }

    public function mensal_library_cofre() {
        $this->db->select('Pool, Label , Location , Porcentagem, date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate');
        $this->db->from('dp_fitas');
        $this->db->like('Pool', 'MENSAL');
        $this->db->where('Location !=', 'Cofre');
        $this->db->where('"ProtectionDate" >', date("d/m/Y"));
        $this->db->or_like('Pool','ANUAL');
        $this->db->where('Location !=', 'Cofre');
        $this->db->where('"ProtectionDate" >', date("d/m/Y"));
        $this->db->order_by('Porcentagem', 'DESC');
        // $this->db->limit(0, 100);
        $query = $this->db->get();
        return $query;
    }

    public function mensal_cofre_library(){
        $dataatual = date("Y-m-d");
        $timestamp = strtotime($dataatual . " + 1 month");
        $dataummes = date('Y-m-d', $timestamp);

        $this->db->select('*,date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate2');
        $this->db->from('dp_fitas');
        $this->db->where('Location ', 'Cofre');
        $this->db->where('ProtectionDate !=', 'NULL');
        $this->db->like('Label', 'MENSAL');
        $this->db->where('ProtectionDate <=', $dataummes);
        $this->db->or_where('Location ', 'Cofre');
        $this->db->where('ProtectionDate !=', 'NULL');
        $this->db->like('Label','ANUAL');
        $this->db->where('ProtectionDate <=', $dataummes);
        $this->db->order_by('ProtectionDate', 'ASC');
        // $this->db->limit(0,100);
        $query = $this->db->get();
        return $query;
    }

    public function fitas_poor() {
        $this->db->select('*, date_format(ocorrencia, "%d/%m/%Y %H:%i:%s") as ocorrencia, date_format(ocorrencia, "%Y/%m/%d-") as data_session');
        $this->db->from('dp_fitas_poor');
        $query = $this->db->get();
        return $query;
    }
    // select *, date_format(ocorrencia, '%d/%m/%Y %H:%i:%s') as ocorrencia, date_format(ocorrencia, '%Y/%m/%d-') as data_session  from dp_fitas_poor
}

/* End of file Fitas_model.php */
/* Location: ./application/models/Fitas_model.php */