
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
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/login-logs');
		$this->load->view('warehouse-common/warehouse-footer');
		// $this->load->view();
	}
 
	
	function loginLogView(){
		$data = $this->loginLogsModel->loginLogView();
		echo json_encode($data);
	}

	 
}
