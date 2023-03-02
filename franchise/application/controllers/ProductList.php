<?php
/**
 * 
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ProductList extends CI_Controller
{
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('productListModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	}

	function get_warehouse_single_product_search_by_barcode(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->productListModel->get_warehouse_product_value_by_barcode();
		echo json_encode($data);		
	}
  

	function get_warehouse_product($id=''){		
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data['wa'] = $this->productListModel->get_warehouse_product_details($id);
		$data['store'] = $this->productListModel->get_store_product_details($id);
		echo json_encode($data);
	}


	function get_store_warehouse_product($id='',$color=''){		
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->productListModel->get_store_product_details($id,$color);
		echo json_encode($data);
	}

	

	function get_single_store_product_details($id=''){		
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->productListModel->get_single_store_product_details($id);
		echo json_encode($data);
	}
	
	function details(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url()); 	
		}
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->productListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']=""; 
        $this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/product/product-details',$data);
		$this->load->view('store-common/store-footer');	
	} 

	function get_single_admin_product($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data['product'] = $this->productListModel->get_admin_product_details($id);
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->productListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		echo json_encode($data);
	}

	function get_warehouse_single_product($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->productListModel->get_warehouse_single_product($id);
		echo json_encode($data);
	}

	function getWareouses($id=''){ 
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data=$this->productListModel->getWareouses();
		echo json_encode($data);
	}
 	
 	function update_stock_value(){
 		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
 		$data=$this->productListModel->update_stock_value();
		echo json_encode($data);
 	}
}