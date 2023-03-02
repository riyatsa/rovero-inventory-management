<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('loginModel');  
	}

	function index(){
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();	
		$this->load->view('admin/login');
	}

	public function verifylogin($p1='',$p2=''){
		
		if($p1 == ''){
		$username=$this->input->post('email');
		$password=$this->input->post('password');
		}else{
		$username=urldecode($p1);
		$password=urldecode($p2);
		}
		
		 $status=$this->loginModel->admin_login($username,$password);
		if($status['status']=='1' && $status['user']['role']=='su_admin'){
			$user=$status['user'];
			$this->loginModel->loginLogs($user);
			$this->session->set_userdata('logged_in', $user);
			echo json_encode($status);
		}else if($status['status']=='0'){
			echo json_encode($status); 
		}
	}

}