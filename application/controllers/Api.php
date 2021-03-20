<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'api', 'file');
        $this->load->helper('api_call');
        $this->load->model('M_Whatsapp', 'modelWA');
        $this->load->model('M_Wilayah', 'modelWilayah');
        $this->load->library('uuid');
        //$this->load->model('M_Sms', 'modelSMS');

    }

    public function getSMS()
    {
        $phoneNumber = $_GET['phoneNumber'];
        $message = $_GET['message'];
        $data = [
            'dari' => $phoneNumber,
            'pesan' => $message
        ];

        $this->db->insert('chat_sms', $data);
    }

    public function bookingservis ()
    {
        if(isset($_POST['submit'])){
            $data = [
                'nama' => strtoupper($this->input->post('nama')),
                'alamat' => $this->input->post('alamat'),
                'no_whatsapp' => $this->input->post('no_whatsapp'),
                'tipe_motor' => $this->input->post('tipe_motor'),
                'last_km' => $this->input->post('last_km'),
                'booking_date' => $this->input->post('booking_date'),
                'booking_time' => $this->input->post('booking_time'),
                'keluhan' => $this->input->post('keluhan')
            ];
            $payload = $this->db->insert('booking_servis', $data);
                if ($payload){
                    echo "<script>
                    alert('Terimakasih, anda telah Berhasil melakukan Booking Service');
                    window.location.href='https://hondalambarona.id/booking';
                    </script>";
                } else {
                    echo "<script>
                    alert('Maaf, Gagal Booking Service');
                    window.location.href='https://hondalambarona.id/booking';
                    </script>";
                }
        }
    }

    public function cekstatuswa() {
        
        $data = $this->modelWA->getwaiting();

        foreach ($data as $chat) {
            $server = $this->modelWA->getServer();
            $uniqid = $chat['uniqid'];
            $chatID = $chat['chat_id'];
            $token = $server['token'];
            $url = $server['url']."status.php";

            $payload = [
                'id' => $chatID,
            ];

            $request = do_wa($url, $token, $payload);

            $status = "{$request->status}";
            $respond = "{$request->data->status}";

            $result = preg_replace('~[^A-Za-z0-9?.!]~', '', $respond);   

            if ($result == "Sukses") {
                $balasan = "Terkirim";
            } else if ($result == "Nomertidakterdaftar"){
                $balasan = "Nomer Tidak Valid";
            } else {
                $balasan = "Gagal";
            }

            if ($status == 1) {
                        
                $this->db->set('status', $balasan);                
                $this->db->where('uniqid', $uniqid);
                $this->db->update('chat');
                
            } else {
                
                $this->db->set('status', 'Gagal');
                $this->db->where('uniqid', $uniqid);
                $this->db->update('chat');

            }

        }

    }

    public function sendwa() {

        $data = $this->modelWA->getChat();
        
        foreach ($data as $chat) {
            $server = $this->modelWA->getServer();
            $id = $chat['id'];
            $tujuan = $chat['untuk'];
            $pesan = $chat['pesan'];

            $token = $server['token'];
            $url = $server['url']."send_message.php";
            $payload = [
                'phone' => $tujuan,
                'type' => 'text',
                'text' => $pesan
            ];

            $request = do_wa($url, $token, $payload);

            $array = (array)$request;
            
            if ($array['status'] == 1) {
                $data = array(
                    'status' => $array['process'],
                    'chat_id' => $array['id'][0],
                );
                $this->db->where('id', $id);
                $this->db->update('chat', $data);
                     
            } else {
                $data = array(
                    'status' => $array['message']
                );
                $this->db->where('id', $id);
                $this->db->update('chat', $data);
            }
        }
    }

    public function callback()
    {
        extract($_POST);
        $server = $this->modelWA->getServer();
        $tanggal = date('Y-m-d');
        $data = [
            'no_mesin' => '-',
            'chat_id' => '-',
            'uniqid' => $this->uuid->v4(),                            
            'dari' => $phone,
            'untuk' => $server['device'],
            'nama' => $phone,
            'pesan' => $message,
            'type' => 'chat',
            'tanggal' => $tanggal,
            'status' => 'Inbox',
            'sender' => 'Fonnte',
        ];
        $this->db->insert('chat', $data);

    }

    // public function sendwhatsapp() {

    //     $data = $this->modelWA->getChat();
        
    //     foreach ($data as $chat) {
    //         $server = $this->modelWA->getServer();
    //         $id = $chat['id'];
    //         $tujuan = $chat['untuk'];
    //         $pesan = $chat['pesan'];
    //         $fileURL = $chat['file_url'];
    //         $fileName = $chat['file_name'];
    //         $token = $server['token'];

    //         // Cek Nomor Dulu
    //         $urlcek = $server['url']."check-number.php";
    //         $payload = [
    //             'token' => $token,
    //             'phone' => $tujuan,
    //         ];
    //         $ceknomor = do_wa($urlcek, $payload);
    //         if ($ceknomor->result == "true") {
    //             if ($ceknomor->status == "valid") {
    //                 if ($chat['type'] == "chat"){
    //                     $urlsend = $server['url']."send-message.php";
    //                     $payload = [
    //                         'token' => $token,
    //                         'phone' => $tujuan,
    //                         'message' => $pesan,
    //                     ];
                        
    //                     $request = do_wa($urlsend, $payload);
        
    //                         if ($request->result == "true") {
    //                             $this->db->set('status', $request->status);
    //                             $this->db->where('id', $id);
    //                             $this->db->update('chat');
    //                         } else if ($request->result == "false"){
    //                             $this->db->set('status', 'Gagal');
    //                             $this->db->where('id', $id);
    //                             $this->db->update('chat');
    //                         }
                            
    //                 } else if ($chat['type'] == "image") {
    //                     $urlsend = $server['url']."send-image.php";
    //                     $payload = [
    //                         'token' => $token,
    //                         'phone' => $tujuan,
    //                         'image' => 'link',
    //                         'filename' => 'link',
    //                         'caption' => $pesan,
    //                     ];
        
    //                     $request = do_wa($urlsend, $payload);
                        
    //                         if ($request->result == "true") {
    //                             $this->db->set('status', 'Terkirim');
    //                             $this->db->where('id', $id);
    //                             $this->db->update('chat');
    //                         } else if ($request->result == "false"){
    //                             $this->db->set('status', 'Gagal');
    //                             $this->db->where('id', $id);
    //                             $this->db->update('chat');
    //                         }
    //                 }
    //             } else {
    //                 $this->db->set('status', 'Tidak Terdaftar');
    //                 $this->db->where('id', $id);
    //                 $this->db->update('chat');
    //             }
    //         } else {
    //             $this->db->set('status', 'Gagal');
    //             $this->db->where('id', $id);
    //             $this->db->update('chat');
    //         }
    //     }
    // }
    
    // public function callback()
    // {
    //     header('Access-Control-Allow-Origin: *');
    //     header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type,Accept");
    //     $json = file_get_contents("php://input");
    //     $result = json_decode($json, true);
    //     $tanggal = date("Y-m-d");

    //     if ($result['ischat'] == true) {
    //         if ($result['type'] == "chat") {
    //             $payload = array(
    //                 'chat_id' => $result['chatid'],
    //                 'uniqid' => $result['id'],
    //                 'dari' => $result['phone'],
    //                 'untuk' => '6281213293966',
    //                 'nama' => $result['pushname'],
    //                 'pesan' => $result['message'],
    //                 'type' => $result['type'],
    //                 'tanggal' => $tanggal,
    //                 'status' => 'Inbox',
    //                 'sender' => 'RuangWA',
    //                 );
    //                 $this->db->insert('chat', $payload);

    //         } else if ($result['type'] == "image") {
    //             $payload = array(
    //                 'chat_id' => $result['chatid'],
    //                 'uniqid' => $result['id'],
    //                 'dari' => $result['phone'],
    //                 'untuk' => '6281213293966',
    //                 'nama' => $result['pushname'],
    //                 'file_url' => $result['message'],
    //                 'file_name' => '',
    //                 'pesan' => $result['caption'],
    //                 'type' => $result['type'],
    //                 'tanggal' => $tanggal,
    //                 'status' => 'inbox',
    //                 'sender' => 'RuangWA',
    //                 );
    //                 $this->db->insert('chat', $payload);
    //         }

    //     } else if ($result['ischat'] == false){

    //                 $file = fopen("testack.txt","w");  
    //                 fwrite($file,$json);  
    //                 fclose($file);

    //         $this->db->set('chat_id', $result['chatid']);
    //         $this->db->set('uniqid', $result['id']);
    //         $this->db->set('status', $result['status']);
    //         $this->db->where('untuk', $result['phone']);
    //         $this->db->update('chat');

    //     }
    // }
    
    public function showProv()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->modelWilayah->showProv($id)->result_array();
        echo json_encode($data);
        
    }

    public function getKota()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->modelWilayah->getKota($id)->result_array();
        echo json_encode($data);
        
    }
    public function getKecamatan()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->modelWilayah->getKecamatan($id)->result_array();
        echo json_encode($data);
        
    }
    public function getKelurahan()
    {
        $id = $this->input->post('id',TRUE);
        $data = $this->modelWilayah->getKelurahan($id)->result_array();
        echo json_encode($data);
        
    }

    public function parsingKTP()
    {
        $id = $this->input->post('id',TRUE);
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
        echo json_encode($data);
    }

}