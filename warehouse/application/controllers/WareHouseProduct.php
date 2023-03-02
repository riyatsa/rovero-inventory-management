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


	/*function generate_code(){
		echo time();
	}
*/
	function generate_code(){
		$code = '';
		for($i = 0; $i < 13; $i++) { $code .= mt_rand(0, 9); }
		echo $code;
	}
// echo generateCode(12);

	function check_duplication_barcode(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		// $data = $this->ProductModel->check_duplication_barcode();
		// echo json_encode($data);
		echo array('status'=>'0','msg'=>'uniqe data');	
	}

	function check_duplication_name(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		echo array('status'=>'0','msg'=>'uniqe data');
		// $data = $this->ProductModel->check_duplication_name();
		// echo json_encode($data);	
	}

	function get_warehouse_barcode_image_details($barcode=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$data = $this->ProductModel->get_warehouse_barcode_image_details($barcode);
		echo json_encode($data);
	}

	function get_monthly_data(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
		$year = date('Y');
		$user = $this->session->userdata('logged_in_warehouse');
		$result = $this->db->query('select monthname(created_date) as MONTHNAME,count(product_id) as total from
		warehouse_products WHERE usersId='.$user['warehouseId'].' AND YEAR(created_date) = '.$year.' group by monthname(created_date) ');

		echo json_encode($result->result_array());
	}

	function index(){
		if(!$this->session->userdata('logged_in_warehouse')){
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

	function product_category(){ 
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-category');
		$this->load->view('warehouse-common/warehouse-footer');
	}

		function product_barcode(){ 
		if(!$this->session->userdata('logged_in_warehouse')){
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
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['title']=""; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-bulk-add');
		$this->load->view('warehouse-common/warehouse-footer');
	}

	function details(){
		if(!$this->session->userdata('logged_in_warehouse')){
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

 
	function getProductCategory(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array());
			exit();
		}
		$data['result']=$this->ProductModel->getProductCategory();
		echo json_encode($data['result']);
	}

	function insert_category(){
		if(!$this->session->userdata('logged_in_warehouse')){
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
		if(!$this->session->userdata('logged_in_warehouse')){
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
		if(!$this->session->userdata('logged_in_warehouse')){
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
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data=$this->ProductModel->check_duplication();
		echo json_encode($data);
	}

	/*for the product insert*/

	function add_warehouse_product(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$barcode ='';
		if ($this->input->post('barcode_status')==1) { 
		$barcode = $this->generate_barcode($this->input->post('barcode'));
		}
		$data = $this->ProductModel->insert_warehouse_products($barcode);
		echo json_encode($data);
	}

	

	function edit_warehouse_product($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->ProductModel->update_warehouse_products($id);
		echo json_encode($data);
	}

	function get_warehouse_product($color){		
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array());
			exit();
		} 
		$data = $this->ProductModel->get_warehouse_product_details($color);
		echo json_encode($data);
	}

	function change_produuct_status($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));
			exit();
		}
		$data = $this->ProductModel->update_warehouse_product_status($id);
		echo json_encode($data);
	}


	function get_single_warehouse_product($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array());
			exit();
		}
		$data['product'] = $this->ProductModel->get_warehouse_product_detail($id);
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
                $user = $this->session->userdata('logged_in_warehouse'); 
                
              if ($value['A'] !='' && $value['B'] !='') {
                  // $data = $this->ProductModel->check_duplicate_product_code_name($value['B'], $user['warehouseId']);
                  	// if ($data['status']!='1'){ 
                  		if ($value['K']=='1') {
                  		$barcode = $this->generate_barcode($value['B']);
                  		$insert_barcode[$i]['barcode'] = $value['B'];
                  		$insert_barcode[$i]['barcode_img'] = $barcode;
                  		}
                  	
		                $inserdata[$i]['product_title'] = $value['A'];
		                $inserdata[$i]['barcode'] = $value['B'];
		                $inserdata[$i]['category_id'] = $value['C'];
		                $inserdata[$i]['purchase_price'] =preg_replace("/[^0-9\.,]/", "", $value['D']);
		                $inserdata[$i]['product_mrp'] =preg_replace("/[^0-9\.,]/", "", $value['E']);
		                $inserdata[$i]['retail_price'] =preg_replace("/[^0-9\.,]/", "", $value['F']);
		                $inserdata[$i]['wholesale_price'] = preg_replace("/[^0-9\.,]/", "",$value['G']);
		                $inserdata[$i]['opening_quantity'] = preg_replace("/[^0-9\.,]/", "",$value['H']);
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

	function check_duplicate_product_code_name($product_title,$barcode,$warehouseId){
		// if(!$this->session->userdata('logged_in_warehouse')){
		// 	echo json_encode(array());
		// 	exit();
		// } 
		$data = $this->ProductModel->check_duplicate_product_code_name($product_title,$barcode,$warehouseId);
		
		echo json_encode($data);
	}


	/* for the search products by product name */
	function get_order_products(){
		$data = $this->ProductModel->get_product_search_by_product_name();
		// if (count($data) > 0) { 
		echo json_encode($data);
		// }else{
			// echo json_encode(array(array('product_id' =>0 , 'product_title' =>0 , 'purchase_price' =>0 )));
		// }
	}

	function get_warehouse_product_value(){
		$data = $this->ProductModel->get_warehouse_product_value(); 
		echo json_encode($data); 
	}


	/*for the store */
	function get_store_list(){
		$data = $this->ProductModel->get_store_list(); 
		echo json_encode($data);
	}


	/**/
	function get_store_product($id=''){
		$data = $this->ProductModel->get_store_product($id);
		echo json_encode($data);
	}



	function importpreview(){
	 
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
                // $user = $this->session->userdata('logged_in_warehouse'); 
                
              // if ($value['A'] !='' && $value['B'] !='') {
               /*   $data = $this->ProductModel->check_duplicate_product_code_name($value['B'], $user['warehouseId']);
                  	if ($data['status']!='1'){ 
                  		if ($value['K']=='1') {
                  		$barcode = $this->generate_barcode($value['B']);
                  		$insert_barcode[$i]['barcode'] = $value['B'];
                  		$insert_barcode[$i]['barcode_img'] = $barcode;
                  		}
                  	*/
		                $inserdata[$i]['product_title'] = $value['A'];
		                $inserdata[$i]['barcode'] = $value['B'];
		                $inserdata[$i]['category_id'] = $value['C'];
		                $inserdata[$i]['purchase_price'] =preg_replace("/[^0-9\.,]/", "", $value['D']);
		                $inserdata[$i]['product_mrp'] =preg_replace("/[^0-9\.,]/", "", $value['E']);
		                $inserdata[$i]['retail_price'] =preg_replace("/[^0-9\.,]/", "", $value['F']);
		                $inserdata[$i]['wholesale_price'] = preg_replace("/[^0-9\.,]/", "",$value['G']);
		                $inserdata[$i]['opening_quantity'] = preg_replace("/[^0-9\.,]/", "",$value['H']);
		                $inserdata[$i]['minimum_stock'] = $value['I'];
		                $inserdata[$i]['tax_rate'] = $value['J'];
		                $inserdata[$i]['barcode_status'] = $value['K'];
                  	// } 
                  // }
                
                  $i++;
                }  
                	// $tempArr = array_unique(array_column($inserdata, 'customer_email_id'));
					// $inserdata_new = array_intersect_key($inserdata, $tempArr);   

	                if (count($inserdata) > 0) {
	                     	 
	               		$data = array('status'=>'1','products'=>$inserdata);//$this->ProductModel->importProduct($inserdata,$insert_barcode);
	                }else{
	                	$data = array('status'=>'0');
	                } 
    

                } else {
                    $data = array('status'=>'0');
                }
           // echo json_encode($data);
         $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-bulk-details',$data);
		$this->load->view('warehouse-common/warehouse-footer');

	}

	function preview_bulk_product(){

		$this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/products/product-bulk-details');
		$this->load->view('warehouse-common/warehouse-footer');
	}

	function importpreview_submited_data(){
 		$product_title = explode(',',$this->input->post('product_title'));
 		$barcode = explode(',',$this->input->post('barcode'));
 		$opening_quantity = explode(',',$this->input->post('opening_quantity'));
 		$minimum_stock = explode(',',$this->input->post('minimum_stock'));
 		$purchase_price = explode(',',$this->input->post('purchase_price'));
 		$product_mrp = explode(',',$this->input->post('product_mrp'));
 		$retail_price = explode(',',$this->input->post('retail_price'));
 		$wholesale_price = explode(',',$this->input->post('wholesale_price'));
 		$tax_rate = explode(',',$this->input->post('tax_rate'));
 		$barcode_status = explode(',',$this->input->post('barcode_status'));
 			  $user = $this->session->userdata('logged_in_warehouse');
 			  $i = 0;
 			  $date = date('Y-m-d');
 			  // echo $this->input->post('barcode');
 			  $inserdata = array();
 			  $insert_barcode = array();
 			foreach ($barcode as $key => $value) {
 				// echo $value;
 			// $data = $this->ProductModel->check_duplicate_product_code_name($value, $user['warehouseId']);
                  	// if ($data['status']!='1'){ 
                  		if ($barcode_status[$key]=='1') {
	                  		$barcode = $this->generate_barcode($value);
	                  		$insert_barcode[$i]['barcode'] = $value;
	                  		$insert_barcode[$i]['barcode_img'] = $barcode;
                  		} 
		                $inserdata[$i]['product_title'] = $product_title[$key];
		                $inserdata[$i]['barcode'] = $value;
		                $inserdata[$i]['category_id'] = 0;
		                $inserdata[$i]['purchase_price'] = $purchase_price[$key];
		                $inserdata[$i]['product_mrp'] = $product_mrp[$key];
		                $inserdata[$i]['retail_price'] = $retail_price[$key];
		                $inserdata[$i]['wholesale_price'] = $wholesale_price[$key];
		                $inserdata[$i]['opening_quantity'] = $opening_quantity[$key];
		                $inserdata[$i]['minimum_stock'] = $minimum_stock[$key];
		                $inserdata[$i]['barcode_status'] = $barcode_status[$key];
		                $inserdata[$i]['tax_rate'] = $tax_rate[$key];
		                $inserdata[$i]['usersId'] = $user['warehouseId'];
		                $inserdata[$i]['warehouseId'] = $user['warehouseId'];
		                $inserdata[$i]['user_type'] = 'warehouse'; 
		                $inserdata[$i]['date'] = $date;
		                $inserdata[$i]['import_excel'] = '0'; 
                  	// } 	
                  	$i++;
 			}

 			$tempArr = array_unique(array_column($inserdata, 'barcode'));
			$inserdata_new = array_intersect_key($inserdata, $tempArr);

			$tempArr_new = array_unique(array_column($insert_barcode, 'barcode'));
			$insert_barcode_new = array_intersect_key($insert_barcode, $tempArr_new);

		    if (count($inserdata_new) > 0) { 
       			// $data = array('status'=>'0','products'=>$inserdata);
       			$data = $this->ProductModel->importProduct($inserdata,$insert_barcode);
            }else{
            	$data = array('status'=>'2','msg'=>'already exist all this data.');
            } 
           echo json_encode($data);
	}
}