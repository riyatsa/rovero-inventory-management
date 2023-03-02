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
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect('?/warehouseLogin');
		}
		$data['title'] = "Vendor";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/vendor/vendor',$data); 
		// echo "Vendor";
		$this->load->view('warehouse-common/warehouse-footer');
		// $this->load->view();
	}

	function insertVendor(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->insertVendor();
		echo json_encode($data);
	}

	function updateVendor($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->updateVendor($id);
		echo json_encode($data);
	}
	
	function VendorList(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect('?/warehouseLogin');
		}
		$data['title'] = "Vendor-List";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/vendor/vendor-list',$data);  
		$this->load->view('warehouse-common/warehouse-footer');
		// $data = $this->VendorModel->VendorView($id);
		// echo json_encode($data);
	}

	function VendorView($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->VendorView($id);
		echo json_encode($data);
	}
 
	function updateVendorStatus($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->VendorModel->updateVendorStatus($id);
		echo json_encode($data);
	}
}
