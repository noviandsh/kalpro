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
        $this->load->helper(array('form', 'url'));
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
			echo 'Username: '.$val['username'].
			// '<br> Password: '.$this->encrypt->decode($val['password']).
			'<br> Type    : '.$val['type'].'<hr>';
		}
	}
	public function index()
	{
		$this->ceklogin();
		$type = $this->session->type;
		if($type=='m'){
			$class = $this->crud->GetSelectWhere('class_member', 'classID', array('username'=>$this->session->name));
			$subData['class'] = $this->crud->GetOrWhere('class', 'classID', $class);
		}else{
			$subData['class'] = $this->crud->GetWhere('class', array('teacher'=>$this->session->name));
		}
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
			$subData['class'] = $this->crud->GetOrWhere('class', 'classID', $class);
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

		$where = array(
			'teacher'=>$username,
			'name'=>$className,
			'classID'=>$classID
		);
		if($type=='m'){
			// echo "haha";
		}else{
			$classCheck = $this->crud->GetCountWhere('class', $where);
			if($classCheck==0){
				show_404();
			}
		}
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
		$this->load->view('page/home', $data);
	}

	public function startQuiz($quizID)
	{
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
		$subData['answer'] = array();
		foreach ($jawaban as $key => $value) {
			if(!empty($value->answer)){
				array_push($subData['answer'], $value->answer);
			}
		}
		// array_push($subData['answer'], 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, nostrum! Aut repellat beatae, numquam dolorum fuga sequi quo cupiditate eligendi ab, ea accusamus aliquam sunt saepe hic, commodi ex nobis.');
		shuffle($subData['answer']);
		$subData['soal'] = $this->crud->GetWhere('question_flow', array('quizID'=>$quizID));

		if(!isset($_SESSION['timer'])){
			$this->session->set_userdata('timer', time()+($subData['quizDetail'][0]['duration']*60));
			// $this->session->set_userdata('timer', time()+(30));
		}
        // $this->session->unset_userdata('timer');

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