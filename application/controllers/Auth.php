<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->session->keep_flashdata('message');
    }

    public function getDefaultPage()
    {
        $direct = $this->db->get_where('user_menu', ['id' => $this->session->userdata('menu_id')])->row_array();
        if ($this->session->userdata('menu_id') == $direct['id']) {
            redirect($direct['controller']);
        } else {
            redirect('auth/logout');
        } 
        
    }
    public function index()
    {
        // Kalau Sudah login Di arahkan kembali
        //
        if (isset($_SESSION['id'])){
            $this->getDefaultPage();
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required');        
            $this->form_validation->set_rules('password', 'Password', 'required');
    
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Page';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {
                $this->_login();
            }
        }

    }

    
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin', ['username' => $username])->row_array();

        // Jika User Ada
        if($user) {
            //Jika User Aktif
            if($user['status'] == 1) {
                // Cek Password
                if(password_verify($password, $user['password'])){
                    $data = [
                        'id' => $user['id'],
                        'menu_id' => $user['menu_id']
                    ];
                    
                    $this->session->set_userdata($data);
                    $direct = $this->db->get_where('user_menu', ['id' => $user['menu_id']])->row_array();
                        //KE ADMINISTRATOR
                    if($user['menu_id'] == $direct['id']){                        
                        redirect($direct['controller']);                   
                    
                    } else {
                        redirect('auth/error');
                    }
                    // AKHIR PENENTUAN HALAMAN UNTUK ROLE                    
                } else {
                    $this->session->set_flashdata('message', 'Password Salah, Periksa Kembali');
                    redirect();
                }
            } else {
                $this->session->set_flashdata('message', 'Akun di Suspend / di kunci');
                redirect();
            }
        } else {
            $this->session->set_flashdata('message', 'Username tidak di temukan');
            redirect();
        }

    }

    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('menu_id');
        $this->session->set_flashdata('message', 'Anda telah mengakhiri sesi login');
        redirect('auth');

    }

    
    public function error404()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        $data['title'] = 'Access Denied!';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);  
        $this->load->view('auth/blocked');
        $this->load->view('templates/footer');
    }

    public function changeprofile()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();
        
        $this->form_validation->set_rules('username','Username', 'required');
        $this->form_validation->set_rules('nama','Nama', 'required');
        $this->form_validation->set_rules('inisial','Inisial', 'required');
        $this->form_validation->set_rules('honda_id','Honda_id', 'required');

        if($this->form_validation->run() == false){

            $data['title'] = 'Change Profile';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('changeprofile', $data);
            $this->load->view('templates/footer');   
            
        } else {

            $upload_image = $_FILES['file']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/user-photo/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = '2048';

                $this->load->library('upload', $config);                

                if ($this->upload->do_upload('file')){
                    $old_image = $data['user']['profil_picture'];

                    if ($old_image != 'default.png'){
                        unlink(FCPATH . 'assets/img/user-photo/' . $old_image);
                    }


                    $namafile = $this->upload->data('file_name');
                    $config['image_library']='gd2';
                    $config['source_image']='./assets/img/user-photo/'.$namafile;
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '50%';
                    $config['width']= 600;
                    $config['height']= 600;
                    $config['new_image']= './assets/img/user-photo/'.$namafile;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $data = [
                        'id' =>  $this->input->post('id'),
                        'username' =>  $this->input->post('username'),
                        'nama' =>  $this->input->post('nama'),
                        'inisial' =>  $this->input->post('inisial'),
                        'honda_id' =>  $this->input->post('honda_id'),
                        'profil_picture' =>  $namafile
                    ];  
                        $this->db->where('id', $data['id']);
                        $update = $this->db->update('admin', $data);
                    
                    if ($update == TRUE) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Merubah Profil.</div>');
                        redirect('auth/changeprofile');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambahkan Data.</div>');
                        redirect('auth/changeprofile');
                    }   
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Upload Gambar.</div>');
                    redirect('auth/changeprofile');
                }
            }  else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gambar Tidak Terupload.</div>');
                redirect('auth/changeprofile');
            }      
        }
    }

    public function changepassword()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if (isset($_POST['submit'])) {

                $passwordlama = $this->input->post('passwordlama');
                $pass = $data['user']['password'];

                if(password_verify($passwordlama, $pass)){
                    $id = $data['user']['id'];
                    $array = [
                        'password' => password_hash($this->input->post('passwordbaru'), PASSWORD_DEFAULT)
                    ];  
                    $this->db->where('id', $id);
                    $update = $this->db->update('admin', $array);
                    if($update){
                        $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Merubah Password.</div>');
                        redirect('auth/changepassword');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Merubah Password</div>');
                        redirect('auth/changepassword');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Password Lama Tidak Sesuai</div>');
                    redirect('auth/changepassword');
                }
        } else {
            $data['title'] = 'Change Password';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('changepassword', $data);
            $this->load->view('templates/footer');
        }
            
    }
}
