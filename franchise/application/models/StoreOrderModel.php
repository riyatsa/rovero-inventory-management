<?php

/**
 * 
 */
class StoreOrderModel extends CI_Model
{


function generate_bill(){
	$code = '';
	for($i = 0; $i < 12; $i++) { $code .= mt_rand(0, 9); }
	return $code;
}

function warehouse_accepted_order_reject($id){
			$order_data = array(  
			'outlet_approve_reject'=>0,
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->where('sales_id',$id);
		if ($this->db->update('warehouse_sales_order',$order_data)) {
			$get_sales_data = $this->db->where('sales_id',$id)->get('warehouse_sales_order')->row_array();
		$order_data_log = array(
			'sales_id' =>$get_sales_data['sales_id'],
			'storeId' =>$get_sales_data['storeId'],
			'bill_number' =>$get_sales_data['bill_number'],
			'bill_date' =>$get_sales_data['bill_date'],
			'invoice_type'=>$get_sales_data['invoice_type'],
			'state_of_supply' =>$get_sales_data['state_of_supply'],
			'product_id'=>$get_sales_data['product_id'],
			'product' =>$get_sales_data['product'],
			'quntity' =>$get_sales_data['quntity'],
			'unit_id' =>$get_sales_data['unit_id'],
			'price' =>$get_sales_data['price'],
			'discount_persent' =>$get_sales_data['discount_persent'],
			'discount_price' =>$get_sales_data['discount_price'],
			'tax_persent' =>$get_sales_data['tax_persent'],
			'tax_price' =>$get_sales_data['tax_price'],
			'amount' =>$get_sales_data['amount'],
			'total' =>$get_sales_data['total'],
			'paid' =>$get_sales_data['paid'],
			'balance' =>$get_sales_data['balance'],
			'purchased_by'=>$get_sales_data['purchased_by'],
			'role'=>$get_sales_data['role'],
			'payment_type' =>$get_sales_data['payment_type'],
			'decription' =>$get_sales_data['decription'],
			'received_qty'=>$this->input->post('received_qty'),
			'outlet_approve_reject'=>0,
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->insert('warehouse_sales_order_log',$order_data_log);
			return array('status'=>'1','message'=>'Successfully update.');	
		}else{
			return array('status'=>'0','message'=>'update Failed.');
		}
}

function accept_warehouse_approvel_product(){

$user = $this->session->userdata('logged_in_store'); 
		$order_data = array( 
			'missing_broken_status'=>$this->input->post('missing_broken_type'),
			'received_qty'=>$this->input->post('received_qty'),
			'outlet_approve_reject'=>1,
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->where('sales_id',$this->input->post('sales_id'));
		if ($this->db->update('warehouse_sales_order',$order_data)) { 
		$get_sales_data = $this->db->where('sales_id',$this->input->post('sales_id'))->get('warehouse_sales_order')->row_array();
			$flag = 0;
			$product_qty = explode(',', $this->input->post('received_qty'));
			$qty = explode(',', $get_sales_data['quntity']);
			$product_quentity = array();
			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
					if ($qty[$key] != $product_qty[$key]) {
						$this->db->query("UPDATE `warehouse_sales_order` SET `qty_status` =1 WHERE `warehouse_sales_order`.`sales_id` =" .$this->input->post('sales_id'));
					}
				$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity-".$product_qty[$key]." WHERE `warehouse_products`.`product_id` =" .$value);
				$this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `store_products`.`product_id` =" .$value." AND storeId = ".$user['storeId']);
				}
			}
		$order_data_log = array(
			'sales_id' =>$get_sales_data['sales_id'],
			'storeId' =>$get_sales_data['storeId'],
			'bill_number' =>$get_sales_data['bill_number'],
			'bill_date' =>$get_sales_data['bill_date'],
			'invoice_type'=>$get_sales_data['invoice_type'],
			'state_of_supply' =>$get_sales_data['state_of_supply'],
			'product_id'=>$get_sales_data['product_id'],
			'product' =>$get_sales_data['product'],
			'quntity' =>$get_sales_data['quntity'],
			'unit_id' =>$get_sales_data['unit_id'],
			'price' =>$get_sales_data['price'],
			'discount_persent' =>$get_sales_data['discount_persent'],
			'discount_price' =>$get_sales_data['discount_price'],
			'tax_persent' =>$get_sales_data['tax_persent'],
			'tax_price' =>$get_sales_data['tax_price'],
			'amount' =>$get_sales_data['amount'],
			'total' =>$get_sales_data['total'],
			'paid' =>$get_sales_data['paid'],
			'balance' =>$get_sales_data['balance'],
			'purchased_by'=>$get_sales_data['purchased_by'],
			'role'=>$get_sales_data['role'],
			'payment_type' =>$get_sales_data['payment_type'],
			'decription' =>$get_sales_data['decription'],
			'received_qty'=>$this->input->post('received_qty'),
			'outlet_approve_reject'=>1,
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		$this->db->insert('warehouse_sales_order_log',$order_data_log);
			return array('status'=>'1','message'=>'Successfully update.');	
		}else{
			return array('status'=>'0','message'=>'update Failed.');
		}
}


function update_sales_order_bill($id){
		$user = $this->session->userdata('logged_in_store');


		$result = $this->db->where('purchase_id',$this->input->post('purchase_id'))->get('store_purchase_order')->row_array();

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
 							$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity-".$actual_qty." WHERE `warehouse_products`.`product_id` =" .$val);
 						}else if($qty[$p] < $quantity[$key]){
 							$actual_qty =$quantity[$key] - $qty[$p];
 							$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity+".$actual_qty." WHERE `warehouse_products`.`product_id` =" .$val);
 						}

 					}
 				}
 			}
 			
 		}else{
 			$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity+".$quantity[$key]." WHERE `warehouse_products`.`product_id` =" .$val);
 		}
 	}

		// print_r($user);
		 $storeId = $user['storeId'];
		// exit();
$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');

		$order_data = array(
			// 'wareshouse_id' =>$this->input->post('party_id'),
			// 'bill_number' =>time(),
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
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'notification'=>'1',
			'approve_reject'=>'3', 
			'updated_date' =>date('Y-m-d H:i:s'),
		);
		$this->db->where('purchase_id',$this->input->post('purchase_id'));
		if ($this->db->update('store_purchase_order',$order_data)) {
			$order_data_log = array(
						'purchase_id'=>$this->input->post('purchase_id'),
						'wareshouse_id' =>$this->input->post('party_id'),
						'bill_number' =>0,
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
						'purchased_by'=>$storeId,
						'role'=>'store',
						'payment_type' =>$this->input->post('payment_type'),
						'decription' =>$this->input->post('order_description'),
						'notification'=>'1',
						'approve_reject'=>'3',
						'created_date' =>date('Y-m-d H:i:s'),
						'updated_date' =>date('Y-m-d H:i:s'),
					);
					$this->db->insert('store_purchase_order_log',$order_data_log);
		
			return array('status'=>'1','message'=>'Successfully Updated.');	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}

	
}

	
	
	function insert_order(){ 
		$user = $this->session->userdata('logged_in_store');
		// print_r($user);
		 $storeId = $user['storeId'];
		// exit();
$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');

		$bill_number = $this->generate_bill(); 
		$check_duplicate = $this->db->where('bill_number',$bill_number)->get('store_purchase_order')->num_rows();
		if ($check_duplicate > 0) {
			return array('status'=>'2','msg'=>'duplication');
		}


		$order_data = array(
			'wareshouse_id' =>$this->input->post('party_id'),
			'bill_number' =>time(),
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
			'purchased_by'=>$storeId,
			'role'=>'store',
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'notification'=>'1',
			'approve_reject'=>'2',
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->db->insert('store_purchase_order',$order_data)) {
			$insert_id = $this->db->insert_id();
					$order_data_log = array(
						'purchase_id'=>$insert_id,
						'wareshouse_id' =>$this->input->post('party_id'),
						'bill_number' =>time(),
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
						'purchased_by'=>$storeId,
						'role'=>'store',
						'payment_type' =>$this->input->post('payment_type'),
						'decription' =>$this->input->post('order_description'),
						'notification'=>'1',
						'approve_reject'=>'2',
						'created_date' =>date('Y-m-d H:i:s'),
						'updated_date' =>date('Y-m-d H:i:s'),
					);	
		
			$product_qty = explode(',', $this->input->post('total_qty'));
			$product_quentity = array();
			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
					$product = $this->db->where('product_id',$value)->where('storeId',$storeId)->get('store_products');
					if ($product->num_rows() > 0) { 
					// $this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `store_products`.`product_id` =" .$value." AND storeId=".$storeId);
					}else{ 
						$product1 = $this->db->where('product_id',$value)->get('warehouse_products');
						$result = $product1->row_array();
						$add_product = array(
							'storeId'=>$storeId,
							'product_id' => $result['product_id'],
							'product_title' => $result['product_title'],
							'unit_id' => $result['unit_id'],
							'barcode' => $result['barcode'],
							'sale_price' => $result['retail_price'],
							'sale_tax_type' => $result['sale_tax_type'],
							'purchase_price' => $result['purchase_price'],
							'wholesale_price'=>$result['wholesale_price'],
							'mrp_price'=>$result['product_mrp'],
							'purchase_tax_type' => $result['purchase_tax_type'],
							'tax_rate' => $result['tax_rate'],
							'discount_in_percent' => 0,
							'discount_in_price' => 0,
							'quantity' =>0,
							'opening_quantity' => $result['opening_quantity'],
							'at_price' => $result['at_price'],
							'date' => $result['date'],
							'minimum_stock' => $result['minimum_stock'],
							'warehouseId' => $result['warehouseId'],
							'main_stock_value' => $result['main_stock_value'],
							'created_date' => date('Y-m-d H:i:s'),
							'updated_date' => date('Y-m-d H:i:s'),
						);
 
						$this->db->insert('store_products',$add_product);
					}
				}
			}


				$this->db->insert('store_purchase_order_log',$order_data_log);

			return array('status'=>'1','message'=>'Successfully Inserted.','insert_id'=>$insert_id);	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}

	function get_order_store_order_list(){
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId'];
		$result = $this->db->select("*")
					->where('purchased_by',$storeId)
					->from('store_purchase_order')
					->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order.wareshouse_id','left')
					->order_by('purchase_id','DESC')
					->get()
					->result_array();
		return $result;
	}
}