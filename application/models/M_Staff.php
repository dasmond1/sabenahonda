<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Staff extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    function getDetailCDB()
    {
		$query = $this->db->query("SELECT * FROM konsumen WHERE (s_cdb = '0') AND s_konsumen = 'Valid'");
		return $query;
    }

    function getDataPrint($no_mesin)
    {

		$query = $this->db->query("SELECT * FROM konsumen WHERE no_mesin = '$no_mesin' AND s_konsumen = 'Valid'");
        return $query->row_array();
        
    }

    function listMutasi()
    {
		$query = $this->db->query("SELECT * FROM history_mutasi GROUP BY no_surat HAVING COUNT(no_surat)  >= 1  ORDER BY id DESC");
        return $query->result_array();
    }

    function printBast($id)
    {
		$query = $this->db->query("SELECT * FROM history_mutasi WHERE id = '$id'");
        return $query;
    }

    function getkodeunit()
    {
        $query = $this->db->query("SELECT * FROM produk");
            return $query;
    }

    function getDetailUnit($kode_unit)
    {
        $query = $this->db->query("SELECT * FROM produk WHERE kode_unit = '$kode_unit' OR kode_unit LIKE '$kode_unit______%' LIMIT 1");
            return $query->unbuffered_row();
    }

    function getWarna($kode)
    {
		$query = $this->db->query("SELECT * FROM warna WHERE kode = '$kode'");
        return $query->unbuffered_row();
    }

    function geturutan()
    {
        $bulan = date('m');
        $tahun = date('Y');
		$query = $this->db->query("SELECT * FROM history_mutasi WHERE (MONTH(tanggal_mutasi) = '$bulan' AND YEAR(tanggal_mutasi) = '$tahun') ORDER by id DESC LIMIT 1");
        return $query->row_array();
    }

    function getDetailbast($nosin)
    {
        $query = $this->db->query("SELECT * FROM stok_unit WHERE no_mesin = '$nosin'");
            return $query->row_array();
    }


}