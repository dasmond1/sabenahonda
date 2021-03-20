<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'administrator');
        $this->load->helper('tgl_indo');
        $this->load->model('M_Dashboard', 'modelDashboard');
        $this->load->model('M_Import', 'modelImport');
        $this->load->model('M_Whatsapp', 'modelWA');
        $this->load->helper('api_call');
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
                $this->load->view('admin/index', $data);
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
                $this->load->view('admin/index', $data);
                $this->load->view('templates/footer');
            }

        } else {
            redirect('auth/logout');
        }

    }
    public function managetarget()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('bulan','Bulan', 'required');
        $this->form_validation->set_rules('tahun','Tahun', 'required');
        $this->form_validation->set_rules('target','target', 'required');

        if($this->form_validation->run() == false){

            $data['get_target'] = $this->db->get('target_penjualan')->result_array();

            $data['title'] = 'Manage Target';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-target', $data);
            $this->load->view('templates/footer');   
            
        } else {    
            $data = [
                'bulan' =>  $this->input->post('bulan'),
                'tahun' =>  $this->input->post('tahun'),
                'target' =>  $this->input->post('target')
            ];
            $insert = $this->db->insert('target_penjualan', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/managetarget');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/managetarget');
            } 
        }
    }
    public function manageuser()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('username','Username', 'required');
        $this->form_validation->set_rules('password','Password', 'required');
        $this->form_validation->set_rules('nama','Nama', 'required');
        $this->form_validation->set_rules('honda_id','Honda_id', 'required');
        $this->form_validation->set_rules('inisial','Inisial', 'required');
        $this->form_validation->set_rules('menu_id','Menu_id', 'required');
        $this->form_validation->set_rules('status','Status', 'required');

        if($this->form_validation->run() == false){

            // Array Role
            $this->load->model('M_namarole', 'namaRole');
            $data['get_user'] = $this->namaRole->getnamaRole();
            $data['role'] = $this->db->get('user_menu')->result_array();

            $data['title'] = 'Manage User';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-user', $data);
            $this->load->view('templates/footer');
            
            
        } else {    
            $data = [
                'username' =>  $this->input->post('username'),
                'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama' =>  $this->input->post('nama'),
                'honda_id' =>  $this->input->post('honda_id'),
                'inisial' =>  $this->input->post('inisial'),
                'profil_picture' =>  'default.png',
                'menu_id' =>  $this->input->post('menu_id'),
                'status' =>  $this->input->post('status')
            ];
            $insert = $this->db->insert('admin', $data);
            // Periksa DB
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/manageuser');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/manageuser');
            }            
        }
    }    
    public function managemenu()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('menu','Menu', 'required');

        if($this->form_validation->run() == false){

            $data['getmenu_list'] = $this->db->get('user_menu')->result_array();

            $data['title'] = 'Manage Menu';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-menu', $data);
            $this->load->view('templates/footer');
            
        } else {    
            $data = [
                'menu' =>  $this->input->post('menu'),
                'controller' =>  strtolower($this->input->post('controller'))
            ];
            $insert = $this->db->insert('user_menu', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/managemenu');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/managemenu');
            }
        }

    }
    public function managesubmenu()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('menu_id','Menu_id', 'required');
        $this->form_validation->set_rules('title','Title', 'required');
        $this->form_validation->set_rules('url','Url', 'required');
        $this->form_validation->set_rules('icon','Icon', 'required');
        $this->form_validation->set_rules('status','Status', 'required');

        if($this->form_validation->run() == false){

            $this->load->model('M_namarole', 'namaMenu');
            $data['getsubmenu'] = $this->namaMenu->getnamaMenu();
            $data['parent'] = $this->db->get('user_menu')->result_array();

            $data['title'] = 'Manage Sub Menu';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-submenu', $data);
            $this->load->view('templates/footer');
            
        } else {    
            $data = [
                'menu_id' =>  $this->input->post('menu_id'),
                'title' =>  $this->input->post('title'),
                'url' =>  $this->input->post('url'),
                'icon' =>  $this->input->post('icon'),
                'is_active' =>  $this->input->post('status')
            ];
            $insert = $this->db->insert('user_sub_menu', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/managesubmenu');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/managesubmenu');
            }
        }

    }
    public function importdb()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $data['title'] = 'Import Database';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/importdb', $data);
            $this->load->view('templates/footer');

            if ( isset($_POST['import'])) {

                $file = $_FILES['file']['tmp_name'];

                // Medapatkan ekstensi file csv yang akan diimport.
                $ekstensi  = explode('.', $_FILES['file']['name']);

                // Tampilkan peringatan jika submit tanpa memilih menambahkan file.
                if (empty($file)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Anda Belum Memilih File atau File anda kosong</div>');
                    redirect('administrator/importdb');
                } else {
                    // Validasi apakah file yang diupload benar-benar file csv.
                    if (strtolower(end($ekstensi)) === 'csv' && $_FILES["file"]["size"] > 0) {

                        $handle = fopen($file, "r");
                        while (($row = fgetcsv($handle, 20000, ";"))) {
                            $id = $row[23];
                            $tanggal_lahir = substr($id, 6, 2);
                            $bulan_lahir = substr($id, 8, 2);
                            $tahun_lahir = substr($id, 10, 2);

                            if (intval($tanggal_lahir) > 40) {
                                $date = intval($tanggal_lahir) - 40;
                                $tanggallahir = "19".$tahun_lahir."-".$bulan_lahir."-".$date;
                                $jenis_kelamin = '2';                                
                            } else if (intval($tanggal_lahir) < 40) {
                                $date = intval($tanggal_lahir);
                                $tanggallahir = "19".$tahun_lahir."-".$bulan_lahir."-".$date;
                                $jenis_kelamin = '1';
                            } else {
                                $tanggallahir = "0000-00-00";
                                $jenis_kelamin = 'N';
                            }

                            $ptn = "/^0/";  // Regex
                            $rpltxt = "62";  // Replacement string

                            // Data yang akan disimpan ke dalam databse																		
                            $data = [
                                'no_so' => $row[20],
                                'jenis_penjualan' => $row[28],
                                'no_mesin' => $row[11],
                                'no_rangka' => "MH1".$row[10],
                                'kode_unit' => $row[9],
                                'tipe' => $row[7],
                                'warna' => $row[8],
                                'tahun' => $row[12],
                                'no_spg' => $row[16],
                                'no_doh' => $row[13],
                                'tanggal_mohon' => $row[21],
                                'nama' => strtoupper($row[22]),
                                'no_ktp' => $row[23],
                                'no_telepon' => preg_replace($ptn, $rpltxt, $row[25]),
                                'alamat' => strtoupper($row[24]),
                                'desa' => strtoupper($row[32]),
                                'kecamatan' => strtoupper($row[36]),
                                'kota' => strtoupper($row[38]),
                                'prov' => 'ACEH',
                                'jenis_kelamin' => $jenis_kelamin,
                                'jenis_konsumen' => $row[43],
                                'tanggal_lahir' => $tanggallahir,
                                'sale_by' => $row[41],
                                's_whatsapp' => 'Uncheck',
                                's_cdb' => '1',
                                's_konsumen' => 'Valid',
                                'created_by' => 'Import File',
                            ];

                            $this->db->where('no_mesin', $row[11]);
                            $query = $this->db->get('konsumen');
                            $count_row = $query->num_rows();
                            if ($count_row > 0) {
                                $this->db->where('no_mesin',  $row[11]);
                                $query = $this->db->update('konsumen', $data);
                            } else {
                                $query = $this->db->insert('konsumen', $data);
                            }
                        }
                        if ($query){
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                            redirect('administrator/importdb');
                        } else if ($query == FALSE){
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> No SPG : '.$data['no_spg'].' Sudah Pernah di Input</div>');
                            redirect('administrator/importdb');
                        }
                            
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Format File Tidak Sesuai (Wajib .umsl)</div>');
                        redirect('administrator/importdb');
                    }
                }
            }
        } else {
            redirect('auth/logout');
        }   
    }

    public function parsingKTP($no_ktp)
    {
        $id = $no_ktp;
        $tanggal_lahir = substr($id, 6, 2);
        $bulan_lahir = substr($id, 8, 2);
        $tahun_lahir = substr($id, 10, 2);

        if (intval($tanggal_lahir) > 40) {
            $date = intval($tanggal_lahir) - 40;
            $tanggallahir = "19".$tahun_lahir."-".$bulan_lahir."-".$date;
            $jenis_kelamin = '2';
            $jk = 'Perempuan';
        } else {
            $date = intval($tanggal_lahir);
            $tanggallahir = "19".$tahun_lahir."-".$bulan_lahir."-".$date;
            $jenis_kelamin = '1';
            $jk = 'Laki Laki';
        }

        $data = array(
            'tanggal_lahir' => $tanggallahir,
            'jenis_kelamin' => $jenis_kelamin,
            'jk' => $jk

        );
        return json_encode($data);
    }

    public function manageaccess()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('role_id','RoleID', 'required');
        $this->form_validation->set_rules('menu_id','MenuID', 'required');

        if($this->form_validation->run() == false){

            $this->load->model('M_namarole', 'accessMenu');
            $data['getaccesspermit'] = $this->db->get('user_menu')->result_array();
            $data['parent'] = $this->db->get('user_access_menu')->result_array();

            $data['title'] = 'Manage Access Permit';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-access', $data);
            $this->load->view('templates/footer');  
            
        } else {    
            $data = [
                'role_id' =>  $this->input->post('role_id'),
                'menu_id' =>  $this->input->post('menu_id')
            ];
            $insert = $this->db->insert('user_access_menu', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/manageaccess');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/manageaccess');
            }
        }

    }

    public function manageinfo()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('nama_info','Nama Info', 'required');
        $this->form_validation->set_rules('info','Info', 'required');

        if($this->form_validation->run() == false){

            $data['info'] = $this->db->get('info')->result_array();

            $data['getaccesspermit'] = $this->db->get('user_menu')->result_array();

            $data['title'] = 'Manage Info';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-info', $data);
            $this->load->view('templates/footer');  
            
        } else {    
            $data = [
                'nama_info' =>  $this->input->post('nama_info'),
                'untuk' =>  $this->input->post('untuk'),
                'info' =>  $this->input->post('info'),
                'is_active' => '1',
            ];
            $insert = $this->db->insert('info', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/manageinfo');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/manageinfo');
            }
        }

    }

    public function managekodeunit()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('role_id','RoleID', 'required');
        $this->form_validation->set_rules('menu_id','MenuID', 'required');

        if($this->form_validation->run() == false){

            $this->load->model('M_namarole', 'accessMenu');
            $data['getaccesspermit'] = $this->db->get('user_menu')->result_array();
            $data['parent'] = $this->db->get('user_access_menu')->result_array();

            $data['title'] = 'Manage Kode Unit';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-kodeunit', $data);
            $this->load->view('templates/footer');  
            
        } else {    
            $data = [
                'role_id' =>  $this->input->post('role_id'),
                'menu_id' =>  $this->input->post('menu_id')
            ];
            $insert = $this->db->insert('user_access_menu', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/manageaccess');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/manageaccess');
            }
        }

    }

    public function managekodewarna()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if (isset($_POST['submit'])){

            $data = [
                'kode' =>  $this->input->post('kodewarna'),
                'nama' =>  $this->input->post('namawarna'),
            ];
            $insert = $this->db->insert('warna', $data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambahkan Data</div>');
                redirect('administrator/managekodewarna');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                redirect('administrator/managekodewarna');
            }
        } else {

            $data['warna'] = $this->db->get('warna')->result_array();

            $data['title'] = 'Manage Kode Warna';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-kodewarna', $data);
            $this->load->view('templates/footer');   

        }

    }
    public function delete()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            $data = [
                'id' =>  $this->input->post('id')
            ];
            $table = $this->input->post('where');
            $halamanAsal = $this->input->post('function');
            $hapus = $this->db->delete($table, $data);
            if ($hapus) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menghapus Data</div>');
                redirect('administrator/'.$halamanAsal);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                redirect('administrator/'.$halamanAsal);
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
                redirect('administrator/'.$halamanAsal);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                redirect('administrator/'.$halamanAsal);
            }

    }
    public function changeStatus()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            
            $id = $this->input->post('id');
            $halamanAsal = $this->input->post('function');
            $table = $this->input->post('where');
            
            $statusakhir = $this->db->get_where('admin', ['id' => $id])->row_array();
            if ($statusakhir['status'] == 1){
                $data = array(
                    'status' => '0'
                );
                $this->db->where('id', $id);
                $this->db->update($table, $data);
            } else if($statusakhir['status'] == 0){
                $data = array(
                    'status' => '1'
                );
                $this->db->where('id', $id);
                $this->db->update($table, $data);
                
            }
            
            redirect('administrator/'.$halamanAsal);
    }
    public function changeActive()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            
            $id = $this->input->post('id');
            $halamanAsal = $this->input->post('function');
            $table = $this->input->post('where');
            
            $statusakhir = $this->db->get_where($table, ['id' => $id])->row_array();
            if ($statusakhir['is_active'] == 1){
                $data = array(
                    'is_active' => '0'
                );
                $this->db->where('id', $id);
                $this->db->update($table, $data);
            } else if($statusakhir['is_active'] == 0){
                $data = array(
                    'is_active' => '1'
                );
                $this->db->where('id', $id);
                $this->db->update($table, $data);
                
            }
            
            redirect('administrator/'.$halamanAsal);
    }

    public function updatekodeunit()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            
        $id = $this->input->post('id');
        $kode_unit = $this->input->post('kode_unit');
        $tipe = $this->input->post('tipe');
        $cc = $this->input->post('cc');
        $halamanAsal = $this->input->post('function');

        
            $data = array(
                'kode_unit' => $kode_unit,
                'tipe' => $tipe,
                'cc' => $cc
            );
            $this->db->where('id', $id);
            $query = $this->db->update('produk', $data);
            
            if ($query){
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Merubah Warna</div>');
                redirect('administrator/'.$halamanAsal);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-check"></i> Gagal Merubah Data</div>');
                redirect('administrator/'.$halamanAsal);
            }
    }

    public function setposisiunit()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();


            $this->db->where('status_unit', 'RFS');
            $this->db->or_where('status_unit', 'NRFS');
            $this->db->or_where('status_unit', 'PAMERAN');
            $data['unit'] = $this->db->get('stok_unit')->result_array();

            $data['title'] = 'Set Posisi Unit';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/manage-posisiunit', $data);
            $this->load->view('templates/footer');
    }
    public function updateposisiunit()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

            
        $id = $this->input->post('id');
        $posisi = $this->input->post('posisi');
        $status = $this->input->post('status');
        $halamanAsal = $this->input->post('function');

        
            $data = array(
                'posisi_unit' => $posisi,
                'status_unit' => $status,
            );
            $this->db->where('id', $id);
            $query = $this->db->update('stok_unit', $data);
            
            if ($query){
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Merubah Posisi</div>');
                redirect('administrator/'.$halamanAsal);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-check"></i> Gagal Merubah Posisi</div>');
                redirect('administrator/'.$halamanAsal);
            }
    }

    public function apicontrol()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();


            $data['whatsapp'] = $this->db->get('api_whatsapp')->result_array();

            //Whatsapp Info
            $server = $this->modelWA->getServer();
            $payload = array(
                'token' => $data['whatsapp']['token'],
                'username' => $data['whatsapp']['username'],
                );
    
            $url = $data['whatsapp']['url']."info.php";
            $data['statuswa'] = info_wa($url, $payload);
                            

            $data['title'] = 'Api Controller';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/api-controller', $data);
            $this->load->view('templates/footer');   
            
    }
}   