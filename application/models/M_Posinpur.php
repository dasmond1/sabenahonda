<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Posinpur extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    function geturutan()
    {
        $bulan = date('m');
        $tahun = date('Y');
		$query = $this->db->query("SELECT * FROM penjualanpos WHERE (MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' AND sumber = 'Pos Inpur') ORDER by id DESC LIMIT 1");
        return $query->row_array();
    }

    function getDetailUnit($id){
        $query = $this->db->get_where('stok_unit', array('no_mesin' => $id));
        return $query;
    }

    function filterbytanggal($tanggalawal,$tanggalakhir){

		$query = $this->db->query("SELECT * FROM penjualanpos where tanggal BETWEEN '$tanggalawal' AND '$tanggalakhir' AND sumber = 'Pos Inpur' ORDER BY id ASC");

		return $query->result();
    }

    function getWarna($id){
        $query = $this->db->get_where('warna', array('kode' => $id));
        return $query->row_array();
    }

    

}