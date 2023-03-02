<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('WerehouseModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin');
		}
		
		$data['title'] = "Were House";
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/warehouse/add-werehouse',$data); 
		$this->load->view('admin-common/admin-footer');
		// $this->load->view();
	}

	function insert_werehouse(){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->WerehouseModel->insert_werehouse();
		echo json_encode($data);
	}

	function details(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin');
		}
		$data['title'] = "Were House";
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/warehouse/werehouse-details',$data); 
		$this->load->view('admin-common/admin-footer');
		// $this->load->view();
	}

	function get_werehouse_details(){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->WerehouseModel->get_werehouse_details();
		echo json_encode($data);
	}

	function get_single_werehouse_details($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->WerehouseModel->get_werehouse_details($id);
		echo json_encode($data);
	}

	function update_werehouse($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->WerehouseModel->update_werehouse($id);
		echo json_encode($data);
	}

	function remove_werehouse_details($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->WerehouseModel->remove_werehouse_details($id);
		echo json_encode($data);	
	}
}

