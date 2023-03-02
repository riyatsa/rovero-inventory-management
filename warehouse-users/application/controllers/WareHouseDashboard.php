<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WareHouseDashboard extends CI_Controller {

		function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('WareHouseUsers');  
	}

	function index(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['title']="WareHouse Dashboard";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		// $this->load->view('admin/index',$data);
		$this->load->view('warehouse-common/warehouse-footer');
	}

	function add_werehouse_users(){

		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['title']="WareHouse Add User";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/users/add-warehouse-users');
		$this->load->view('warehouse-common/warehouse-footer');
	}

	function get_warehouse_users(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array());
			exit();
		}
		$data = $this->WareHouseUsers->get_warehouse_users();
		echo json_encode($data);
	}
	function get_wereehous_single_user($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->get_warehouse_users($id);
		echo json_encode($data);		
	}

	function add_warehouseusers(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->insert_warehouse_user();
		echo json_encode($data);
	}

	function update_warehouseusers($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->update_warehouse_user($id);
		echo json_encode($data);
	}


	function update_warehouse_users_status($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->update_warehouse_users_status($id);
		echo json_encode($data);
	}
}
