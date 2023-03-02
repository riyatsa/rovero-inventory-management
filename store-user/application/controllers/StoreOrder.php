<?php

/**
 * 
 */
class StoreOrder extends CI_Controller
{
	
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  // $this->load->model('OrderModel');  
	  // $this->load->model('vendorModel');  
	  $this->load->model('ProductListModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	  $this->load->model('StoreOrderModel'); 
	  // $this->load->model('SalesOrderModel');   
	}


	function index(){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/add-order',$data);
		$this->load->view('store-common/store-footer');	
	}

	function print_invoice($param){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$number = base64_decode(urldecode($param));
		$data['bill'] = $this->ProductListModel->get_generated_store_bill($number);
	
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/store-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}

	function get_store_purchase_order($id){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductListModel->get_store_purchase_order($id);
		echo json_encode($data);
	}


	function details(){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());	
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/store-order-list');
		$this->load->view('store-common/store-footer');	
	}


	function get_warehouse_product(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductListModel->get_warehouse_product();
		echo json_encode($data);
	}

	function get_warehouse_product_value(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductListModel->get_warehouse_product_value();
		echo json_encode($data);
	}

	function get_store_product_value(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductListModel->get_store_product_value();
		echo json_encode($data);
	}


	function get_state_for_warehouse($id){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$result = $this->db->where('warehouseId',$id)->get('warehousedetails')->row_array();
		echo json_encode($result);
	}

	function add_purchase_order(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
				$data = $this->StoreOrderModel->insert_order();
		echo json_encode($data);
	}

	function get_order_store_order_list(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->StoreOrderModel->get_order_store_order_list();
		echo json_encode($data);
	}
	function get_store_product(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductListModel->get_store_product();
		// if (count($data) > 0) { 
			echo json_encode($data);
		// }
	}
	

}