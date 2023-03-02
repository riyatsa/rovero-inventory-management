<?php

/**
 * 
 */
class SalesOrderModel extends CI_Model
{

	public function viewCustomer($id=''){  
		// $this->db->where('store_id',$user['storeId']);
		$user = $this->session->userdata('logged_in_warehouse');
 		$warehouseId = $user['warehouseId'];
		if ($id !='') {
			if(strlen($id) >= '10'){
				$this->db->where('mobile_number',(int)$id);
			
		 
			}else{
				$this->db->where('customer_id',$id);
			}
			 
		}else{
			$this->db->order_by('customer_id','DESC');
		}
		$this->db->select("*")
		->from('store_customer');
		// ->join('customer_credits','store_customer.mobile_number = customer_credits.customer_mobile','left');
		$r=$this->db->get();
		if ($id !='') {
				$result = $r->row_array();
			if (isset($result['customer_id'])) {
				 // return $result;
				$credit = array('customer_credits.credit_status'=>0/*,'customer_credits.role'=>'warehouse','customer_credits.storeId'=>$warehouseId*/,'customer_credits.customer_mobile'=>$id);
				$data = $this->db->where($credit)->select('SUM(customer_credits.credit_balance) AS credit_total')->from('customer_credits')->get()->row_array();
			return	$storeLogData = array(
			 	'customer_id'=>$result['customer_id'],
				'name'=>$result['name'],
				'credit_total'=>$data['credit_total'],
				'mobile_number'=>$result['mobile_number'],
				'store_id'=>$result['store_id'],
				'refral_code'=>$result['refral_code'],
				'reffered_by'=>$result['reffered_by'],
				'address'=>$result['address'],
				'city'=>$result['city'],
				'state'=>$result['state'],
				'pincode'=>$result['pincode'],
				'balance'=>$result['balance'],
				'customer_status'=>$result['customer_status'],
				 
			);
			}
			return null;
		}else{ 
		return $r->result_array();
		}

	}



	function get_credit_history($num){
		$user = $this->session->userdata('logged_in_warehouse');
 		$warehouseId = $user['warehouseId'];
		 $result = $this->db->where('customer_mobile',$num)//->where('storeId',$warehouseId)->where('role','warehouse')
								->order_by('credit_id','DESC')
								->get('customer_credits')
								->result_array(); 

				return $result; 
	}
 

	function re_update_sales_order($sales_id){ 
 
		$user = $this->session->userdata('logged_in_warehouse'); 
		$price = array();
		$gst_price = array();
		$received_qty = explode(',',$this->input->post('received_qty'));
		$gst = explode(',', $this->input->post('main_gst'));
		foreach (explode(',', $this->input->post('price')) as $key => $value) {
			// echo $value;
		 $total = (float)$value * (float)$received_qty[$key];
			$gst_total = ((float)$total * (float)$gst[$key]) / 100;
			array_push($price, round($total,2));
			array_push($gst_price, round($gst_total,2));
		}//gst_price = (price * main_gst) / 100; 
		$order_data = array(  
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('received_qty'),//$this->input->post('total_qty'),
			'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'discount_persent' =>$this->input->post('discount'),
			'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>implode(',', $gst_price),//$this->input->post('gst_price'),
			'amount' =>implode(',', $price) ,//$this->input->post('sub_amount'),
			'total' =>round(array_sum($price),2),//$this->input->post('main_total_amount'),
			'paid' =>round(array_sum($price),2),//$this->input->post('paid_price'),  
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'), 
			'missing_broken_status'=>$this->input->post('missing_broken_type'),
			'warehouse_return_status'=>1,
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		// return $order_data;
		$this->db->where('sales_id',$sales_id);
		if ($this->db->update('warehouse_sales_order',$order_data)) {
			return array('status'=>'1','message'=>'Successfully update.');
		}else{
			return array('status'=>'0','message'=>'update Failed.');
		}
	}
	
	function get_store_details(){
	 	$result = $this->db->order_by('storeId','DESC')
	 			->get('storedetails')
	 			->result_array();
	 	return $result;
	}

	function get_sales_order_details(){
	 	$result = $this->db->order_by('sales_id','DESC')
			 				->select('*')
			 				->from('warehouse_sales_order')
			 				->join('storedetails','storedetails.storeId = warehouse_sales_order.storeId','left')
			 				->get()
			 				->result_array();
		return $result;
	}
	function get_sales_order_details_approve(){
	 	$result = $this->db->order_by('sales_id','DESC')
	 						->where('qty_status!=',0)
			 				->select('*')
			 				->from('warehouse_sales_order')
			 				->join('storedetails','storedetails.storeId = warehouse_sales_order.storeId','left')
			 				->get()
			 				->result_array();
		return $result;
	}
 

 	function get_sales_order_veiw($id){
 		$result = $this->db->order_by('sales_id','DESC')
		 	->select('*')
		 	->from('warehouse_sales_order')
		 	->join('storedetails','storedetails.storeId = warehouse_sales_order.storeId','left')
		 	->where('sales_id',$id)
		 	->get()
		 	->result_array();
	return $result;
 	}

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
				 
			);
			$this->db->insert('store_log_details',$storeLogData);
			return array('status'=>'1','message'=>'Successfully insert.');
		}else{
			return array('status'=>'0','message'=>'insert Failed.');
		}
	}	



	
function insert_sales_order(){
 
$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');


// $balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');

		$data['threshold'] = $this->db->limit(1)->get('threshold')->row_array();

		 
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
$bill_number =time();
$user = $this->session->userdata('logged_in_warehouse'); 
		$order_data = array(
			'storeId' =>$this->input->post('party_id'),
			'bill_number' =>$bill_number,
			'bill_date' =>$this->input->post('bill_date'),
			'invoice_type'=>$this->input->post('invoice_type'),
			'state_of_supply' =>$this->input->post('bill_state'),
			'product_id'=>$this->input->post('product_id'),
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('total_qty'),
			'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'discount_persent' =>$this->input->post('discount'),
			'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>$this->input->post('gst_price'),
			'amount' =>$this->input->post('sub_amount'),
			'total' =>$this->input->post('main_total_amount'),
			'paid' =>$this->input->post('paid_price'),
			'balance' =>$balance,
			'purchased_by'=>$user['warehouseId'],
			'role'=>'warehouse',
			'customer_name'=>$this->input->post('customer_name'),
			'mobile_number'=>$this->input->post('contact_no'),
			'customer_gst_number'=>$this->input->post('gst_number'),
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			/**/
			'use_referral_code'=>$this->input->post('referral_code'),
			'applied_coupon_type' => $this->input->post('applied_coupon_type'),
			'coupon_code' => $this->input->post('coupon_code'),
			'order_discounted_percentage' => $this->input->post('order_discounted_percentage'),
			'order_discounted_price'=>$this->input->post('order_discounted_price'),
			/**/
			'point'=>$point_less,
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->input->post('contact_no') !='' && $this->input->post('contact_no') !=null ) {
		 $order_data['outlet_approve_reject'] = 1;

		 		if ($balance > 0) {

					$customer_credit = array(
						'customer_mobile'=>$this->input->post('contact_no'),
						'customer_name'=>$this->input->post('customer_name'),
						'credit_balance'=>$balance,
						'bill_number'=>$bill_number,
						'storeId'=>$user['warehouseId'],
						'role'=>'warehouse',
					); 
					$this->db->insert('customer_credits',$customer_credit);

				}
		}
		if ($this->db->insert('warehouse_sales_order',$order_data)) {
			$insert_id = $this->db->insert_id();
			$product_qty = explode(',', $this->input->post('total_qty'));
			$product_quentity = array();
			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
				$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity-".$product_qty[$key]." WHERE `warehouse_products`.`product_id` =" .$value);
				}
			}



			$custStatus = '';
 
			if ($this->input->post('contact_no') !=null && $this->input->post('contact_no') !='') {

				 $this->input->post('contact_no');
				if( $this->input->post('isCustomerNew') != 'yes'){  
				$storeData = array(
					'name'=>$this->input->post('customer_name'),
					'mobile_number'=>$this->input->post('contact_no'),
					'refral_code'=>$this->input->post('refralCode'),
					'store_id'=>'0',
					'address'=>$this->input->post('bill_state'),
					'city'=>'-',
					'state'=>$this->input->post('bill_state'),
					'pincode'=>'0',
					'customer_status'=>'1'
					 
				);
				if ($this->input->post('referral_code')) {
					$storeData['reffered_by']=$this->input->post('referral_code');
					// $storeData['balance']=$subtotal_total;
				}
 
				if ($this->db->insert('store_customer',$storeData)) {
					$storeLogData = array(
						'customer_id'=>$this->db->insert_id(),
						'name'=>$this->input->post('customer_name'),
						'mobile_number'=>$this->input->post('contact_no'),
						'refral_code'=>$this->input->post('refralCode'),
						'store_id'=>'0',
						'address'=>$this->input->post('bill_state'),
						'city'=>'-',
						'state'=>$this->input->post('bill_state'),
						'pincode'=>'0',
						'customer_status'=>'1'
					);
			/*	if ($this->input->post('referral_code')) {
					$storeLogData['reffered_by']=$this->input->post('referral_code');
					$storeLogData['balance']=$subtotal_total;
				}*/

					$this->db->insert('store_customer_log',$storeLogData);
					 $custStatus = 'Customer Inserted';
				}else{
					$custStatus = 'Customer Failed';
				}

			}else{
				$custStatus = 'Old Customer';
			}
			}

		$order_data_log = array(
			'sales_id' =>$insert_id,
			'storeId' =>$this->input->post('party_id'),
			'bill_number' =>$bill_number,
			'bill_date' =>$this->input->post('bill_date'),
			'invoice_type'=>$this->input->post('invoice_type'),
			'state_of_supply' =>$this->input->post('bill_state'),
			'product_id'=>$this->input->post('product_id'),
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('total_qty'),
			'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'discount_persent' =>$this->input->post('discount'),
			'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>$this->input->post('gst_price'),
			'amount' =>$this->input->post('sub_amount'),
			'total' =>$this->input->post('main_total_amount'),
			'paid' =>$this->input->post('paid_price'),
			'balance' =>$balance,
			'purchased_by'=>$user['warehouseId'],
			'role'=>'warehouse',
			'customer_name'=>$this->input->post('customer_name'),
			'mobile_number'=>$this->input->post('contact_no'),
			'customer_gst_number'=>$this->input->post('gst_number'),
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			/**/
			'use_referral_code'=>$this->input->post('referral_code'),
			'applied_coupon_type' => $this->input->post('applied_coupon_type'),
			'coupon_code' => $this->input->post('coupon_code'),
			'order_discounted_percentage' => $this->input->post('order_discounted_percentage'),
			'order_discounted_price'=>$this->input->post('order_discounted_price'),
			/**/
			'point'=>$point_less,
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->insert('warehouse_sales_order_log',$order_data_log);


 
			return array('status'=>'1','message'=>'Successfully Inserted.','insert_id'=>$insert_id);	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}




	function get_warehouse_sales_order($id){
/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `warehouse_sales_order` WHERE 1*/
		$user = $this->session->userdata('logged_in_warehouse'); 
		// $storeId = $user['storeId'];
		$where = array('warehouse_sales_order.sales_id'=>$id,'purchased_by'=>$user['warehouseId'],'role'=>'warehouse');
		$result = $this->db->where($where)
				->select('warehouse_sales_order.*,storedetails.*,store_customer.refral_code')
				->from('warehouse_sales_order')
		 		->join('storedetails','storedetails.storeId = warehouse_sales_order.storeId','left')
		 		->join('store_customer','store_customer.mobile_number = warehouse_sales_order.mobile_number','left')
				->limit(1)
				->order_by('sales_id','DESC')
				->get()
				->row_array();

		// return $result;

		$bill_data = array();
		// $warehouseName = $result['warehouseName'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['bill_date'];
		// $phoneNumber = $result['PhoneNumber'];
		$paid = $result['paid'];
		$point = $result['point'];
		$balance = $result['balance'];
		$referal = $result['refral_code'];
		// $party_name = $result['vendor_name'];
		if ($result['storeName'] !='' ) {
			$storename = $result['storeName'];
		}else{
			$storename = $result['customer_name'];
		}

		$product_id = explode(',', $result['product_id']);
		$product_name = explode(',', $result['product']);
		$product_qty = explode(',', $result['quntity']);
		$product_price = explode(',', $result['price']);
		$amount = explode(',', $result['amount']);
		$tax_persent = explode(',', $result['tax_persent']);
		$tax_price = explode(',', $result['tax_price']);
		$unit_id = explode(',', $result['unit_id']);
				// $productId = array();
		// return $amount;
		$total = 0;
		$qty = 0; 
		$amount_price = 0; 
		$tax_price_total =0;
		$tax_persent_total =0;
		$grand_total =0; 
		foreach ($product_id as $key => $prId) { 
			if ($prId !='' && $prId !='0') { 
				$row['product_id'] = $prId;
				$barcode = $this->db->query("SELECT barcode FROM warehouse_products WHERE product_id=".$prId)->row_array();
				$row['barcode'] = $barcode['barcode'];
				// $unit = $this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				// $row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['unit_name'] = '-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key]; 
				$row['product_amount'] = (string)$product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = isset($tax_persent[$key])?$tax_persent[$key]:'0';
				$row['tax_price'] = $tax_price[$key];
				$qty += $product_qty[$key];
				$total += $product_price[$key];
				$amount_price += $amount[$key];
				$grand_total += $product_qty[$key]*$product_price[$key];
				$tax_price_total += $tax_price[$key];
				$tax = 0;
				if (isset($tax_persent[$key])) {
					$tax = $tax_persent[$key];
				}
				$tax_persent_total += (float)$tax;
				array_push($bill_data, $row); 
			}
		}
		return array('point'=>$point,'referal'=>$referal,'order_discounted_percentage'=>$result['order_discounted_percentage'],'order_discounted_price'=>$result['order_discounted_price'],'party_name'=>$storename, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance); 
	
	}


	function get_warehouse_sales_order_bill($id){
/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `warehouse_sales_order` WHERE 1*/
		$user = $this->session->userdata('logged_in_warehouse'); 
		// $storeId = $user['storeId'];
		$where = array('warehouse_sales_order.sales_id'=>$id,'purchased_by'=>$user['warehouseId'],'role'=>'warehouse');
		$result = $this->db->where($where)
				->select('*')
				->from('warehouse_sales_order')
		 		->join('storedetails','storedetails.storeId = warehouse_sales_order.storeId','left')
				->limit(1)
				->order_by('sales_id','DESC')
				->get()
				->row_array();

		// return $result;

		$bill_data = array();
		// $warehouseName = $result['warehouseName'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['bill_date'];
		// $phoneNumber = $result['PhoneNumber'];
		$paid = $result['paid'];
		$balance = $result['balance'];
		// $party_name = $result['vendor_name'];
		if ($result['storeName'] !='' ) {
			$storename = $result['storeName'];
		}else{
			$storename = $result['customer_name'];
		}

		$product_id = explode(',', $result['product_id']);
		$product_name = explode(',', $result['product']);
		$product_qty = explode(',', $result['quntity']);
		$product_price = explode(',', $result['price']);
		$amount = explode(',', $result['amount']);
		$tax_persent = explode(',', $result['tax_persent']);
		$tax_price = explode(',', $result['tax_price']);
		$unit_id = explode(',', $result['unit_id']);
				// $productId = array();
		// return $amount;
		$total = 0;
		$qty = 0;
		$amount_price = 0; 
		$tax_price_total =0;
		$tax_persent_total =0;
		$grand_total =0;
		foreach ($product_id as $key => $prId) { 
			if ($prId !='' && $prId !='0') { 
				$row['product_id'] = $prId;
				$barcode = $this->db->query("SELECT barcode FROM warehouse_products WHERE product_id=".$prId)->row_array();
				$row['barcode'] = $barcode['barcode'];
				// $unit = $this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				// $row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['unit_name'] = '-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key]; 
				$row['product_amount'] = (string)$product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = isset($tax_persent[$key])?$tax_persent[$key]:'0';
				$row['tax_price'] = $tax_price[$key];
				$qty += $product_qty[$key];
				$total += $product_price[$key];
				$amount_price += $amount[$key];
				$grand_total += $product_qty[$key]*$product_price[$key];
				$tax_price_total += $tax_price[$key];
				$tax = 0;
				if (isset($tax_persent[$key])) {
					$tax = $tax_persent[$key];
				}
				$tax_persent_total += (float)$tax;
				array_push($bill_data, $row); 
			}
		}
		return array('party_name'=>$storename, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance); 
	
	}





	
function insert_sales_order_bill($id){

					$userdata = array(
					'approve_reject'=>1,
				);

	
$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');
$user = $this->session->userdata('logged_in_warehouse'); 
		$order_data = array(
			'storeId' =>$this->input->post('party_id'),
			'bill_number' =>time(),
			'bill_date' =>$this->input->post('bill_date'),
			'invoice_type'=>1,
			'state_of_supply' =>$this->input->post('bill_state'),
			'product_id'=>$this->input->post('product_id'),
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('total_qty'),
			'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'discount_persent' =>$this->input->post('discount'),
			'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>$this->input->post('gst_price'),
			'amount' =>$this->input->post('sub_amount'),
			'total' =>$this->input->post('main_total_amount'),
			'paid' =>$this->input->post('paid_price'),
			'balance' =>$balance,
			'purchased_by'=>$user['warehouseId'],
			'role'=>'warehouse',
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->db->insert('warehouse_sales_order',$order_data)) {
			$insert_id = $this->db->insert_id();

			$product_qty = explode(',', $this->input->post('total_qty'));
			$product_quentity = array();
/*			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
				$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity-".$product_qty[$key]." WHERE `warehouse_products`.`product_id` =" .$value);
				$this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `store_products`.`product_id` =" .$value." AND storeId = ".$this->input->post('party_id'));
				}
			}*/


		$order_data_log = array(
			'sales_id' =>$insert_id,
			'storeId' =>$this->input->post('party_id'),
			'bill_number' =>time(),
			'bill_date' =>$this->input->post('bill_date'),
			'invoice_type'=>1,
			'state_of_supply' =>$this->input->post('bill_state'),
			'product_id'=>$this->input->post('product_id'),
			'product' =>$this->input->post('item_name'),
			'quntity' =>$this->input->post('total_qty'),
			'unit_id' =>$this->input->post('select_unit'),
			'price' =>$this->input->post('price'),
			'discount_persent' =>$this->input->post('discount'),
			'discount_price' =>$this->input->post('discount_price'),
			'tax_persent' =>$this->input->post('main_gst'),
			'tax_price' =>$this->input->post('gst_price'),
			'amount' =>$this->input->post('sub_amount'),
			'total' =>$this->input->post('main_total_amount'),
			'paid' =>$this->input->post('paid_price'),
			'balance' =>$balance,
			'purchased_by'=>$user['warehouseId'],
			'role'=>'warehouse',
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->insert('warehouse_sales_order_log',$order_data_log);
 	$this->db->where('purchase_id',$id)->update('store_purchase_order',$userdata);
			return array('status'=>'1','message'=>'Successfully Inserted.','id'=>$insert_id);	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}


	
	function add_new_item_for_warehouse_billing(){
		return $this->db->where('product_id',$this->input->post('selected_item_product_id'))->get('warehouse_products')->row_array();
	}



	/*function get_credit_history($num){
		$user = $this->session->userdata('logged_in_warehouse');
 		$warehouseId = $user['warehouseId'];
		 $result = $this->db->where('customer_mobile',$num)->where('storeId',$warehouseId)->where('role','warehouse')
								->order_by('credit_id','DESC')
								->get('customer_credits')
								->result_array(); 

				return $result; 
	}*/

	function update_credited_bill($id){
		$update_bill = array(
			'post_paid'=>$this->input->post('pay_amount'),
		);
		$this->db->where('bill_number',$this->input->post('bill_number'));
		$result = '';
		if ($this->input->post('role') == 'store') {
			$result = $this->db->update('store_sales_order',$update_bill);
		}else{
			$result = $this->db->update('warehouse_sales_order',$update_bill);
		}
		if ($result) {
			$credits = $this->db->where('bill_number',$this->input->post('bill_number'))->get('customer_credits');
			if ($credits->num_rows() > 0) {
				 $credits_data = array(
				 	'paid_credit'=>$this->input->post('pay_amount'),
				 	'credit_status'=>1
				 );
				 $this->db->where('bill_number',$this->input->post('bill_number'))->update('customer_credits',$credits_data);
			}
			return array('status'=>'1','message'=>'Success.');		
		}else{
			return array('status'=>'0','message'=>'Failed.');	
		}
	}




		function get_current_store_sales_order_bill($id,$role){
		 
  
			 $this->db->where('bill_number',$id);
					$this->db->order_by('sales_id','DESC');
				if ($role == 'store') { 
				$result = $this->db->get('store_sales_order')->result_array();
			}else{
				$result = $this->db->get('warehouse_sales_order')->result_array();
			}
				 
				
				

			if ($role == 'store') { 
				$this->db->where('mobile_number',$result[0]['customer_mobile_number']);
			}else{
				$this->db->where('mobile_number',$result[0]['mobile_number']);
			}
					$data = $this->db->get('store_customer')
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