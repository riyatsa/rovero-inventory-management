<?php

/**
 * 
 */
class StoreBillingModel extends CI_Model
{


function __construct()
{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	// $this->load->model('smsModal');
}

function generate_bill(){
	$code = '';
	for($i = 0; $i < 12; $i++) { $code .= mt_rand(0, 9); }
	return $code;
}
 
 function edit_store_sales_billing(){  
 	$result = $this->db->where('sales_id',$this->input->post('sales_id'))->get('store_sales_order')->row_array();

 	$product_id = explode(',', $this->input->post('product_id'));
 	$quantity = explode(',', $result['quntity']);
 	$qty = explode(',', $this->input->post('total_qty'));
 	foreach (explode(',', $result['product_id']) as $key => $val) {
 		if (in_array($val, $product_id)) {
 			foreach ($product_id as $p => $value) {
 				if ($val == $value) {
 					if ($qty[$p] != $quantity[$key]) {
 						
 						if ($qty[$p] > $quantity[$key]) {
 							$actual_qty = $qty[$p] - $quantity[$key];
 							$this->db->query("UPDATE `store_products` SET `quantity` = quantity-".$actual_qty." WHERE `store_products`.`store_product_id` =" .$val);
 						}else if($qty[$p] < $quantity[$key]){
 							$actual_qty =$quantity[$key] - $qty[$p];
 							$this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$actual_qty." WHERE `store_products`.`store_product_id` =" .$val);
 						}

 				}
 			}
 			}
 		}else{
 			$this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$quantity[$key]." WHERE `store_products`.`store_product_id` =" .$val);
 		}
 	}
		
		$user = $this->session->userdata('logged_in_store_user');
		// print_r($user);
		 $storeId = $user['soreId'];
		// exit();
		$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');
 
$point_less = $this->input->post('point') -$this->input->post('point_less');
		 

		$order_data = array(
			'storeId' =>$storeId, 
			'bill_date' =>$this->input->post('bill_date'),
			// 'sales_type'=>$this->input->post('sales_type'),
			'state_of_supply' =>$this->input->post('bill_state'),
			// 'applied_coupon_type' => $this->input->post('applied_coupon_type'),
			// 'coupon_code' => $this->input->post('coupon_code'),
			'order_discounted_percentage' => $this->input->post('order_discounted_percentage'),
			'order_discounted_price'=>$this->input->post('order_discounted_price'), 
			'customer_name' =>$this->input->post('customer_name'),
			'customer_mobile_number' =>$this->input->post('contact_no'),
			'customer_address' =>$this->input->post('customer_address'),
			'customer_city' =>$this->input->post('customer_city'),
			'customer_state' =>$this->input->post('bill_state'),
			'customer_pincode' =>$this->input->post('customer_pincode'), 
			'product_id'=>$this->input->post('product_id'),
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('total_qty'),
			// 'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'mrp_price' =>$this->input->post('mrp_price'),
			// 'discount_persent' =>$this->input->post('discount'),
			// 'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>$this->input->post('gst_price'),
			'amount' =>$this->input->post('sub_amount'),
			'total' =>$this->input->post('main_total_amount'),
			'paid' =>$this->input->post('paid_price'),
			'balance' =>$balance,
			'purchased_by'=>$storeId,
			'role'=>$user['role'],
			'order_status'=>2,
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'), 
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->where('sales_id',$this->input->post('sales_id'));
		if ($this->db->update('store_sales_order',$order_data)) {

				$order_data_log = array(
					'sales_id'=>$this->input->post('sales_id'),
					'storeId' =>$storeId,
					'bill_number' =>$result['bill_number'],
					'bill_date' =>$this->input->post('bill_date'),
					'state_of_supply' =>$this->input->post('bill_state'),
					/*new*/
					'customer_name' =>$this->input->post('customer_name'),
					'customer_mobile_number' =>$this->input->post('contact_no'),
					'customer_address' =>$this->input->post('customer_address'),
					'customer_city' =>$this->input->post('customer_city'),
					'customer_state' =>$this->input->post('bill_state'),
					'customer_pincode' =>$this->input->post('customer_pincode'), 
					'use_referral_code'=>$this->input->post('referral_code'),
					'point'=>$point_less, 
					'sales_type'=>$this->input->post('sales_type'),
					'product_id'=>$this->input->post('product_id'),
					'product' =>$this->input->post('item_name'),
					'quntity' =>$this->input->post('total_qty'),
					'unit_id' =>$this->input->post('select_unit'),
					'price' =>$this->input->post('price'),
					'mrp_price' =>$this->input->post('mrp_price'),
					'discount_persent' =>$this->input->post('discount'),
					'discount_price' =>$this->input->post('discount_price'),
					'tax_persent' =>$this->input->post('main_gst'),
					'tax_price' =>$this->input->post('gst_price'),
					'amount' =>$this->input->post('sub_amount'),
					'total' =>$this->input->post('main_total_amount'),
					'paid' =>$this->input->post('paid_price'),
					'balance' =>$balance,
					'purchased_by'=>$storeId,
					'role'=>$user['role'],
					'payment_type' =>$this->input->post('payment_type'),
					'decription' =>$this->input->post('order_description'),
					'created_date' =>date('Y-m-d H:i:s'),
					'updated_date' =>date('Y-m-d H:i:s'),
				);	
				$this->db->insert('store_sales_order_log',$order_data_log);
			return array('status'=>'1','message'=>'Successfully Inserted.');	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}

 }
	
	function insert_order(){ 
		// $token = $this->smsModel->get_sms_token();
		$user = $this->session->userdata('logged_in_store_user');
		// print_r($user);
		 $storeId = $user['soreId'];
		// exit();
		$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');

		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$bill_number = $this->generate_bill(); 
		$check_duplicate = $this->db->where('bill_number',$bill_number)->get('store_sales_order')->num_rows();
		if ($check_duplicate > 0) {
			return array('status'=>'2','msg'=>'duplication');
		}

		/*

		echo $subtotal_total = ((int)$this->input->post('main_total_amount') * (int)$data['threshold']['percent']) / 100;
		echo "<br>".$this->input->post('main_total_amount');
		echo "<br>".$data['threshold']['percent'];
		exit();*/


		// `quantity` = quantity+".$product_qty[$key]."
		$point_less = $this->input->post('point') -$this->input->post('point_less');
		if ($this->input->post('point') !='0' && $this->input->post('point') !='') {
			// $this->db->where('',$this->input->post('contact_no'));

		$this->db->query('UPDATE `store_customer` SET `balance` = balance-'.$point_less.' WHERE `store_customer`.`mobile_number` ='.$this->input->post('contact_no'));
		}
		if ($this->input->post('referral_code') !='0' && $this->input->post('referral_code') !='') {
			$where = "mobile_number !=".$this->input->post('contact_no')." AND ( refral_code = ".$this->input->post('referral_code')." OR mobile_number =".$this->input->post('referral_code').")";
			$subtotal_total = ((int)$this->input->post('main_total_amount') * (int)$data['threshold']['percent']) / 100;
			$num = $this->db->query('SELECT mobile_number FROM store_customer WHERE `store_customer`.`refral_code` ="'.$this->input->post('referral_code').'"');
			$this->db->query("UPDATE `store_customer` SET `balance` = `balance`+".$subtotal_total." WHERE ".$where);
			$this->db->query("UPDATE `store_customer` SET `reffered_by` = ".$this->input->post('referral_code')." WHERE mobile_number =".$this->input->post('contact_no'));
			// $sms_message = "Test Referal code message.";
			 // $this->SmsModal->send_sms($num['mobile_number'],$sms_message,$token);
		}
 
		/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `customer_name`, `customer_mobile_number`, `customer_address`, `customer_city`, `customer_state`, `customer_pincode`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_sales_order` WHERE 1*/

		/* message body */
		// $sms_message = "THank You for the purchasing this order.";
		// $this->SmsModal->send_sms($this->input->post('contact_no'),$sms_message,$token);
		/*end massage body */

		$order_data = array(
			'storeId' =>$storeId,
			'bill_number' =>$bill_number,
			'bill_date' =>$this->input->post('bill_date'),
			'sales_type'=>$this->input->post('sales_type'),
			'state_of_supply' =>$this->input->post('bill_state'),
			'applied_coupon_type' => $this->input->post('applied_coupon_type'),
			'coupon_code' => $this->input->post('coupon_code'),
			'order_discounted_percentage' => $this->input->post('order_discounted_percentage'),
			'order_discounted_price'=>$this->input->post('order_discounted_price'),
			/*new*/
			'customer_name' =>$this->input->post('customer_name'),
			'customer_mobile_number' =>$this->input->post('contact_no'),
			'customer_address' =>$this->input->post('customer_address'),
			'customer_city' =>$this->input->post('customer_city'),
			'customer_state' =>$this->input->post('bill_state'),
			'customer_pincode' =>$this->input->post('customer_pincode'),
			/**/
			'use_referral_code'=>$this->input->post('referral_code'),
			'point'=>$point_less,
			/**/
			'product_id'=>$this->input->post('product_id'),
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('total_qty'),
			'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'mrp_price' =>$this->input->post('mrp_price'),
			'discount_persent' =>$this->input->post('discount'),
			'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>$this->input->post('gst_price'),
			'amount' =>$this->input->post('sub_amount'),
			'total' =>$this->input->post('main_total_amount'),
			'paid' =>$this->input->post('paid_price'),
			'balance' =>$balance,
			'purchased_by'=>$storeId,
			'role'=>$user['role'],
			'order_status'=>$this->input->post('status'),
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->db->insert('store_sales_order',$order_data)) {
			$sales_id = $this->db->insert_id();
				$order_data_log = array(
					'sales_id'=>$sales_id,
					'storeId' =>$storeId,
					'bill_number' =>$bill_number,
					'bill_date' =>$this->input->post('bill_date'),
					'state_of_supply' =>$this->input->post('bill_state'),
					/*new*/
					'customer_name' =>$this->input->post('customer_name'),
					'customer_mobile_number' =>$this->input->post('contact_no'),
					'customer_address' =>$this->input->post('customer_address'),
					'customer_city' =>$this->input->post('customer_city'),
					'customer_state' =>$this->input->post('bill_state'),
					'customer_pincode' =>$this->input->post('customer_pincode'),
					/**/
								/**/
			'use_referral_code'=>$this->input->post('referral_code'),
			'point'=>$point_less,
			/**/
			'sales_type'=>$this->input->post('sales_type'),
					'product_id'=>$this->input->post('product_id'),
					'product' =>$this->input->post('item_name'),
					'quntity' =>$this->input->post('total_qty'),
					'unit_id' =>$this->input->post('select_unit'),
					'price' =>$this->input->post('price'),
					'mrp_price' =>$this->input->post('mrp_price'),
					'discount_persent' =>$this->input->post('discount'),
					'discount_price' =>$this->input->post('discount_price'),
					'tax_persent' =>$this->input->post('main_gst'),
					'tax_price' =>$this->input->post('gst_price'),
					'amount' =>$this->input->post('sub_amount'),
					'total' =>$this->input->post('main_total_amount'),
					'paid' =>$this->input->post('paid_price'),
					'balance' =>$balance,
					'purchased_by'=>$storeId,
					'role'=>$user['role'],
					'order_status'=>$this->input->post('status'),
					'payment_type' =>$this->input->post('payment_type'),
					'decription' =>$this->input->post('order_description'),
					'created_date' =>date('Y-m-d H:i:s'),
					'updated_date' =>date('Y-m-d H:i:s'),
				);	


				if ($balance > 0) {

					$customer_credit = array(
						'customer_mobile'=>$this->input->post('contact_no'),
						'customer_name'=>$this->input->post('customer_name'),
						'credit_balance'=>$balance,
						'bill_number'=>$bill_number,
						'storeId'=>$storeId,
						'role'=>'store',
					); 
					$this->db->insert('customer_credits',$customer_credit);

				}

			$product_qty = explode(',', $this->input->post('total_qty'));
			$product_quentity = array();
			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
					// $product = $this->db->where('product_id',$value)->get('store_products');
					// if ($product->num_rows() > 0) { 
					$this->db->query("UPDATE `store_products` SET `quantity` = quantity-".$product_qty[$key]." WHERE `store_products`.`store_product_id` =" .$value." AND storeId=".$storeId);
					/*}else{ 
						$result = $product->row_array();
						$add_product = array(
							'storeId'=>$storeId,
							'product_id' => $result['product_id'],
							'product_title' => $result['product_title'],
							'unit_id' => $result['unit_id'],
							'barcode' => $result['barcode'],
							'sale_price' => $result['sale_price'],
							'sale_tax_type' => $result['sale_tax_type'],
							'purchase_price' => $result['purchase_price'],
							'purchase_tax_type' => $result['purchase_tax_type'],
							'tax_rate' => $result['tax_rate'],
							'discount_in_percent' => 0,
							'discount_in_price' => 0,
							'quantity' =>$product_qty[$key],
							'opening_quantity' => $result['opening_quantity'],
							'at_price' => $result['at_price'],
							'date' => $result['date'],
							'minimum_stock' => $result['minimum_stock'],
							'warehouseId' => $result['warehouseId'],
							'main_stock_value' => $result['main_stock_value'],
							'created_date' => date('Y-m-d H:i:s'),
							'updated_date' => date('Y-m-d H:i:s'),
						);
						// echo "";
						$this->db->insert('store_products',$add_product);
					}*/
				}
			}
			$custStatus = '';
			if ($this->input->post('contact_no') !=null && $this->input->post('contact_no') !='') {
				if($this->input->post('isCustomerNew') != 'yes'){
				$user = $this->session->userdata('logged_in_store_user');
	 
				$storeData = array(
					'name'=>$this->input->post('customer_name'),
					'mobile_number'=>$this->input->post('contact_no'),
					'refral_code'=>$this->input->post('refralCode'),
					'store_id'=>$user['soreId'],
					'address'=>$this->input->post('address'),
					'city'=>$this->input->post('customer_city'),
					'state'=>$this->input->post('bill_state'),
					'pincode'=>$this->input->post('customer_pincode'),
					'customer_status'=>'1'
					 
				);

				if ($this->db->insert('store_customer',$storeData)) {
					$storeLogData = array(
						'customer_id'=>$this->db->insert_id(),
						'name'=>$this->input->post('customer_name'),
						'mobile_number'=>$this->input->post('contact_no'),
						'refral_code'=>$this->input->post('refralCode'),
						'store_id'=>$user['soreId'],
						'address'=>$this->input->post('address'),
						'city'=>$this->input->post('customer_city'),
						'state'=>$this->input->post('bill_state'),
						'pincode'=>$this->input->post('customer_pincode'),
						'customer_status'=>'1'
					);

					$this->db->insert('store_customer_log',$storeLogData);
					$custStatus = 'Customer Inserted';
				}else{
					$custStatus = 'Customer Failed';
				}

			}else{
				$custStatus = 'Old Customer';
			}
			}

			$this->db->insert('store_sales_order_log',$order_data_log);
			return array('status'=>'1','message'=>'Successfully Inserted.','customer_Status'=>$custStatus,'sales_id'=>$sales_id);	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.','customer_Status'=>$custStatus);
		}
	}

	function get_current_store_sales_order_data($id){
		 
		$user = $this->session->userdata('logged_in_store_user');
		if($id == ''){ 
			// storeId 
			$where = array('storeId'=>$user['soreId'],'role'=>$user['role']);
			$result = $this->db->where($where)
					->order_by('sales_id','DESC')
					->get('store_sales_order')
					->result_array();
			return $result;
		}else{  
			$result = $this->db->where('storeId',$user['soreId'])
					->where('sales_id',$id)
					->order_by('sales_id','DESC')
					->get('store_sales_order')
					->result_array();  
			// $productIds = explode(",", $result[0]['product_id']);
			// $productData = [];
			// array_push($productData, $result);
			// foreach ($productIds as $key => $prId) { 
			// 		if ($prId !='' && $prId !='0') {  
			// 			$productDetail= $this->db->where('store_product_id',$prId)
			// 							->get('store_products')
			// 							->result_array(); 
			// 			array_push($productData, $productDetail);
			// 		}
			// } 
				$data = $this->db->where('mobile_number',$result[0]['customer_mobile_number'])
					->get('store_customer')
					->row_array(); 

			$customerDetail = array(
				'mobile_number' => isset($data['mobile_number'])?$data['mobile_number']:'Unregistered',
				'name' => isset($data['name'])?$data['name']:'Unregistered',
				'refral_code' => isset($data['refral_code'])?$data['refral_code']:'-',
			);
			 
			// array_push($productData, array($customerDetail));
			return array("productData"=>$result,"customerDetail"=>$customerDetail);
		}

	}

	function get_current_hold_bill($id=''){

		$user = $this->session->userdata('logged_in_store_user');
		if($id == ''){ 
			// storeId 
			$where = array('storeId'=>$user['soreId'],'role'=>$user['role']);
			$result = $this->db->where($where)
					->order_by('sales_id','DESC')
					->where('order_status',3)
					->get('store_sales_order')
					->result_array();
			return $result;
		}else{ 
			$result = $this->db->where('storeId',$user['storeId'])
					->where('sales_id',$id)
					->order_by('sales_id','DESC')
					->where('order_status',3)
					->get('store_sales_order')
					->result_array();  
			// $productIds = explode(",", $result[0]['product_id']);
			// $productData = [];
			// array_push($productData, $result);
			// foreach ($productIds as $key => $prId) { 
			// 		if ($prId !='' && $prId !='0') {  
			// 			$productDetail= $this->db->where('store_product_id',$prId)
			// 							->get('store_products')
			// 							->result_array(); 
			// 			array_push($productData, $productDetail);
			// 		}
			// } 
			$data = $this->db->where('mobile_number',$result[0]['customer_mobile_number'])
					->get('store_customer')
					->row_array(); 

			$customerDetail = array(
				'mobile_number' => isset($data['mobile_number'])?$data['mobile_number']:'Unregistered',
				'name' => isset($data['name'])?$data['name']:'Unregistered',
				'refral_code' => isset($data['refral_code'])?$data['refral_code']:'-',
			);
			 
			// array_push($productData, array($customerDetail));
			return array("productData"=>$result,"customerDetail"=>$customerDetail);
		}
	}
 	
 	function change_store_bill_order_status($id){
 		$user = $this->session->userdata('logged_in_store_user');
 		$storeId = $user['soreId'];
		$where = array('sales_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('store_sales_order') 
				->limit(1)
				->order_by('sales_id','DESC')
				->get()
				->row_array();

				$userdata = array(
					'order_status'=>'0',
				);
 
				$product_id = explode(',', $result['product_id']); 
				$product_qty = explode(',', $result['quntity']);  


				$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();

		 
				if ($result['use_referral_code'] !='0' && $result['use_referral_code'] !='') {
					$where = " refral_code = ".$result['use_referral_code'];
					$subtotal_total = ((int)$result['order_discounted_price'] * (int)$data['threshold']['percent']) / 100; 
					$this->db->query("UPDATE `store_customer` SET `balance` = `balance`-".$subtotal_total." WHERE ".$where); 
				}

				foreach ($product_id as $key => $prId) { 
					if ($prId !='' && $prId !='0') {  
						 
						$this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `store_products`.`store_product_id` =" .$prId);
					}
				}

			$this->db->where('sales_id',$id);
			if ($this->db->update('store_sales_order',$userdata)) { 
			return array('status'=>'1','message'=>'Successfully Cancel.');		
			}else{
			return array('status'=>'0','message'=>'Cancel Failed.');	
			} 

	}

	
	function get_single_sales_bill($id){ 
			  $result = $this->db->where('sales_id',$id)
								->order_by('sales_id','DESC')
								->get('store_sales_order')
								->row_array(); 

				return $result; 
	}


}