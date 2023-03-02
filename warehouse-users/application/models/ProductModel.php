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


		function get_warehouse_barcode_image_details(){
			$user = $this->session->userdata('logged_in_warehouse_user');

		$product_data = array(
			'usersId'=>$user['usersId'],
			'user_type'=>$user['role']);
		$this->db->where($product_data);
		$result = $this->db->select("product_barcode.*,warehouse_products.product_title")
				->from("product_barcode")
				->join("warehouse_products","warehouse_products.barcode = product_barcode.barcode","left")
				->get()
				->result_array();
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
	function insert_warehouse_products($barcode_img){
		/*SELECT `id`, `category_id`, `product_title`, `unit_id`, `uinit`, `barcode`, `sale_price`, `sale_tax_type`, `purchase_price`, `purchase_tax_type`, `tax_rate`, `opening_quantity`, `at_price`, `date`, `minimum_stock`, `iteam_location`, `product_status`, `created_date`, `updated_date` FROM `warehouse_products` WHERE 1*/
		$user = $this->session->userdata('logged_in_warehouse_user');

		$product_data = array(
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=>$user['usersId'],
			'user_type'=>$user['role'],
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
						'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'),
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
			'usersId'=> $user['usersId'],
			'user_type'=>$user['role'],
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'),
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
		$user = $this->session->userdata('logged_in_warehouse_user');
		$this->db->where('product_id',$id);
		$product_data = array(
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=> $user['usersId'],
			'user_type'=>$user['role'],
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			/*'sale_price' =>$this->input->post('sale_price'),
			'sale_tax_type' =>$this->input->post('sale_tax_type'),
			'purchase_price' =>$this->input->post('purchase_price'),
			'purchase_tax_type' =>$this->input->post('purchase_tax_type'),*/
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'), 
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->update('warehouse_products',$product_data)) {
		$product_log = array(
			'product_id'=>$id,
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'usersId'=> $user['usersId'],
			'user_type'=>$user['role'],
			'unit_id' =>$this->input->post('unit_id'),
			// 'uinit' =>$this->input->post('uinit'),
			'barcode' =>$this->input->post('barcode'),
			/*'sale_price' =>$this->input->post('sale_price'),
			'sale_tax_type' =>$this->input->post('sale_tax_type'),
			'purchase_price' =>$this->input->post('purchase_price'),
			'purchase_tax_type' =>$this->input->post('purchase_tax_type'),*/
			'product_mrp' =>$this->input->post('product_mrp'),
			'wholesale_price' =>$this->input->post('wholesale_price'),
			'retail_price' =>$this->input->post('retail_price'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'),
			// 'at_price' =>$this->input->post('at_price'),
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'),
			// 'iteam_location' =>$this->input->post('iteam_location'),
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		$this->db->insert('warehouse_products_log',$product_log);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed Insert.');
		}

	}


	/*get products */
	function get_warehouse_product_details($id=''){
		$user = $this->session->userdata('logged_in_warehouse_user'); 
                
		if ($id !='') {
			$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left')
				// ->where('product_status',1)
				->where('product_id',$id)
				// ->where('usersId',$user['usersId'])
				// ->where('warehouseId',$user['warehouseId'])
				->order_by('product_id','DESC')
				->get()
				->row_array();
		}else{
		$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left')
				// ->where('product_status',1)
				->where('usersId',$user['usersId'])
				->where('warehouseId',$user['warehouseId'])
				->order_by('product_id','DESC')
				->get()
				->result_array();
		}

		return $result;
	}


	function update_warehouse_product_status($id){
		$this->db->where('product_id',$id);
		$product_status = array(
			'product_status'=>$this->input->post('product_status'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->update('warehouse_products',$product_status)) {
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed Insert.');
		}
	}

	
	function importProduct($import,$barcode){
		$this->db->insert_batch('product_barcode',$barcode);
		if ($this->db->insert_batch('warehouse_products',$import)) { 
			return array('status'=>'1','message'=>'success');
		}else{
			return array('status'=>'0','message'=>'failed');
		}
	}

	function check_duplicate_product_code_name($product_title,$barcode,$warehouseId){
		 
		$this->db->where('product_title',urldecode($product_title));
		$this->db->where('barcode',$barcode);
		$this->db->where('warehouseId',$warehouseId);
		$r=$this->db->get('warehouse_products');
		if ($r->num_rows() > 0) {
			return array('status'=>'1','message'=>'Success.');
		}else{
			return array('status'=>'0','message'=>'Failed.');
		}
	}

	function get_warehouse_product_details_by_search(){
		$this->db->like('product_title',$this->input->get('term'));
		$this->db->or_like('barcode',$this->input->get('term'));
		$result = $this->db->where('product_status',1)->get('warehouse_products')->result_array();
		return $result;
	}

	
	function get_warehouse_product_value(){
		$result = $this->db->where('barcode',$this->input->post('barcode'))
					->where('product_status',1)
				   ->get('warehouse_products')
				   ->row_array();
		return $result;
	}

}