<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'penjualan');
        $this->load->helper('tgl_indo');
        $this->load->model('M_Penjualan', 'modelPenjualan');
        $this->load->model('M_Import', 'modelImport');
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
                $this->load->view('penjualan/index', $data);
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
                $this->load->view('penjualan/index', $data);
                $this->load->view('templates/footer');
            }

        } else {
            redirect('auth/logout');
        }

        
    }
    public function laporan()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();
        
        $this->form_validation->set_rules('nomor_faktur1','Nomor Faktur', 'required');
        $this->form_validation->set_rules('no_mesin','No Mesin', 'required');
        $this->form_validation->set_rules('no_rangka','No Rangka', 'required');
        $this->form_validation->set_rules('tipe','Tipe', 'required');
        $this->form_validation->set_rules('warna','warna', 'required');
        $this->form_validation->set_rules('tahun','Tahun', 'required');
        $this->form_validation->set_rules('nama','Nama', 'required');
        $this->form_validation->set_rules('jenis_penjualan','Jenis Penjualan', 'required');
        $this->form_validation->set_rules('sale_by','Sale By', 'required');

        if($this->form_validation->run() == false){
             // Select 2 Stock
             $data['stok'] = $this->db->query("SELECT * FROM stok_unit WHERE status_unit = 'RFS' OR status_unit = 'MUTASI' ORDER BY id ASC")->result_array();
             // Select 2 jenis Penjualan
             $data['jenis'] = $this->db->get('jenis_penjualan')->result_array();
             // Select 2 Sale By
             $data['saleby'] = $this->db->get('admin')->result_array();  
             
             $data['title'] = 'Input Laporan';
             $this->load->view('templates/header', $data);
             $this->load->view('templates/navbar', $data);
             $this->load->view('templates/sidebar', $data);
             $this->load->view('penjualan/laporan', $data);
             $this->load->view('templates/footer');
            
        } else {    
            $data = [
                'no_so' =>  $this->input->post('nomor_faktur1').$this->input->post('nomor_faktur2'),
                'no_mesin' =>  $this->input->post('no_mesin'),
                'no_rangka' =>  $this->input->post('no_rangka'),
                'tipe' =>  $this->input->post('tipe'),
                'warna' =>  $this->input->post('warna'),
                'tahun' =>  $this->input->post('tahun'),
                'nama' =>  strtoupper($this->input->post('nama')),
                'jenis_penjualan' =>  $this->input->post('jenis_penjualan'),
                'sale_by' =>  $this->input->post('sale_by'),
                'no_spg' =>  $this->input->post('no_spg'),
                'no_doh' =>  $this->input->post('no_doh'),
                'tanggal_mohon' =>  $this->input->post('tanggal'),
                'jenis_konsumen' =>  $this->input->post('jenis_konsumen'),
                'created_by' =>  $this->input->post('created_by'),
                's_cdb' =>  '0',
                's_whatsapp' =>  'Uncheck',
                's_konsumen' => 'Valid'
                
            ];
            // Periksa DB
            $this->db->where('no_so', $data['no_so']);
            $query = $this->db->get('konsumen');
            $count_row = $query->num_rows();
            if ($count_row > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Nomor Faktur '.$data['no_so'].' Sudah pernah di input</div>');
                redirect('penjualan/laporan');
            } else {
                $this->db->insert('konsumen', $data);
                $this->db->set('status_unit', 'SALE');
                $this->db->set('status_pos', 'SALE');
                $this->db->where('no_mesin', $data['no_mesin']);
                $this->db->update('stok_unit');
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('penjualan/laporan');
            }

        }
    }
    public function showData()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->modelPenjualan->getDetailUnit($id)->row_array();
        echo json_encode($data);
        
    }
    
    public function viewlaporan()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();
        
        $data['title'] = 'View Laporan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('penjualan/view-laporan', $data);
        $this->load->view('templates/footer');
    }

    function filter(){
		$tanggalawal = $this->input->post('tanggalawal');
		$tanggalakhir = $this->input->post('tanggalakhir');
		
		$nilaifilter = $this->input->post('nilaifilter');


		if ($nilaifilter == 1) {
			
			$data['title'] = "Laporan Penjualan";
			$data['subtitle'] = date_indo($tanggalawal).' s/d '.date_indo($tanggalakhir);
			$data['datafilter'] = $this->modelPenjualan->filterbytanggal($tanggalawal,$tanggalakhir);

            $this->load->view('templates/header', $data);
            $this->load->view('penjualan/print-laporan', $data);

		}
    }

    public function importspg()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $data['title'] = 'Import SPG';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penjualan/import-spg', $data);
            $this->load->view('templates/footer');  

            if ( isset($_POST['import'])) {

                $file = $_FILES['file']['tmp_name'];

                // Medapatkan ekstensi file csv yang akan diimport.
                $ekstensi  = explode('.', $_FILES['file']['name']);

                // Tampilkan peringatan jika submit tanpa memilih menambahkan file.
                if (empty($file)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Anda Belum Memilih File atau File anda kosong</div>');
                    redirect('penjualan/importspg');
                } else {
                    // Validasi apakah file yang diupload benar-benar file csv.
                    if (strtolower(end($ekstensi)) === 'umsl' && $_FILES["file"]["size"] > 0) {

                        $handle = fopen($file, "r");
                        while (($row = fgetcsv($handle, 10000, ";"))) {

                            // Data yang akan disimpan ke dalam databse
                            $tanggal = date("Y-m-d");
                            $jam = date("H:i:sa");
                            $data = [
                                'no_surat' => $row[0],
                                'tanggal_kirim' => $row[1],
                                'id_dealer' => $row[2],
                                'kode_dealer' => $row[3],
                                'kode_unit' => $row[4],
                                'warna' => $row[5],
                                'no_rangka' => 'MH1'.$row[6],
                                'no_mesin' => $row[7],
                                'tahun' => $row[8],
                                'no_doh' => $row[9],
                                'pengirim' => $row[10],
                                'no_truk' => $row[11],
                                'no_spg' => $row[12],
                                'posisi_unit' => 'On Dealer',
                                'tanggal_input' => $tanggal,
                                'jam_tiba' => $jam,
                                'status_unit' => 'RFS',
                            ];
                                // Simpan data ke database.
                                $import = $this->modelImport->saveSPG($data);
                            }
                            if ($import == TRUE){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                                redirect('penjualan/importspg');
                            } else if ($import == FALSE){
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> No SPG : '.$data['no_spg'].' Sudah Pernah di Input</div>');
                                redirect('penjualan/importspg');
                            }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Format File Tidak Sesuai (Wajib .umsl)</div>');
                        redirect('penjualan/importspg');
                    }
                }
            }
        } else {
            redirect('auth/logout');
        }   
    }
    public function viewstok()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();
        
        if ($this->session->has_userdata('id')) {

            $where = "status_unit = 'RFS' OR status_unit = 'NRFS' OR status_unit = 'REJECT' OR status_unit = 'PAMERAN'";
            $this->db->where($where);
            $data['stok'] = $this->db->get('stok_unit')->result_array();

            $data['title'] = 'View Stok';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('penjualan/view-stok', $data);
            $this->load->view('templates/footer');


        } else {    
            redirect('auth/logout');
        }        
    }
    public function deletekonsumen()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            $data = [
                'no_mesin' =>  $this->input->post('no_mesin')
            ];
            $nomesin = $this->input->post('no_mesin');
            $table = $this->input->post('where');
            $halamanAsal = $this->input->post('function');
            $hapus = $this->db->delete($table, $data);
            if ($hapus) {
                $data2 = array(
                    'status_unit' => 'RFS',
                    'status_pos' => '',
                );
                $this->db->where('no_mesin', $nomesin);
                $this->db->update('stok_unit', $data2);
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menghapus Data</div>');
                redirect('penjualan/'.$halamanAsal);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                redirect('penjualan/'.$halamanAsal);
            }

    }
    

}


        