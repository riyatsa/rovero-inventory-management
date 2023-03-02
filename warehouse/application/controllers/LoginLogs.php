
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
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
		}
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/login-logs');
		$this->load->view('warehouse-common/warehouse-footer');
		// $this->load->view();
	}
 
	
	function loginLogView(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->loginLogsModel->loginLogView();
		echo json_encode($data);
	}

	 
}
