<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('customerModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect('?/StoreLogin'); 	
		}
		$data['title'] = "Customer";
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/customer/customer',$data); 
		// echo "Customer";
		$this->load->view('store-common/store-footer');
		// $this->load->view();
	}

	function insertCustomer(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->customerModel->insertCustomer();
		echo json_encode($data);
	}

	function updateCustomer($id){
		if(!$this->session->userdata('logged_in_store_user')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->customerModel->updateCustomer($id);
		echo json_encode($data);
	}
	
	function CustomerList(){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect('?/StoreLogin'); 	
		}
		$data['title'] = "Customer-List";
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/customer/customer-list',$data);  
		$this->load->view('store-common/store-footer');
		// $data = $this->customerModel->CustomerView($id);
		// echo json_encode($data);
	}

	function viewCustomer($id=''){
		if(!$this->session->userdata('logged_in_store_user')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->customerModel->viewCustomer($id);
		echo json_encode($data);
	}

	function updateCustomerStatus($id){
		if(!$this->session->userdata('logged_in_store_user')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->customerModel->updateCustomerStatus($id);
		echo json_encode($data);
	}
}
