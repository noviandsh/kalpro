<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataProccess extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('encrypt');
        $this->load->model('Crud');
        date_default_timezone_set('Asia/Jakarta');
    }
    
    // PROSES LOGOUT
    public function logout() 
    {
        $this->session->sess_destroy();
        redirect(base_url('login-page'));
    }
        
    public function login()
    {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $getUser = $this->crud->GetWhere('user', array('username'=>$user));
        if(!empty($getUser)){
            $storedPass = $this->encrypt->decode($getUser[0]['password']);
            if($storedPass == $pass){
                $this->session->set_userdata('username', $getUser[0]['username']);
                $this->session->set_userdata('type', $getUser[0]['type']);
                echo "1";
            }else{
                echo "Password Salah";
            }
        }else{
            echo "Username Salah";
        }
    }

    public function userCheck()
    {
        $user = $this->crud->GetCountWhere('user', array('username'=>$_POST['username']));
        if($user>0){
            echo "<span style='color:red'> Username Tidak Tersedia.</span>";
        }else{
            echo "<span style='color:green'> Username Tersedia.</span>";
        }
    }

    public function register()
    {
        $user = $_POST['user'];
        $pass = $this->encrypt->encode($_POST['pass']);
        $type = $_POST['type'];
        $regist = $this->crud->Insert('user', array(
            "username"=>$user,
            "password"=>$pass,
            "type"=>$type
        ));
        echo $regist;
    }

    public function newClass()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            return $random_string;
        }
        $newClass = array(
            'classID'=>generate_string($permitted_chars, 6),
            'teacher'=>$this->session->username,
            'name'=>$_POST['className'] 
        );
        $insert = $this->crud->Insert('class', $newClass);
        if($insert){
            $this->session->set_flashdata('success', 'Berhasil Menambahkan Kelas.');
        }else{
            $this->session->set_flashdata('error', 'Gagal Menambahkan Kelas.');
        }
        redirect(base_url('class'));
    }
    public function joinClass()
	{
        $id = $_POST['classID'];
        $checkClass = $this->crud->GetCountWhere('class', array('classID'=>$id));
        if($checkClass){
            $data = array(
                'username'=> $this->session->username,
                'classID'=> $id
            );
            $checkMember = $this->crud->GetCountWhere('class_member', $data);
            if($checkMember>0){
                echo "wes tau bergabung";
            }else{
                $join = $this->crud->Insert('class_member', $data);
            }
        }
    }
    public function post(){
        // date format '2019-07-30 19:30:10'
        $data = array(
            'sender'=> $this->session->username,
            'classID'=> $_POST['classID'],
            'date'=> date("Y-m-d H:i:s"),
            'content'=> nl2br($_POST['content'])
        );
        $post = $this->crud->Insert('feed', $data);
        if($post){
            redirect(base_url($_POST['prevLink']));
        }
    }
}

/* End of file DataProccess.php */
