<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dashboardinpur extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    // Hitung Berdasarkan Tanggal terpilih
    function byDate($tanggal)
    {
		$query = $this->db->query("SELECT * FROM penjualanpos WHERE (tanggal = '$tanggal') AND s_konsumen = 'Valid' AND sumber = 'Pos Inpur'");
		return $query->num_rows();
    }

    //Hitung 1 Bulan
    function penjualanOneMonth($bulan, $tahun)
    {
		$query = $this->db->query("SELECT * FROM penjualanpos WHERE (MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun') AND s_konsumen = 'Valid' AND sumber = 'Pos Inpur'");
		return $query->num_rows();
    }

    //Hitung Stok Akhir
    function getStokAkhir()
    {
        $this->db->where('status_pos', 'RFS');
        $this->db->where('posisi_unit', 'On Pos Inpur');
        $query = $this->db->get('stok_unit');
		return $query->num_rows();
    }

    // Ambid Data Pengiriman By Tanggal ()
    function getPengirim($tanggal)
    {
        $query = $this->db->query("SELECT * FROM history_mutasi WHERE (tanggal_mutasi = '$tanggal' AND tujuan = 'On Pos Inpur') AND status = 'Pengantaran' ORDER BY ID DESC LIMIT 1");
        $result =  $query->row('supir');
        
        return $result;
        
    }
    function getJamKirim($tanggal)
    {
        $query = $this->db->query("SELECT * FROM history_mutasi WHERE (tanggal_mutasi = '$tanggal' AND tujuan = 'On Pos Inpur') AND status = 'Pengantaran' ORDER BY ID DESC LIMIT 1");
        if($query){
            return $query->row('jam_mutasi');
        } else {
            return('Tidak ada Penerimaan');
        }
    }
    function getTotalKiriman($tanggal)
    {
        $query = $this->db->get_where('history_mutasi', array('tanggal_mutasi' => $tanggal, 'tujuan' => 'On Pos Inpur'));
        return $query;
    }
    function getTarget($bulan, $tahun)
    {
        $query = $this->db->get_where('target_penjualan', array('bulan' => $bulan, 'tahun' => $tahun, 'untuk' => 'Pos Inpur'));
        $target = $query->row('target');
        if($target){
            return $target;
        } else {            
            return ('0');
        }
    }

    function getDetail($tanggal)
    {
        $query = $this->db->query("SELECT * FROM penjualanpos WHERE (tanggal = '$tanggal') AND s_konsumen = 'Valid' AND sumber = 'Pos Inpur'");
		return $query->result_array();
    }  

    function getDetailSPG($tanggal)
    {
        $query = $this->db->query("SELECT * FROM history_mutasi WHERE (tanggal_mutasi = '$tanggal' AND tujuan = 'On Pos Inpur')");
		return $query->result_array();
    } 

    function getDetailFinco($bulan, $tahun)
    {
       
        $query = $this->db
        ->select("jenis_penjualan, count(*) AS top",false)
        ->from ("penjualanpos")
        ->where("YEAR(tanggal)",$tahun)
        ->where("MONTH(tanggal)",$bulan)
        ->where("sumber","Pos Inpur")
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



