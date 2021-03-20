<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'owner');
        $this->load->helper('tgl_indo');
        $this->load->model('M_Dashboard', 'modelDashboard');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            if (isset($_GET['tanggal'])) {
                $tanggal = $_GET['tanggal'];
                $time  = strtotime($tanggal);
                $bulan = date('m',$time);
                $tahun  = date('Y',$time);

                $data['stok'] = $this->modelDashboard->getStokAkhir($tanggal);

                $data['todate'] = $this->modelDashboard->byDate($tanggal);

                $data['bulan_ini'] = $this->modelDashboard->penjualanOneMonth($bulan, $tahun);

                $data['kiriman'] = $this->modelDashboard->getTotalKiriman($tanggal);

                $data['pengirim'] = $this->modelDashboard->getPengirim($tanggal);

                $data['jam_kirim'] = $this->modelDashboard->getJamKirim($tanggal);

                $data['target'] = $this->modelDashboard->getTarget($bulan, $tahun);

                $data['detail'] = $this->modelDashboard->getDetail($tanggal);   

                $data['detail_spg'] = $this->modelDashboard->getDetailSPG($tanggal);

                $data['detail_sale_by'] = $this->modelDashboard->getDetailSaleby($bulan, $tahun);  
                             
                $data['detail_finco'] = $this->modelDashboard->getDetailFinco($bulan, $tahun);               

                $data['tanggal_selected'] =  $_GET['tanggal'];
                $data['bulan'] = $bulan;
                $data['tahun'] = $tahun;
                $data['title'] = 'Dashboard';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('owner/index', $data);
                $this->load->view('templates/footer');
            } else {
                $tanggal = date('Y-m-d');
                $bulan = date('m');
                $tahun = date('Y');

                $data['stok'] = $this->modelDashboard->getStokAkhir($tanggal);

                $data['todate'] = $this->modelDashboard->byDate($tanggal);

                $data['bulan_ini'] = $this->modelDashboard->penjualanOneMonth($bulan, $tahun);

                $data['kiriman'] = $this->modelDashboard->getTotalKiriman($tanggal);

                $data['pengirim'] = $this->modelDashboard->getPengirim($tanggal);

                $data['jam_kirim'] = $this->modelDashboard->getJamKirim($tanggal);

                $data['target'] = $this->modelDashboard->getTarget($bulan, $tahun);

                $data['detail'] = $this->modelDashboard->getDetail($tanggal);

                $data['detail_spg'] = $this->modelDashboard->getDetailSPG($tanggal);

                $data['detail_sale_by'] = $this->modelDashboard->getDetailSaleby($bulan, $tahun);   

                $data['detail_finco'] = $this->modelDashboard->getDetailFinco($bulan, $tahun);
                
                $data['tanggal_selected'] =  date('Y-m-d');
                $data['bulan'] = $bulan;
                $data['tahun'] = $tahun;
                $data['title'] = 'Dashboard';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('owner/index', $data);
                $this->load->view('templates/footer');
            }

        } else {
            redirect('auth/logout');
        }

    }
}