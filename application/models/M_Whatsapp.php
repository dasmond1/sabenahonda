<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Whatsapp extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function getServer()
    {
		$query = $this->db->query("SELECT * FROM api_whatsapp");
		return $query->row_array();
    }

    function getChat()
    {
		$query = $this->db->query("SELECT * FROM chat WHERE status = 'Outbox' LIMIT 25");
		return $query->result_array();
    }

    function getWaiting()
    {
		$query = $this->db->query("SELECT * FROM chat WHERE status = 'waiting' LIMIT 25");
		return $query->result_array();
    }

}