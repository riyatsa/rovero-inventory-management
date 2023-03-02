<?php

/**
 * 
 */
class SalesOrder extends CI_Controller
{
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  // $this->load->model('OrderModel');  
	  // $this->load->model('vendorModel');  
	  $this->load->model('ProductModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	  $this->load->model('SalesOrderModel');   
	}
 

	function index(){
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse_user'); 
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']="Purchase Order"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		$this->load->view('warehouse/sales/add-sales-order',$data);
		$this->load->view('warehouse-common/warehouse-footer',$data);	
	}

	function sales_details(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse_user'); 
		$data['title']="Sales Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/sales/sales-list',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}

	function get_sales_orders(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->get_sales_order_details();
		echo json_encode($data);
	}

	function get_store_details(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->get_store_details();
		echo json_encode($data);
	}

	function insertStore(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->SalesOrderModel->insertStore();
		echo json_encode($data);
	}

	function insert_sales_order(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->insert_sales_order();
		echo json_encode($data);	
	}

	
	function sales_invoice($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$ids = base64_decode(urldecode($id));
		$data['bill'] = $this->SalesOrderModel->get_warehouse_sales_order($ids);
		$data['title']="Sales Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/sales/sales-invoice',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}

	function get_sales_order_veiw($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->get_sales_order_veiw($id); 
		$product_id = explode(',', $data[0]['product_id']); 
		// echo json_encode($product_id);
		// exit();
		$productDetail = [];
		for ($i=0; $i < count($product_id); $i++) { 
			$productData = $this->ProductModel->get_warehouse_product_details($product_id[$i]);
			array_push($productDetail, $productData);
			
		} 
		echo json_encode(array("invoice"=>$data,"productDetail"=>$productDetail));
	}



}