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
  

	function get_warehouse_product($id=''){		
		// if(!$this->session->userdata('logged_in')){
		// 	echo json_encode(array('status'=>'3'));	
		// 	exit();
		// }
		$data = $this->productListModel->get_warehouse_product_details($id);
		echo json_encode($data);
	}

	function details(){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->productListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']=""; 
        $this->load->view('admin-common/admin-header');
		$this->load->view('admin-common/admin-sidebar');
		$this->load->view('admin/product/product-details',$data);
		$this->load->view('admin-common/admin-footer');	
	} 

	function get_single_admin_product($id){
		if(!$this->session->userdata('logged_in')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data['product'] = $this->productListModel->get_admin_product_details($id);
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->productListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		echo json_encode($data);
	}



	function getWareouses($id=''){ 
		//  getWareouses
		//  if(!$this->session->userdata('logged_in')){
		// 	echo json_encode(array('status'=>'3'));	
		// 	exit();
		// }
		$data=$this->productListModel->getWareouses();
		echo json_encode($data);
	}
 
}