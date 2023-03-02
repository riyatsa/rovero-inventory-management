<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class StoreDashBoardModel extends CI_Model
{
	
	function total_purchase(){

		$user = $this->session->userdata('logged_in_store'); 
		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order WHERE purchased_by='.$user['storeId'])->row_array(); 
		return $count;
	}

	function total_sales(){
		$user = $this->session->userdata('logged_in_store'); 
		$count = $this->db->query('SELECT SUM(total) AS total_sales, COUNT(*) AS totalSalesOrder FROM store_sales_order WHERE order_status = 1 AND purchased_by='.$user['storeId'])->row_array(); 
		return $count;
	}

	function total_ptoduct(){
		$user = $this->session->userdata('logged_in_store'); 
		$count = $this->db->query('SELECT COUNT(*) AS totalProduct FROM store_products WHERE storeId='.$user['storeId'])->row_array(); 
		return $count;
	}

	function get_monthly_data(){
		$year = date('Y');
		$user = $this->session->userdata('logged_in_store');
		// $result = $this->db->query('select monthname(created_date) as MONTHNAME,count(product_id) as total FROM warehouse_products WHERE usersId='.$user['storeId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)');

		$purchase_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_purchase, monthname(created_date) AS month FROM store_purchase_order WHERE purchased_by='.$user['storeId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 

		$sales_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_sales, monthname(created_date) month FROM store_sales_order WHERE order_status = 1 AND purchased_by='.$user['storeId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 
		// $purchase_order_rs = round($purchase_order['total_purchase'],2);
		$analytics['purchase_order'] = $purchase_order;
		$analytics['sales_order'] = $sales_order;

		return $analytics;
		
	}

	function total_purchase_order(){
						$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else{
	    	$where = " where approve_reject = 1 AND purchased_by=".$user['storeId'];
	    }

		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order '.$where)->row_array(); 
		return $count;
	}

	function average_purchase_order(){
						$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else{
	    	$where = " where approve_reject = 1 AND purchased_by=".$user['storeId'];
	    }

		$count = $this->db->query('SELECT AVG(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order '.$where)->row_array(); 
		return $count;
	}
	function total_purchase_order_return(){
						$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND approve_reject = 1";
	    }else{
	    	$where = " where approve_reject = 1 AND purchased_by=".$user['storeId'];
	    }

		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order_return '.$where)->row_array(); 
		return $count;
	}

	function total_sales_order(){
		// $user = $this->session->userdata('logged_in_store'); 
				$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else{
	    	$where = " where order_status = 1 AND purchased_by=".$user['storeId'];
	    }

		$count = $this->db->query('SELECT SUM(total) AS total_sales, COUNT(*) AS totalSalesOrder FROM store_sales_order'.$where)->row_array(); 
		return $count;
	}

	function average_sales_order(){
		// $user = $this->session->userdata('logged_in_store'); 
				$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else{
	    	$where = " where order_status = 1 AND purchased_by=".$user['storeId'];
	    }

		$count = $this->db->query('SELECT AVG(total) AS total_sales FROM store_sales_order'.$where)->row_array(); 
		return $count;
	}

	/**/


	function product_sales_report(){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
			// $user = $this->session->userdata('logged_in_store'); 
				$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else{
	    	$where = " where order_status = 1 AND purchased_by=".$user['storeId'];
	    }
			 
		$result = $this->db->query('SELECT * FROM store_sales_order '.$where)->result_array(); 


			$new_array = array();
			$product_price = array();
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
		            $groups[$key]['product_amount'] = (int)$groups[$key]['product_qty'] * (float)$groups[$key]['product_price']; 
		        }
		    } 
		    // echo json_encode($groups);
		    $sum = array();
		    $sum_qty = array();
		    foreach ($groups as $key => $value) { 

		    	if ($this->input->post('product_id')!='all') {
		    		 if ($value['product_id']==$this->input->post('product_id')) { 
			    		array_push($sum, round($value['product_amount'],2));
			    		array_push($sum_qty, round($value['product_qty']));
			    	}
		    	}else{
		    		array_push($sum, round($value['product_amount'],2));
		    		array_push($sum_qty, round($value['product_qty']));
		    	}

		    }

		return array('total'=>round(array_sum($sum),2),'qty'=>array_sum($sum_qty)); 
	 
}


 function get_top_selling_items(){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
			// $user = $this->session->userdata('logged_in_store'); 
				$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store' AND order_status = 1";
	    }else{
	    	$where = " where order_status = 1 AND purchased_by=".$user['storeId'];
	    }
			 
		$result = $this->db->query('SELECT * FROM store_sales_order '.$where)->result_array(); 


			$new_array = array();
			$product_price = array();
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
		            $groups[$key]['product_amount'] = (int)$groups[$key]['product_qty'] * (float)$groups[$key]['product_price']; 
		        }
		    } 
	    
	$keys = array_column($groups, 'product_amount');

    array_multisort($keys, SORT_DESC, $groups);

    // echo json_encode($new);
    return $groups;

 }




}