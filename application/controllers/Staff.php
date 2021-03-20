<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'staff');
        $this->load->helper('tgl_indo');
        $this->load->model('M_Staff', 'modelStaff');
        $this->load->model('M_Import', 'modelImport');    
        $this->load->model('M_Dashboard', 'modelDashboard');
        $this->load->model('M_Wilayah', 'modelWilayah');
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
                $this->load->view('staff/index', $data);
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
                $this->load->view('staff/index', $data);
                $this->load->view('templates/footer');
            }
            

        } else {
            redirect('auth/logout');
        }

    }

    public function koreksicdb()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $data['detail_cdb'] = $this->modelStaff->getDetailCDB()->result_array();

                //Array Alamat
                $data['provinsi'] = $this->modelWilayah->getProvinsi()->result_array();

                $data['kodeunit'] = $this->modelStaff->getkodeunit()->result_array();

                $data['title'] = 'Koreksi CDB';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('staff/koreksicdb', $data);
                $this->load->view('templates/footer', $data);
        
        if (isset($_POST['submit'])){
            $nomesin = $this->input->post('no_mesin');            
            
            $idProv = $this->input->post('provinsi');
            $idKota = $this->input->post('kota');
            $idKecamatan = $this->input->post('kecamatan');
            $idDesa = $this->input->post('desa');

            //MAKA Hasilnya
            $namaProv = $this->modelWilayah->getNameProvinsi($idProv)->row_array();
            $namaKota = $this->modelWilayah->getNameKota($idKota)->row_array();
            $namaKecamatan = $this->modelWilayah->getNameKecamatan($idKecamatan)->row_array();
            $namaDesa = $this->modelWilayah->getNameKelurahan($idDesa)->row_array();

            $ptn = "/^0/";  // Regex
            $rpltxt = "62";  // Replacement string

            $data = [               
                'nama' =>  strtoupper($this->input->post('nama')),
                'kode_unit' =>  strtoupper($this->input->post('kode_unit')),
                'no_ktp' =>  $this->input->post('no_ktp'),
                'tanggal_lahir' =>  $this->input->post('tanggal_lahir'),                
                'jenis_kelamin' =>  $this->input->post('jenis_kelamin'),
                'no_telepon' =>  preg_replace($ptn, $rpltxt, $this->input->post('no_telepon')),
                'alamat' =>  strtoupper($this->input->post('alamat')),
                'prov' => strtoupper($namaProv['name']),
                'kota' =>  strtoupper($namaKota['name']),
                'kecamatan' =>  strtoupper($namaKecamatan['name']),
                'desa' =>  strtoupper($namaDesa['name']),
                's_cdb' =>  '1'   
            ];
            $this->db->where('no_mesin', $nomesin);
            $update = $this->db->update('konsumen', $data);
            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Update CDB</div>');
                redirect('staff/koreksicdb');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal merubah CDB.</div>');
                redirect('staff/koreksicdb');
            }
        }
            

        } else {
            redirect('auth/logout');
        }

    }

    public function importcdb()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            if ( isset($_POST['submit'])) {

                $file = $_FILES['file']['tmp_name'];

                // Medapatkan ekstensi file csv yang akan diimport.
                $ekstensi  = explode('.', $_FILES['file']['name']);

                // Tampilkan peringatan jika submit tanpa memilih menambahkan file.
                if (empty($file)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Anda Belum Memilih File atau File anda kosong</div>');
                    redirect('staff/koreksicdb');
                } else {
                    // Validasi apakah file yang diupload benar-benar file csv.
                    if (strtolower(end($ekstensi)) === 'csv' && $_FILES["file"]["size"] > 0) {
                         
                        $handle = fopen($file, "r"); 
                        while (($row = fgetcsv($handle, 10000, ";"))) {
                              
                            $ktp = $row[6];
                            $tanggal_lahir = substr($ktp, 6, 2);
                            $bulan_lahir = substr($ktp, 8, 2);
                            $tahun_lahir = substr($ktp, 10, 2);

                            if (intval($tanggal_lahir) > 40) {
                                $date = intval($tanggal_lahir) - 40;
                                $tanggallahir = "19".$tahun_lahir."-".$bulan_lahir."-".$date;
                                $jenis_kelamin = '2';                                
                            } else {
                                $date = intval($tanggal_lahir);
                                $tanggallahir = "19".$tahun_lahir."-".$bulan_lahir."-".$date;
                                $jenis_kelamin = '1';
                            }

                            $ptn = "/^0/";  // Regex
                            $rpltxt = "62";  // Replacement string
                            

                            // Data yang akan disimpan ke dalam databse																		
                            $data = [
                                'no_mesin' => $row[2],
                                'kode_unit' => $row[17],
                                'no_ktp' => $row[6],
                                'no_telepon' => preg_replace($ptn, $rpltxt, $row[7]),
                                'tanggal_lahir' => $tanggallahir,
                                'jenis_kelamin' => $jenis_kelamin,
                                'alamat' => strtoupper($row[14]),
                                'desa' => strtoupper($row[27]),
                                'kecamatan' => strtoupper($row[29]),
                                'kota' => strtoupper($row[31]),
                                'prov' => 'ACEH',
                                's_cdb' => '1',
                            ];
                            $import = $this->modelImport->saveCDB($data);
                        }
                        if ($import){
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                            redirect('staff/koreksicdb');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data</div>');
                            redirect('staff/koreksicdb');
                        }                        
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Format File Tidak Sesuai (Wajib .csv)</div>');
                        redirect('staff/koreksicdb');
                    }
                }
            }

        } else {
            redirect('auth/logout');
        }

    }


    public function mutasiunit()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            if (isset($_POST['submit'])){

                //Time
                $tanggal = date("Y-m-d");
                $jam = date("H:i:sa");

                $nourut = $this->modelStaff->geturutan();
                $urutan = $nourut['no_urut'] + 1;

                $kode =  sprintf("%03s", $urutan);
                $no_surat = $kode.'/BAST/LMB/'.date("m/Y");

                if ($_POST['tujuanX'] == "other"){
                    $tujuan = $_POST['tujuan1'];
                    $sale_pos = "";
                    $sale_dealer = "MUTASI";
                } else if ($_POST['tujuanX'] == "pameran"){
                    $tujuan = "On Dealer";
                    $sale_pos = "";
                    $sale_dealer = "RFS";
                } else if ($_POST['tujuanX'] == "On Pos Lamno"){
                    $tujuan = $_POST['tujuanX'];
                    $sale_pos = "NRFS";
                    $sale_dealer = "MUTASI";
                } else if ($_POST['tujuanX'] == "On Pos Inpur"){
                    $tujuan = $_POST['tujuanX'];
                    $sale_pos = "NRFS";
                    $sale_dealer = "MUTASI";
                }
                    
                    $data = [
                        'no_surat' => $no_surat,
                        'no_urut' =>  $urutan,
                        'no_mesin' =>  implode(",", $this->input->post('nomesin')),
                        'tujuan' =>  $tujuan,
                        'alamat_tujuan' =>  $this->input->post('alamat_tujuan'),
                        'supir' =>  strtoupper($this->input->post('driver')),
                        'tanggal_mutasi' =>  $tanggal,
                        'jam_mutasi' =>  $jam,
                        'status' =>  'Pengantaran'
                    ];

                    $insert = $this->db->insert('history_mutasi', $data);

                    if ($insert){
                        $mesin = explode(",", $data['no_mesin']);
                        foreach ($mesin as $ns) {
                            $data2 = [
                                'status_unit' => $sale_dealer,
                                'status_pos' => $sale_pos,
                                'posisi_unit' => $tujuan
                            ];
                            $this->db->where('no_mesin', $ns);
                            $update = $this->db->update('stok_unit', $data2);
                        }
                        if ($update){
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Mutasi Unit <a href="historymutasi"> Print BAST</a></div>');
                            redirect('staff/mutasiunit');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Mutasi Unit</div>');
                            redirect('staff/mutasiunit');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Mutasi Unit</div>');
                        redirect('staff/mutasiunit');
                    }

            } else {

                // Select 2 Stock
                $data['stok'] = $this->db->query("SELECT * FROM stok_unit WHERE status_unit = 'RFS' ORDER BY id ASC")->result_array();

                // Select 2 Driver
                $data['driver'] = $this->db->get('admin')->result_array();
                $data['title'] = 'Mutasi Unit';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('staff/mutasiunit', $data);
                $this->load->view('templates/footer');
            
            }


        } else {
            redirect('auth/logout');
        }

    }

    public function historymutasi()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $data['listmutasi'] = $this->modelStaff->listMutasi();

                $data['title'] = 'History Mutasi';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('staff/historymutasi', $data);
                $this->load->view('templates/footer');
            

        } else {
            redirect('auth/logout');
        }

    }


    public function printbast($id)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

               $data['output'] = $this->modelStaff->printBast($id)->row_array();
               $data['data'] = $this->modelStaff->printBast($id)->result_array();
               $this->load->view('staff/print-bastunit', $data);

        } else {
            redirect('auth/logout');
        }

    }

    public function deletebast()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            
            $id =  $this->input->post('id');
            $result = $this->modelStaff->printBast($id)->row_array();
            $no_mesin = explode(",", $result['no_mesin']);
            foreach ($no_mesin as $ns) {
                $data2 = array(
                    'status_unit' => 'RFS',
                    'status_pos' => '',
                    'posisi_unit' => 'On Dealer',
                );
                $this->db->where('no_mesin', $ns);
                $update = $this->db->update('stok_unit', $data2);
                }
            if ($update){
                $table = $this->input->post('where');
                $this->db->where('id', $id);
                $hapus = $this->db->delete($table);
                if ($hapus) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menghapus Data</div>');
                    redirect('staff/historymutasi');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                    redirect('staff/historymutasi');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                redirect('staff/historymutasi');
            }

    }

    public function blangkokuning()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                

                if(isset($_POST["submit"])){

                    // Periksa DB
                    $no_mesin = $this->input->post('no_mesin',TRUE);
                    $this->db->where('no_mesin', $no_mesin);
                    $query = $this->db->get('konsumen');
                    $count_row = $query->num_rows();

                    if ($count_row == 0){
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Data Tidak di temukan</div>');
                        redirect('staff/blangkokuning');
                    } else {

                        $data['blangkokuning'] = $this->modelStaff->getDataPrint($no_mesin);
                        if ($data['blangkokuning']['s_cdb'] == "0"){
                            $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Data CDB Belum Lengkap. Lengkapi di Menu <b>Koreksi CDB</b></div>');
                            redirect('staff/blangkokuning');
                        } else {
                            $this->load->view('staff/print-blangko', $data);
                        }

                    }

                } else {

                    $data['title'] = 'Blangko Kuning';
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/navbar', $data);
                    $this->load->view('templates/sidebar', $data);
                    $this->load->view('staff/blangkokuning', $data);
                    $this->load->view('templates/footer');

                }
            

        } else {
            redirect('auth/logout');
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
            $this->load->view('staff/import-spg', $data);
            $this->load->view('templates/footer'); 

            if ( isset($_POST['import'])) {

                $file = $_FILES['file']['tmp_name'];

                // Medapatkan ekstensi file csv yang akan diimport.
                $ekstensi  = explode('.', $_FILES['file']['name']);

                // Tampilkan peringatan jika submit tanpa memilih menambahkan file.
                if (empty($file)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Anda Belum Memilih File atau File anda kosong</div>');
                    redirect('staff/importspg');
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
                                redirect('staff/importspg');
                            } else if ($import == FALSE){
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> No SPG : '.$data['no_spg'].' Sudah Pernah di Input</div>');
                                redirect('staff/importspg');
                            }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Format File Tidak Sesuai (Wajib .umsl)</div>');
                        redirect('staff/importspg');
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
            $this->load->view('staff/view-stok', $data);
            $this->load->view('templates/footer');


        } else {    
            redirect('auth/logout');
        }        
    }

    public function printbastunit()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            if(isset($_POST["submit"])){

                // Periksa DB
                $no_mesin = $this->input->post('no_mesin',TRUE);

                    $query = $this->modelStaff->getDataPrint($no_mesin);
                    if ($query['s_cdb'] == "0"){
                         $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Data CDB Belum Lengkap. Lengkapi di Menu <b>Koreksi CDB</b></div>');
                         redirect('staff/printbastunit');
                    } else {
                         $this->_bastunit($no_mesin);
                    }

            } else {

                $data['title'] = 'Print BAST Unit';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('staff/blangkobast', $data);
                $this->load->view('templates/footer');

            }

        } else {
            redirect('auth/logout');
        }

    }

    private function _bastunit($no_mesin)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

               $data['output'] = $this->modelStaff->getDataPrint($no_mesin);
               $this->load->view('staff/print-bast', $data);

        } else {
            redirect('auth/logout');
        }
    }
}