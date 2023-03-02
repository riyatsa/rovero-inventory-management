<?php
/**
 * 
 */
class OrderModel extends CI_Model
{
	
	function insert_order($attachments=''){
		/*SELECT `purchase_id`, `patry_id`, `bill_number`, `bill_date`, `state_of_supply`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `created_date`, `updated_date` FROM `warehouse_purchase_order` WHERE 1*/

 
$balance = $this->input->post('main_total_amount') - $this->input->post('paid_price');
		$user = $this->session->userdata('logged_in_warehouse'); 
		$order_data = array(
			'patry_id' =>$this->input->post('party_id'),
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
			'payment_type' =>$this->input->post('payment_type'),
			'decription' =>$this->input->post('order_description'),
			'purchased_by' => $user['warehouseId'],
			'role' => 'warehouse',
			'created_date' =>date('Y-m-d H:i:s'),
			'updated_date' =>date('Y-m-d H:i:s'),
		);	

		if ($attachments !='') {
			 $order_data['bill_attachment'] = implode(',', $attachments);
		}

		if ($this->db->insert('warehouse_purchase_order',$order_data)) {
			$insert_id = $this->db->insert_id();
			$product_qty = explode(',', $this->input->post('total_qty'));
			$product_quentity = array();
			foreach (explode(',', $this->input->post('product_id')) as $key => $value) {
				if ($value !=0) {  
				$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `warehouse_products`.`product_id` =" .$value);
				}
			}



			// $this->db->update_batch('warehouse_products',$product_quentity,'product_id');

			return array('status'=>'1','message'=>'Successfully Inserted.','insert_id'=>$insert_id);	
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}

	function getPurchseDetails($id=''){
		$user = $this->session->userdata('logged_in_warehouse'); 
		// echo $user['warehouseId'];
		if ($id !='') {
			$result = $this->db->select("*")
				->from('warehouse_purchase_order')
				->join('vendor_details','vendor_details.vendor_Id = warehouse_purchase_order.patry_id','left')
				->where('purchase_id',$id)
				->where('purchased_by',$user['warehouseId']) 
				->get()
				->row_array(); 
		}else{
			
		$result = $this->db->select("*")
				->from('warehouse_purchase_order')
				->join('vendor_details','vendor_details.vendor_Id = warehouse_purchase_order.patry_id','left') 
				->where('purchased_by',$user['warehouseId'])
				->order_by('purchase_id','DESC')
				->get()
				->result_array(); 
		}

		return $result;
	}

	function getPurchseDetailsView($id=''){
		$user = $this->session->userdata('logged_in_warehouse'); 
		// echo $user['warehouseId'];
		if ($id !='') {
			$result = $this->db->select("*")
				->from('warehouse_purchase_order')
				->join('vendor_details','vendor_details.vendor_Id = warehouse_purchase_order.patry_id','left')
				->where('purchase_id',$id)
				->where('purchased_by',$user['warehouseId']) 
				->get()
				->row_array(); 
		}else{
			
		$result = $this->db->select("*")
				->from('warehouse_purchase_order')
				->join('vendor_details','vendor_details.vendor_Id = warehouse_purchase_order.patry_id','left') 
				->where('purchased_by',$user['warehouseId'])
				->order_by('purchase_id','DESC')
				->get()
				->result_array(); 
		}

		return $result;
	}



	function get_warehouse_purchase_order($id){
 /*SELECT `purchase_id`, `patry_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `warehouse_purchase_order` WHERE 1*/
		$user = $this->session->userdata('logged_in_warehouse'); 
		// $storeId = $user['storeId'];
		$where = array('purchase_id'=>$id,'purchased_by'=>$user['warehouseId']);
		$result = $this->db->where($where)
				->select('*')
				->from('warehouse_purchase_order')  
				->join('vendor_details','vendor_details.vendor_Id = warehouse_purchase_order.patry_id','left') 
				->limit(1)
				->order_by('purchase_id','DESC')
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
		$party_name = $result['vendor_name'];
		// $storename = $user['storeName'];

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
				// return $unit_id[$key];
				// exit();
				// $unit_ids = isset($unit_id[$key])?$unit_id[$key]:'0';
				// $unit = $this->db->query("SELECT unit_name FROM unit_category WHERE unit_id = ".$unit_ids)->row_array();
				// $row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['unit_name'] = '-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key]; 
				$row['product_amount'] = (string)$product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = round(isset($tax_persent[$key])?$tax_persent[$key]:0,2);
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
		return array('party_name'=>$party_name, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance); 
	
	}
 
	function get_order_store_order_list(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$result = $this->db->select("*")
				->where('wareshouse_id',$user['warehouseId'])
				->from('store_purchase_order')
				->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order.wareshouse_id','left')
				->join('storedetails','storedetails.storeId = store_purchase_order.purchased_by','left')
				->order_by('purchase_id','DESC')
				->get()
				->result_array();
		return $result;
	}

	function get_return_store_order_list(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$result = $this->db->select("*")
				->where('wareshouse_id',$user['warehouseId'])
				->from('store_purchase_order_return')
				->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order_return.wareshouse_id','left')
				->join('storedetails','storedetails.storeId = store_purchase_order_return.purchased_by','left')
				->order_by('purchase_id','DESC')
				->get()
				->result_array();
		return $result;		
	}


	function get_store_purchase_order($id){

		/*SELECT `purchase_id`, `wareshouse_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_purchase_order` WHERE 1
		*/
		// $user = $this->session->userdata('logged_in_store');
		// $storeId = $user['storeId'];
		$where = array('purchase_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('store_purchase_order')
				// ->join('unit_category','unit_category.unit_id = store_purchase_order.unit_id','left')
				->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order.wareshouse_id','left')
				->limit(1)
				->order_by('product_id','DESC')
				->get()
				->row_array();

		// return $result;
		$this->db->where('storeId',$result['purchased_by']); 
		$this->db->select('storeName');
		$this->db->from('storedetails');
		$storeName=$this->db->get(); 
		$storeName= $storeName->row_array();

		$bill_data = array();
		$warehouseName = $result['warehouseName'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['bill_date'];
		$phoneNumber = $result['PhoneNumber'];
		$paid = $result['paid'];
		$balance = $result['balance'];
		$approve_reject_status = $result['approve_reject'];
		// $bill_data['bill_number'] = $new_array;
		$storename = $storeName;

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
		return array('warehouseName'=>$warehouseName, 'bill_number'=>$bill_number,'phoneNumber'=>$phoneNumber,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance,'storename'=>$storename,'approve_reject_status'=>$approve_reject_status); 
	
	}

	function get_return_purchase_order($id){

		/*SELECT `purchase_id`, `wareshouse_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_purchase_order` WHERE 1
		*/
		// $user = $this->session->userdata('logged_in_store');
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
		$this->db->where('storeId',$result['purchased_by']); 
		$this->db->select('storeName');
		$this->db->from('storedetails');
		$storeName=$this->db->get(); 
		$storeName= $storeName->row_array();

		$bill_data = array();
		$warehouseName = $result['warehouseName'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['bill_date'];
		$phoneNumber = $result['PhoneNumber'];
		$paid = $result['paid'];
		$balance = $result['balance'];
		$approve_reject_status = $result['approve_reject'];
		// $bill_data['bill_number'] = $new_array;
		$storename = $storeName;

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
				$row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
				// $unit = $this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				// $row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['unit_name'] = '-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key]; 
				$row['product_amount'] = (string)$product_qty[$key]*$product_price[$key];
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
		return array('warehouseName'=>$warehouseName, 'bill_number'=>$bill_number,'phoneNumber'=>$phoneNumber,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance,'storename'=>$storename,'approve_reject_status'=>$approve_reject_status); 
	
	}



	function change_puchase_order_status($id){

		$where = array('purchase_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('store_purchase_order') 
				->limit(1)
				->order_by('product_id','DESC')
				->get()
				->row_array();

				$userdata = array(
					'approve_reject'=>$this->input->post('status'),
				);

			/*	if ($this->input->post('status')=='1') {  

				$product_id = explode(',', $result['product_id']); 
				$product_qty = explode(',', $result['quntity']);  

				foreach ($product_id as $key => $prId) { 
					if ($prId !='' && $prId !='0') {  
						 
						$this->db->query("UPDATE `store_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `store_products`.`product_id` =" .$prId);
					}
				}


			}*/
			$this->db->where('purchase_id',$id);
			if ($this->db->update('store_purchase_order',$userdata)) { 
			return array('status'=>'1','message'=>'Successfully update.');		
			}else{
			return array('status'=>'0','message'=>'update Failed.');	
			} 

	}

	function change_return_order_status($id){
		$where = array('purchase_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('store_purchase_order_return') 
				->limit(1)
				->order_by('product_id','DESC')
				->get()
				->row_array();

				$userdata = array(
					'approve_reject'=>$this->input->post('status'),
				);

				if ($this->input->post('status')=='1') {  

				$product_id = explode(',', $result['product_id']); 
				$product_qty = explode(',', $result['quntity']);  

				foreach ($product_id as $key => $prId) { 
					if ($prId !='' && $prId !='0') {  
						 
						$this->db->query("UPDATE `store_products` SET `quantity` = quantity-".$product_qty[$key]." WHERE `store_products`.`product_id` =" .$prId." AND storeId=".$result['purchased_by']);
						$this->db->query("UPDATE `warehouse_products` SET `quantity` = quantity+".$product_qty[$key]." WHERE `warehouse_products`.`product_id` =" .$prId);
					}
				}


			}
			$this->db->where('purchase_id',$id);
			if ($this->db->update('store_purchase_order_return',$userdata)) { 
			return array('status'=>'1','message'=>'Successfully update.');		
			}else{
			return array('status'=>'0','message'=>'update Failed.');	
			} 		
	}
}


