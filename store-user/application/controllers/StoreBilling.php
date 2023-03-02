<?php
/**
 * 
 */
class StoreBilling extends CI_Controller
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
	  $this->load->model('StoreBillingModel');   
	  $this->load->model('customerModel');   
	}


	function edit_sales_bill($id){
				if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_store_user');
		// print_r($user);
		 $storeId = $user['soreId'];
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$data['title']="Purchase Order"; 
		$data['order'] = $this->StoreBillingModel->get_single_sales_bill($id);
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/edit-billing-order',$data);
		$this->load->view('store-common/store-footer');	
	}

	function edit_print_invoice($param){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$number = base64_decode(urldecode($param));
		$data['bill'] = $this->ProductListModel->get_generated_sales_bill($number); 
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/print-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}


	
	function index(){ 
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_store_user');
		// print_r($user);
		 $storeId = $user['soreId'];
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/add-billing-order',$data);
		$this->load->view('store-common/store-footer');	
	} 

	function print_invoice($param){
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$number = base64_decode(urldecode($param));
		$data['bill'] = $this->ProductListModel->get_generated_bill($number); 
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/print-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}

	
	function details(){ 
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/sales-order-list');
		$this->load->view('store-common/store-footer');	
	} 

	
	function get_current_hold_bill($id=''){
			$data = $this->StoreBillingModel->get_current_hold_bill($id);
		echo json_encode($data);
	}



	function hold_sales_bill($id){
				if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_store_user');
		// print_r($user);
		 $storeId = $user['soreId'];
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$data['title']="Purchase Order"; 
		$data['order'] = $this->StoreBillingModel->get_single_sales_bill($id);
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/hold-billing-order',$data);
		$this->load->view('store-common/store-footer');	
	}

		function hold_bills(){ 
		if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/hold-order-list');
		$this->load->view('store-common/store-footer');	
	} 



	function add_store_sales_billing(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->StoreBillingModel->insert_order();
		echo json_encode($data);
	}

	function get_current_store_sales_order_data($id=''){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->StoreBillingModel->get_current_store_sales_order_data($id);
		echo json_encode($data);
	}


	function customerData($phoneNumber){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->customerModel->viewCustomer($phoneNumber);
	 	
		if($data > 0){
			echo json_encode(array('status'=>'1','customer' => $data));
		}else{
			echo json_encode(array('status'=>'0','message'=>'New Customer'));
		}
	}

	
	function change_store_bill_order_status($id){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->StoreBillingModel->change_store_bill_order_status($id);
		echo json_encode($data);
	}
	
		function edit_store_sales_billing(){
				if(!$this->session->userdata('logged_in_store_user')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreBillingModel->edit_store_sales_billing();
		echo json_encode($data);
	}
}