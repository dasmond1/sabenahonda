<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dashboard extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    // Hitung Berdasarkan Tanggal terpilih
    function byDate($tanggal)
    {
		$query = $this->db->query("SELECT * FROM konsumen WHERE (tanggal_mohon = '$tanggal') AND s_konsumen = 'Valid'");
		return $query->num_rows();
    }

    //Hitung 1 Bulan
    function penjualanOneMonth($bulan, $tahun)
    {
		$query = $this->db->query("SELECT * FROM konsumen WHERE (MONTH(tanggal_mohon) = '$bulan' AND YEAR(tanggal_mohon) = '$tahun') AND s_konsumen = 'Valid'");
		return $query->num_rows();
    }

    //Hitung Stok Akhir
    function getStokAkhir()
    {
        $this->db->where('status_unit', 'RFS');
        $this->db->or_where('status_unit', 'NRFS');
        $this->db->or_where('status_unit', 'PAMERAN');
        $query = $this->db->get('stok_unit');
		return $query->num_rows();
    }

    // Ambid Data Pengiriman By Tanggal ()
    function getPengirim($tanggal)
    {
        $query = $this->db->query("SELECT * FROM stok_unit WHERE (tanggal_input = '$tanggal') AND status_unit = 'RFS' ORDER BY ID DESC LIMIT 1");
        $result =  $query->row('pengirim');

        if ($result == "WYU"){
            return ('WAHYU EKSPRESS');
        } else if($result == "SLWH"){
            return ('SEULAWAH EKSPRESS');
        } else if($result == "RPME"){
            return ('RODA PRIMA EKSPRESS');
        } else {
            return ('Tidak ada Penerimaan');
        }
    }
    function getJamKirim($tanggal)
    {
        $query = $this->db->query("SELECT * FROM stok_unit WHERE (tanggal_input = '$tanggal') AND status_unit = 'RFS' ORDER BY ID DESC LIMIT 1");
        if($query){
            return $query->row('jam_tiba');
        } else {
            return('Tidak ada Penerimaan');
        }
    }
    function getTotalKiriman($tanggal)
    {
        $query = $this->db->get_where('stok_unit', array('tanggal_input' => $tanggal));
		return $query->num_rows();
    }
    function getTarget($bulan, $tahun)
    {
        $query = $this->db->get_where('target_penjualan', array('bulan' => $bulan, 'tahun' => $tahun, 'untuk' => 'Dealer'));
        $target = $query->row('target');
        if($target){
            return $target;
        } else {            
            return ('0');
        }
    }

    function getDetail($tanggal)
    {
        $query = $this->db->query("SELECT * FROM konsumen WHERE (tanggal_mohon = '$tanggal') AND s_konsumen = 'Valid'");
		return $query->result_array();
    }  

    function getDetailSPG($tanggal)
    {
        $query = $this->db->query("SELECT * FROM stok_unit WHERE (tanggal_input = '$tanggal')");
		return $query->result_array();
    } 

    function getDetailSaleby($bulan, $tahun)
    {
        
        $query = $this->db
        ->select("sale_by, count(*) AS top",false)
        ->from ("konsumen")
        ->where("YEAR(tanggal_mohon)",$tahun)
        ->where("MONTH(tanggal_mohon)",$bulan)
        ->group_by("sale_by")
        ->order_by("top","DESC")
        ->get();

        foreach ($query->result() as $row) {
            $data[] = array(
                'sale_by' => $row->sale_by,                
                'jumlah' => $row->top
            );
            
        }
            return $data;
        
    
    
    }

    function getDetailFinco($bulan, $tahun)
    {
       
        $query = $this->db
        ->select("jenis_penjualan, count(*) AS top",false)
        ->from ("konsumen")
        ->where("YEAR(tanggal_mohon)",$tahun)
        ->where("MONTH(tanggal_mohon)",$bulan)
        ->group_by("jenis_penjualan")
        ->order_by("top","DESC")
        ->get();

        foreach ($query->result() as $row) {
            $data[] = array(
                'jenis_penjualan' => $row->jenis_penjualan,                
                'jumlah' => $row->top
            );
        }
    
    return $data;
    } 

    function getNamaAsli($honda_id)
    {
        $query = $this->db->query("SELECT * FROM admin WHERE honda_id = '$honda_id'");
		return $query->unbuffered_row();
    }

    function getInfo($where=null)
    {
        $query = $this->db->query("SELECT * FROM info WHERE (untuk = '$where') AND is_active = '1' ORDER BY id DESC");
        
            return $query->result_array();
      
    }
}



