<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_Penjualan extends CI_Model{
     
    function getDetailUnit($id){
        $query = $this->db->get_where('stok_unit', array('no_mesin' => $id));
        return $query;
    }

    function filterbytanggal($tanggalawal,$tanggalakhir){

		$query = $this->db->query("SELECT * FROM konsumen where tanggal_mohon BETWEEN '$tanggalawal' AND '$tanggalakhir' ORDER BY id ASC");

		return $query->result();
    }	
     
}