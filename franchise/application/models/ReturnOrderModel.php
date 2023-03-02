<?php
/**
 * 
 */
class ReturnOrderModel extends CI_Model
{
	
	function get_return_order_list(){ 
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId'];
		$result = $this->db->select("*")
					->where('purchased_by',$storeId)
					->from('store_purchase_order_return')
					->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order_return.wareshouse_id','left')
					->order_by('purchase_id','DESC')
					->get()
					->result_array();
		return $result;
	
	}


	
	function insert_return_order(){ 
		$user = $this->session->userdata('logged_in_store');
		// print_r($user);
		 $storeId = $user['storeId'];
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
			'role'=>'store',
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'notification'=>'1',
			'approve_reject'=>'2',
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	
		if ($this->db->insert('store_purchase_order_return',$order_data)) {
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
		

				$this->db->insert('store_purchase_order_return_log',$order_data_log);

			return array('status'=>'1','message'=>'Successfully Inserted.','purchase_id'=>$insert_id);	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}


	function get_return_order($id){

		/*SELECT `purchase_id`, `wareshouse_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_purchase_order` WHERE 1
		*/
		$user = $this->session->userdata('logged_in_store');
		// $storeId = $user['storeId'];
		$where = array('purchase_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('store_purchase_order_return')
				// ->join('unit_category','unit_category.unit_id = store_purchase_order.unit_id','left')
				->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order_return.wareshouse_id','left')
				->limit(1)
				->order_by('product_id','DESC')
				->get()
				->row_array();

		// return $result;

		$bill_data = array();
		$warehouseName = $result['warehouseName'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['bill_date'];
		$phoneNumber = $result['PhoneNumber'];
		$paid = $result['paid'];
		$balance = $result['balance'];
		// $bill_data['bill_number'] = $new_array;
		$storename = $user['storeName'];

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
				$unit =''; //$this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				$row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = $product_qty[$key];
				$row['product_price'] = $product_price[$key]; 
				$row['product_amount'] = $product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = isset($tax_persent[$key])?$tax_persent[$key]:0;
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
		return array('warehouseName'=>$warehouseName, 'bill_number'=>$bill_number,'phoneNumber'=>$phoneNumber,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance,'storename'=>$storename); 
	
	}



}