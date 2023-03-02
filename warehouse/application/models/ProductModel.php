<?php
/**
 * 
 */
class ProductModel extends CI_Model
{

function getProductCategory($id=''){
		if ($id !='') {
		$result  = $this->db->where('category_id',$id)
				->order_by('category_id','DESC')
				->get('product_category')
				->row_array();		
		}else{
		$result  = $this->db->order_by('category_id','DESC')
				->get('product_category')
				->result_array();			 
		}

		return $result;
}	

	function check_duplication_barcode(){ 

		$where = array('barcode'=>$this->input->post('barcode'));
		$result = $this->db->where('barcode',$this->input->post('barcode'))
				   ->get('warehouse_products')
				   ->num_rows(); 
		if ($result > 0) {
			return array('status' => 0);
		}else{ 
			return array('status' => 1);
		}
	}

	function get_warehouse_barcode_image_details($barcode=''){
		if ($barcode !='') {
			$this->db->where('warehouse_products.barcode',$barcode);
		}
		$r = $this->db->select("*")
				->from("product_barcode")
				->join("warehouse_products","warehouse_products.barcode = product_barcode.barcode","left")
				->get();
				if ($barcode !='') {
					$result = $r->row_array();
				}else{ 
				$result = $r->result_array();
				}
		return $result;
	}

	function check_duplication_name(){
				// $where = array('barcode'=>$this->input->post('barcode'));
		$result = $this->db->where('product_title',$this->input->post('name'))
				   ->get('warehouse_products')
				   ->num_rows(); 
		if ($result > 0) {
			return array('status' => 0);
		}else{ 
			return array('status' => 1);
		}
	}

	function insert_category(){
		$userdata = array(
			'category_name'=>$this->input->post('category_name'),
			'category_status'=>1,
			'category_updated_date'=>date('Y-m-d H:s:i'),
			'category_created_date'=>date('Y-m-d H:s:i')
		);

		if ($this->db->insert('product_category',$userdata)) { 
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}

	function update_category($id){
		$this->db->where('category_id ',$id);
		$userdata = array(
			'category_name'=>$this->input->post('category_name'),
			'category_updated_date'=>date('Y-m-d H:s:i')
		);

		if ($this->db->update('product_category',$userdata)) { 


			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Update Failed.');
		}
	}

	// for category delete
	function remove_category($id){
		$this->db->where('category_id ',$id);
		if ($this->db->delete('product_category')) { 

			return array('status'=>'1','message'=>'Successfully Removed.');
		}else{
			return array('status'=>'0','message'=>'Remove Failed.');
		}
	}

	/* */
	function check_duplication(){
		$this->db->where('category_name',$this->input->post('product_category'));
		$r=$this->db->get('product_category');
		if ($r->num_rows() > 0) {
			return array('status'=>'1','message'=>'Success.');
		}else{
			return array('status'=>'0','message'=>'Failed.');
		}
	}


	/* for the warehouse product */ 
	function insert_warehouse_products($barcode_img=''){
		/*SELECT `id`, `category_id`, `product_title`, `unit_id`, `uinit`, `barcode`, `sale_price`, `sale_tax_type`, `purchase_price`, `purchase_tax_type`, `tax_rate`, `opening_quantity`, `at_price`, `date`, `minimum_stock`, `iteam_location`, `product_status`, `created_date`, `updated_date` FROM `warehouse_products` WHERE 1*/
		// var_dump($_POST);
		/* { ["category_id"]=> string(1) "3" ["unit_id"]=> string(1) "4" ["barcode"]=> string(8) "12345678" ["product_title"]=> string(17) "santur shop 200mg" ["sale_price"]=> string(4) "1212" ["sale_tax_type"]=> string(7) "exclude" ["purchase_price"]=> string(4) "1212" ["purchase_tax_type"]=> string(7) "exclude" ["tax_rate"]=> string(1) "1" ["opening_quantity"]=> string(2) "40" ["date"]=> string(10) "2020-10-13" ["minimum_stock"]=> string(1) "0" }*/
		// exit();
		$user = $this->session->userdata('logged_in_warehouse');

		$product_data = array(
			'barcode_status' =>$this->input->post('barcode_status'),
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=>$user['warehouseId'],
			'user_type'=>'warehouse',
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			'purchase_price' =>$this->input->post('purchase_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>0,//$this->input->post('opening_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>date('Y-m-d'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'),
			'warehouseId'=>$user['warehouseId'],
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);

		$barcode = array(
			'barcode'=>$this->input->post('barcode'),
			'barcode_img'=>$barcode_img,
		);
		$this->db->insert('product_barcode',$barcode);
		if ($this->db->insert('warehouse_products',$product_data)) { 

		$product_log = array(
			'product_id'=>$this->db->insert_id(),
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=>$user['warehouseId'],
			'user_type'=>'warehouse',
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
				'purchase_price' =>$this->input->post('purchase_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'),
			'warehouseId'=>$user['warehouseId'],
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		$this->db->insert('warehouse_products_log',$product_log);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed Insert.');
		}

	}

	function update_warehouse_products($id){ 
		$user = $this->session->userdata('logged_in_warehouse');

		$this->db->where('product_id',$id);
		$product_data = array(
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=>$user['warehouseId'],
			'user_type'=>'warehouse',
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			// 'purchase_price' =>$this->input->post('purchase_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'quantity' =>$this->input->post('available_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>date('Y-m-d'),//$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			'warehouseId'=>$user['warehouseId'],
			// 'iteam_location' =>$this->input->post('iteam_location'), 
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->update('warehouse_products',$product_data)) {
		$product_log = array(
			'product_id'=>$id,
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=>$user['warehouseId'],
			'user_type'=>'warehouse',
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			// 'purchase_price' =>$this->input->post('purchase_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'quantity' =>$this->input->post('available_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>date('Y-m-d'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'),
			'warehouseId'=>$user['warehouseId'],
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		$this->db->insert('warehouse_products_log',$product_log);
			// return array('status'=>'1','message'=>'Successfully Inserted.');
		
		// store product price updated 
			$this->db->where('product_id',$id);
				$product_data = array(
					'product_title' =>$this->input->post('product_title'),
					'barcode' =>$this->input->post('barcode'),
					'mrp_price' =>$this->input->post('product_mrp'),
					'wholesale_price' =>$this->input->post('wholesale_price'),
					'sale_price' =>$this->input->post('retail_price')
				);
			if($this->db->update('store_products',$product_data)){

				$this->db->where('product_id',$id);
				$product_data = array(
					// 'mrp_price' =>$this->input->post('product_mrp'),
					'product_title' =>$this->input->post('product_title'),
					'barcode' =>$this->input->post('barcode'),
					'wholesale_price' =>$this->input->post('wholesale_price'),
					'sale_price' =>$this->input->post('retail_price')
				);
				
				$this->db->update('store_products_log',$product_data);
				return array('status'=>'1','message'=>'Successfully Updated.');

			}else{
				return array('status'=>'0','message'=>'Failed Update.but Warehouse price updated');
			}
		}else{
			return array('status'=>'0','message'=>'Failed Update.');
		}

	}


	/*get products */
	function get_warehouse_product_details($color=''){
		$user = $this->session->userdata('logged_in_warehouse'); 
		// echo $user['warehouseId'];
		if ($color !='' && $color !='0') {
			/*$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left')
				->where_in('product_id',$id)
				->where('warehouseId',$user['warehouseId'])
				->order_by('product_id','DESC')
				->get()
				->row_array();*/
		$where = '';
			if ($color !='0') {

				if ($color == '1') {
				 	 $where = " AND quantity >= 20 ORDER by quantity DESC";
				 	 // return $color;
				 } else if ($color =='2') {
				 	// return $color;
				 	  $where = " AND quantity BETWEEN 11 AND 20 ORDER by quantity DESC";
				 }else if($color =='3'){
				 		$where = " AND quantity < 10 ORDER by quantity DESC";
				 		// return $color;
				 }
			}

			$result = $this->db->query("SELECT * FROM warehouse_products LEFT JOIN product_category ON product_category.category_id = warehouse_products.category_id WHERE warehouseId=".$user['warehouseId'].$where)->result_array();

				// ->where('product_status',1)
		}else{
		$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left') 
				->where('warehouseId',$user['warehouseId'])
				->order_by('product_id','DESC')
				->get()
				->result_array();
				// ->where('product_status',1)
		}

		return $result;
	}
	function get_warehouse_product_detail($id=''){
		$user = $this->session->userdata('logged_in_warehouse'); 
		// echo $user['warehouseId'];
		if ($id !='') {
			$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left')
				->where_in('product_id',$id)
				->where('warehouseId',$user['warehouseId'])
				->order_by('product_id','DESC')
				->get()
				->row_array();

				// ->where('product_status',1)
		}else{
		$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left') 
				->where('warehouseId',$user['warehouseId'])
				->order_by('product_id','DESC')
				->get()
				->result_array();
				// ->where('product_status',1)
		}

		return $result;
	}


	function update_warehouse_product_status($id){

		$this->db->where('product_id',$id);
		$status = $this->input->post('product_status');

		$product_status = array(
			'product_status'=>$status,
			'updated_date'=>date('Y-m-d H:i:s'),
		);

		if ($this->db->update('warehouse_products',$product_status)) {
			$this->db->where('product_id',$id);
			if($this->db->update('store_products',$product_status)){
				return array('status'=>'1','message'=>'Successfully Updated.');
			}else{
				return array('status'=>'0','message'=>'Failed, only update in warehouse product.');
			} 
		}else{
			return array('status'=>'0','message'=>'Failed Insert.');
		}
	}


	function importProduct($import,$barcode){ 
		if (count($barcode) > 0) { 
		$this->db->insert_batch('product_barcode',$barcode);
		}

		if ($this->db->insert_batch('warehouse_products',$import)) { 
			return array('status'=>'1','message'=>'success');
		}else{
			return array('status'=>'0','message'=>'failed');
		}
	}

	function check_duplicate_product_code_name($barcode,$warehouseId){
		 
		// $this->db->where('product_title',urldecode($product_title));
		$this->db->where('barcode',$barcode);
		$this->db->where('warehouseId',$warehouseId);
		$r=$this->db->get('warehouse_products');
		if ($r->num_rows() > 0) {
			return array('status'=>'1','message'=>'Success.');
		}else{
			return array('status'=>'0','message'=>'Failed.');
		}
	}


	/*product search by product name */
	function get_product_search_by_product_name(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$result = $this->db->where('warehouseId',$user['warehouseId'])
							->where('product_status',1)
							->like('product_title',$this->input->get('term'))
							->or_like('barcode',$this->input->get('term'))
						   	->get('warehouse_products')
						   	->result_array();

		return $result;
	}

	function get_warehouse_product_value(){
		$result = $this->db->where('barcode',$this->input->post('barcode'))
					->where('product_status',1)
				   	->get('warehouse_products')
				   	->row_array();
		return $result;
	}


	function get_store_list(){ 
		$result = $this->db->order_by('storeId','DESC')
				   ->get('storedetails')
				   ->result_array();
		return $result;
	}

	function get_store_product($id=''){
		if ($id !='') {
			$this->db->where('storeId',$id);
		}

				$result = $this->db->select("*")
				->from('store_products')
				->join('product_category','product_category.category_id = store_products.category_id','left')
				->join('unit_category','unit_category.unit_id = store_products.unit_id','left')  
				->order_by('store_product_id','DESC')
				->get()
				->result_array();

		return $result;

	}

	function change_warehouse_accept_order_status($sales_id){
		if ($this->input->post('status') == 1) {
			return array('status'=>'1','msg'=>'accepted');
		}

		$result = $this->db->where('sales_id',$sales_id)->get('warehouse_sales_order')->row_array();

		/*$qty = explode(',', $result['quntity']);
		foreach (explode(',', $result['quntity']) as $key => $value) {
			 if ($qty[$key] != $value) {
			 	 $total = $value - $qty[$key];
			 	 // $this->db->where('product_id')
			 }
		}*/
		$purchase_data = array(
			'received_qty'=>$result['quntity'],
			'warehouse_return_status'=>0,
			'updated_date'=>date('Y-m-d H:i:s')
		);
		if ($this->db->update('warehouse_sales_order',$purchase_data)) {
			return array('status'=>'2','message'=>'Success.');
		}else{
			return array('status'=>'0','message'=>'Failed.');
		}
	}

		/* sales prder list view */
	function sales_order_get_by_id($id){
		/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `warehouse_sales_order` WHERE 1*/
		$user = $this->session->userdata('logged_in_warehouse'); 
		// $storeId = $user['storeId'];
		$where = array('warehouse_sales_order.sales_id'=>$id,'purchased_by'=>$user['warehouseId']);
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
		if ($result['storeName'] !='' && $result['storeName'] !='null' ) {
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
		$received_qty = explode(',', $result['received_qty']);
		$missing_broken_status = explode(',', $result['missing_broken_status']);
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
				$status_missing = isset($missing_broken_status[$key])?$missing_broken_status[$key]:0;
				$status = 'Received';
				if ($status_missing == '1') {
					$status = 'Missing';
				}else if($status_missing == '2'){
					$status = 'Broken';
				}
				$row['unit_name'] = '-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key]; 
				$row['product_amount'] = (string)$product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = $tax_persent[$key];
				$row['tax_price'] = $tax_price[$key];
				$row['received'] = isset($received_qty[$key])?$received_qty[$key]:0;
				$row['status'] = $status;
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
		return array('sales_id'=>$result['sales_id'],'warehouse_return_status'=>$result['warehouse_return_status'],'party_name'=>$storename, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance); 
	}



	function get_warehouse_purchase_single_order($id){
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
		$party_number = $result['phone_number'];
		$party_gstin_number = $result['gstin_number'];
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
				$row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
				// $unit = $this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				// $row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['unit_name'] = '-';
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
		return array('party_name'=>$party_name,'party_number'=>$party_number,'party_gstin_number'=>$party_gstin_number, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance); 
	
	}

}