<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'crm');
        $this->load->helper('tgl_indo');
        $this->load->model('M_Dashboard', 'modelDashboard');
        $this->load->model('M_CRM', 'modelCrm');
        $this->load->model('M_Whatsapp', 'modelWA');
        $this->load->helper('api_call');
        $this->load->library('uuid');
        
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
                redirect('crm/'.$halamanAsal);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                redirect('crm/'.$halamanAsal);
            }

    } 

    public function index()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $data['lahirtoday'] = $this->modelCrm->getLahirToday();
                $data['reminderkpb1'] = $this->modelCrm->getkpb1();
                $data['reminderkpb2'] = $this->modelCrm->getkpb2();
                $data['reminderkpb3'] = $this->modelCrm->getkpb3();
                $data['reminderkpb4'] = $this->modelCrm->getkpb4();


                // Whatsapp terkirim
                $tanggal = date("Y-m-d");
                $data['wa_terkirim'] = $this->modelCrm->getwhatsapp($tanggal, 'Terkirim');
                $data['wa_masuk'] = $this->modelCrm->getwhatsapp($tanggal, 'Inbox');                

                $data['booking'] = $this->modelCrm->getbooking($tanggal);

                $data['title'] = 'Dashboard';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('crm/index', $data);
                $this->load->view('templates/footer');

        } else {
            redirect('auth/logout');
        }

    }

    public function createtemplatesms()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                if (isset($_POST['submit'])){
                    $data = [
                        'nama_template' =>  $this->input->post('nama_template'),
                        'pesan' =>  $this->input->post('pesan'),
                    ];  
                        $insert = $this->db->insert('template_sms', $data);
                    
                        if ($insert == TRUE) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Template.</div>');
                            redirect('crm/createtemplatesms');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Template.</div>');
                            redirect('crm/createtemplatesms');
                        } 
                } else {

                    $data['template'] = $this->modelCrm->getTemplateSMS();
                    
                    $data['title'] = 'Create Temp SMS';
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/navbar', $data);
                    $this->load->view('templates/sidebar', $data);
                    $this->load->view('crm/template-sms', $data);
                    $this->load->view('templates/footer');

                }


        } else {
            redirect('auth/logout');
        }

    }

    public function shortlink($url)
    {
        $json = file_get_contents("https://cutt.ly/api/api.php?key=00414bd7e3e1d2558e42fafd69ddf3027f773&short=".$url);
        return json_decode($json, true);
    }

    public function createtemplatewa()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                if(isset($_POST['submit'])){

                    $upload_image = $_FILES['file']['name'];

                    if ($upload_image) {
                        $config['upload_path']          = './assets/img/template/';
                        $config['allowed_types']        = 'jpg|jpeg|png|jfif';
                        $config['max_size']             = '2048';
                        $config['encrypt_name']         = TRUE;

                        $this->load->library('upload', $config);

                        if ($this->upload->do_upload('file')){

                            $namafile = $this->upload->data('file_name');
                            $config['image_library']='gd2';
                            $config['source_image']='./assets/img/template/'.$namafile;
                            $config['create_thumb']= FALSE;
                            $config['maintain_ratio']= FALSE;
                            $config['quality']= '60%';                            
                            $config['new_image']= './assets/img/template/'.$namafile;
                            $this->load->library('image_lib', $config);
                            $this->image_lib->resize();

                            $url = $this->config->config['base_url'].'assets/img/template/'.$namafile;
                            $result_payload = $this->shortlink($url);

                            $pesan = $this->input->post('pesan').urldecode('%0A')."*Lihat Selengkapnya...*".urldecode('%0A').$result_payload["url"]["shortLink"];
                            $data = [
                                'nama_template' =>  $this->input->post('nama_template'),
                                'file' =>  $namafile,
                                'pesan' =>  $pesan,
                                'tipe' =>  'image',
                            ];  
                                $insert = $this->db->insert('template', $data);
                            
                                if ($insert == TRUE) {
                                    $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Template.</div>');
                                    redirect('crm/createtemplatewa');
                                } else {
                                    $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Template.</div>');
                                    redirect('crm/createtemplatewa');
                                }   
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Upload Gambar. Periksa Ukuran File. Maksimal 2MB</div>');
                            redirect('crm/createtemplatewa');
                        }
                    }  else {
                        $data = [
                            'nama_template' =>  $this->input->post('nama_template'),
                            'pesan' =>  $this->input->post('pesan'),
                            'tipe' =>  'chat',
                        ];  
                            $insert = $this->db->insert('template', $data);
                        
                            if ($insert == TRUE) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Template.</div>');
                                redirect('crm/createtemplatewa');
                            } else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Template.</div>');
                                redirect('crm/createtemplatewa');
                            } 
                    }

                } else {

                    $data['template'] = $this->modelCrm->getTemplate();
                    
                    $data['title'] = 'Create Temp WA';
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/navbar', $data);
                    $this->load->view('templates/sidebar', $data);
                    $this->load->view('crm/template-wa', $data);
                    $this->load->view('templates/footer');

                }

        } else {
            redirect('auth/logout');
        }

    }

    public function grouping()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $data['grup'] = $this->modelCrm->getGroup();
                
                $data['title'] = 'Grouping Data';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('crm/grup', $data);
                $this->load->view('templates/footer');

        } else {
            redirect('auth/logout');
        }

    }

    public function addByNomesin()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {
                $no_mesin = $this->input->post('no_mesin');
                $nama_group = $this->input->post('nama_group');
                $nomesin = str_replace(array("\r\n","\r","\n"),',',$no_mesin);

                $data = [
                    'nama_group' =>  strtoupper($this->input->post('nama_group')),
                    'anggota' => $nomesin,
                ];  
                    $insert = $this->db->insert('grup_konsumen', $data);
                    if ($insert == TRUE) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Data.</div>');
                        redirect('crm/grouping');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Data.</div>');
                        redirect('crm/grouping');
                    }
                


        } else {
            redirect('auth/logout');
        }
    }

    public function addByTanggalJual()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $nama_group = $this->input->post('nama_group');
                $tanggalawal = $this->input->post('tanggalawal');
                $tanggalakhir = $this->input->post('tanggalakhir');

               //Get No Mesin
               $data = $this->modelCrm->filterbytanggalbeli($tanggalawal,$tanggalakhir);
               if ($data == TRUE){
                   $nomesin = implode(',', array_column($data, 'no_mesin'));
                   $data = [
                       'nama_group' =>  $nama_group,
                       'anggota' => $nomesin,
                   ];  
                       $insert = $this->db->insert('grup_konsumen', $data);
                       if ($insert == TRUE) {
                           $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Data.</div>');
                           redirect('crm/grouping');
                       } else {
                           $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Data.</div>');
                           redirect('crm/grouping');
                       }     
               } else {
                   $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Konsumen tidak di temukan.</div>');
                   redirect('crm/grouping');
               }     
               

                

        } else {
            redirect('auth/logout');
        }
    }

    public function addByTanggalLahir()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $nama_group = $this->input->post('nama_group');
                $tanggalawal = $this->input->post('tanggalawal');
                $tanggalakhir = $this->input->post('tanggalakhir');

                //Get No Mesin
                $data = $this->modelCrm->filterbytanggallahir($tanggalawal,$tanggalakhir);
                if ($data == TRUE){
                    $nomesin = implode(',', array_column($data, 'no_mesin'));
                    $data = [
                        'nama_group' =>  $nama_group,
                        'anggota' => $nomesin,
                    ];  
                        $insert = $this->db->insert('grup_konsumen', $data);
                        if ($insert == TRUE) {
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Data.</div>');
                            redirect('crm/grouping');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Data.</div>');
                            redirect('crm/grouping');
                        }     
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Konsumen tidak di temukan.</div>');
                    redirect('crm/grouping');
                }
                

               

                

        } else {
            redirect('auth/logout');
        }
    }


    public function proseskirim()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            if(isset($_POST['whatsapp'])){

                $sender = $data['user']['nama'];
            
                $template = $this->input->post('template');
                $nama_group = $this->input->post('grup');

                $get_template = $this->db->get_where('template', ['id' => $template])->row_array();
                
                $get_anggota = $this->db->get_where('grup_konsumen', ['nama_group' => $nama_group])->row_array();
                
                
                $mesin = explode(",", $get_anggota['anggota']);
                $server = $this->modelWA->getServer();
                foreach ($mesin as $ns) {
                        $get_detail = $this->db->get_where('konsumen', ['no_mesin' => $ns,'no_telepon !=' => 'NULL'])->row_array();
                        if ($get_detail !== 0){

                            $pesan = $get_template['pesan'];
                            $nama = $get_detail['nama'];
                            $nosin = $get_detail['no_mesin'];
    
                            $dealer = "PT. Lambarona Sakti";
                            $salam = "Salam SatuHATI.";
                            if ($get_detail['jenis_kelamin'] == 1){
                                $sapa = "Abang ";
                            } else if ($get_detail['jenis_kelamin'] == 2){
                                $sapa = "Kakak ";
                            } else {
                                $sapa = "";
                            }
                            $cari = array('#nama', '#sapa', '#nosin', '#dealer', '#salam', '#sender');
                            $ganti =[$nama,$sapa,$nosin,$dealer,$salam, $sender];
                            $replace_pesan = str_replace($cari, $ganti, $pesan);
                            $tanggal = date("Y-m-d");
    
                            if ($get_template['tipe'] == 'chat') {
                                
                                $data = [
                                    'no_mesin' => $nosin,
                                    'uniqid' => $this->uuid->v4(),
                                    'dari' => $server['device'],
                                    'untuk' => $get_detail['no_telepon'],
                                    'nama' => 'Lambarona Sakti',
                                    'pesan' => $replace_pesan,
                                    'type' => 'chat',
                                    'tanggal' => $tanggal,
                                    'status' => 'Outbox',
                                    'sender' => $sender,
                                   
                                ];
                                
                            } else if ($get_template['tipe'] == 'image'){
                                
                                $data = [
                                    'no_mesin' => $nosin,
                                    'uniqid' => $this->uuid->v4(),                             
                                    'dari' => $server['device'],
                                    'untuk' => $get_detail['no_telepon'],
                                    'nama' => 'Lambarona Sakti',
                                    'pesan' => $replace_pesan,
                                    'file_name' => $get_template['file'],
                                    'file_url' => $this->config->config['base_url'].'assets/img/template/'.$get_template['file'],
                                    'type' => 'chat',
                                    'tanggal' => $tanggal,
                                    'status' => 'Outbox',
                                    'sender' => $sender,
                                    
                                    ];
                            }
                            $insert = $this->db->insert('chat', $data);
                        } 
                    
                }
                        if ($insert){
                            $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Kirim Ke Outbox</a></div>');
                            redirect('crm/proseskirim');
                        } else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Kirim Ke Outbox</div>');
                            redirect('crm/proseskirim');
                        }
                    
            } else if(isset($_POST['sms'])){
                $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-exclamation-triangle"></i> Modul SMS Sedang dalam Pengembangan</div>');
                redirect('crm/proseskirim');
            } else {

            $data['template'] = $this->modelCrm->getTemplate();
            $data['template_sms'] = $this->modelCrm->getTemplateSMS();
            $data['grup'] = $this->modelCrm->getGroup();
            
            $data['title'] = 'Proses Kirim';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('crm/proses', $data);
            $this->load->view('templates/footer');

            }

        } else {
            redirect('auth/logout');
        }

    }

    public function reportwa()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {
                
                $data['device'] = $this->db->get_where('api_sms', array('status' => 'valid'))->result_array();
                $data['title'] = 'Report Whatsapp';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('crm/report-whatsapp', $data);
                $this->load->view('templates/footer');

                if (isset($_POST['export'])){
                    $tanggal = $this->input->post('tanggal');
                    $this->exportexcel($tanggal);
                } 

        } else {
            redirect('auth/logout');
        }

    }

    public function chatwa()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $data['inbox'] = $this->modelCrm->getInbox();
                $data['title'] = 'Chat Whatsapp';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('crm/chat-whatsapp', $data);
                $this->load->view('templates/footer');


        } else {
            redirect('auth/logout');
        }

    }
    
    public function retrysend($tanggal)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $payload = $this->modelCrm->retrySend($tanggal);
                if ($payload) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Mengirim Ulang</div>');
                    redirect('crm/reportwa');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" id="myalert"><i class="fas fa-check"></i> Gagal Mengirim Ulang</div>');
                    redirect('crm/reportwa');
                }
                

        } else {
            redirect('auth/logout');
        }

    }

    public function exportexcel($tanggal)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $data['tanggal_selected'] =  $tanggal;
                $data['data'] = $this->modelCrm->getChat($tanggal);
                $this->load->view('crm/export-excel', $data);

        } else {
            redirect('auth/logout');
        }

    }
    public function sendtosms()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

                $id = $this->input->post('id');
                $device_id = $this->input->post('device_id');
                $halamanAsal = $this->input->post('function');

                $get = $this->db->get_where('chat', ['id' => $id])->row_array();
                $device = $this->db->get_where('api_sms', ['device_id' => $device_id])->row_array();

                $payload = [
                    'device_id' => $device_id,
                    'uniqid' => $this->uuid->v4(),
                    'dari' => $device['phone'],
                    'untuk' => '+'.$get['untuk'],
                    'nama' => $device['username'],
                    'pesan' => $get['pesan'],
                    'status' => 'Outbox',
                    'sender' => $data['user']['nama'],
                ];
                $insert = $this->db->insert('chat_sms', $payload);
                
                if ($insert) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Mengirim Ke SMS</div>');
                    redirect('crm/'.$halamanAsal);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Mengirim Ke SMS</div>');
                    redirect('crm/'.$halamanAsal);
                }

        } else {
            redirect('auth/logout');
        }

    }

    public function remiderbooking($id=null)
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $getbooking = $this->db->get_where('booking_servis', array('id' => $id))->row_array();

            $sender = $data['user']['nama'];

            $nama = $getbooking['nama'];
            $jam = $getbooking['booking_time'];
            $tanggal = date("Y-m-d");
            $pesan = "Assalamualaikum.. ".urldecode('%0A')."Kami dari AHASS Lambarona Sakti. ".urldecode('%0A')."Ingin Mengingatkan kembali, bahwasanya pada hari ini Bapak / Ibu *".$nama."* ada melakukan booking servis pada jam *".$jam."* Mendatang.".urldecode('%0A')."Data anda sudah kami daftarkan untuk hari ini.".urldecode('%0A')."Konfirmasikan kepada kami, jika ada kesalahan jadwal atau rencana pembatalan.".urldecode('%0A %0A')."Contact TIKA : 085261521293".urldecode('%0A %0A')."Terima Kasih.".urldecode('%0A')."Salam SatuHATI.";

            $ptn = "/^0/";  // Regex
            $rpltxt = "62";  // Replacement string
            $server = $this->modelWA->getServer();
            $data = [
                'no_mesin' => '',
                'uniqid' => $this->uuid->v4(),                            
                'dari' => $server['device'],
                'untuk' => preg_replace($ptn, $rpltxt, $getbooking['no_whatsapp']),
                'nama' => $nama,
                'pesan' => $pesan,
                'type' => 'chat',
                'tanggal' => $tanggal,
                'status' => 'Outbox',
                'sender' => $sender,
            ];      
            $insert = $this->db->insert('chat', $data);
            if ($insert){
                echo "<script>
                    alert('Berhasil, Mereminder Booking');
                    window.location.href='https://portal.hondalambarona.id/crm';
                    </script>";
            } else {
                echo "<script>
                alert('Gagal, Mereminder Booking');
                window.location.href='https://portal.hondalambarona.id/crm';
                </script>";
            }

        } else {
            redirect('auth/logout');
        }
    }
}