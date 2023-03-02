<?php
/**
 * 
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Zend\Barcode\Barcode;
class WareHouseProduct extends CI_Controller
{
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('ProductModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	}

	function index(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/add-product',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}
		function get_warehouse_barcode_image_details(){
		$data = $this->ProductModel->get_warehouse_barcode_image_details();
		echo json_encode($data);
	}


	
	function check_duplication_barcode(){
		$data = $this->ProductModel->check_duplication_barcode();
		echo json_encode($data);
	}

	function check_duplication_name(){
		$data = $this->ProductModel->check_duplication_name();
		echo json_encode($data);	
	}

	function product_category(){ 
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-category');
		$this->load->view('warehouse-common/warehouse-footer');
	}

	function details(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-details',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}

	function product_barcode(){ 
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-barcode');
		$this->load->view('warehouse-common/warehouse-footer');
	}
	
	function bulk_add_product(){ 
		if(!$this->session->userdata('logged_in_warehouse_user')){
			redirect(base_url());
			exit();
		}
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-bulk-add');
		$this->load->view('warehouse-common/warehouse-footer');
	}
 
	function getProductCategory(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array());
			exit();
		}
		$data['result']=$this->ProductModel->getProductCategory();
		echo json_encode($data['result']);
	}

	function insert_category(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data=$this->ProductModel->insert_category();
		if ($data['status']=='1') {
		echo json_encode($data);
		}else{
		echo json_encode($data); 
		}
	}

	function update_category($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data=$this->ProductModel->update_category($id);
		if ($data['status']=='1') {
		echo json_encode($data);
		}else{
		echo json_encode($data); 
		}
	}
	function remove_category($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data=$this->ProductModel->remove_category($id);
		if ($data['status']=='1') {
		echo json_encode($data);
		}else{
		echo json_encode($data); 
		}
	}

	function check_duplication(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data=$this->ProductModel->check_duplication();
		echo json_encode($data);
	}

	/*for the product insert*/

	function add_warehouse_product(){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$barcode = $this->generate_barcode($this->input->post('barcode'));
		$data = $this->ProductModel->insert_warehouse_products($barcode);
		echo json_encode($data);
	}

	function edit_warehouse_product($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->ProductModel->update_warehouse_products($id);
		echo json_encode($data);
	}

	function get_warehouse_product(){		
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array());
			exit();
		} 
		$data = $this->ProductModel->get_warehouse_product_details();
		echo json_encode($data);
	}

	function change_produuct_status($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->ProductModel->update_warehouse_product_status($id);
		echo json_encode($data);
	}


	function get_single_warehouse_product($id){
		if(!$this->session->userdata('logged_in_warehouse_user')){
			echo json_encode(array());
			exit();
		}
		$data['product'] = $this->ProductModel->get_warehouse_product_details($id);
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		echo json_encode($data);
	}


	function importExcel(){

		 // If file uploaded
            if(!empty($_FILES['files']['name'])) { 
                // get file extension
                $extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
 
                if($extension == 'csv'){
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                } elseif($extension == 'xlsx') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }
                // file path
                $spreadsheet = $reader->load($_FILES['files']['tmp_name']);
                $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            
                // array Count
                $arrayCount = count($allDataInSheet);
              	$flag = true;
                $i=0;
                $date = date('Y-m-d');
                $inserdata = array();
                foreach ($allDataInSheet as $value) {
                  if($flag){
                    $flag =false;
                    continue;
                }

                $user = $this->session->userdata('logged_in_warehouse_user'); 
                
              if ($value['A'] !='' && $value['B'] !='' && $value['D'] != '') {
                  // $data = $this->ProductModel->check_duplicate_product_code_name($value['A'],$value['B'], $user['warehouseId']);
                  	// if ($data['status']!='1'){ 
                  		$barcode = $this->generate_barcode($value['B']);
                  		$insert_barcode[$i]['barcode'] = $value['B'];
                  		$insert_barcode[$i]['barcode_img'] = $barcode;

		               	$inserdata[$i]['product_title'] = $value['A'];
		                $inserdata[$i]['barcode'] = $value['B'];
		                $inserdata[$i]['category_id'] = $value['C'];
		                $inserdata[$i]['purchase_price'] =preg_replace("/[^0-9\.,]/", "", $value['D']);
		                $inserdata[$i]['product_mrp'] =preg_replace("/[^0-9\.,]/", "", $value['E']);
		                $inserdata[$i]['retail_price'] =preg_replace("/[^0-9\.,]/", "", $value['F']);
		                $inserdata[$i]['wholesale_price'] = preg_replace("/[^0-9\.,]/", "",$value['G']);
		                $inserdata[$i]['opening_quantity'] = preg_replace("/[^0-9\.,]/", "",$value['H']);
		                // $inserdata[$i]['opening_quantity'] = $value['H'];
		                $inserdata[$i]['minimum_stock'] = $value['I'];
		                $inserdata[$i]['tax_rate'] = $value['J'];
		                $inserdata[$i]['usersId'] = $user['warehouseId'];
		                $inserdata[$i]['warehouseId'] = $user['warehouseId'];
		                $inserdata[$i]['user_type'] = 'warehouse'; 
		                $inserdata[$i]['date'] = $date;
		                $inserdata[$i]['import_excel'] = '0'; 
                  	// } 
                  }
                
                  $i++;
                }  
                	// $tempArr = array_unique(array_column($inserdata, 'customer_email_id'));
					// $inserdata_new = array_intersect_key($inserdata, $tempArr);   

	                if (count($inserdata) > 0) {
	                     	 
	               		$data = $this->ProductModel->importProduct($inserdata,$insert_barcode);
	                }else{
	                	$data = array('status'=>'0');
	                } 
    

                } else {
                    $data = array('status'=>'0');
                }
           echo json_encode($data);

	}

	function check_duplicate_product_code_name($product_title,$barcode,$warehouseId){
		// if(!$this->session->userdata('logged_in_warehouse')){
		// 	echo json_encode(array());
		// 	exit();
		// } 
		$data = $this->ProductModel->check_duplicate_product_code_name($product_title,$barcode,$warehouseId);
		
		echo json_encode($data);
	}


	function get_order_products(){
		$data = $this->ProductModel->get_warehouse_product_details_by_search();
		if (count($data) > 0) { 
			echo json_encode($data);
		}else{
			echo json_encode(array(array('product_id' =>0 , 'product_title' =>0 , 'purchase_price' =>0 )));
		}
	}  


	function get_warehouse_product_value(){
		$data = $this->ProductModel->get_warehouse_product_value(); 
		echo json_encode($data); 
	}

		function generate_barcode($code){ 
		// Only the text to draw is required
		$barcodeOptions = array('text' => $code);

		// No required options
		$rendererOptions = array();

		// Draw the barcode in a new image,
		// send the headers and the image
		/*$render = Barcode::factory(
		    'code128', 'image', $barcodeOptions,$rendererOptions
		)->drow(); 
		return $render;*/
		$file = Barcode::draw('code128', 'image', array('text' => $code), array());
		   // $code = time().$temp;
		   $store_image = imagepng($file,"../uploads/barcode/{$code}.png");
		   return $code.'.png';
	}
}