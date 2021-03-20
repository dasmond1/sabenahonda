<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Wilayah extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    function getProvinsi()
    {
		$query = $this->db->query("SELECT * FROM provinces  ORDER BY name ASC");
		return $query;
    }

    function getKota($id)
    {
		$query = $this->db->query("SELECT * FROM regencies WHERE province_id = '$id' ORDER BY name ASC");
		return $query;
    }

    function getKecamatan($id)
    {
		$query = $this->db->query("SELECT * FROM districts WHERE regency_id = '$id' ORDER BY name ASC");
		return $query;
    }

    function getKelurahan($id)
    {
		$query = $this->db->query("SELECT * FROM villages WHERE district_id = '$id' ORDER BY name ASC");
		return $query;
    }

    // Get Name Wilayah
    function getNameProvinsi($id)
    {
		$query = $this->db->query("SELECT * FROM provinces WHERE id = '$id'");
		return $query;
    }

    function getNameKota($id)
    {
		$query = $this->db->query("SELECT * FROM regencies WHERE id = '$id'");
		return $query;
    }

    function getNameKecamatan($id)
    {
		$query = $this->db->query("SELECT * FROM districts WHERE id = '$id'");
		return $query;
    }

    function getNameKelurahan($id)
    {
		$query = $this->db->query("SELECT * FROM villages WHERE id = '$id'");
		return $query;
    }

}