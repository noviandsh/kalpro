<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dataprocess extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'tgl', 'form'));
        // $this->load->library('encrypt');
        $this->load->model('Crud');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        echo 'coba';
    }
    
    // GOOGLE LOGIN
    public function googlelogin()
    {
        require APPPATH . 'vendor\google\google-api-php-client\vendor\autoload.php';
        $CLIENT_ID = '629518986414-8j66q6m7h3mf08kh51n18cpsrkigl1kk.apps.googleusercontent.com';
        $id_token = $_POST['token'];
        $name = $_POST['name'];
        $photo = $_POST['photo'];
        $email = $_POST['email'];
        // Get $id_token via HTTPS POST.

        $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            $userid = $payload['sub'];
            // get user data
            $getUser = $this->crud->GetWhere('user', array('id'=>$userid));
            // user google found
            if(!empty($getUser)){
                $this->session->set_userdata('id', $getUser[0]['id']);
                $this->session->set_userdata('name', $getUser[0]['name']);
                $this->session->set_userdata('type', $getUser[0]['type']);
                $res = array(
                    'status' => 1,
                    'msg' => 'Login berhasil'
                );
            }else{ // user google not found 
                $res = array(
                    'status' => 0,
                    'msg' => 'Anda belum terdaftar'
                );
            }
            // If request specified a G Suite domain:
            //$domain = $payload['hd'];
        } else {
            // Invalid ID token
            echo 'gagal';
        }
        header('Content-Type: application/json');
        echo json_encode($res);
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
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $res = array();
        $getUser = $this->crud->GetWhere('user', array('email'=>$email,'google'=>0));
        // user found
        if(!empty($getUser)){
            if(password_verify($pass, $getUser[0]['password'])){ // password verify success
                // set user data to session
                $this->session->set_userdata('id', $getUser[0]['id']);
                $this->session->set_userdata('name', $getUser[0]['name']);
                $this->session->set_userdata('type', $getUser[0]['type']);
                $res = array(
                    'status' => 1,
                    'msg' => 'Login berhasil'
                );
            }else{  // password verify failed
                $res = array(
                    'status' => 0,
                    'msg' => 'Password yang anda masukkan salah'
                );
            }
        }else{ // user not found
            $res = array(
                'status' => 0,
                'msg' => 'Email tidak ditemukan'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($res);
    }

    // PROSES USERNAME TERSEDIA
    public function usercheck()
    {
        $val = $_POST['val'];
        $col = $_POST['col'];
        $text = array(
            'email'=>'Email',
            'name'=>'Nama'
        );
        $user = $this->crud->GetCountWhere('user', array($col=>$val));
        if($user>0){
            $res = array(
                'color' => '#c23a3a',
                'msg' => $text[$col]." tidak tersedia"
            );
        }else{
            $res = array(
                'color' => '#0cbe73',
                'msg' => $text[$col]." tersedia"
            );
        }
        header('Content-Type: application/json');
        echo json_encode($res);
    }

    // PROSES DAFTAR AKUN BARU
    public function register()
    {
        // load library form validation
        $this->load->library('form_validation');
        // declare variable
        $id = $_POST['id'];
        $id_token = $_POST['idtoken'];
        $google = $_POST['google-acc'];
        $email = $_POST['reg-email'];
        $name = $_POST['reg-name'];
        $photo = $_POST['photo'];
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $type = $_POST['type'];
        $data = array(
            'name' => $name,
            'email' => $email,
            'type' => $type,
            'google' => $google
        );
        // Form validation
        $this->form_validation->set_rules('type', 'Tipe akun', 'required',
            array(
                'required' => '{field} wajib diisi',
                'valid_email' => '{field} tidak valid'
            ));
        $this->form_validation->set_rules('reg-email', 'Email', 'required|valid_email',
            array(
                'required' => '{field} wajib diisi',
                'valid_email' => '{field} tidak valid'
            ));
        $this->form_validation->set_rules('reg-name', 'Nama', 'required|alpha_numeric_spaces',
            array(
                'required' => '{field} wajib diisi',
                'alpha_numeric_spaces' => '{field} hanya dapat berisi huruf, angka dan spasi'
            ));

        // google account verify id token
        if($google){
            if($id == 0){ 
                require APPPATH . 'vendor\google\google-api-php-client\vendor\autoload.php';
                $CLIENT_ID = '629518986414-8j66q6m7h3mf08kh51n18cpsrkigl1kk.apps.googleusercontent.com';
                $client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
                $payload = $client->verifyIdToken($id_token);
                if ($payload) {
                    $data2['id'] = $payload['sub'];
                    // If request specified a G Suite domain:
                    //$domain = $payload['hd'];
                } else {
                    // Invalid ID token
                    echo 'gagal';
                }
            }else{
                $data2['id'] = $id;
            }
            $data['photo'] = $photo;
        }else{ // non google account
            $data2 = array(
                'photo' => base_url('assets/img/photos/default.png'),
                'password' => $pass
            );
            if($id == 0){ 
                $data2['id'] = uniqid();
            }else{
                $data2['id'] = $id;
            }
            // addition form validation for password input
            $this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric_spaces|min_length[5]',
                array(
                    'required' => '{field} wajib diisi',
                    'alpha_numeric_spaces' => '{field} hanya dapat berisi huruf, angka dan spasi',
                    'min_length' => '{field} harus lebih dari {param} karakter'
                ));
            $this->form_validation->set_rules('passconf', 'Konfirmasi password', 'required|matches[pass]|alpha_numeric_spaces',
                array(
                    'required' => '{field} wajib diisi',
                    'matches' => '{field} tidak cocok dengan {param} yang telah anda masukkan',
                    'alpha_numeric_spaces' => '{field} hanya dapat berisi huruf, angka dan spasi'
                ));
        }
        
        // form validation failed
        if ($this->form_validation->run() == FALSE){
            $remove_p = str_replace('<p>', '', validation_errors());
            $remove_nl = explode('</p>', $remove_p);
            $count = count($remove_nl);
            unset($remove_nl[$count-1]);
            $data2['validation_error'] = preg_replace("/[^A-Za-z0-9 ]/", '', $remove_nl);
            $this->session->set_flashdata('data', array_merge($data, $data2));
            // print_r($_SESSION['data']);
            redirect(base_url('login-page'));
        }else{ // form validation success
            $regist = $this->crud->Insert('user', array_merge($data, $data2));
            if($regist){
                $this->session->set_flashdata("regist", "Berhasil mendaftar, silahkan masuk");
                redirect(base_url('login-page'));
            }
        }
    }

    // PROSES BUAT KELAS BARU
    public function newclass()
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
            'teacher'=>$this->session->name,
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
    public function joinclass()
	{
        $url = $_POST['url'];
        $id = $_POST['classID'];
        $checkClass = $this->crud->GetCountWhere('class', array('classID'=>$id));
        if($checkClass){
            $data = array(
                'username'=> $this->session->name,
                'classID'=> $id
            );
            $checkMember = $this->crud->GetCountWhere('class_member', $data);
            if($checkMember>0){
                $this->session->set_flashdata('joinStat', 'Anda sudah bergabung di kelas ini.');
                redirect(base_url());
            }else{
                $join = $this->crud->Insert('class_member', $data);
                $this->session->set_flashdata('joinStat', 'Anda berhasil bergabung di kelas ini.');
                redirect(base_url($url));
            }
        }
    }

    // PROSES KIRIM POSTINGAN
    public function post(){
        // date format '2019-07-30 19:30:10'
        $data = array(
            'sender'=> $this->session->name,
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
            'sender'=> $this->session->name,
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
    public function getcomment($feedID)
    {
        $n = 0;
        $comment = $this->crud->GetWhere('feed_comment', array('feedID'=>$feedID));
        foreach($comment as $val){
            $comment[$n]['date'] = tgl_indo($val['date']);
            $n++;
        }
        $commenJSON = json_encode($comment);
        echo $commenJSON;
    }

    // PROSES MENAMPILKAN KONTEN
    public function showcontent($page, $classID)
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
            $where['teacher'] = $this->session->name;
        }
        $subData['class'] = $this->crud->GetWhere('class', $where);
        switch($page){
            // CASE POST START
            case 'post':
                $subData['feed'] = $this->crud->GetWhereOrder('feed', array('classID'=>$classID), 'date', 'DESC');
                $subData['allAcc'] = $this->crud->Get('user');
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
                $subData['class'] = $this->crud->GetWhere('class', array('classID'=> $classID));
                $subData['user'] = $this->crud->Get('user');
                break;
            // CASE MEMBER END
        }
        $this->load->view('class-page/'.$page, $subData);
        
    }

    public function quizresultlist($id)
    {
        $data['result'] = $this->crud->GetWhere('quiz_result', array('quizID' => $id));
        $this->load->view('class-page/quiz-result', $data);
    }

    // PROSES MEMBUAT KUIS BARU
    public function newquestion()
    {
        $data = array(
            'quizID' => $_POST['quizDetail']['id'],
            'question' => $_POST['question'],
            'answer' => $_POST['answer'],
            'svg' => $_POST['svg']
        );
        $this->crud->Insert('question_flow', $data);
        $this->crud->Insert('quiz', $_POST['quizDetail']);
		
		$this->session->set_flashdata('alert', 'Berhasil menambahkan kuis');
    }
    public function editquiz()
    {
        $id = $_POST['id'];
        $data = array(
            'question' => $_POST['question'],
            'answer' => $_POST['answer'],
            'svg' => $_POST['svg']
        );
        $detail = $_POST['quizDetail'];
        $this->crud->Update('question_flow', $data, array('quizID'=>$_POST['id']));
        $this->crud->Update('quiz', $detail, array('id'=>$_POST['id']));

		$this->session->set_flashdata('alert', 'Berhasil menyimpan kuis');
    }
    // Lihat kuis
    public function viewquiz($id)
    {
        $quiz = $this->crud->GetWhere('question_flow', array('quizID'=>$id));
        echo json_encode($quiz[0]);
    }

    public function submitanswer($quizID)
    {
        $this->session->unset_userdata('timer');

        // KOREKSI JAWABAN
        // Inisiasi variabel
        // ambil data dari database
        $keys = $this->crud->GetWhere('question_flow', array('quizID'=>$quizID))[0];
        // konversi json dari diagram gojs ke php array
        $userAnswerRaw = json_decode(json_encode(json_decode($_POST['answer'])),true);
        $keysAnswerRaw = json_decode(json_encode(json_decode($keys['answer'])),true);
        // variable delete key dari array jawaban
        $delKey = array('from', 'to', 'fromPort', 'toPort', 'points', 'visible');
        // variabel key array user answer dan key answer
        $u=0;
        $k=0;
        $total=0;
        $countKey=0;
        $corr=0;
        $corrAns=0;
        $keysAnswer_perc=0;
        // unset key dari userAnswer dan keyAnswer
        unset(
            $userAnswerRaw['class'],
            $userAnswerRaw['linkFromPortIdProperty'],
            $userAnswerRaw['linkToPortIdProperty'],
            $keysAnswerRaw['class'],
            $keysAnswerRaw['linkFromPortIdProperty'],
            $keysAnswerRaw['linkToPortIdProperty']
        );
        // mengisi array nodekey
        foreach($userAnswerRaw['nodeDataArray'] as $key => $val){
            $nodeUser[$val['key']]['category'] = $val['category'];
            $nodeUser[$val['key']]['text'] = $val['text'];
        }
        foreach($keysAnswerRaw['nodeDataArray'] as $key => $val){
            $nodeKey[$val['key']]['category'] = $val['category'];
            $nodeKey[$val['key']]['text'] = $val['text'];
        }
        // mengisi array userAnswer
        foreach($userAnswerRaw['linkDataArray'] as $uar){
            foreach($uar as $key => $val){
                if(!in_array($key, $delKey)){
                    $userAnswer[$u][$key] = $val;
                }
            }
            $userAnswer[$u]['fromNode'] = $nodeUser[$uar['from']]['category'];
            $userAnswer[$u]['toNode'] = $nodeUser[$uar['to']]['category'];
            if($nodeUser[$uar['from']]['category'] != "Start"){
                $userAnswer[$u]['nodeText'] = $nodeUser[$uar['from']]['text'];
            }
            $u++;
        }
        // mengisi array keysAnswer
        foreach($keysAnswerRaw['linkDataArray'] as $kar){
            foreach($kar as $key => $val){
                if(!in_array($key, $delKey)){
                    $keysAnswer[$k][$key] = $val;
                }
            }
            $keysAnswer[$k]['fromNode'] = $nodeKey[$kar['from']]['category'];
            $keysAnswer[$k]['toNode'] = $nodeKey[$kar['to']]['category'];
        
            if($nodeKey[$kar['from']]['category'] != "Start"){
                $keysAnswer[$k]['nodeText'] = $nodeKey[$kar['from']]['text'];
            }
            $k++;
        }
        // total kunci jawaban
        foreach($keysAnswer as $val){
            $total += count($val);
        }
        // koreksi jawaban
        foreach($keysAnswer as $val){
            $similar = array_intersect($keysAnswer[$corr], $userAnswer[$corr]);
            $keysAnswer_perc += count($similar) / count($keysAnswer[$corr]); // 0.5
            $corrAns += count($similar);
            $corr++;
        }
        $score = round((100 / count($keysAnswer)) * $keysAnswer_perc); // 0.5714..
        
        $result = array(
            'username'=> $this->session->name,
            'quizID'=> $quizID,
            'correctAnswer'=> $corrAns.'/'.$total,
            'score'=> $score
        );
        $userAnswer = array(
            'answer'=> $_POST['answer'],
            'svg'=> $_POST['svg']
        );
        $where =  array(
            'username'=>$this->session->name,
            'quizID'=>$quizID
        );
        $answerData = $this->crud->Update('user_answer', $userAnswer, $where);
        $quizResult = $this->crud->Insert('quiz_result', $result);
    }
    public function checkAnswer($id)
    {
        // Inisiasi variabel
        // ambil data dari database
        $user = $this->crud->GetWhere('user_answer', array('quizID'=>$id))[0];
        $keys = $this->crud->GetWhere('question_flow', array('quizID'=>$id))[0];
        // konversi json dari diagram gojs ke php array
        $userAnswerRaw = json_decode(json_encode(json_decode($user['answer'])),true);
        $keysAnswerRaw = json_decode(json_encode(json_decode($keys['answer'])),true);
        // variable delete key dari array jawaban
        $delKey = array('from', 'to', 'fromPort', 'toPort', 'points', 'visible');
        // variabel key array user answer dan key answer
        $u=0;
        $k=0;
        $total=0;
        $countKey=0;
        $corr=0;
        $corrAns=0;
        $keysAnswer_perc=0;
        // unset key dari userAnswer dan keyAnswer
        unset(
            $userAnswerRaw['class'],
            $userAnswerRaw['linkFromPortIdProperty'],
            $userAnswerRaw['linkToPortIdProperty'],
            $keysAnswerRaw['class'],
            $keysAnswerRaw['linkFromPortIdProperty'],
            $keysAnswerRaw['linkToPortIdProperty']
        );
        // mengisi array nodekey
        foreach($userAnswerRaw['nodeDataArray'] as $key => $val){
            $nodeUser[$val['key']]['category'] = $val['category'];
            $nodeUser[$val['key']]['text'] = $val['text'];
        }
        foreach($keysAnswerRaw['nodeDataArray'] as $key => $val){
            $nodeKey[$val['key']]['category'] = $val['category'];
            $nodeKey[$val['key']]['text'] = $val['text'];
        }
        // mengisi array userAnswer
        foreach($userAnswerRaw['linkDataArray'] as $uar){
            foreach($uar as $key => $val){
                if(!in_array($key, $delKey)){
                    $userAnswer[$u][$key] = $val;
                }
            }
            $userAnswer[$u]['fromNode'] = $nodeUser[$uar['from']]['category'];
            $userAnswer[$u]['toNode'] = $nodeUser[$uar['to']]['category'];
            if($nodeUser[$uar['from']]['category'] != "Start"){
                $userAnswer[$u]['nodeText'] = $nodeUser[$uar['from']]['text'];
            }
            $u++;
        }
        // mengisi array keysAnswer
        foreach($keysAnswerRaw['linkDataArray'] as $kar){
            foreach($kar as $key => $val){
                if(!in_array($key, $delKey)){
                    $keysAnswer[$k][$key] = $val;
                }
            }
            $keysAnswer[$k]['fromNode'] = $nodeKey[$kar['from']]['category'];
            $keysAnswer[$k]['toNode'] = $nodeKey[$kar['to']]['category'];
        
            if($nodeKey[$kar['from']]['category'] != "Start"){
                $keysAnswer[$k]['nodeText'] = $nodeKey[$kar['from']]['text'];
            }
            $k++;
        }
        foreach($keysAnswer as $val){
            $total += count($val);
        }
        foreach($keysAnswer as $val){
            $similar = array_intersect($keysAnswer[$corr], $userAnswer[$corr]);
            $keysAnswer_perc += count($similar) / count($keysAnswer[$corr]); // 0.5
            $corrAns += count($similar);
            echo $corrAns.' | ';
            $corr++;
        }
        echo $score = round((100 / count($keysAnswer)) * $keysAnswer_perc); // 0.5714..
        print_r($userAnswer);
        print_r($keysAnswer);
    }

    public function deleteclass()
    {
        $class = $_POST['id'];
        $teacher = $this->session->name;
        $del = $this->crud->Delete('class', array('classID'=>$class, 'teacher'=>$teacher));
        if($del){
            $res = 1;
        }else{
            $res = 0;
        }
        
        header('Content-Type: application/json');
        echo json_encode($res);
    }
    public function deletequiz()
    {
        $id = $_POST['id'];
        $teacher = $this->session->name;
        $del = $this->crud->Delete('quiz', array('id'=>$id, 'teacher'=>$teacher));
        if($del){
            $this->crud->Delete('question_flow', array('quizID'=>$id));
            $res = 1;
        }else{
            $res = 0;
        }
        
        header('Content-Type: application/json');
        echo json_encode($res);
    }
    public function deletepost()
    {
        $id = $_POST['id'];
        $type = $_POST['table'];
        $table = array(
            'kiriman'=>'feed',
            'komentar'=>'feed_comment'
        );
        $del = $this->crud->Delete($table[$type], array('id'=>$id));
        if($del){
            $res = 1;
        }else{
            $res = 0;
        }
        
        header('Content-Type: application/json');
        echo json_encode($res);
    }
}

/* End of file Dataprocess.php */
