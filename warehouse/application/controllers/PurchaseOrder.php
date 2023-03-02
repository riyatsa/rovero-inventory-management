<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchaseOrder extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('OrderModel');  
	  $this->load->model('vendorModel');  
	  $this->load->model('ProductModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel');  
	  $this->load->model('salesOrderModel'); 
	  $this->load->model('VendorModel'); 
	}

	function index(){
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['vendor'] = $this->VendorModel->VendorView();
		$data['title']="Purchase Order"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		// $this->load->view('warehouse/purchase/add-order',$data);
		$this->load->view('warehouse/purchase/new-ui-add-order',$data);
		$this->load->view('warehouse-common/warehouse-footer',$data);	
	}

	function purchase_order_invoice($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$ids = base64_decode(urldecode($id));
		$data['bill'] = $this->OrderModel->get_warehouse_purchase_order($ids);
		$data['title']="Purchase Order Invoice"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/purchase/print-purchase-order',$data);
		$this->load->view('warehouse-common/warehouse-footer',$data);	
	}
	
	function add_purchase_order(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$storeFiles=array();
	    $output_dir = 'uploads/attachments/';
	    // If files are selected to upload 
	    
	    if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
	      $error =$_FILES["files"]["error"]; 
	      if(!is_array($_FILES["files"]["name"])) {
	        $file_ext = pathinfo($_FILES["files"]["name"], PATHINFO_EXTENSION);
	        $fileName = uniqid().date('YmdHis').'.'.$file_ext;
	        move_uploaded_file($_FILES["files"]["tmp_name"],$output_dir.$fileName);
	        $storeFiles[]= $fileName; 
	      } else {
	        $fileCount = count($_FILES["files"]["name"]);
	        for($i=0; $i < $fileCount; $i++) {
	          $files_name = $_FILES["files"]["name"][$i];
	          $file_ext = pathinfo($files_name, PATHINFO_EXTENSION);
	          $fileName = uniqid().date('YmdHis').'.'.$file_ext;
	          move_uploaded_file($_FILES["files"]["tmp_name"][$i],$output_dir.$fileName);
	          $storeFiles[]= $fileName; 
	        } 
	      } 
	    }
		$data = $this->OrderModel->insert_order($storeFiles);
		echo json_encode($data);
	}

	function VendorView($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->VendorModel->VendorView($id);
		echo json_encode($data);
	}
  
  	function get_single_warehouse_product($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data['product'] = $this->ProductModel->get_warehouse_product_details($id);
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		echo json_encode($data);
	}

	function purchsedetails(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Purchase Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		$this->load->view('warehouse/purchase/purchaseOrderList',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}


	function storePurchsedetails(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Purchase Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		$this->load->view('warehouse/purchase/storePurchase OrderList',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}

	function store_return_order(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Purchase Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		$this->load->view('warehouse/purchase/store-return-order',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}


	function getPurchseDetails($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data = $this->OrderModel->getPurchseDetails($id);
		echo json_encode($data);
	}

	function getPurchseDetailsView($id=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data = $this->ProductModel->get_warehouse_purchase_single_order($id);
		// $product_id = explode(',', $data['product_id']);
		// echo count($product_id);*/
		// exit();
		/*$productDetail = [];
		for ($i=0; $i < count($product_id); $i++) { 
			$productData = $this->ProductModel->get_warehouse_product_details($product_id[$i]);
			array_push($productDetail, $productData);
			*/
		// }
		// echo json_encode($productDetail);
		// exit();
		// echo "<br><br>";
		echo json_encode($data);

	}



	function get_order_store_order_list(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->OrderModel->get_order_store_order_list();
		echo json_encode($data);
	}
	function get_return_store_order_list(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->OrderModel->get_return_store_order_list();
		echo json_encode($data);		
	}

	function get_store_purchase_order($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->OrderModel->get_store_purchase_order($id);
		echo json_encode($data);
	}

	function get_return_purchase_order($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->OrderModel->get_return_purchase_order($id);
		echo json_encode($data);
	}

	function change_puchase_order_status($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		if ($this->input->post('status')=='1') {  
			// redirect('store-purchase-order/'.$id);
			echo json_encode(array('status'=>'1','msg'=>'next bill.'));
		}else{ 
		$data = $this->OrderModel->change_puchase_order_status($id);
		echo json_encode($data);
		}
	}

	function change_return_order_status($id){
		if(!$this->session->userdata('logged_in_warehouse')){
		echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
		exit();
		}
	 
		$data = $this->OrderModel->change_return_order_status($id);
		echo json_encode($data);
		 
	}

	function store_purchase_order($id){
				if(!$this->session->userdata('logged_in_warehouse')){
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

		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Purchase Order List"; 
		$data['gst'] = $this->GstModel->viewGst();
		$data['order'] = $result;
		$data['purchase_id'] = $id;
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		// $this->load->view('warehouse/purchase/store-purchase-order',$data);
		$this->load->view('warehouse/purchase/new-ui-store-purchase-order',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}


	function add_sales_order($id){
		$data = $this->salesOrderModel->insert_sales_order_bill($id);
		echo json_encode($data);
	}
 

 function sales_order_bill($id){
	if(!$this->session->userdata('logged_in_warehouse')){
		redirect(base_url());
		exit();
	}
	 $ids = base64_decode(urldecode($id));
// die();
	$data['bill'] = $this->salesOrderModel->get_warehouse_sales_order_bill($ids);
	$data['title']="Purchase Order Invoice"; 
    $this->load->view('warehouse-common/warehouse-header');
	$this->load->view('warehouse-common/warehouse-sidebar');
	$this->load->view('warehouse/sales/sales-invoice',$data);
	$this->load->view('warehouse-common/warehouse-footer',$data);	
 }



 function re_update_sales_order($sales_order){
 	$data = $this->salesOrderModel->re_update_sales_order($sales_order);
 	echo json_encode($data);
 }
function po_attachments($purchase_id){
$files = array();
$data = $this->db->where('purchase_id',$purchase_id)->select('bill_number,bill_attachment')->from('warehouse_purchase_order')->get()->row_array();
$fileName = 'uploads/attachments/'.$data['bill_number'].'.zip';
 foreach (explode(',', $data['bill_attachment']) as $key => $value) {
 	array_push($files, $value);
 }
 
	$result = $this->createZipArchive($files,$fileName);
	if (file_exists($fileName)) {
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($fileName));
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($fileName));
	    ob_clean();
	    flush();
	    readfile($fileName); 
	        unlink($fileName);
	    // }
	    exit;
    }
}

/* create a compressed zip file */
function createZipArchive($files = array(), $destination = '', $overwrite = false) {

   if(file_exists($destination) && !$overwrite) { return false; }

   $validFiles = array();
   if(is_array($files)) {
      foreach($files as $file) {
         if(file_exists('uploads/attachments/'.$file)) {
            $validFiles[] = $file;
         }
      }
   }

   if(count($validFiles)) {
      $zip = new ZipArchive();
      if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) == true) {
         foreach($validFiles as $file) {
            $zip->addFile("uploads/attachments/".$file,$file);
         }
         $zip->close();
         return file_exists($destination);
      }else{
          return false;
      }
   }else{
      return false;
   }
}


function add_new_item_for_warehouse_billing(){
	$data = $this->salesOrderModel->add_new_item_for_warehouse_billing();
		echo json_encode($data);
}



}