<?php
/**
 * Created Date 9/30/2020 
 * Created By Yash
 */
class StoreModel extends CI_Model
{
	function insertStore()
	{
		$storeData = array(
			'storeName'=>$this->input->post('storename'),
			'PhoneNumber'=>$this->input->post('phonenumber'),
			'gstinNumber'=>$this->input->post('gstinumber'),
			'userName'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password')),
			'openingBalance'=>$this->input->post('openingBalance'),
			'gst_type'=>$this->input->post('gst_type'),
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			'storeStaus'=>'1'
			 
		);
		if ($this->db->insert('storedetails',$storeData)) {
			 $storeLogData = array(
			 	'storeId'=>$this->db->insert_id(),
				'storeName'=>$this->input->post('storename'),
				'PhoneNumber'=>$this->input->post('phonenumber'),
				'gstinNumber'=>$this->input->post('gstinumber'),
				'userName'=>$this->input->post('username'),
				'password'=>md5($this->input->post('password')),
				'openingBalance'=>$this->input->post('openingBalance'),
				'gst_type'=>$this->input->post('gst_type'),
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'storeStaus'=>'1' 
			); 
			$this->db->insert('store_log_details',$storeLogData);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}	

	function updateStore($id)
	{
		$this->db->where('storeId',$id);
		$storeData = array(
			'storeName'=>$this->input->post('storename'),
			'PhoneNumber'=>$this->input->post('phonenumber'),
			'gstinNumber'=>$this->input->post('gstinumber'),
			'userName'=>$this->input->post('username'),
			// 'password'=>md5($this->input->post('password')),
			'openingBalance'=>$this->input->post('openingBalance'),
			'gst_type'=>$this->input->post('gst_type'),
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			 
		);
		
		if ($this->db->update('storedetails',$storeData)) {
			 $storeLogData = array(
			 	'storeId'=>$id,
				'storeName'=>$this->input->post('storename'),
				'PhoneNumber'=>$this->input->post('phonenumber'),
				'gstinNumber'=>$this->input->post('gstinumber'),
				'userName'=>$this->input->post('username'),
				// 'password'=>md5($this->input->post('password')),
				'openingBalance'=>$this->input->post('openingBalance'),
				'gst_type'=>$this->input->post('gst_type'),
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				 
			);
			$this->db->insert('store_log_details',$storeLogData);
			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Updation Failed.');
		}
	}	


	function storeView($id=''){
		if ($id !='') {
			$this->db->where('storeId',$id);
		}else{
			$this->db->order_by('storeId','DESC');
		}
		$r=$this->db->get('storedetails');
		if ($id !='') {
			return $r->row_array();
		}else{ 
		return $r->result_array();
		}

	}

	function updateStoreStatus($id){
		$this->db->where('storeId',$id);
		$userdata = array(
			'storeStaus'=>$this->input->post('store_status'),
		);
		 
		if ($this->db->update('storedetails',$userdata)) {
			return array('status'=>'1','message'=>'Successfully updated status.');
		}else{
			return array('status'=>'0','message'=>'status Failed update.');
		}	
	}


	function total_purchase_order(){
		// $user = $this->session->userdata('logged_in_store'); 
		$storeId = $this->input->post('storeId'); 
		$store = '';
		if ($storeId !='all') {
			$store = " AND purchased_by=".$storeId;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store' ".$store;
	    }else{
	    	if ($storeId != 'all') {
	    		$where = " where purchased_by=".$storeId;
	    	}
	    }
		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order '.$where)->row_array(); 
		return $count;
	}

	function average_purchase_order(){
						// $user = $this->session->userdata('logged_in_store'); 
		$storeId = $this->input->post('storeId');  
		$store = '';
		if ($storeId !='all') {
			$store = " AND purchased_by=".$storeId;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store' ".$store;
	    }else{
	    	if ($storeId != 'all') {
	    		$where = " where purchased_by=".$storeId;
	    	}
	    }

		$count = $this->db->query('SELECT AVG(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order '.$where)->row_array(); 
		return $count;
	}

	function total_purchase_order_return(){
						// $user = $this->session->userdata('logged_in_store'); 
		$storeId = $this->input->post('storeId'); 
		$store = '';
		if ($storeId !='all') {
			$store = " AND purchased_by=".$storeId;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store'  ".$store;
	    }else{
	    	if ($storeId != 'all') {
	    		$where = " where purchased_by=".$storeId;
	    	}
	    }

		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order_return '.$where)->row_array(); 
		return $count;
	}

	function total_sales_order(){
		// $user = $this->session->userdata('logged_in_store'); 
				// $user = $this->session->userdata('logged_in_store'); 
		$storeId = $this->input->post('storeId'); 
		$store = '';
		if ($storeId !='all') {
			$store = " AND purchased_by=".$storeId;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store' ".$store;
	    }else{
	    	if ($storeId != 'all') {
	    		$where = " where purchased_by=".$storeId;
	    	}
	    }

		$count = $this->db->query('SELECT SUM(total) AS total_sales, COUNT(*) AS totalSalesOrder FROM store_sales_order'.$where)->row_array(); 
		return $count;
	}

	function average_sales_order(){
		// $user = $this->session->userdata('logged_in_store'); 
				// $user = $this->session->userdata('logged_in_store'); 
		$storeId = $this->input->post('storeId'); 
		$store = '';
		if ($storeId !='all') {
			$store = " AND purchased_by=".$storeId;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store' ".$store;
	    }else{
	    	if ($storeId != 'all') {
	    		$where = " where purchased_by=".$storeId;
	    	}

	    }

		$count = $this->db->query('SELECT AVG(total) AS total_sales FROM store_sales_order'.$where)->row_array(); 
		return $count;
	}

	/**/


	function product_sales_report(){
		$storeId = $this->input->post('storeId'); 
		$store = '';
		if ($storeId !='all') {
			$store = " AND purchased_by=".$storeId;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store' ".$store;
	    }else{
	    	if ($storeId != 'all') {
	    		$where = " where purchased_by=".$storeId;
	    	}

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
	$storeId = $this->input->post('storeId'); 
	$store = '';
	if ($storeId !='all') {
		$store = " AND purchased_by=".$storeId;
	}

	$where ='';
	if ($this->input->post('duration') == 'today') {
	  $where=" where date(created_date) = CURDATE()  AND role='store' ".$store;
	}else if($this->input->post('duration') == 'this_week'){
	  $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()  AND role='store' ".$store;
	}else if($this->input->post('duration') == 'this_month'){
	  $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE()  AND role='store' ".$store;
	}else if($this->input->post('duration') == 'three_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 3 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'six_month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 6 MONTH AND CURDATE()  AND role='store' ".$store;
	    }else if($this->input->post('duration') == 'this_year'){
	  $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE()  AND role='store' ".$store;
	}else if($this->input->post('duration') == 'between'){
	  $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."'  AND role='store' ".$store;
	}else{
		if ($storeId != 'all') {
			$where = " where purchased_by=".$storeId;
		}

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