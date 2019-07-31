<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataProcess extends CI_Controller {
    
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
        
    // PROSES LOGIN
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

    // PROSES USERNAME TERSEDIA
    public function userCheck()
    {
        $user = $this->crud->GetCountWhere('user', array('username'=>$_POST['username']));
        if($user>0){
            echo "<span style='color:red'> Username Tidak Tersedia.</span>";
        }else{
            echo "<span style='color:green'> Username Tersedia.</span>";
        }
    }

    // PROSES DAFTAR AKUN BARU
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

    // PROSES BUAT KELAS BARU
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

    // PROSES GABUNG KELAS
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

    // PROSES KIRIM POSTINGAN
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

    // PROSES KIRIM KOMENTAR
    public function comment()
    {
        $data = array(
            'sender'=> $this->session->username,
            'feedID'=> $_POST['feedID'],
            'comment'=> nl2br($_POST['comment']),
            'date'=> date("Y-m-d H:i:s")
        );
        $post = $this->crud->Insert('feed_comment', $data);
        if($post){
            redirect(base_url($_POST['prevLink']));
        }
    }

    // PROSES MENGAMBIL DATA KOMENTAR
    public function getComment($feedID)
    {
        $comment = $this->crud->GetWhere('feed_comment', array('feedID'=>$feedID));
        $commenJSON = json_encode($comment);
        echo $commenJSON;
    }

    // PROSES MENAMPILKAN KONTEN
    public function showContent($page, $classID)
    {
        function clean($string) {
            $string = strtolower($string);
            $string = trim($string, " ");
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        }
        $where = array(
            'classID'=>$classID
        );
        if($this->session->type == 'd'){
            $where['teacher'] = $this->session->username;
        }
        $subData['class'] = $this->crud->GetWhere('class', $where);
        switch($page){
            // CASE POST START
            case 'post':
                $subData['feed'] = $this->crud->GetWhereOrder('feed', array('classID'=>$classID), 'date', 'DESC');
                $subData['feedID'] = array();
                $subData['link'] = clean($subData['class'][0]['name']).'-'.$subData['class'][0]['classID'].'/post';
                foreach($subData['feed'] as $val){
                    array_push($subData['feedID'], $val['id']);
                }
                break;
            // CASE POST END
            
            // CASE QUIZ START
            case 'quiz':
                if($this->session->type == 'd'){
                    $subData['link'] = clean($subData['class'][0]['name']).'-'.$subData['class'][0]['classID'].'/quiz';
                    $subData['quiz'] = $this->crud->GetWhere('quiz', array('classID'=>$classID));
                }else{
                    show_404();
                }
                break;
            // CASE QUIZ END

            // CASE MEMBER START
            case 'member':
                $subData['member'] = $this->crud->GetWhere('class_member', array('classID'=> $classID));
                break;
            // CASE MEMBER END
        }
        $this->load->view('class-page/'.$page, $subData);
        
    }

    // PROSES MEMBUAT KUIS BARU
    public function newQuestion()
    {
        foreach($_POST['question'] as $key => $val){
            
            if(strpos($key, 'target') !== false){
                $_POST['question'][$key]['answer'] = nl2br($_POST['question'][$key]['answer']);
            }
        }
        $question = json_encode($_POST['question']);
        $this->crud->Insert('question_flow', array('quizID'=>$_POST['quizDetail']['id'],'answer'=>$question));
        $this->crud->Insert('quiz', $_POST['quizDetail']);
    }

    public function submitAnswer($quizID)
    {
        $this->session->unset_userdata('timer');
        $matchAnswer = 0;
        $matchShape = 0;
        $matchArrow = 0;
        $n = 0;
        $wrongPlace = 0;
        //Mengambil kunci jawaban dan menkonversi menjadi array
        $answer['flowchart'] = $this->crud->GetWhere('question_flow', array('quizID'=>$quizID));
        $rawAnswer = get_object_vars(json_decode($answer['flowchart'][0]['answer']));

        // Menghitung jumlah bagian soal
        foreach($rawAnswer as $key => $val){
            // cek key target
            if(strpos($key, 'target') === 0){
                $n += count($val->shape);
                $n += count($val->answer);
            }else{
                // cek turn-arrow
                if(strpos($val->arrow, '-') === 4){
                    $n += 0.5;
                }else{
                    $n += count($val);
                }
            }
        }

        // Mencocokkan jawaban dengan kunci jawaban
        foreach($_POST as $key => $val){
            // cek isi answer 
            if(isset($val['answer'])){
                if(!empty($rawAnswer[$key]->answer)){
                    if($val['answer'] == $rawAnswer[$key]->answer){
                        $matchAnswer++;
                    }
                }else{
                    $wrongPlace++;
                }
            }
            // cek isi shape
            if(isset($val['shape'])){
                if(!empty($rawAnswer[$key]->shape)){
                    if($val['shape'] == $rawAnswer[$key]->shape){
                        $matchShape++;
                    }
                }else{
                    $wrongPlace++;
                }
            }
            // cek isi arrow
            if(isset($val['arrow'])){
                if(!empty($rawAnswer[$key]->arrow)){
                    if($val['arrow'] == $rawAnswer[$key]->arrow){
                        if(strpos($val['arrow'], '-') === 4){
                            $matchArrow+=0.5;
                        }else{
                            $matchArrow++;
                        }
                    }
                }else{
                    if(strpos($val['arrow'], '-') === 4){
                        $wrongPlace+=0.5;
                    }else{
                        $wrongPlace++;
                    }
                }
            }
        }
        
        // print_r($_POST);
        // print_r($matchArrow);

        // Menghitung nilai total dan jumlah bagian yang benar
        // echo round((100/$n)*($matchAnswer+$matchShape+$matchArrow)-($wrongPlace*2)).'|';
        // echo ($matchAnswer+$matchShape+$matchArrow).'/'.$n;
        
        $result = array(
            'username'=> $this->session->username,
            'quizID'=> $quizID,
            'correctAnswer'=> ($matchAnswer+$matchShape+$matchArrow).'/'.$n,
            'score'=> round((100/$n)*($matchAnswer+$matchShape+$matchArrow)-($wrongPlace*2))
        );
        $where =  array(
            'username'=>$this->session->username,
            'quizID'=>$quizID
        );
        $answerData = $this->crud->Update('user_answer', array('answer'=>json_encode($_POST)), $where);
        $quizResult = $this->crud->Insert('quiz_result', $result);
    }
}

/* End of file DataProcess.php */
