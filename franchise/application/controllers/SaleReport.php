<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class SaleReport extends CI_Controller {
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('customerModel');  
	}	

	function index(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar'); 
		$this->load->view('store/report/get-report');
		$this->load->view('store-common/store-footer');

	}



	function daily_sale_report(){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store'";
	    }else{
	    	$where=" where purchased_by = ".$storeId." AND role='store'";
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
			$result = $this->db->query('SELECT * FROM store_sales_order '.$where)->result_array();
			// var_dump($result);
			/*var_dump($result);
			exit();*/


			$new_array = array();
			foreach ($result as $key => $value) {
				$product_id = explode(',', $value['product_id']);
				$product_name = explode(',', $value['product']);
				$product_qty = explode(',', $value['quntity']);
				$product_price = explode(',', $value['price']);
				$amount = explode(',', $value['amount']);
						// $productId = array();
					foreach ($product_id as $key => $prId) { 
						if ($prId !='' && $prId !='0') { 
								$storeproduct = $this->db->where('store_product_id',$prId)->select('barcode,mrp_price,sale_price,wholesale_price,purchase_price,tax_rate')->from('store_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = isset($product_name[$key])?$product_name[$key]:'';
							$row['barcode'] = isset($storeproduct['barcode'])?$storeproduct['barcode']:'-';
							$row['product_mrp'] = isset($storeproduct['mrp_price'])?$storeproduct['mrp_price']:'-';
							$row['retail_price'] = isset($storeproduct['sale_price'])?$storeproduct['sale_price']:'-';
							$row['wholesale_price'] = isset($storeproduct['wholesale_price'])?$storeproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($storeproduct['purchase_price'])?$storeproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($storeproduct['tax_rate'])?$storeproduct['tax_rate']:'-';
							$row['product_qty'] = isset($product_qty[$key])?$product_qty[$key]:'';
							$row['product_price'] = isset($product_price[$key])?$product_price[$key]:'';
							$row['product_amount'] = $amount[$key];
							array_push($new_array, $row);

						}

					}

			} 




		    $groups = array(); 
		    foreach ($new_array as $item) {
		        $key = $item['product_id'];
		        if (!array_key_exists($key, $groups)) {

		            $groups[$key] = array(
		                'product_id' => $item['product_id'], 
		                'product_name' => $item['product_name'], 
		                'barcode' => $item['barcode'], 
		                'product_mrp' => $item['product_mrp'], 
		                'retail_price' => $item['retail_price'], 
		                'wholesale_price' => $item['wholesale_price'], 
		                'purchase_price' => $item['purchase_price'], 
		                'tax_rate' => $item['tax_rate'], 
		                'product_qty' => $item['product_qty'], 
		                'product_price' => $item['product_price'], 
		                'product_amount' => $item['product_amount'], 
		            ); 
		        } else {
		            $groups[$key]['product_qty'] = (int)$groups[$key]['product_qty'] + (int)$item['product_qty'];
		            $groups[$key]['product_price'] = $groups[$key]['product_price'];
		            // $groups[$key]['product_amount'] = $groups[$key]['product_amount'] + $item['product_amount']; 
		            $groups[$key]['product_amount'] = (int)$groups[$key]['product_qty'] * (int)$groups[$key]['product_price']; 
		        }
		    }  
	 
	 		// create file name
	        $fileName = 'sales-report-'.time().'.xlsx';  
	 		// load excel librarySr#	product ID 	Product Name 	quantity	product/price 	Total amount
	        // $this->load->library('excel');
	        // $subscriberdata = $this->customerModel->get_subscribe();subscribeList
	         // $subscriberdata = $this->export->subscribeList();
	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product ID ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Barcode');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Retail Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Wholesale Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purchase Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('j1', 'Tax Rate');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($groups as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['barcode']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_mrp']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['retail_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['wholesale_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['purchase_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['tax_rate']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['product_amount']);
	            $rowCount++;
	        }
	 
	        $objWriter = new Xlsx($objPHPExcel);
	         $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        // header("Content-Type: application/vnd.ms-excel");
	        //   redirect(base_url().'uploads/report/'.$fileName);

	        echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));  
	}


	function dailyPurchaseReport(){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 


	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store'";
	    }else{
	      $where=" where purchased_by = ".$storeId." AND role='store'";
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
		$result = $this->db->query('SELECT * FROM store_purchase_order '.$where)->result_array();
			// var_dump($result);
			// exit();

			$new_array = array();
			foreach ($result as $key => $value) {
				$product_id = explode(',', $value['product_id']);
				$product_name = explode(',', $value['product']);
				$product_qty = explode(',', $value['quntity']);
				$product_price = explode(',', $value['price']);
				$amount = explode(',', $value['amount']);
						// $productId = array();
					foreach ($product_id as $key => $prId) { 
						if ($prId !='' && $prId !='0') { 
							$storeproduct = $this->db->where('product_id',$prId)->select('barcode,product_mrp,retail_price,wholesale_price,purchase_price,tax_rate')->from('warehouse_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = $product_name[$key]; 
							$row['barcode'] = isset($storeproduct['barcode'])?$storeproduct['barcode']:'-';
							$row['product_mrp'] = isset($storeproduct['product_mrp'])?$storeproduct['product_mrp']:'-';
							$row['retail_price'] = isset($storeproduct['retail_price'])?$storeproduct['retail_price']:'-';
							$row['wholesale_price'] = isset($storeproduct['wholesale_price'])?$storeproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($storeproduct['purchase_price'])?$storeproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($storeproduct['tax_rate'])?$storeproduct['tax_rate']:'-';
							$row['product_qty'] = $product_qty[$key];

							$row['product_price'] = $product_price[$key];
							$row['product_amount'] = $amount[$key];
							array_push($new_array, $row);

						}

					}

			} 




		    $groups = array(); 
		    foreach ($new_array as $item) {
		        $key = $item['product_id'];
		        if (!array_key_exists($key, $groups)) {

		            $groups[$key] = array(
		                'product_id' => $item['product_id'], 
		                'product_name' => $item['product_name'], 
		                'barcode' => $item['barcode'], 
		                'product_mrp' => $item['product_mrp'], 
		                'retail_price' => $item['retail_price'], 
		                'wholesale_price' => $item['wholesale_price'], 
		                'purchase_price' => $item['purchase_price'], 
		                'tax_rate' => $item['tax_rate'], 
		                'product_qty' => $item['product_qty'], 
		                'product_price' => $item['product_price'], 
		                'product_amount' => $item['product_amount'], 
		            ); 
		        } else {
		            $groups[$key]['product_qty'] = $groups[$key]['product_qty'] + $item['product_qty'];
		            $groups[$key]['product_price'] = $groups[$key]['product_price'];
		            // $groups[$key]['product_amount'] = $groups[$key]['product_amount'] + $item['product_amount']; 
		            $groups[$key]['product_amount'] = $groups[$key]['product_qty'] * $groups[$key]['product_price']; 
		        }
		    }  
	 
	 		// create file name
	        $fileName = 'purchase-report-'.time().'.xlsx';  
	 		// load excel librarySr#	product ID 	Product Name 	quantity	product/price 	Total amount
	        // $this->load->library('excel');
	        // $subscriberdata = $this->customerModel->get_subscribe();subscribeList
	         // $subscriberdata = $this->export->subscribeList();
	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product ID ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Barcode');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Retail Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Wholesale Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purchase Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('j1', 'Tax Rate');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($groups as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['barcode']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_mrp']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['retail_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['wholesale_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['purchase_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['tax_rate']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['product_amount']);
	            $rowCount++;
	        } 
	 
	        $objWriter = new Xlsx($objPHPExcel);
	        $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        // header("Content-Type: application/vnd.ms-excel");
	        // redirect(base_url().'uploads/report/'.$fileName);  

			echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));

	}

	function daily_purchase_return_report(){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 


	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store'";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store'";
	    }else{
	      $where=" where purchased_by = ".$storeId." AND role='store'";
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
		$result = $this->db->query('SELECT * FROM store_purchase_order_return '.$where)->result_array();
			// var_dump($result);
			// exit();

			$new_array = array();
			foreach ($result as $key => $value) {
				$product_id = explode(',', $value['product_id']);
				$product_name = explode(',', $value['product']);
				$product_qty = explode(',', $value['quntity']);
				$product_price = explode(',', $value['price']);
				$amount = explode(',', $value['amount']);
						// $productId = array();
					foreach ($product_id as $key => $prId) { 
						if ($prId !='' && $prId !='0') { 
							$storeproduct = $this->db->where('product_id',$prId)->select('barcode,product_mrp,retail_price,wholesale_price,purchase_price,tax_rate')->from('warehouse_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = $product_name[$key]; 
							$row['barcode'] = isset($storeproduct['barcode'])?$storeproduct['barcode']:'-';
							$row['product_mrp'] = isset($storeproduct['product_mrp'])?$storeproduct['product_mrp']:'-';
							$row['retail_price'] = isset($storeproduct['retail_price'])?$storeproduct['retail_price']:'-';
							$row['wholesale_price'] = isset($storeproduct['wholesale_price'])?$storeproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($storeproduct['purchase_price'])?$storeproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($storeproduct['tax_rate'])?$storeproduct['tax_rate']:'-';
							$row['product_qty'] = $product_qty[$key];

							$row['product_price'] = $product_price[$key];
							$row['product_amount'] = $amount[$key];
							array_push($new_array, $row);

						}

					}

			} 




		    $groups = array(); 
		    foreach ($new_array as $item) {
		        $key = $item['product_id'];
		        if (!array_key_exists($key, $groups)) {

		            $groups[$key] = array(
		                'product_id' => $item['product_id'], 
		                'product_name' => $item['product_name'], 
		                'barcode' => $item['barcode'], 
		                'product_mrp' => $item['product_mrp'], 
		                'retail_price' => $item['retail_price'], 
		                'wholesale_price' => $item['wholesale_price'], 
		                'purchase_price' => $item['purchase_price'], 
		                'tax_rate' => $item['tax_rate'], 
		                'product_qty' => $item['product_qty'], 
		                'product_price' => $item['product_price'], 
		                'product_amount' => $item['product_amount'], 
		            ); 
		        } else {
		            $groups[$key]['product_qty'] = $groups[$key]['product_qty'] + $item['product_qty'];
		            $groups[$key]['product_price'] = $groups[$key]['product_price'];
		            // $groups[$key]['product_amount'] = $groups[$key]['product_amount'] + $item['product_amount']; 
		            $groups[$key]['product_amount'] = $groups[$key]['product_qty'] * $groups[$key]['product_price']; 
		        }
		    }  
	 
	 		// create file name
	        $fileName = 'purchase-return-report-'.time().'.xlsx';  
	 		// load excel librarySr#	product ID 	Product Name 	quantity	product/price 	Total amount
	        // $this->load->library('excel');
	        // $subscriberdata = $this->customerModel->get_subscribe();subscribeList
	         // $subscriberdata = $this->export->subscribeList();
	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product ID ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Barcode');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Retail Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Wholesale Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purchase Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('j1', 'Tax Rate');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($groups as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['barcode']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_mrp']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['retail_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['wholesale_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['purchase_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['tax_rate']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['product_amount']);
	            $rowCount++;
	        } 
	 
	        $objWriter = new Xlsx($objPHPExcel);
	        $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        // header("Content-Type: application/vnd.ms-excel");
	        // redirect(base_url().'uploads/report/'.$fileName);  

			echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));

	}


	function product_report(){
		if(!$this->session->userdata('logged_in_store')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
	 	
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND storeId = ".$storeId;
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND storeId = ".$storeId;
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND storeId = ".$storeId;
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND storeId = ".$storeId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND storeId = ".$storeId;
	    }else{
	      $where=" where storeId = ".$storeId;
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
		$result = $this->db->query('SELECT * FROM store_products '.$where)->result_array(); 
		
	 		// create file name
	        $fileName = 'product-report-'.time().'.xlsx';   

	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product ID ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Product Code');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Purchase Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Retail Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Minimum stock Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Tax Rate');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($result as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['store_product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_title']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['barcode']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['purchase_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['mrp_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['sale_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['quantity']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['minimum_stock']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['tax_rate']);
	            $rowCount++;
	        }
	 
	        $objWriter = new Xlsx($objPHPExcel);
	         $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        // header("Content-Type: application/vnd.ms-excel");
	        //   redirect(base_url().'uploads/report/'.$fileName);

	        echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));  
	}



function sale_report($sales_id){

	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	     
			 
			$result = $this->db->query('SELECT * FROM store_sales_order where sales_id='.$sales_id)->result_array();
		 

			$new_array = array();
			foreach ($result as $key => $value) {
				$product_id = explode(',', $value['product_id']);
				$product_name = explode(',', $value['product']);
				$product_qty = explode(',', $value['quntity']);
				$product_price = explode(',', $value['price']);
				$amount = explode(',', $value['amount']);
						// $productId = array();
					foreach ($product_id as $key => $prId) { 
						if ($prId !='' && $prId !='0') { 
								$storeproduct = $this->db->where('store_product_id',$prId)->select('barcode,mrp_price,sale_price,wholesale_price,purchase_price,tax_rate')->from('store_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = isset($product_name[$key])?$product_name[$key]:'';
							$row['barcode'] = isset($storeproduct['barcode'])?$storeproduct['barcode']:'-';
							$row['product_mrp'] = isset($storeproduct['mrp_price'])?$storeproduct['mrp_price']:'-';
							$row['retail_price'] = isset($storeproduct['sale_price'])?$storeproduct['sale_price']:'-';
							$row['wholesale_price'] = isset($storeproduct['wholesale_price'])?$storeproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($storeproduct['purchase_price'])?$storeproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($storeproduct['tax_rate'])?$storeproduct['tax_rate']:'-';
							$row['product_qty'] = isset($product_qty[$key])?$product_qty[$key]:'';
							$row['product_price'] = isset($product_price[$key])?$product_price[$key]:'';
							$row['product_amount'] = $amount[$key];
							array_push($new_array, $row);

						}

					}

			} 

 
	 
	 		// create file name
	        $fileName = 'sales-report-'.time().'.xlsx';  
	 		// load excel librarySr#	product ID 	Product Name 	quantity	product/price 	Total amount
	        // $this->load->library('excel');
	        // $subscriberdata = $this->customerModel->get_subscribe();subscribeList
	         // $subscriberdata = $this->export->subscribeList();
	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	         $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product ID ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Barcode');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Retail Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Wholesale Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purchase Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('j1', 'Tax Rate');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($new_array as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['barcode']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_mrp']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['retail_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['wholesale_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['purchase_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['tax_rate']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['product_amount']);
	            $rowCount++;
	        }
	 
	        $objWriter = new Xlsx($objPHPExcel);
	         $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        header("Content-Type: application/vnd.ms-excel");
	          redirect(base_url().'uploads/report/'.$fileName);

	        // echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));  
	}



	function purchaseReport($purchase_id){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 
  
		$result = $this->db->query('SELECT * FROM store_purchase_order where purchase_id='.$purchase_id)->result_array(); 

			$new_array = array();
			foreach ($result as $key => $value) {
				$product_id = explode(',', $value['product_id']);
				$product_name = explode(',', $value['product']);
				$product_qty = explode(',', $value['quntity']);
				$product_price = explode(',', $value['price']);
				$amount = explode(',', $value['amount']); 
					foreach ($product_id as $key => $prId) { 
						if ($prId !='' && $prId !='0') { 
							$storeproduct = $this->db->where('product_id',$prId)->select('barcode,product_mrp,retail_price,wholesale_price,purchase_price,tax_rate')->from('warehouse_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = $product_name[$key]; 
							$row['barcode'] = isset($storeproduct['barcode'])?$storeproduct['barcode']:'-';
							$row['product_mrp'] = isset($storeproduct['product_mrp'])?$storeproduct['product_mrp']:'-';
							$row['retail_price'] = isset($storeproduct['retail_price'])?$storeproduct['retail_price']:'-';
							$row['wholesale_price'] = isset($storeproduct['wholesale_price'])?$storeproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($storeproduct['purchase_price'])?$storeproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($storeproduct['tax_rate'])?$storeproduct['tax_rate']:'-';
							$row['product_qty'] = $product_qty[$key];

							$row['product_price'] = $product_price[$key];
							$row['product_amount'] = $amount[$key];
							array_push($new_array, $row);

						}

					}

			} 

 
	 		// create file name
	        $fileName = 'purchase-report-'.time().'.xlsx';  
	 		// load excel librarySr#	product ID 	Product Name 	quantity	product/price 	Total amount
	        // $this->load->library('excel');
	        // $subscriberdata = $this->customerModel->get_subscribe();subscribeList
	         // $subscriberdata = $this->export->subscribeList();
	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Product ID ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Product Name');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Barcode');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'MRP');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Retail Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Wholesale Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Purchase Price');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('j1', 'Tax Rate');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($new_array as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['barcode']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_mrp']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val['retail_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val['wholesale_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val['purchase_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val['tax_rate']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val['product_amount']);
	            $rowCount++;
	        } 
	 
	        $objWriter = new Xlsx($objPHPExcel);
	        $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        header("Content-Type: application/vnd.ms-excel");
	        redirect(base_url().'uploads/report/'.$fileName);  

			// echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));

	}



	function customer_contact_report(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}

		/*SELECT `customer_id`, `name`, `mobile_number`, `store_id`, `refral_code`, `reffered_by`, `address`, `city`, `state`, `pincode`, `discount`, `balance`, `customer_status`, `created_date`, `updated_date` FROM `store_customer` WHERE 1*/
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 
  
		$result = $this->db->query('SELECT * FROM store_customer')->result_array(); 

			  

 
	 		// create file name
	        $fileName = 'customer-contact-report-'.time().'.xlsx'; 
	        $objPHPExcel = new Spreadsheet();
	        
	        // set Header
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr.no.');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Customer Name ');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mobile Number');         
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($result as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['mobile_number']); 
	            $rowCount++;
	        } 
	 
	        $objWriter = new Xlsx($objPHPExcel);
	        $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        header("Content-Type: application/vnd.ms-excel");
	        // redirect(base_url().'uploads/report/'.$fileName);  

			echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));

	}




}
