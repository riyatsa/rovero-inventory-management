<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WareHouseLogin extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('loginModel');  
	}

	function index(){
		$this->session->unset_userdata('logged_in_warehouse_user');
		$this->session->sess_destroy();	
		$this->load->view('warehouse/login');
	}

 
	public function verifylogin($p1='',$p2=''){
	
	if($p1 == ''){
	$username=$this->input->post('email');
	$password=$this->input->post('password');
	}else{
	$username=urldecode($p1);
	$password=urldecode($p2);
	}
	
	 $status=$this->loginModel->warehouse_login($username,$password);
	if($status['status']=='1'){
		$user=$status['user'];
		$this->loginModel->warehouseLoginLog($user);
		$this->session->set_userdata('logged_in_warehouse_user', $user);
		echo json_encode($status);
	}else if($status['status']=='0'){
		echo json_encode($status); 
	}
}

}