<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fetadia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api_call');
    }


    public function index()
    {   
        if (isset($_POST['search'])){
            $payload = $this->input->post('text');
            

            $data['result'] = caridb($payload);
            $this->load->view('fa/fetadia', $data);
        } else {
            $this->load->view('fa/fetadia');
        }
    }
    public function nonton($tt)
    {

        $data['tt'] = $tt;
        $this->load->view('fa/kaloen', $data);
    }
}