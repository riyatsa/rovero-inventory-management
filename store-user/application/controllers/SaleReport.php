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
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar'); 
		$this->load->view('store/report/get-report');
		$this->load->view('store-common/store-footer');

	}



	function daily_sale_report(){
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
	 	
		$user = $this->session->userdata('logged_in_store_user'); 
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
	    }
	    
	    if ($where !='') { 
	      $this->db->where($where);
	    } 
			 
			$result = $this->db->query('SELECT * FROM store_sales_order '.$where)->result_array();
			// var_dump($result);

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
							 
							$row['product_id'] = $prId;
							$row['product_name'] = $product_name[$key];
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
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($groups as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_amount']);
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
		if(!$this->session->userdata('logged_in_store_user')){
			echo array('status'=>'3','msg'=>'invalid user, please login.');	
			exit();
		}
	 	
		$user = $this->session->userdata('logged_in_store_user'); 
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
	    }
	    
	    if ($where !='') { 
	      $this->db->where($where);
	    } 
			 
		$result = $this->db->query('SELECT * FROM store_purchase_order '.$where)->result_array();
			// var_dump($result);

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
					$row['product_id'] = $prId;
					$row['product_name'] = $product_name[$key];
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
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Quantity');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Product Sell Price(Per Product)');       
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Total Amount');       
	        // set Row
	        $rowCount = 2;
	        $i =1;
	        foreach ($groups as $key => $val) 
	        {
	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i++);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val['product_id']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $val['product_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val['product_qty']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val['product_price']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val['product_amount']);
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