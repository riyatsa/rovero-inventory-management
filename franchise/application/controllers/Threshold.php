<?php
class Threshold extends CI_Controller{
	
	
	function __construct(){

	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('thresholdModel');  
	   
	}
 	
 	function index(){

 		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		} 
		$user = $this->session->userdata('logged_in_store');

		$result['threshold']  = $this->thresholdModel->getThresholdData($user['storeId']);
		// print_r($result['threshold'] );
		// exit(); 
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/threshold/threshold',$result);
		$this->load->view('store-common/store-footer');

 	}

 	function updateThresholdData($id){
 		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->thresholdModel->updateThresholdData($id);
		echo json_encode($data);
	}
}
?>