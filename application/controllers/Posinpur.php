<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posinpur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'posinpur');
        $this->load->helper('tgl_indo');
        $this->load->model('M_Wilayah', 'modelWilayah');   
        $this->load->model('M_Posinpur', 'modelInpur');
        $this->load->model('M_Dashboardinpur', 'modelDashboard');

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

                $data['kiriman'] = $this->modelDashboard->getTotalKiriman($tanggal)->result_array();

                $data['pengirim'] = $this->modelDashboard->getPengirim($tanggal);

                $data['jam_kirim'] = $this->modelDashboard->getJamKirim($tanggal);

                $data['target'] = $this->modelDashboard->getTarget($bulan, $tahun);

                $data['detail'] = $this->modelDashboard->getDetail($tanggal);   

                $data['detail_spg'] = $this->modelDashboard->getDetailSPG($tanggal);

                $data['detail_finco'] = $this->modelDashboard->getDetailFinco($bulan, $tahun);

                $data['tanggal_selected'] =  $_GET['tanggal'];
                $data['bulan'] = $bulan;
                $data['tahun'] = $tahun;
                $data['title'] = 'Dashboard';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('pos-inpur/index', $data);
                $this->load->view('templates/footer');
            } else {
                $tanggal = date('Y-m-d');
                $bulan = date('m');
                $tahun = date('Y');

                $data['stok'] = $this->modelDashboard->getStokAkhir($tanggal);

                $data['todate'] = $this->modelDashboard->byDate($tanggal);

                $data['bulan_ini'] = $this->modelDashboard->penjualanOneMonth($bulan, $tahun);

                $data['kiriman'] = $this->modelDashboard->getTotalKiriman($tanggal)->result_array();

                $data['pengirim'] = $this->modelDashboard->getPengirim($tanggal);

                $data['jam_kirim'] = $this->modelDashboard->getJamKirim($tanggal);

                $data['target'] = $this->modelDashboard->getTarget($bulan, $tahun);

                $data['detail'] = $this->modelDashboard->getDetail($tanggal);

                $data['detail_spg'] = $this->modelDashboard->getDetailSPG($tanggal);

                $data['detail_finco'] = $this->modelDashboard->getDetailFinco($bulan, $tahun);

                $data['tanggal_selected'] =  date('Y-m-d');
                $data['bulan'] = $bulan;
                $data['tahun'] = $tahun;
                $data['title'] = 'Dashboard';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('pos-inpur/index', $data);
                $this->load->view('templates/footer');
            }

        } else {
            redirect('auth/logout');
        }

    }

    public function inputpenjualan(){
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $nourut = $this->modelInpur->geturutan();
            $urutan = $nourut['urutan'] + 1;

            $data['urutan'] = $urutan;

            $kode =  sprintf("%03s", $urutan);
            $data['no_tt'] = $kode.'/TT-INP/LMB/'.romawi_bulan(date("m"))."/".date("Y");

            $data['stok'] = $this->db->query("SELECT * FROM stok_unit WHERE status_pos = 'RFS' AND posisi_unit = 'On Pos Inpur' ORDER BY id ASC")->result_array();

            // Select 2 jenis Penjualan
            $data['jenis'] = $this->db->get('jenis_penjualan')->result_array();
            //Array Alamat
            $data['provinsi'] = $this->modelWilayah->getProvinsi()->result_array();

            $data['title'] = 'Input Penjualan';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pos-inpur/input-penjualan', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth/logout');
        }
    }

    public function showData()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->modelInpur->getDetailUnit($id)->row_array();

        echo json_encode($data);
        
    }

    public function savePenjualan()
    {

            //Get Name Wilayah By ID
            $namaProv = $this->modelWilayah->getNameProvinsi($this->input->post('provinsi'))->row_array();
            $namaKota = $this->modelWilayah->getNameKota($this->input->post('kota'))->row_array();
            $namaKecamatan = $this->modelWilayah->getNameKecamatan($this->input->post('kecamatan'))->row_array();
            $namaDesa = $this->modelWilayah->getNameKelurahan($this->input->post('desa'))->row_array();

            $ptn = "/^0/";  // Regex
            $rpltxt = "62";  // Replacement string

        $data = [
            'urutan' =>  $this->input->post('urutan'),
            'no_tt' =>  $this->input->post('no_tt'),
            'nama' =>  strtoupper($this->input->post('nama')),
            'no_ktp' =>  $this->input->post('no_ktp'),
            'alamat' =>  strtoupper($this->input->post('alamat')),
            'prov' => strtoupper($namaProv['name']),
            'kota' =>  strtoupper($namaKota['name']),
            'kecamatan' =>  strtoupper($namaKecamatan['name']),
            'desa' =>  strtoupper($namaDesa['name']),
            'no_telepon' =>  preg_replace($ptn, $rpltxt, $this->input->post('no_telepon')),
            'no_mesin' =>  $this->input->post('no_mesin'),
            'jenis_penjualan' =>  $this->input->post('jenis_penjualan'),
            'nominal' =>  preg_replace('~\D~', '', $this->input->post('nominal')),
            'register_plat' =>  strtoupper($this->input->post('register_plat')),
            'plat_sementara' =>  strtoupper($this->input->post('plat_sementara')),
            'sale_by' =>  $this->input->post('sale_by'),
            's_dealer' =>  'Not Check',
            's_konsumen' =>  'Valid',
            'tanggal' =>  $this->input->post('tanggal'),
            'sumber' =>  'Pos Inpur',
        ];  
            $insert = $this->db->insert('penjualanpos', $data);
            if ($insert) {
                $this->db->set('status_pos', 'SALE');
                $this->db->where('no_mesin', $this->input->post('no_mesin'));
                $this->db->update('stok_unit');
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Lapor Penjualan</div><div><a href="print_tt/'.$data['no_mesin'].'" class="btn btn-primary"><i class="fas fa-print"></i> Print</a>');
                redirect('posinpur/inputpenjualan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Lapor Penjualan</div>');
                redirect('staff/inputpenjualan');
            }

    }

    public function print_tt($no_mesin)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $nosin = urldecode($no_mesin);

                $data['title'] = "Print TT";
                $data['detail'] = $this->db->query("SELECT * FROM penjualanpos WHERE no_mesin = '$nosin' AND s_konsumen = 'Valid' AND sumber = 'Pos Inpur'")->row_array();
                $data['unit'] = $this->db->query("SELECT * FROM stok_unit WHERE no_mesin = '$nosin'")->row_array();
                $this->load->view('templates/auth_header', $data);
                $this->load->view('pos-inpur/print-tt', $data);

        } else {
            redirect('auth/logout');
        }
    }

    public function terimastok()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $data['inbound'] = $this->db->query("SELECT * FROM history_mutasi WHERE tujuan = 'On Pos Inpur' AND status = 'Pengantaran'")->result_array();
            $data['title'] = 'Terima Stok';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pos-inpur/terima-stok', $data);
            $this->load->view('templates/footer');

        } else {
            redirect('auth/logout');
        }
    }

    public function terima_inbound($id)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $this->db->where('id', $id);
            $this->db->set('status', 'Di Terima');
            $update = $this->db->update('history_mutasi');
            if ($update) {
                $get_nosin = $this->db->query("SELECT * FROM history_mutasi WHERE id = $id")->row_array();
                $nosin = explode(",", $get_nosin['no_mesin']);
                foreach ($nosin as $key) {
                    $this->db->where('no_mesin', $key);
                    $this->db->set('status_pos', 'RFS');
                    $this->db->update('stok_unit');
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Terima Unit</div>');
                redirect('posinpur/terimastok');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menerima Unit</div>');
                redirect('staff/terimastok');
            }

        } else {
            redirect('auth/logout');
        }
    }

    public function returstok()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            if (isset($_POST['submit'])){

                //Time
                $tanggal = date("Y-m-d");
                $jam = date("H:i:sa");

                $nourut = $this->modelInpur->geturutan();
                $urutan = $nourut['no_urut'] + 1;

                $kode =  sprintf("%03s", $urutan);
                $no_surat = $kode.'/BAST-RTR/LMB/'.date("m/Y");

                    
                    $data = [
                        'no_surat' => $no_surat,
                        'no_urut' =>  $urutan,
                        'no_mesin' =>  implode(",", $this->input->post('nomesin')),
                        'tujuan' =>  $this->input->post('tujuan'),
                        'alamat_tujuan' =>  $this->input->post('alamat_tujuan'),
                        'supir' =>  strtoupper($this->input->post('driver')),
                        'tanggal_mutasi' =>  $tanggal,
                        'jam_mutasi' =>  $jam,
                        'status' =>  'Pengantaran'
                    ];

                    $insert = $this->db->insert('history_retur', $data);

                    if ($insert){
                        $mesin = explode(",", $data['no_mesin']);
                        foreach ($mesin as $ns) {
                            $data2 = [
                                'status_unit' => 'RFS',
                                'status_pos' => 'RETUR',
                                'posisi_unit' => $this->input->post('tujuan'),
                            ];
                            $this->db->where('no_mesin', $ns);
                            $update = $this->db->update('stok_unit', $data2);
                        }
                        if ($update){
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Mutasi Unit </div>');
                            redirect('posinpur/returstok');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Retur Unit</div>');
                            redirect('posinpur/returstok');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Retur Unit</div>');
                        redirect('posinpur/returstok');
                    }

            } else {
                $data['retur'] = $this->db->query("SELECT * FROM history_retur WHERE  status = 'Pengantaran'")->result_array();
                $data['unit'] = $this->db->query("SELECT * FROM stok_unit WHERE posisi_unit = 'On Pos Inpur' AND status_pos = 'RFS'")->result_array();
                $data['driver'] = $this->db->get('admin')->result_array();
                $data['title'] = 'Retur Stok';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('pos-inpur/retur-stok', $data);
                $this->load->view('templates/footer');

            }

        } else {
            redirect('auth/logout');
        }
    }
    public function laporanstok()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {
        $this->db->where('posisi_unit', 'On Pos Inpur');
        $this->db->where('status_pos', 'RFS');
        $data['stok'] = $this->db->get('stok_unit')->result_array();

        $data['title'] = 'Laporan Stok';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pos-inpur/lap-stok', $data);
        $this->load->view('templates/footer');

            
        } else {
            redirect('auth/logout');
        }
            
    }
    public function laporanpenjualan()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();
        
        $data['title'] = 'Laporan Penjualan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pos-inpur/view-laporan', $data);
        $this->load->view('templates/footer');
    }

    function filter(){
		$tanggalawal = $this->input->post('tanggalawal');
		$tanggalakhir = $this->input->post('tanggalakhir');
		
		$nilaifilter = $this->input->post('nilaifilter');


		if ($nilaifilter == 1) {
			
			$data['title'] = "Laporan Penjualan Pos Indrapuri";
			$data['subtitle'] = date_indo($tanggalawal).' s/d '.date_indo($tanggalakhir);
			$data['datafilter'] = $this->modelInpur->filterbytanggal($tanggalawal,$tanggalakhir);

            $this->load->view('templates/header', $data);
            $this->load->view('pos-inpur/print-laporan', $data);

		}
    }

}
