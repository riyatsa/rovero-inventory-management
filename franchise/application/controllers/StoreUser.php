<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreUser extends CI_Controller {

	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('StoreUserModel');   
	}
	
	function index(){

	if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
	}
		$data['title']="Store Add User";
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('users/add-store-users');
		$this->load->view('store-common/store-footer');
	}

	function get_store_users(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreUserModel->get_store_users();
		echo json_encode($data);
	}

	function insert_store_users(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreUserModel->insert_store_user();
		echo json_encode($data);
	}

	function update_store_users($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreUserModel->update_store_user($id);
		echo json_encode($data);
	}

	function update_store_status($id){ 
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreUserModel->update_store_users_status($id);
		echo json_encode($data);
	}

	function get_store_single_user($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
				$data = $this->StoreUserModel->get_store_users($id);
		echo json_encode($data);
	}

}
