<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_CRM extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // List Data Template WA
    function getTemplate()
    {
      $query = $this->db->query("SELECT * FROM template WHERE status = 'Valid'");
      return $query->result_array();
    }

    // List Data Template SMS
    function getTemplateSMS()
    {
      $query = $this->db->query("SELECT * FROM template_sms WHERE status = 'Valid'");
      return $query->result_array();
    }

    // List Data Template SMS
    function getGroup()
    {
      $query = $this->db->query("SELECT * FROM grup_konsumen WHERE status = 'Valid'");
      return $query->result_array();
    }

    function getLahirToday()
    {
      $tanggal = date("d");
      $bulan = date("m");
      $query = $this->db->query("SELECT * FROM konsumen WHERE (MONTH(tanggal_lahir) = '$bulan' AND DAY(tanggal_lahir) = '$tanggal') AND s_konsumen = 'Valid' ");
      return $query->result_array();
    }

    function getbooking($tanggal=null)
    {
      $query = $this->db->query("SELECT * FROM booking_servis WHERE booking_date = '$tanggal' ORDER BY id DESC ");
      return $query->result_array();
    }

    // Reminder KPB
    function getkpb1()
    {
      $query = $this->db->query("SELECT * FROM konsumen WHERE tanggal_mohon BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW() AND s_konsumen = 'Valid' ");
      return $query->num_rows();
    }

    function getkpb2()
    {
      $query = $this->db->query("SELECT * FROM konsumen WHERE tanggal_mohon BETWEEN DATE_SUB(NOW(), INTERVAL 4 MONTH) AND NOW() AND s_konsumen = 'Valid' ");
      return $query->num_rows();
    }

    function getkpb3()
    {
      $query = $this->db->query("SELECT * FROM konsumen WHERE tanggal_mohon BETWEEN DATE_SUB(NOW(), INTERVAL 8 MONTH) AND NOW() AND s_konsumen = 'Valid' ");
      return $query->num_rows();
    }

    function getkpb4()
    {
      $query = $this->db->query("SELECT * FROM konsumen WHERE tanggal_mohon BETWEEN DATE_SUB(NOW(), INTERVAL 12 MONTH) AND NOW() AND s_konsumen = 'Valid' ");
      return $query->num_rows();
    }

    function getwhatsapp($tanggal=null, $status=null)
    {
      $query = $this->db->query("SELECT * FROM chat WHERE tanggal = '$tanggal' AND status = '$status' ");
      return $query->num_rows();
    }

    function getKonsumen($no_mesin)
    {
      $query = $this->db->query("SELECT * FROM konsumen WHERE no_mesin = '$no_mesin'");
      return $query->row_array();
    }

    function filterbytanggalbeli($tanggalawal,$tanggalakhir)
    {
      $query = $this->db->query("SELECT * FROM konsumen where tanggal_mohon BETWEEN '$tanggalawal' AND '$tanggalakhir' AND s_konsumen = 'Valid' AND s_cdb = '1' ORDER BY id ASC");
      if ($query == TRUE){
        return $query->result();
      } else {
        return FALSE;
      }
    }	

    function filterbytanggallahir($tanggalawal,$tanggalakhir)
    {
      $query = $this->db->query("SELECT * FROM konsumen where tanggal_lahir BETWEEN '$tanggalawal' AND '$tanggalakhir' AND s_konsumen = 'Valid' AND s_cdb = '1' ORDER BY id ASC");
      if ($query == TRUE){
        return $query->result();
      } else {
        return FALSE;
      }
    }	

    function getChat($tanggal)
    {
		$query = $this->db->query("SELECT * FROM chat WHERE tanggal = '$tanggal' AND status != 'Inbox'");
        return $query->result_array();
    }
    
    function retrySend($tanggal)
    {
        $this->db->set('status', 'Outbox');
        $this->db->where('tanggal', $tanggal);
        $this->db->where('status', 'Gagal');
		$payload = $this->db->update('chat');
		return $payload;
        
    }

    function getPesan($key)
    {
		$query = $this->db->query("SELECT * FROM chat WHERE dari = '$key' ORDER BY timestamp DESC LIMIT 5");
        return $query->result_array();
    }

    function getInbox()
    {
		$query = $this->db->query("SELECT * FROM chat WHERE status = 'Inbox' GROUP BY dari HAVING COUNT(dari)  >= 1");
        return $query->result_array();
    }

    function numsGagal($tanggal)
    {
      $query = $this->db->query("SELECT * FROM chat WHERE date(tanggal = '$tanggal') AND status = 'Gagal' OR status = ''");
      return $query->num_rows();
    }
    function numsTerkirim($tanggal)
    {
      $query = $this->db->query("SELECT * FROM chat WHERE tanggal = '$tanggal' AND status = 'Terkirim'");
      return $query->num_rows();
    }
    function numsNotRegister($tanggal)
    {
      $query = $this->db->query("SELECT * FROM chat WHERE tanggal = '$tanggal' AND status = 'Nomer Tidak Valid'");
      return $query->num_rows();
    }
    function numswaiting($tanggal)
    {
      $query = $this->db->query("SELECT * FROM chat WHERE tanggal = '$tanggal' AND status = 'waiting'");
      return $query->num_rows();
    }
}