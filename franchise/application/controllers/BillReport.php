<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class BillReport extends CI_Controller {
	
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
		$data['customer'] = $this->db->get('store_customer')->result_array();
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar'); 
		$this->load->view('store/report/new-get-report',$data);
		$this->load->view('store-common/store-footer');

	}



	function daily_sale_report(){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 
		$customer='';
		if ($this->input->post('customer') !='all' && $this->input->post('customer') !='') {
			$customer = " AND customer_mobile_number=".$this->input->post('customer');
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else{
	    	$where=" where purchased_by = ".$storeId." AND role='store'".$customer;
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
			$result = $this->db->query('SELECT * FROM store_sales_order '.$where.' AND order_status=1')->result_array();
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
							$row['bill_number'] = $value['bill_number'];
							$row['bill_date'] = $value['bill_date'];
							$row['customer_name'] = ($value['customer_name']!='')?$value['customer_name']:'-';
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
	        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Bill Number');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Bill Date'); 
	        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Customer Name');               
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
	            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $val['bill_number']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $val['bill_date']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $val['customer_name']);
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
			 
		$result = $this->db->query('SELECT * FROM store_purchase_order '.$where.' AND approve_reject=1')->result_array();
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
							$row['bill_number'] = $value['bill_number'];
							$row['bill_date'] = $value['bill_date'];
							
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
	        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Bill Number');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Bill Date');        
	        
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
	            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $val['bill_number']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $val['bill_date']);
	            
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
			 
		$result = $this->db->query('SELECT * FROM store_purchase_order_return '.$where.' AND approve_reject=1')->result_array();
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
							$row['bill_number'] = $value['bill_number'];
							$row['bill_date'] = $value['bill_date']; 
 							array_push($new_array, $row);

						}

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
	        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Bill Number');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Bill Date');        
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
	            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $val['bill_number']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $val['bill_date']);
	            $rowCount++;
	        } 
	 
	        $objWriter = new Xlsx($objPHPExcel);
	        $objWriter->save('uploads/report/'.$fileName);
	 		// download file
	        // header("Content-Type: application/vnd.ms-excel");
	        // redirect(base_url().'uploads/report/'.$fileName);  

			echo json_encode(array('filename' =>$fileName ,'path' =>base_url().'uploads/report/'.$fileName));

	}




}
