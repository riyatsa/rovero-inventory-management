<?php
/**
 * Created Date 10/01/2020 
 * Created By Yash
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('unitModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['title'] = "Unit List";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/unit/uni-list',$data);  
		$this->load->view('warehouse-common/warehouse-footer'); 
	}

	function insertUnit(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->insertUnit();
		echo json_encode($data);
	}

	function updateUnit($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->updateUnit($id);
		echo json_encode($data);
	}
	
	

	function viewUnit($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->viewUnitAll($id);
		echo json_encode($data);
	}

	function updateUnitStatus($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->updateUnitStatus($id);
		echo json_encode($data);
	}
	
	/**************************
	*UnitSubCategory Operation*
	**************************/
	
	function unitSubCategoryList(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['title'] = "Unit List";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/unit/uni-sub-list',$data);  
		$this->load->view('warehouse-common/warehouse-footer'); 
	}

	function insertUnitSubCategory(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->insertUnitSubCategory();
		echo json_encode($data);
	}

	function updateUnitSubCategory($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->updateUnitSubCategory($id);
		echo json_encode($data);
	}


	function viewUnitSubCategory($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->viewUnitSubCategory($id);
		echo json_encode($data);
	}

	function updateUnitStatusSubCategory($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->unitModel->updateUnitStatusSubCategory($id);
		echo json_encode($data);
	}
}
