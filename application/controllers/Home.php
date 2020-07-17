<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->helper(array('form', 'url', 'tgl'));
        // $this->load->library('encrypt');
        date_default_timezone_set('Asia/Jakarta');
	}
	
	public function ceklogin()
  	{
		$id = $this->session->id;
		if (!isset($id)) {
			redirect(base_url('login-page'));
		}
   	}
	
	public function akun()
	{
		$akun = $this->crud->Get('user');
		foreach($akun as $val){
			echo 'Email: '.$val['email'].
			'<br> Name: '.$val['name'].
			'<br> Type    : '.$val['type'].'<hr>';
		}
	}
	public function index()
	{
		$this->ceklogin();
		$type = $this->session->type;
		// login as mahasiswa
		if($type=='m'){
			$class = $this->crud->GetSelectWhere('class_member', 'classID', array('username'=>$this->session->name));
			if(!empty($class)){
				$subData['class'] = $this->crud->GetOrWhere('class', 'classID', $class);
			}
		}else{ // login as dosen
			$subData['class'] = $this->crud->GetWhere('class', array('teacher'=>$this->session->name));
		}
		
		if(!empty($subData['class'])){
			$subData['quiz'] = array();
			foreach($subData['class'] as $key => $val){
				array_push($subData['quiz'], $this->crud->GetWhere('quiz', array('classID'=>$val['classID'])));
			}
			if(isset($subData['quiz'])){
				$subData['quiz'] = $subData['quiz'][0];
			}
			$subData['feed'] = $this->crud->GetOrWhereOrder('feed', 'classID', $subData['class'], 'date', 'DESC');
			$subData['feedID'] = array();
			foreach($subData['feed'] as $val){
				array_push($subData['feedID'], $val['id']);
			}
		}
		$subData['quizRes'] = $this->crud->GetWhere('quiz_result', array('username'=>$this->session->name));
		$subData['acc'] = $this->crud->GetWhere('user', array('id'=>$this->session->id))[0];
		$subData['allAcc'] = $this->crud->Get('user');
		$data['page'] = $this->load->view('sub-page/home', $subData, TRUE);
		$this->load->view('page/home', $data);
	}
	public function login()
	{
		$id = $this->session->id;
		if (isset($id)) {
			redirect(base_url(''));
		}
		$this->load->view('page/login-page');
	}

	public function manageClass()
	{
		$this->ceklogin();
		$type = $this->session->type;
		if($type=='m'){
			$class = $this->crud->GetSelectWhere('class_member', 'classID', array('username'=>$this->session->name));
			if(!empty($class)){
				$subData['class'] = $this->crud->GetOrWhere('class', 'classID', $class);
			}else{
				$subData = '';
			}
		}else{
			$subData['class'] = $this->crud->GetWhere('class', array('teacher'=>$this->session->name));
		}
		$data['page'] = $this->load->view('sub-page/manage-class', $subData, TRUE);
		$this->load->view('page/home', $data);
	}

	public function classPage()
	{
		$this->ceklogin();
		function clean($string) {
			return str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
		}
		$link = $this->uri->segment(2);
		$className = clean(substr($link, 0, -7));
		$classID = substr($link, -6);
		$username = $this->session->name;
		$type = $this->session->type;

		if($type=='m'){
			$where = array(
				'username'=>$username,
				'classID'=>$classID
			);
			$table = 'class_member';
		}else{
			$where = array(
				'teacher'=>$username,
				'name'=>$className,
				'classID'=>$classID
			);
			$table = 'class';
		}
		$classCheck = $this->crud->GetCountWhere($table, $where);
		if($classCheck==0){
			show_404();
		}
		$subData['quizRes'] = $this->crud->GetWhere('quiz_result', array('username'=>$this->session->name));
		$subData['quiz'] = $this->crud->GetWhere('quiz', array('classID'=>$classID));
		$subData['class'] = $where;
		$subData['link'] = $link;
		// http://localhost/kalpro/class/agama-lalapan-RHXwQc
		$data['page'] = $this->load->view('sub-page/class', $subData, TRUE);
		$this->load->view('page/home', $data);
	}

	public function createQuiz(){
		$subData['draft'] = array(
			'id' => uniqid(),
			'teacher'=> $this->session->name,
			'classID'=> substr($this->uri->segment(2), -6),
			'title'=> 'untitled quiz '.date("Y-m-d")
		);
		// $draftQuiz = $this->crud->Insert('quiz', $subData['draft']);
		$data['page'] = $this->load->view('sub-page/new-quiz', $subData, TRUE);
		$data['script'] = array('go-debug.js', 'Figures.js', 'quiz.js');
		$this->load->view('page/home', $data);
	}

	public function editQuiz(){
		$id = $_GET['id'];
		$subData['quiz'] = $this->crud->GetWhere('question_flow', array('quizID'=>$id))[0];
		$subData['detail'] = $this->crud->GetWhere('quiz', array('id'=>$id))[0];
		$data['page'] = $this->load->view('sub-page/edit-quiz', $subData, TRUE);
		$data['script'] = array('go-debug.js', 'Figures.js', 'quiz.js');
		$this->load->view('page/home', $data);
	}

	public function startQuiz($quizID)
	{
		// temp data for user answer
		$subData['startTime'] = date("Y-m-d H:i:s");
		$this->crud->Insert('user_answer', array(
			'username'=> $this->session->name,
			'quizID'=> $quizID,
			'startTime'=> $subData['startTime']
		));

		$subData['quizDetail'] = $this->crud->GetWhere('quiz', array('id'=>$quizID));
		$subData['endTime'] = date('Y-m-d H:i:s', strtotime('+'.$subData['quizDetail'][0]['duration'].' minutes',strtotime($subData['startTime'])));
		$subData['question']['flowchart'] = $this->crud->GetWhere('question_flow', array('quizID'=>$quizID));
		
		$jawaban = get_object_vars(json_decode($subData['question']['flowchart'][0]['answer']));
		$subData['soal'] = $this->crud->GetWhere('question_flow', array('quizID'=>$quizID));

		if(!isset($_SESSION['timer'])){
			$this->session->set_userdata('timer', time()+($subData['quizDetail'][0]['duration']*60));
			// $this->session->set_userdata('timer', time()+(30));
		}
        // $this->session->unset_userdata('timer');

		$data['script'] = array('go-debug.js', 'Figures.js', 'quiz.js');
		$data['page'] = $this->load->view('sub-page/start-quiz', $subData, TRUE);
		$this->load->view('page/home', $data);
	}

	public function quizResult($quizID)
	{
		$where = array(
			'username'=>$this->session->name,
			'quizID'=>$quizID
		);
		$subData['result'] = $this->crud->GetWhere('quiz_result', $where);
		$subData['userAnswer'] = $this->crud->GetWhere('user_answer', $where);
		$subData['quizDetail'] = $this->crud->GetWhere('quiz', array('id'=>$quizID));
		$data['page'] = $this->load->view('sub-page/quiz-result', $subData, TRUE);
		$this->load->view('page/home', $data);
	}
	
	public function messagePage()
	{
		$data['page'] = $this->load->view('sub-page/message', null, TRUE);
		$this->load->view('page/home', $data);
	}
}