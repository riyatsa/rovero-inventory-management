<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * created date: 29-09-2020
 */
class AdminDashboard extends CI_Controller
{

	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('WerehouseModel');
	  $this->load->model('StoreModel');
	}	

	function index(){
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin'); 	
		}
		$data['total_warehouse'] = $this->WerehouseModel->count_warehouse();
		$data['warehouseproduct'] = $this->db->get('warehouse_products')->num_rows();
		$data['total_purchase'] = $this->WerehouseModel->total_purchase();
		$data['total_sales'] = $this->WerehouseModel->total_sales();
		$data['sales'] = 0;
		$data['warehouse_purchase_order'] = $this->db->get('warehouse_purchase_order')->num_rows(); 
		$data['warehouse_sales_order'] = $this->db->get('warehouse_sales_order')->num_rows(); 
		$data['all_product_names'] = $this->db->select('store_product_id,product_title')->from('store_products')->get()->result_array();
		
		$data['title']="Admin Dashboard";
		$data['store']= $this->db->where('storeStaus',1)->get('storedetails')->result_array();
		$this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/index',$data);
		$this->load->view('admin-common/admin-footer');
	}



	function total_sales_order(){
		$data = $this->StoreModel->total_sales_order();
		echo round($data['total_sales'],2);
	}

	function average_sales_order(){
		$data = $this->StoreModel->average_sales_order();
		echo round($data['total_sales'],2);
	}

	function total_purchase_order(){
		$data = $this->StoreModel->total_purchase_order();
		echo round($data['total'],2);
	}

	function average_purchase_order(){
		$data = $this->StoreModel->average_purchase_order();
		echo round($data['total'],2);
	}

	/*count*/
	function get_total_no_of_orders(){
		$data = $this->StoreModel->total_sales_order();
		echo round($data['totalSalesOrder']);		
	}
	function get_total_no_of_purchase_orders(){
		$data = $this->StoreModel->total_purchase_order();
		echo round($data['totalOrder']);		
	}
	function get_total_order_returns(){
		$data = $this->StoreModel->total_purchase_order_return();
		echo round($data['totalOrder']);		
	}
	function get_sales_by_item_count(){
		$data = $this->StoreModel->product_sales_report();
		echo json_encode($data);
		// explode(',', $data);

	}
	function get_top_selling_items(){
		$data = $this->StoreModel->get_top_selling_items();
		echo json_encode($data);
		// explode(',', $data);

	}


	
}