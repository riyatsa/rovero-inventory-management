
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginLogs extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('loginLogsModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin'); 	
		}
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/login-logs');
		// echo "Store";
		$this->load->view('admin-common/admin-footer');
		// $this->load->view();
	}
 
	
	function loginLogView(){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->loginLogsModel->loginLogView();
		echo json_encode($data);
	}

	 
}
