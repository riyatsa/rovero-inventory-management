<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WareHouseDashboard extends CI_Controller {

		function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('WareHouseUsers');  
	  $this->load->model('notificationModel');  
	}

	function index(){

		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['total_warehouse'] = $this->WareHouseUsers->count_warehouse();
		$data['warehouseproduct'] = $this->WareHouseUsers->count_product();
		$data['total_purchase'] = $this->WareHouseUsers->total_purchase();
		$data['total_sales'] = $this->WareHouseUsers->total_sales();
		$data['sales'] = 0;
		$data['warehouse_purchase_order'] = $this->db->where('purchased_by',$user['sessionData']['warehouseId'])->get('warehouse_purchase_order')->num_rows(); 
		$data['all_product_names'] = $this->db->select('product_id,product_title')->from('warehouse_products')->get()->result_array();

		$data['warehouse_sales_order'] = $this->db->where('purchased_by',$user['sessionData']['warehouseId'])->get('warehouse_sales_order')->num_rows(); 
		$data['title']="WareHouse Dashboard";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		$this->load->view('warehouse/index',$data);
		$this->load->view('warehouse-common/warehouse-footer');
	}

	function add_werehouse_users(){

		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['title']="WareHouse Add User";
		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/users/add-warehouse-users');
		$this->load->view('warehouse-common/warehouse-footer');
	}


	function getSalesPurchase(){
		
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array());
			exit();
		}
		$data = $this->WareHouseUsers->getSalesPurchase();
		echo json_encode($data);
	}	


	function get_warehouse_users(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array());
			exit();
		}
		$data = $this->WareHouseUsers->get_warehouse_users();
		echo json_encode($data);
	}
	function get_wereehous_single_user($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->get_warehouse_users($id);
		echo json_encode($data);		
	}

	function add_warehouseusers(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->insert_warehouse_user();
		echo json_encode($data);
	}

	function update_warehouseusers($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->update_warehouse_user($id);
		echo json_encode($data);
	}


	function update_warehouse_users_status($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->WareHouseUsers->update_warehouse_users_status($id);
		echo json_encode($data);
	}

	function total_purchase(){

	}

	public function notification($id = ''){
			 
		if($id != ''){
			$result = $this->notificationModel->updateNotification($id);
			if($result['status'] == '1'){
			// redirect('?/AllOrder');
				$data['result'] = $this->notificationModel->notification();
			}

		}else{
			$data['result'] = $this->notificationModel->notification();	
		}
 		 

		// $this->db->where('storeId',$data['result'][0]['purchased_by']); 
		// $this->db->select('storeName');
		// $this->db->from('storedetails');
		// $storeName=$this->db->get(); 
		// $storeName= $storeName->row_array();
		// array_push($data['result'], $storeName); 
		echo json_encode($data['result']);
	}


	function notification_1($id = ''){
			if($id != ''){
			$result = $this->notificationModel->updateNotification_1($id);
			if($result['status'] == '1'){
			// redirect('?/AllOrder');
				$data['result'] = $this->notificationModel->notification_1();
			}

		}else{
			$data['result'] = $this->notificationModel->notification_1();	
		}
 		  
		echo json_encode($data['result']);
	}


	
	function total_sales_order(){
		$data = $this->WareHouseUsers->total_sales_order();
		echo round($data['total_sales'],2);
	}

	function average_sales_order(){
		$data = $this->WareHouseUsers->average_sales_order();
		echo round($data['total_sales'],2);
	}

	function total_purchase_order(){
		$data = $this->WareHouseUsers->total_purchase_order();
		echo round($data['total'],2);
	}

	function average_purchase_order(){
		$data = $this->WareHouseUsers->average_purchase_order();
		echo round($data['total'],2);
	}

	/*count*/
	function get_total_no_of_orders(){
		$data = $this->WareHouseUsers->total_sales_order();
		echo round($data['totalSalesOrder']);		
	}
	function get_total_no_of_purchase_orders(){
		$data = $this->WareHouseUsers->total_purchase_order();
		echo round($data['totalOrder']);		
	}
	function get_total_order_returns(){
		$data = $this->WareHouseUsers->total_purchase_order_return();
		echo round($data['totalOrder']);		
	}
	function get_sales_by_item_count(){
		$data = $this->WareHouseUsers->product_sales_report();
		echo json_encode($data);
		// explode(',', $data);

	}
	function get_top_selling_items(){
		$data = $this->WareHouseUsers->get_top_selling_items();
		echo json_encode($data);
		// explode(',', $data);

	}


	
}
