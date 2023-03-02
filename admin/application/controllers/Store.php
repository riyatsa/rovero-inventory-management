<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('storeModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin'); 	
		}
		$data['title'] = "Store";
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/store/store',$data); 
		// echo "Store";
		$this->load->view('admin-common/admin-footer');
		// $this->load->view();
	}

	function insertStore(){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->storeModel->insertStore();
		echo json_encode($data);
	}

	function updateStore($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->storeModel->updateStore($id);
		echo json_encode($data);
	}
	
	function storeList(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin'); 	
		}
		$data['title'] = "Store-List";
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/store/store-list',$data);  
		$this->load->view('admin-common/admin-footer');
		// $data = $this->storeModel->storeView($id);
		// echo json_encode($data);
	}

	function storeView($id=''){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->storeModel->storeView($id);
		echo json_encode($data);
	}

	function updateStoreStatus($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->storeModel->updateStoreStatus($id);
		echo json_encode($data);
	}
}
