<?php

/**
 * 
 */
class StoreOrderModel extends CI_Model
{
	
	
	function insert_order(){ 
		$user = $this->session->userdata('logged_in_store_user');
		// print_r($user);
		 $storeId = $user['soreId'];
		// exit();
$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');

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
			'role'=>$user['role'],
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'notification'=>'1',
			'approve_reject'=>'2',
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->db->insert('store_purchase_order',$order_data)) {
					$order_data_log = array(
						'purchase_id'=>$this->db->insert_id(),
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
						'role'=>$user['role'],
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
							'sale_price' => $result['sale_price'],
							'sale_tax_type' => $result['sale_tax_type'],
							'purchase_price' => $result['purchase_price'],
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

						// return $add_product;
						// echo "";
						$this->db->insert('store_products',$add_product);
					}
				}
			}


				$this->db->insert('store_purchase_order_log',$order_data_log);

			return array('status'=>'1','message'=>'Successfully Inserted.');	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}

	function get_order_store_order_list(){
		$result = $this->db->select("*")
					->from('store_purchase_order')
					->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order.wareshouse_id','left')
					->order_by('purchase_id','DESC')
					->get()
					->result_array();
		return $result;
	}
}