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
        $this->load->library('encrypt');
	}
	
	public function ceklogin()
  {
		$username = $this->session->username;
		if (!isset($username)) {
			redirect(base_url('login-page'));
		}
   }
	
	public function akun()
	{
		$akun = $this->crud->Get('user');
		foreach($akun as $val){
			echo 'Username: '.$val['username'].
			'<br> Password: '.$this->encrypt->decode($val['password']).
			'<br> Type    : '.$val['type'].'<hr>';
		}
	}
	public function index()
	{
		$this->ceklogin();
		$subData['class'] = $this->crud->GetWhere('class', array('teacher'=>$this->session->username));
		$data['page'] = $this->load->view('sub-page/home', $subData, TRUE);
		$this->load->view('page/home', $data);
	}
	public function login()
	{
		$username = $this->session->username;
		if (isset($username)) {
			redirect(base_url(''));
		}
		$this->load->view('page/login-page');
	}

	public function manageClass()
	{
		$this->ceklogin();
		$subData['class'] = $this->crud->GetWhere('class', array('teacher'=>$this->session->username));
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
		$username = $this->session->username;
		$type = $this->session->type;

		$where = array(
			'teacher'=>$username,
			'name'=>$className,
			'classID'=>$classID
		);
		if($type=='m'){
			echo "haha";
		}else{
			$classCheck = $this->crud->GetCountWhere('class', $where);
			if($classCheck==0){
				show_404();
			}
		}
		$subData['class'] = $where;
		$subData['member'] = $this->crud->GetWhere('class_member', array('classID'=> $classID));
		// http://localhost/kalpro/class/agama-lalapan-RHXwQc
		$data['page'] = $this->load->view('sub-page/class', $subData, TRUE);
		$this->load->view('page/home', $data);
	}
}
