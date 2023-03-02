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

	function warehouse_accepted_order_reject($id){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data = $this->StoreOrderModel->warehouse_accepted_order_reject($id);
		echo json_encode($data);
	}

	function accept_warehouse_approvel_product(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
			$data = $this->StoreOrderModel->accept_warehouse_approvel_product();
		echo json_encode($data);
	}
	function view_received_bill($sales_id){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data = $this->ProductListModel->get_accepted_purchase_order($sales_id);
		echo json_encode($data);
	}


	function accepted_order_bill($param){
		
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		 $purchase_id = base64_decode(urldecode($param));
		// die();
		$data['bill'] = $this->ProductListModel->get_accepted_purchase_order($purchase_id);
	
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/accepted-store-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}



	function store_received_product_order($id){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$where = array('sales_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('warehouse_sales_order') 
				->limit(1)
				->order_by('sales_id','DESC')
				->get()
				->row_array();
  
		$data['order'] = $result;
		$data['purchase_id'] = $id;
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/warehouse-approved-bill',$data);
		$this->load->view('store-common/store-footer');	

		
	}

	function edit_sales_order($id){
				$data = $this->StoreOrderModel->update_sales_order_bill($id);
		echo json_encode($data);
	}

	function edit_purchase_bill($id){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
	}

		$where = array('purchase_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('store_purchase_order') 
				->limit(1)
				->order_by('product_id','DESC')
				->get()
				->row_array();
  
		$data['order'] = $result;
		$data['purchase_id'] = $id;
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/store-purchase-bill',$data);
		$this->load->view('store-common/store-footer');	
	}


	function index(){
		if(!$this->session->userdata('logged_in_store')){
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
		// $this->load->view('store/order/add-order',$data);
		$this->load->view('store/order/new-ui-add-order',$data);
		$this->load->view('store-common/store-footer');	
	}

	function sales_order_bill($param){
		
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		 $purchase_id = base64_decode(urldecode($param));
		// die();
		$data['bill'] = $this->ProductListModel->get_store_purchase_order($purchase_id);
	
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/store-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}

	function print_invoice($param){
		if(!$this->session->userdata('logged_in_store')){
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
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->get_store_purchase_order($id);
		echo json_encode($data);
	}


	function details(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/store-order-list');
		$this->load->view('store-common/store-footer');	
	}

	function get_warehouse_order_approved_list($id=''){
			$data = $this->ProductListModel->get_warehouse_approved_store_purchase_order($id);
		echo json_encode($data);
	}

	function warehouse_approved_products(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/warehouse-approve-list');
		$this->load->view('store-common/store-footer');	
	}


	function get_warehouse_product(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->get_warehouse_product();
		echo json_encode($data);
	}

	function get_warehouse_product_value(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->get_warehouse_product_value();
		echo json_encode($data);
	}

	function get_store_product_value(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->get_store_product_value();
		echo json_encode($data);
	}


	function get_state_for_warehouse($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$result = $this->db->where('warehouseId',$id)->get('warehousedetails')->row_array();
		echo json_encode($result);
	}

	function add_purchase_order(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
				$data = $this->StoreOrderModel->insert_order();
		echo json_encode($data);
	}

	function get_order_store_order_list(){

		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreOrderModel->get_order_store_order_list();
		echo json_encode($data);
	}
	function get_store_product(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->get_store_product();
		// if (count($data) > 0) { 
			echo json_encode($data);
		// }
	}

	/*return order */
	function get_store_return_purchase_order($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->get_store_return_purchase_order($id);
		echo json_encode($data);
	}
	

}