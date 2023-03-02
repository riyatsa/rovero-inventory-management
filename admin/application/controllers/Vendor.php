<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('VendorModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin');
		}
		$data['title'] = "Vendor";
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/vendor/vendor',$data); 
		// echo "Vendor";
		$this->load->view('admin-common/admin-footer');
		// $this->load->view();
	}

	function insertVendor(){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->insertVendor();
		echo json_encode($data);
	}

	function updateVendor($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->updateVendor($id);
		echo json_encode($data);
	}
	
	function VendorList(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin');
		}
		$data['title'] = "Vendor-List";
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/vendor/vendor-list',$data);  
		$this->load->view('admin-common/admin-footer');
		// $data = $this->VendorModel->VendorView($id);
		// echo json_encode($data);
	}

	function VendorView($id=''){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->VendorView($id);
		echo json_encode($data);
	}

	function updateVendorStatus($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->updateVendorStatus($id);
		echo json_encode($data);
	}
}
