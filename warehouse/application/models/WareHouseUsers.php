<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class WareHouseUsers extends CI_Model
{
	
	function get_warehouse_users($id=''){
		$wid = $this->session->userdata('logged_in_warehouse');
		if ($id !='') {
		$result  = $this->db->where('usersId',$id)
							->order_by('usersId','DESC')
							->get('warehouseusers')
							->row_array();		
		}else{
				$result  = $this->db->where('warehouseId',$wid['warehouseId'])
							->order_by('usersId','DESC')
							->get('warehouseusers')
							->result_array();			 
		}

		return $result;
	}

	function getSalesPurchase(){
		$year = date('Y');
		$user = $this->session->userdata('logged_in_warehouse');
	 
		$purchase_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_purchase, monthname(created_date) AS month FROM warehouse_purchase_order WHERE purchased_by='.$user['warehouseId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 

		$sales_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_sales, monthname(created_date) month FROM warehouse_sales_order WHERE purchased_by='.$user['warehouseId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 
		// $purchase_order_rs = round($purchase_order['total_purchase'],2);
		$analytics['purchase_order'] = $purchase_order;
		$analytics['sales_order'] = $sales_order;

		return $analytics;
		
	}

	function count_warehouse(){
		$user = $this->session->userdata('logged_in_warehouse');
		$count = $this->db->where('warehouseId',$user['warehouseId'])->get('warehousedetails')->num_rows();
		return $count;
	}

		function count_product(){
		$user = $this->session->userdata('logged_in_warehouse');
		$count = $this->db->where('warehouseId',$user['warehouseId'])->get('warehouse_products')->num_rows();
		return $count;
	}

	function insert_warehouse_user(){ 
		$user = $this->session->userdata('logged_in_warehouse');
		$userdata = array(
			'warehouseId' => $user['warehouseId'],
			'userName' => $this->input->post('userName'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'password' => MD5($this->input->post('password')),
		);
		if ($this->db->insert('warehouseusers',$userdata)) {
		$userdatalog = array(
			'usersId'=>$this->db->insert_id(),
			'warehouseId' => $user['warehouseId'],
			'userName' => $this->input->post('userName'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'password' => MD5($this->input->post('password')),
		);
		$this->db->insert('warehouseuserslog',$userdatalog);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed .');
		}
	}

		function update_warehouse_user($id){ 
				$this->db->where('usersId',$id);
			$user = $this->session->userdata('logged_in_warehouse');
			$userdata = array(
				'warehouseId' => $user['warehouseId'],
				'userName' => $this->input->post('userName'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'password' => MD5($this->input->post('password')),
			);
			if ($this->db->update('warehouseusers',$userdata)) {
			$userdatalog = array(
				'usersId'=>$id,
				'warehouseId' => $user['warehouseId'],
				'userName' => $this->input->post('userName'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'password' => MD5($this->input->post('password')),
			);
			$this->db->insert('warehouseuserslog',$userdatalog);
				return array('status'=>'1','message'=>'Successfully Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed .');
			}
	}

	function update_warehouse_users_status($id){
						$this->db->where('usersId',$id);
			$user = $this->session->userdata('logged_in_warehouse');
			$userdata = array(
				'users_status' =>$this->input->post('users_status'),
				'updatedDate' =>date('Y-m-d H:i:s')
			);
			$status = 1;
			if ($this->input->post('users_status') != 1) {
					$status = 2;
			}
			if ($this->db->update('warehouseusers',$userdata)) {
				$result = $this->db->where('usersId',$id)->get('warehouseusers')->row_array();
			$userdatalog = array(
				'usersId'=>$id,
				'warehouseId' => $user['warehouseId'],
				'userName' =>$result['userName'],
				'email' => $result['email'],
				'role' => $result['role'],
				'users_status'=>$status,
				'password' => MD5($result['password']),
			);
			$this->db->insert('warehouseuserslog',$userdatalog);
				return array('status'=>'1','message'=>'Successfully Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed .');
			}
	}

	function total_purchase(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$count = $this->db->query('SELECT SUM(total) AS total FROM warehouse_purchase_order WHERE purchased_by='.$user['warehouseId'])->row_array(); 
		return $count;
	}

	function total_sales(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$count = $this->db->query('SELECT SUM(total) AS total_sales FROM warehouse_sales_order WHERE purchased_by='.$user['warehouseId'])->row_array(); 
		return $count;
	}


	function total_purchase_order(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId'];  

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId;
	    }else{
	    	$where = " where purchased_by=".$warehouseId;
	    }

		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM warehouse_purchase_order '.$where)->row_array(); 
		return $count;
	}

	function average_purchase_order(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId'];   

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId;
	    }else{
	    	$where = " where purchased_by=".$warehouseId;
	    }

		$count = $this->db->query('SELECT AVG(total) AS total, COUNT(*) AS totalOrder FROM warehouse_purchase_order '.$where)->row_array(); 
		return $count;
	}
	function total_purchase_order_return(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId'];   

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND wareshouse_id = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND wareshouse_id = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND wareshouse_id = ".$warehouseId;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND wareshouse_id = ".$warehouseId;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND wareshouse_id = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND wareshouse_id = ".$warehouseId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND wareshouse_id = ".$warehouseId;
	    }else{
	    	$where = " where wareshouse_id=".$warehouseId;
	    }

		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order_return '.$where)->row_array(); 
		return $count;
	}

	function total_sales_order(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId'];   

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId;
	    }else{
	    	$where = " where purchased_by=".$warehouseId;
	    }

		$count = $this->db->query('SELECT SUM(total) AS total_sales, COUNT(*) AS totalSalesOrder FROM warehouse_sales_order'.$where)->row_array(); 
		return $count;
	}

	function average_sales_order(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId'];   

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId;
	    }else{
	    	$where = " where purchased_by=".$warehouseId;
	    }

		$count = $this->db->query('SELECT AVG(total) AS total_sales FROM warehouse_sales_order'.$where)->row_array(); 
		return $count;
	}

	/**/

	
	function product_sales_report(){
	 	if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
			// $user = $this->session->userdata('logged_in_store'); 
				$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId']; 


	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId;
	    }else{
	    	$where = " where purchased_by=".$warehouseId;
	    }

		$result = $this->db->query('SELECT * FROM warehouse_sales_order '.$where)->result_array(); 


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
							$warehouseproduct = $this->db->where('product_id',$prId)->select('barcode,product_mrp,retail_price,wholesale_price,purchase_price,tax_rate')->from('warehouse_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = $product_name[$key]; 
							$row['barcode'] = isset($warehouseproduct['barcode'])?$warehouseproduct['barcode']:'-';
							$row['product_mrp'] = isset($warehouseproduct['product_mrp'])?$warehouseproduct['product_mrp']:'-';
							$row['retail_price'] = isset($warehouseproduct['retail_price'])?$warehouseproduct['retail_price']:'-';
							$row['wholesale_price'] = isset($warehouseproduct['wholesale_price'])?$warehouseproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($warehouseproduct['purchase_price'])?$warehouseproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($warehouseproduct['tax_rate'])?$warehouseproduct['tax_rate']:'-';
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
	 		if(!$this->session->userdata('logged_in_warehouse')){
				echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
				exit();
			}
				// $user = $this->session->userdata('logged_in_store'); 
					$user = $this->session->userdata('logged_in_warehouse'); 
			$warehouseId = $user['warehouseId']; 


		    $where ='';
		    if ($this->input->post('duration') == 'today') {
		      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId;
		    }else if($this->input->post('duration') == 'this_week'){
		      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId;
		    }else if($this->input->post('duration') == 'this_month'){
		      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
		    }else if($this->input->post('duration') == 'three_month'){
		      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
		    }else if($this->input->post('duration') == 'six_month'){
		      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE() AND purchased_by = ".$warehouseId;
		    }else if($this->input->post('duration') == 'this_year'){
		      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId;
		    }else if($this->input->post('duration') == 'between'){
		      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId;
		    }else{
		    	$where = " where purchased_by=".$warehouseId;
		    }

			$result = $this->db->query('SELECT * FROM warehouse_sales_order '.$where)->result_array(); 


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
								$warehouseproduct = $this->db->where('product_id',$prId)->select('barcode,product_mrp,retail_price,wholesale_price,purchase_price,tax_rate')->from('warehouse_products')->get()->row_array();
								$row['product_id'] = $prId;
								$row['product_name'] = $product_name[$key]; 
								$row['barcode'] = isset($warehouseproduct['barcode'])?$warehouseproduct['barcode']:'-';
								$row['product_mrp'] = isset($warehouseproduct['product_mrp'])?$warehouseproduct['product_mrp']:'-';
								$row['retail_price'] = isset($warehouseproduct['retail_price'])?$warehouseproduct['retail_price']:'-';
								$row['wholesale_price'] = isset($warehouseproduct['wholesale_price'])?$warehouseproduct['wholesale_price']:'-';
								$row['purchase_price'] = isset($warehouseproduct['purchase_price'])?$warehouseproduct['purchase_price']:'-';
								$row['tax_rate'] = isset($warehouseproduct['tax_rate'])?$warehouseproduct['tax_rate']:'-';
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

		$keys = array_column($groups, 'product_amount');

	    array_multisort($keys, SORT_DESC, $groups);

	    // echo json_encode($new);
	    return $groups;

	 }





}