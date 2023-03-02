<?php

/**
 * 
 */
class SalesOrderModel extends CI_Model
{
	
 function get_store_details(){
 	$result = $this->db->order_by('storeId','DESC')
 			->get('storedetails')
 			->result_array();
 	return $result;
 }
 function get_sales_order_details(){
 	$user = $this->session->userdata('logged_in_warehouse_user'); 
 	$where = array(	'purchased_by'=>$user['usersId'],'role'=>$user['role']);
 	$result = $this->db->order_by('','DESC')
		 				->select('*')
		 				->from('warehouse_sales_order')
		 				->join('storedetails','storedetails.storeId = warehouse_sales_order.storeId','left')
		 				->where($where)
		 				->get()
		 				->result_array();
	return $result;
 }



 	function get_sales_order_veiw($id){
 		$result = $this->db->order_by('','DESC')
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
$user = $this->session->userdata('logged_in_warehouse_user'); 
		$order_data = array(
			'storeId' =>$this->input->post('party_id'),
			'bill_number' =>time(),
			'invoice_type'=>$this->input->post('invoice_type'),
			'bill_date' =>$this->input->post('bill_date'),
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
			'purchased_by'=>$user['usersId'],
			'role'=>$user['role'],
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->db->insert('warehouse_sales_order',$order_data)) {
			$insert_id = $this->db->insert_id();
			$product_qty = explode(',', $this->input->post('total_qty'));
			$product_quentity = array();
			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
				$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity-".$product_qty[$key]." WHERE `warehouse_products`.`product_id` =" .$value);
				}
			}

		$order_data_log = array(
			'sales_id' =>$insert_id,
			'storeId' =>$this->input->post('party_id'),
			'bill_number' =>time(),
			'invoice_type'=>$this->input->post('invoice_type'),
			'bill_date' =>$this->input->post('bill_date'),
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
			'purchased_by'=>$user['usersId'],
			'role'=>$user['role'],
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->insert('warehouse_sales_order_log',$order_data_log);
 
			return array('status'=>'1','message'=>'Successfully Inserted.','insert_id'=>$insert_id );	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}



	function get_warehouse_sales_order($id){
/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `warehouse_sales_order` WHERE 1*/

/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `invoice_type`, `payment_type`, `payment_refrance`, `decription`, `received_qty`, `outlet_approve_reject`, `qty_status`, `missing_broken_status`, `warehouse_return_status`, `purchased_by`, `role`, `customer_name`, `mobile_number`, `customer_gst_number`, `notification`, `notification_1`, `created_date`, `updated_date`, `use_referral_code`, `point`, `applied_coupon_type`, `coupon_code`, `post_paid`, `order_discounted_percentage`, `order_discounted_price` FROM `warehouse_sales_order` WHERE 1*/
		$user = $this->session->userdata('logged_in_warehouse_user'); 
		// $storeId = $user['storeId'];
		$where = array('warehouse_sales_order.storeId'=>$id,'purchased_by'=>$user['usersId'],'role'=>$user['role']);
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
		$point = $result['point'];
		$order_discounted_percentage = $result['order_discounted_percentage'];
		$balance = $result['balance'];
		// $party_name = $result['vendor_name'];
		$storename = $result['storeName'];

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
				$row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key]; 
				$row['product_amount'] = (string)$product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = $tax_persent[$key];
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
		return array('party_name'=>$storename,'point'=$point, 'order_discounted_percentage'=$order_discounted_percentage, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance); 
	
	}



}