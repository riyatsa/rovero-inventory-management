<?php
/**
 * Created Date 10/01/2020 
 * Created By Yash
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class GST extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('gstModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit(); 
		}
		$data['title'] = "GST List";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/gst/gst-list',$data);  
		$this->load->view('warehouse-common/warehouse-footer'); 
	}

	function insertGst(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->gstModel->insertGst();
		echo json_encode($data);
	}

	function updateGst($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->gstModel->updateGst($id);
		echo json_encode($data);
	} 

	function viewGst($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array());
			exit();
		}
		$data = $this->gstModel->viewGstAll($id);
		echo json_encode($data);
	}

	function updateGstStatus($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->gstModel->updateGstStatus($id);
		echo json_encode($data);
	}
	 
}
