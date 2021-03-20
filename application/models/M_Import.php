<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Import extends CI_Model {

    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Fungsi untuk insert data ke dalam database.
     *
     */
    public function saveSPG($data)
    {
        $this->db->where('no_mesin', $data['no_mesin']);
        $query = $this->db->get('stok_unit');
        $count_row = $query->num_rows();
        if ($count_row > 0) {
            return FALSE;
        } else {
            $query = $this->db->insert('stok_unit', $data);
            return TRUE;
        }
        
    }

    public function saveCDB($data)
    {
        $this->db->where('no_mesin', $data['no_mesin']);
        $query = $this->db->update('konsumen', $data);
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
}