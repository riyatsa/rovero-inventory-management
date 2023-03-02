<?php 
/**
 * 
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Zend\Barcode\Barcode;
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
	if(!$this->session->userdata('logged_in_store')){
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
	// $this->load->view('store/product/add-product',$data);
	$this->load->view('store/product/add-product-new',$data);
	$this->load->view('store-common/store-footer');
	}

	function add_warehouse_product(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->ProductListModel->insert_warehouse_products();
		echo json_encode($data);
	}


	function bulk_add_product(){ 
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data['title']=""; 
	    $this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/product/product-bulk-upload');
		$this->load->view('store-common/store-footer');
	}

	function importExcel(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
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
                $user = $this->session->userdata('logged_in_store'); 
                
              if ($value['A'] !='' && $value['B'] !='') {
                  $data = $this->ProductListModel->check_duplicate_product_code_name($value['A'],$value['B'],$user['storeId']);
                  $product = $this->ProductListModel->get_product_id($value['B']);

                  $prod_id = isset($product['product_id'])?$product['product_id']:'';
                  $warehouse = isset($product['warehouseId'])?$product['warehouseId']:'';
                  	if ($data['status']!='1' && $prod_id !='' && $warehouse !=''){ 
                  		// $barcode = $this->generate_barcode($value['B']);
                  		// $insert_barcode[$i]['barcode'] = $value['B'];
                  		// $insert_barcode[$i]['barcode_img'] = $barcode;
		                $inserdata[$i]['product_id'] = $prod_id;
		                $inserdata[$i]['product_title'] = $value['A'];
		                $inserdata[$i]['barcode'] = $value['B'];
		                $inserdata[$i]['category_id'] = $value['C'];
		                $inserdata[$i]['purchase_price'] = preg_replace("/[^0-9\.,]/", "",$value['D']);
		                $inserdata[$i]['mrp_price'] = preg_replace("/[^0-9\.,]/", "",$value['E']);
		                $inserdata[$i]['sale_price'] = preg_replace("/[^0-9\.,]/", "",$value['F']);
		                $inserdata[$i]['wholesale_price'] = preg_replace("/[^0-9\.,]/", "",$value['G']);
		                $inserdata[$i]['quantity'] = preg_replace("/[^0-9\.,]/", "",$value['H']);
		                $inserdata[$i]['minimum_stock'] = $value['I'];
		                $inserdata[$i]['tax_rate'] = $value['J'];
		                $inserdata[$i]['storeId'] = $user['storeId'];
		                $inserdata[$i]['warehouseId'] = $warehouse;
		                // $inserdata[$i]['user_type'] = 'store'; 
		                $inserdata[$i]['date'] = $date;
		                $inserdata[$i]['import_excel'] = '0'; 
                  	} 
                  }
                
                  $i++;
                }  
                	// $tempArr = array_unique(array_column($inserdata, 'customer_email_id'));
					// $inserdata_new = array_intersect_key($inserdata, $tempArr);   

	                if (count($inserdata) > 0) {
	                     	 
	               		$data = $this->ProductListModel->importProduct($inserdata);
	                }else{
	                	$data = array('status'=>'0');
	                } 
    

                } else {
                    $data = array('status'=>'0');
                }
           echo json_encode($data);

	}


	function add_store_product(){
		$data = $this->ProductListModel->add_store_product();
		echo json_encode($data);
	}


	function update_product_details(){ 
		$result = $this->db->where('storeId',3)
							->select("store_products.product_id,store_products.store_product_id,warehouse_products.*")
							->from('store_products')
							->join('warehouse_products','store_products.product_id=warehouse_products.product_id','left')
							->get()
							->result_array();


		// return $product_id;
		// $user = $this->session->userdata('logged_in_store');

		// $result = $this->db->where_in('product_id',$product_id)->get('warehouse_products')->result_array();

		// return $result;
		$product_data = array();
		foreach ($result as $key => $value) {
			
			$row['store_product_id']=$value['store_product_id'];
			$row['product_id']=$value['product_id'];
			$row['category_id'] =$value['category_id'];
			$row['product_title'] =$value['product_title'];
			// $row['storeId']=$user['storeId'];
			$row['unit_id'] =$value['unit_id'];
			$row['barcode'] =$value['barcode'];
			$row['discount_in_percent']=0;
			$row['discount_in_price']=0;
			$row['sale_price'] =$value['retail_price'];
			$row['sale_tax_type'] =$value['sale_tax_type'];
			$row['purchase_price'] =$value['purchase_price'];
			$row['wholesale_price']=$value['wholesale_price'];
			$row['mrp_price']=$value['product_mrp'];
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			$row['tax_rate'] =$value['tax_rate'];
			$row['opening_quantity'] = $value['opening_quantity'];
			$row['date'] =date('Y-m-d');
			$row['minimum_stock'] =$value['minimum_stock'];
			$row['warehouseId']=$value['warehouseId']; 
		array_push($product_data, $row);
		}

		// echo json_encode($product_data);
		if ($this->db->update_batch('store_products',$product_data,'store_product_id')) {
			echo json_encode(array('status'=>'1','msg'=>'success'));
		}else{
			echo json_encode(array('status'=>'0','msg'=>'faliled'));
		}

	
	}

}