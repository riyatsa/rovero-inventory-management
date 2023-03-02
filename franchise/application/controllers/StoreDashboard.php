<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreDashboard extends CI_Controller {

	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('storeDashBoardModel'); 
	  $this->load->model('notificationModel'); 
	}

	function index(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url()); 	
		}
		$user = $this->session->userdata('logged_in_store');
		$data['total_purchase'] = $this->storeDashBoardModel->total_purchase();
		$data['total_sales'] = $this->storeDashBoardModel->total_sales();
		$data['total_product'] = $this->storeDashBoardModel->total_ptoduct();
		$data['all_product_names'] = $this->db->where('storeId',$user['storeId'])->select('store_product_id,product_title')->from('store_products')->get()->result_array();
		$data['title']="store Dashboard";
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/index',$data);
		$this->load->view('store-common/store-footer');
	}
 
 	function get_monthly_data(){
 		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
 		$data = $this->storeDashBoardModel->get_monthly_data();
 		echo json_encode($data);
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

	function total_sales_order(){
		$data = $this->storeDashBoardModel->total_sales_order();
		echo round($data['total_sales'],2);
	}

	function average_sales_order(){
		$data = $this->storeDashBoardModel->average_sales_order();
		echo round($data['total_sales'],2);
	}

	function total_purchase_order(){
		$data = $this->storeDashBoardModel->total_purchase_order();
		echo round($data['total'],2);
	}

	function average_purchase_order(){
		$data = $this->storeDashBoardModel->average_purchase_order();
		echo round($data['total'],2);
	}

	/*count*/
	function get_total_no_of_orders(){
		$data = $this->storeDashBoardModel->total_sales_order();
		echo round($data['totalSalesOrder']);		
	}
	function get_total_no_of_purchase_orders(){
		$data = $this->storeDashBoardModel->total_purchase_order();
		echo round($data['totalOrder']);		
	}
	function get_total_order_returns(){
		$data = $this->storeDashBoardModel->total_purchase_order_return();
		echo round($data['totalOrder']);		
	}

	function get_sales_by_item_count(){
		$data = $this->storeDashBoardModel->product_sales_report();
		echo json_encode($data);
		// explode(',', $data);

	}

	function get_top_selling_items(){
		$data = $this->storeDashBoardModel->get_top_selling_items();
		echo json_encode($data);
	}


}
