<?php 
/**
 * 
 */
class StoreProduct extends CI_Controller
{
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('ProductListModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
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
	$data['title']=""; 
    $this->load->view('store-common/store-header');
	$this->load->view('store-common/store-sidebar');
	$this->load->view('store/product/add-product',$data);
	$this->load->view('store-common/store-footer');
	}

	function add_warehouse_product(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductListModel->insert_warehouse_products();
		echo json_encode($data);
	}
}