<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

class Display extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->session->keep_flashdata('message');
        $this->load->helper('url', 'display');
        $this->load->helper('tgl_indo');
        
    }

    public function index()
    {
        $data['displayvid'] = $this->db->get('display_video')->row_array();
        $data['title'] = 'TV Display';
        $this->load->view('displaytv', $data);
    }

    public function managetv()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $data['displayvid'] = $this->db->get('display_video')->row_array();
            $data['iklan'] = $this->db->get('display_image')->result_array();
            $data['title'] = 'Manage TV Display';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/managetvdisplay', $data);
            $this->load->view('templates/footer');
        
        } else {
            redirect('auth/logout');
        }
       
    }

    public function loadiklan()
    {
        $data['displayiklan'] = $this->db->get_where('display_image', array('status' => 'Valid'))->result_array();
        $this->load->view('admin/load-iklan', $data);
    }

    public function loadfooter()
    {
        $data['displayvid'] = $this->db->get('display_video')->row_array();
        $this->load->view('admin/load-footer', $data);
    }

    public function updateframevideo()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $data = [
                'iframe_name' =>  $this->input->post('iframe_name'),
                'iframe_url' =>  $this->input->post('iframe_url'),
                'footer_text' =>  $this->input->post('footer_text'),
            ];
            $update = $this->db->update('display_video', $data);
            
            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Mengupdate Informasi Tv</div>');
                redirect('display/managetv');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Mengupdate Informasi Tv</div>');
                redirect('display/managetv');
            }
        
        } else {
            redirect('auth/logout');
        }
    }

    public function insertiklan()
    {
        $data['user'] = $this->db->get_where('admin', ['id' => 
        $this->session->userdata('id')])->row_array();

        if ($this->session->has_userdata('id')) {

            $upload_image = $_FILES['file']['name'];

            if ($upload_image) {
                $config['upload_path']          = './vendor/slide/';
                $config['allowed_types']        = 'png';
                $config['max_size']             = '2048';

                $this->load->library('upload', $config);                

                if ($this->upload->do_upload('file')){

                    $namafile = $this->upload->data('file_name');
                    $config['image_library']='gd2';
                    $config['source_image']='./vendor/slide/'.$namafile;
                    $config['create_thumb']= FALSE;
                    $config['maintain_ratio']= FALSE;
                    $config['quality']= '100%';
                    $config['width']= 763;
                    $config['height']= 700;
                    $config['new_image']= './vendor/slide/'.$namafile;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $data = [
                        
                        'image_name' =>  $this->input->post('image_name'),
                        'image_url' =>  $namafile,
                        'status' => 'Valid',
                    ];  
                        $insert = $this->db->insert('display_image', $data);
                    
                    if ($insert == TRUE) {
                        $this->session->set_flashdata('message1', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menambah Iklan TV.</div>');
                        redirect('display/managetv');
                    } else {
                        $this->session->set_flashdata('message1', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menambah Iklan TV.</div>');
                        redirect('display/managetv');
                    }   
                } else {
                    $this->session->set_flashdata('message1', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Upload Gambar.</div>');
                    redirect('display/managetv');
                }
            }  else {
                $this->session->set_flashdata('message1', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gambar Tidak Terupload.</div>');
                redirect('display/managetv');
            } 
        
        } else {
            redirect('auth/logout');
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
            $hapus = $this->db->delete($table, $data);
            
            if ($hapus) {
                $this->session->set_flashdata('message2', '<div class="alert alert-success" id="myalert"><i class="fas fa-check"></i> Berhasil Menghapus Data</div>');
                redirect('display/managetv');
            } else {
                $this->session->set_flashdata('message2', '<div class="alert alert-danger" id="myalert"><i class="fas fa-exclamation-triangle"></i> Gagal Menghapus Data.</div>');
                redirect('display/managetv');
            }

    }

}