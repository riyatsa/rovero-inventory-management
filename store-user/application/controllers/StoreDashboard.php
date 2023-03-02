<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreDashboard extends CI_Controller {

	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('storeDashBoardModel');  
	}

	function index(){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url()); 	
		}
		// $data['total_purchase'] = $this->storeDashBoardModel->total_purchase();
		// $data['total_sales'] = $this->storeDashBoardModel->total_sales();
		// $data['total_product'] = $this->storeDashBoardModel->total_ptoduct();
		$data['title']="store Dashboard";
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		// $this->load->view('store/index',$data);
		$this->load->view('store-common/store-footer');
	}
 
 	function get_monthly_data(){
 		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
 		$data = $this->storeDashBoardModel->get_monthly_data();
 		echo json_encode($data);
 	}
}
