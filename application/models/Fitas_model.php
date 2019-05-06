<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fitas_model extends CI_Model {

    public function diario_library_cofre() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('Label , Location , Porcentagem, date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate');
        $portal_moni->from('tbl_dp_fitas');
        $portal_moni->like('Pool','LTO');
        $portal_moni->not_like('Pool','MENSAL');
        $portal_moni->where('Location !=','Cofre');
        $portal_moni->where('"ProtectionDate" >',date("d/m/Y"));
        $portal_moni->order_by('Porcentagem','DESC');
        // $portal_moni->limit(0,100);
        $query = $portal_moni->get();
        return $query;
    }

    public function diario_cofre_library(){
        $dataatual = date("Y-m-d");
        $timestamp = strtotime($dataatual . " + 1 month");
        $dataummes = date('Y-m-d', $timestamp);

        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('*, date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate2');
        $portal_moni->from('tbl_dp_fitas');
        $portal_moni->where('Location','Cofre');
        $portal_moni->where('ProtectionDate !=','NULL');
        $portal_moni->like('Pool','LTO');
        $portal_moni->not_like('Pool','VTL');
        $portal_moni->not_like('Pool','MENSAL');
        $portal_moni->where('ProtectionDate <=', $dataummes);
        $portal_moni->order_by('Porcentagem','ASC');
        // $portal_moni->limit(0,100);
        $query = $portal_moni->get();
        return $query;
    }

    public function mensal_library_cofre() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('Pool, Label , Location , Porcentagem, date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate');
        $portal_moni->from('tbl_dp_fitas');
        $portal_moni->like('Pool', 'MENSAL');
        $portal_moni->where('Location !=', 'Cofre');
        $portal_moni->where('"ProtectionDate" >', date("d/m/Y"));
        $portal_moni->or_like('Pool','ANUAL');
        $portal_moni->where('Location !=', 'Cofre');
        $portal_moni->where('"ProtectionDate" >', date("d/m/Y"));
        $portal_moni->order_by('Porcentagem', 'DESC');
        // $portal_moni->limit(0, 100);
        $query = $portal_moni->get();
        return $query;
    }

    public function mensal_cofre_library(){
        $dataatual = date("Y-m-d");
        $timestamp = strtotime($dataatual . " + 1 month");
        $dataummes = date('Y-m-d', $timestamp);

        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('*,date_format(ProtectionDate, "%d/%m/%Y") as ProtectionDate2');
        $portal_moni->from('tbl_dp_fitas');
        $portal_moni->where('Location ', 'Cofre');
        $portal_moni->where('ProtectionDate !=', 'NULL');
        $portal_moni->like('Label', 'MENSAL');
        $portal_moni->where('ProtectionDate <=', $dataummes);
        $portal_moni->or_where('Location ', 'Cofre');
        $portal_moni->where('ProtectionDate !=', 'NULL');
        $portal_moni->like('Label','ANUAL');
        $portal_moni->where('ProtectionDate <=', $dataummes);
        $portal_moni->order_by('ProtectionDate', 'ASC');
        // $portal_moni->limit(0,100);
        $query = $portal_moni->get();
        return $query;
    }

    public function fitas_poor() {
        $portal_moni = $this->load->database('portalmoni',true);
        $portal_moni->select('*, date_format(ocorrencia, "%d/%m/%Y %H:%i:%s") as ocorrencia, date_format(ocorrencia, "%Y/%m/%d-") as data_session');
        $portal_moni->from('tbl_dp_fitas_poor');
        $query = $portal_moni->get();
        return $query;
    }
    // select *, date_format(ocorrencia, '%d/%m/%Y %H:%i:%s') as ocorrencia, date_format(ocorrencia, '%Y/%m/%d-') as data_session  from tbl_dp_fitas_poor
}

/* End of file Fitas_model.php */
/* Location: ./application/models/Fitas_model.php */