<?php

/**
 * 
 */
class ReturnOrder extends CI_Controller
{
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');   
	  $this->load->model('ProductListModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	  $this->load->model('returnOrderModel');    
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
		// $this->load->view('store/order/return-order',$data);
		$this->load->view('store/order/new-ui-return-order',$data);
		$this->load->view('store-common/store-footer');	
	}

	function details(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/return-order-view');
		$this->load->view('store-common/store-footer');	
	}

	function return_order_bill($param){
		
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		 $purchase_id = base64_decode(urldecode($param));
		// die();
		$data['bill'] = $this->returnOrderModel->get_return_order($purchase_id);
	
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/return-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}



	function get_return__order_list(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->returnOrderModel->get_return_order_list();
		echo json_encode($data);
	}

	function add_return_purchase_order(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
				$data = $this->returnOrderModel->insert_return_order();
		echo json_encode($data);
	}
}