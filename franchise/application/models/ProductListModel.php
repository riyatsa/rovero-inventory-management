
<?php
/**
 * 
 */
class ProductListModel extends CI_Model
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

	
	function get_store_product_details($warehouse_Id ='',$color=''){

		$user = $this->session->userdata('logged_in_store');

/*		if($warehouse_Id != ''){
		}*/
			// $result = '';  
		if($warehouse_Id != '' && $warehouse_Id != '0'){
			// $this->db->where('warehouseId',$warehouse_Id);
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
			$result = $this->db->query("SELECT * FROM store_products WHERE storeId =".$user['storeId']." AND warehouseId=".$warehouse_Id.$where)->result_array();
		}else{ 
		
			$this->db->where('storeId',$user['storeId']);
		$data = $this->db->select("*")
				->from('store_products') 
				->join('unit_category','unit_category.unit_id = store_products.unit_id','left') 
				->order_by('product_id','DESC')
				->get();
				$result = $data->result_array();
		}
		return $result;	
	}
   	

   	function get_single_store_product_details($id =''){ 
			  
		if($id != ''){
			$this->db->where('store_product_id',$id);
		}
		$user = $this->session->userdata('logged_in_store');
			$this->db->where('storeId',$user['storeId']);
		$data = $this->db->select("*")
				->from('store_products') 
				->join('unit_category','unit_category.unit_id = store_products.unit_id','left') 
				->order_by('product_id','DESC')
				->get();
				$result = $data->result_array();
		return $result;	
	}
   
   
	function get_warehouse_product_details($warehouse_Id=''){
		  
		if($warehouse_Id != ''){
			$this->db->where('warehouseId',$warehouse_Id);
		}
		$result = $this->db->select("*")
				->from('warehouse_products') 
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left') 
				->order_by('product_id','DESC')
				->get()
				->result_array();
		return $result;
	}

	function get_warehouse_product_value(){ 
		$result = $this->db->where('barcode',$this->input->post('barcode'))
				   ->get('warehouse_products')
				   ->row_array();
		return $result;
	}

	function get_warehouse_product_value_by_barcode(){
		$user = $this->session->userdata('logged_in_store');
		$where = array('storeId'=>$user['storeId'],'barcode'=>$this->input->post('barcode'));
		$result = $this->db->where('barcode',$this->input->post('barcode'))
				   ->get('warehouse_products')
				   ->row_array();
		$check_duplicate = $this->db->where($where)
				   ->get('store_products')
				   ->num_rows();
				   // return $check_duplicate;
		if ($check_duplicate > 0) {
			return array('barcode' => 0);
		}else{ 
		return $result;
		}
	}

	
	function get_store_product_value(){
		$user = $this->session->userdata('logged_in_store');
		$where = array('storeId'=>$user['storeId'],'barcode'=>$this->input->post('barcode'));
				$result = $this->db->where($where)
					->where('product_status',1)
				   ->get('store_products')
				   ->row_array();
		return $result;
	}


	function get_warehouse_product(){
		
		$this->db->where('product_status',1);
		$this->db->where('warehouseId',$this->input->get('id'));
		$this->db->like('product_title',$this->input->get('term'));
		$this->db->or_like('barcode',$this->input->get('term'));
		$result = $this->db->select("*")
				->from('warehouse_products')
				->order_by('product_id','DESC')
				->get()
				->result_array();
		return $result;	
	}

	function get_warehouse_single_product($id){
		$result = $this->db->where('product_id',$id)
							->get('warehouse_products')
							->row_array();
		return $result;
	}


	function getWareouses($id=''){
		$this->db->select("warehouseId,warehouseName");
		if ($id !='') {
			$this->db->where('warehouseId',$id);
		}else{
			$this->db->order_by('warehouseId','DESC');
		}
		$this->db->where('status',1);
		$r=$this->db->get('warehousedetails');
		if ($id !='') {
			return $r->row_array();
		}else{ 
		return $r->result_array();
		}  
	}

	function get_store_product(){
		$user = $this->session->userdata('logged_in_store');
		$result = $this->db->order_by('store_product_id','DESC')
							->where('storeId',$user['storeId'])
							->where('product_status',1)
							->like('product_title',$this->input->get('term'))
							->or_like('barcode',$this->input->get('term'))
							->where('product_status',1)
							->get('store_products')
							->result_array();
		return $result;
	}

	function update_stock_value(){
		$user = $this->session->userdata('logged_in_store');
		$product_data = array(

			'product_title' =>$this->input->post('product_title'),
			'barcode' =>$this->input->post('barcode'),
			'quantity' =>$this->input->post('stock'),
			'sale_price' =>$this->input->post('retail_price'),
			'purchase_price' =>$this->input->post('purchase_price'),
			'mrp_price' =>$this->input->post('mrp_price')

		);
			$this->db->where('store_product_id',$this->input->post('store_product_id'));
		if ($this->db->update('store_products',$product_data)) {
			 
			$product_log = array(
			'store_product_id'=>$this->input->post('store_product_id'),
			'product_title' =>$this->input->post('product_title'),
			'barcode' =>$this->input->post('barcode'),
			'quantity' =>$this->input->post('stock'),
			'sale_price' =>$this->input->post('retail_price'),
			'purchase_price' =>$this->input->post('purchase_price'),
			'mrp_price' =>$this->input->post('mrp_price'),
			'storeId'=>$user['storeId'],
			'store_role'=>'store',
			);
			$this->db->insert('store_products_log',$product_log);

			return array('status'=>'1','message'=>'Successfully Detail Updated.');
		}else{
			return array('status'=>'0','message'=>'Failed Detail Update.');
		}
	}
	/* for the warehouse product */ 
	function insert_warehouse_products(){
		/*SELECT `store_product_id`, `product_id`, `category_id`, `storeId`, `product_title`, `unit_id`, `barcode`, `sale_price`, `sale_tax_type`, `purchase_price`, `purchase_tax_type`, `tax_rate`, `discount_in_percent`, `discount_in_price`, `quantity`, `opening_quantity`, `at_price`, `date`, `minimum_stock`, `warehouseId`, `main_stock_value`, `iteam_location`, `product_status`, `import_excel`, `created_date`, `updated_date` FROM `store_products` WHERE 1*/
		$user = $this->session->userdata('logged_in_store');

		$product_data = array(
			'product_id'=>$this->input->post('product_id'),
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'storeId'=>$user['storeId'], 
			'unit_id' =>$this->input->post('unit_id'), 
			'barcode' =>$this->input->post('barcode'),
			'discount_in_percent'=>$this->input->post('discount_in_percent'),
			'discount_in_price'=>$this->input->post('discount_in_price'),
			'sale_price' =>$this->input->post('sale_price'),
			'sale_tax_type' =>$this->input->post('sale_tax_type'),
			'purchase_price' =>$this->input->post('purchase_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'), 
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'), 
			'warehouseId'=>$this->input->post('warehouse_id'), 
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->insert('store_products',$product_data)) {

		$product_log = array(
			'store_product_id'=>$this->db->insert_id(),
			'product_id'=>$this->input->post('product_id'),
			'category_id' =>$this->input->post('category_id'),
			'product_title' =>$this->input->post('product_title'),
			'storeId'=>$user['storeId'], 
			'unit_id' =>$this->input->post('unit_id'), 
			'barcode' =>$this->input->post('barcode'),
			'discount_in_percent'=>$this->input->post('discount_in_percent'),
			'discount_in_price'=>$this->input->post('discount_in_price'),
			'sale_price' =>$this->input->post('sale_price'),
			'sale_tax_type' =>$this->input->post('sale_tax_type'),
			'purchase_price' =>$this->input->post('purchase_price'),
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			'tax_rate' =>$this->input->post('tax_rate'),
			'opening_quantity' =>$this->input->post('opening_quantity'), 
			'date' =>$this->input->post('date'),
			'minimum_stock' =>$this->input->post('minimum_stock'), 
			'warehouseId'=>$this->input->post('warehouse_id'), 
			'created_date'=>date('Y-m-d H:i:s'),
			'updated_date'=>date('Y-m-d H:i:s'),
		);
		$this->db->insert('store_products_log',$product_log);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed Insert.');
		}

	}

	/**/

	function add_store_product(){
		$product_id = explode(',', $this->input->post('product_id'));

		// return $product_id;
		$user = $this->session->userdata('logged_in_store');

		$result = $this->db->where_in('product_id',$product_id)->get('warehouse_products')->result_array();

		// return $result;
		$product_data = array();
		foreach ($result as $key => $value) {
			
			$row['product_id']=$value['product_id'];
			$row['category_id'] =$value['category_id'];
			$row['product_title'] =$value['product_title'];
			$row['storeId']=$user['storeId'];
			$row['unit_id'] =$value['unit_id'];
			$row['barcode'] =$value['barcode'];
			$row['discount_in_percent']=0;
			$row['discount_in_price']=0;
			$row['sale_price'] =$value['retail_price'];
			$row['sale_tax_type'] =$value['sale_tax_type'];
			$row['purchase_price'] =$value['purchase_price'];
			$row['wholesale_price']=$value['wholesale_price'];
			$row['mrp_price']=$value['product_mrp'];
			// 'purchase_tax_type' =>$this->input->post('purchase_tax_type'),
			$row['tax_rate'] =$value['tax_rate'];
			$row['opening_quantity'] = $value['opening_quantity'];
			$row['date'] =date('Y-m-d');
			$row['minimum_stock'] =$value['minimum_stock'];
			$row['warehouseId']=$value['warehouseId'];
			$row['created_date']=date('Y-m-d H:i:s');
			$row['updated_date']=date('Y-m-d H:i:s');
		array_push($product_data, $row);
		}

		// return $product_data;
		if ($this->db->insert_batch('store_products',$product_data)) {
			return array('status'=>'1','msg'=>'success');
		}else{
			return array('status'=>'0','msg'=>'faliled');
		}

	}
	/**/

		function check_duplicate_product_code_name($product_title,$barcode,$storeId){
		 
		$this->db->where('product_title',urldecode($product_title));
		$this->db->where('barcode',$barcode); 
		$this->db->where('storeId',$storeId);
		$r=$this->db->get('store_products');
		if ($r->num_rows() > 0) {
			return array('status'=>'1','message'=>'Success.');
		}else{
			return array('status'=>'0','message'=>'Failed.');
		}
	}

	function get_product_id($barcode){ 
		$this->db->where('barcode',$barcode); 
		$this->db->select('product_id,warehouseId'); 
		$this->db->from('warehouse_products');
		$r=$this->db->get();
		return $r->row_array();
	}

	function get_generated_sales_bill($param){
			$result = $this->db->where('sales_id',$param)
						->order_by('sales_id','DESC')
						->select('store_sales_order.*,store_customer.refral_code')
						->from('store_sales_order')
						->join('store_customer','store_customer.mobile_number = store_sales_order.customer_mobile_number','left')
						->limit(1)
						->get()
						->row_array();
		// return $result;

		/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `customer_name`, `customer_mobile_number`, `customer_address`, `customer_city`, `customer_state`, `customer_pincode`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_sales_order` WHERE 1*/

		$bill_data = array();
		$point = $result['point'];
		$store_name = $result['storeId'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['created_date'];
		$customer_name = $result['customer_name'];
		$referal = $result['refral_code'];
		// $bill_data['bill_number'] = $new_array;

		$product_id = explode(',', $result['product_id']);
		$product_name = explode(',', $result['product']);
		$product_qty = explode(',', $result['quntity']);
		$product_price = explode(',', $result['price']);
		$amount = explode(',', $result['amount']);
		$tax_persent = explode(',', $result['tax_persent']);
		$mrp_price = explode(',', $result['mrp_price']);
		$tax_price = explode(',', $result['tax_price']);

		
				// $productId = array();
		// echo $result['product_id'];
		// return $product_id;
		$total = 0;
		$qty = 0;
		$amount_price = 0; 
		$tax_price_total =0;
		$tax_persent_total =0;
		$grand_total =0;
		foreach ($product_id as $key => $prId) { 
			if ($prId !='' && $prId !='0') { 
				$row['product_id'] = $prId;
				/*$pr = $this->db->where('store_product_id',$prId)->select('mrp_price')->from('store_products')->get()->row_array();*/ 
				$row['mrp_price'] = isset($mrp_price[$key])?$mrp_price[$key]:'-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key];
				$row['product_amount'] = (string)$amount[$key];
				$row['tax_persent'] = (string)$tax_persent[$key];
 
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

		return array('point'=>$point,'referal'=>$referal,'order_discounted_percentage'=>$result['order_discounted_percentage'],'order_discounted_price'=>$result['order_discounted_price'],'store_name'=>$store_name, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'customer_name'=>$customer_name,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total,'product'=>$bill_data);
	}


	function get_generated_bill($param){
		$result = $this->db->where('sales_id',$param)
						->order_by('sales_id','DESC')
						->select('store_sales_order.*,store_customer.refral_code')
						->from('store_sales_order')
						->join('store_customer','store_customer.mobile_number = store_sales_order.customer_mobile_number','left')
						->limit(1)
						->get()
						->row_array();
		// return $result;

		/*SELECT `sales_id`, `storeId`, `bill_number`, `bill_date`, `state_of_supply`, `customer_name`, `customer_mobile_number`, `customer_address`, `customer_city`, `customer_state`, `customer_pincode`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_sales_order` WHERE 1*/

		$bill_data = array();
		$point = $result['point'];
		$store_name = $result['storeId'];
		$bill_number = $result['bill_number'];
		$bill_date = $result['created_date'];
		$customer_name = $result['customer_name'];
		$referal = $result['refral_code'];
		// $bill_data['bill_number'] = $new_array;

		$product_id = explode(',', $result['product_id']);
		$product_name = explode(',', $result['product']);
		$product_qty = explode(',', $result['quntity']);
		$product_price = explode(',', $result['price']);
		$amount = explode(',', $result['amount']);
		$tax_persent = explode(',', $result['tax_persent']);
		$mrp_price = explode(',', $result['mrp_price']);
		$tax_price = explode(',', $result['tax_price']);

		
				// $productId = array();
		// echo $result['product_id'];
		// return $product_id;
		$total = 0;
		$qty = 0;
		$amount_price = 0; 
		$tax_price_total =0;
		$tax_persent_total =0;
		$grand_total =0;
		foreach ($product_id as $key => $prId) { 
			if ($prId !='' && $prId !='0') { 
				$row['product_id'] = $prId;
				/*$pr = $this->db->where('store_product_id',$prId)->select('mrp_price')->from('store_products')->get()->row_array();*/ 
				$row['mrp_price'] = isset($mrp_price[$key])?$mrp_price[$key]:'-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = (string)$product_qty[$key];
				$row['product_price'] = (string)$product_price[$key];
				$row['product_amount'] = (string)$amount[$key];
				$row['tax_persent'] = (string)isset($tax_persent[$key])?$tax_persent[$key]:0;
				$tax = 0;
				if (isset($tax_persent[$key])) {
				$tax = $tax_persent[$key];	
				}
 
				$qty += $product_qty[$key];
				$total += $product_price[$key];
				$amount_price += $amount[$key];
				$grand_total += $product_qty[$key]*$product_price[$key];
				$tax_price_total += $tax_price[$key];
				$tax_persent_total += (float)$tax ;
				array_push($bill_data, $row); 
			}
		} 

		return array('point'=>$point,'referal'=>$referal,'order_discounted_percentage'=>$result['order_discounted_percentage'],'order_discounted_price'=>$result['order_discounted_price'],'store_name'=>$store_name, 'bill_number'=>$bill_number,'bill_date'=>$bill_date,'customer_name'=>$customer_name,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total,'product'=>$bill_data);
	}


	function get_generated_store_bill($param){

		/*SELECT `purchase_id`, `wareshouse_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_purchase_order` WHERE 1
		*/
		$user = $this->session->userdata('logged_in_store');
		$storeId = $user['storeId'];
		$where = array('store_purchase_order.purchased_by'=>$storeId, 'store_purchase_order.purchase_id'=>$param,'store_purchase_order.role'=>'store');
		$result = $this->db->where($where)
				->select('*')
				->from('store_purchase_order')
				// ->join('unit_category','unit_category.unit_id = store_purchase_order.unit_id','left')
				->join('warehousedetails','warehousedetails.warehouseId = store_purchase_order.wareshouse_id','left')
				->limit(1)
				->order_by('store_purchase_order.purchase_id','DESC')
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
		$storename = $user['storeName'];
		// $bill_data['bill_number'] = $new_array;

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
				$barcode = $this->db->query("SELECT barcode,product_mrp FROM warehouse_products WHERE product_id=".$prId)->row_array();
				$row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
				$row['product_mrp'] = isset($barcode['product_mrp'])?$barcode['product_mrp']:'';
				$unit = '';//$this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				$row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
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
		return array('warehouseName'=>$warehouseName, 'bill_number'=>$bill_number,'phoneNumber'=>$phoneNumber,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance,'storename'=>$storename); 

	}

	function get_warehouse_approved_store_purchase_order(){
				$user = $this->session->userdata('logged_in_store');
		// $storeId = $user['storeId'];
		$where = array('storeId'=>$user['storeId']);
		$result = $this->db->where($where)
				->select('*')
				->from('warehouse_sales_order') 
				->join('warehousedetails','warehousedetails.warehouseId = warehouse_sales_order.purchased_by','left') 
				->order_by('sales_id','DESC')
				->get()
				->result_array();

				return $result;
	}


	function get_store_purchase_order($id){

		/*SELECT `purchase_id`, `wareshouse_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_purchase_order` WHERE 1
		*/
		$user = $this->session->userdata('logged_in_store');
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
				$barcode = $this->db->query("SELECT barcode,product_mrp FROM warehouse_products WHERE product_id=".$prId)->row_array();
				$row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
				$row['product_mrp'] = isset($barcode['product_mrp'])?$barcode['product_mrp']:'';
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



	function get_accepted_purchase_order($id){

		/*SELECT `purchase_id`, `wareshouse_id`, `bill_number`, `bill_date`, `state_of_supply`, `product_id`, `product`, `quntity`, `unit_id`, `price`, `discount_persent`, `discount_price`, `tax_persent`, `tax_price`, `amount`, `total`, `paid`, `balance`, `payment_type`, `decription`, `purchased_by`, `role`, `created_date`, `updated_date` FROM `store_purchase_order` WHERE 1
		*/
		$user = $this->session->userdata('logged_in_store');
		// $storeId = $user['storeId'];
		$where = array('sales_id'=>$id);
		$result = $this->db->where($where)
				->select('*')
				->from('warehouse_sales_order')
				// ->join('unit_category','unit_category.unit_id = store_purchase_order.unit_id','left')
				->join('warehousedetails','warehousedetails.warehouseId = warehouse_sales_order.purchased_by','left')
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
		$received_qty = explode(',', $result['received_qty']);
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
		$rqty = 0;
		foreach ($product_id as $key => $prId) { 
			if ($prId !='' && $prId !='0') { 
				$row['product_id'] = $prId;
				$barcode = $this->db->query("SELECT barcode FROM warehouse_products WHERE product_id=".$prId)->row_array();
				$row['barcode'] = $barcode['barcode'];
				$unit =''; //$this->db->query("SELECT unit_name FROM unit_category WHERE unit_id=".$unit_id[$key])->row_array();
				$row['unit_name'] = isset($unit['unit_name'])?$unit['unit_name']:'-';
				$row['product_name'] = $product_name[$key];
				$row['product_qty'] = $product_qty[$key];
				$row['received_qty'] = isset($received_qty[$key])?$received_qty[$key]:0;;
				$row['product_price'] = $product_price[$key]; 
				$row['product_amount'] = $product_qty[$key]*$product_price[$key];
				$row['tax_persent'] = isset($tax_persent[$key])?$tax_persent[$key]:0;
				$row['tax_price'] = $tax_price[$key];
				$qty += $product_qty[$key];
				$rq = 0;
				if (isset($received_qty[$key])) {
					$rq = $received_qty[$key];
				}
				$rqty += (int)$rq;
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
		return array('warehouseName'=>$warehouseName, 'bill_number'=>$bill_number,'phoneNumber'=>$phoneNumber,'bill_date'=>$bill_date,'total'=>$total, 'qty'=>$qty, 'amount_price'=>$amount_price,'amount'=>$amount_price,'product'=>$bill_data,'tax_price_total'=>$tax_price_total,'tax_persent_total'=>$tax_persent_total,'grand_total'=>$grand_total, 'paid'=>$paid, 'balance'=>$balance,'storename'=>$storename,'rqty'=>$rqty); 
	
	}


	function importProduct($import){
		if ($this->db->insert_batch('store_products',$import)) { 
			return array('status'=>'1','message'=>'success');
		}else{
			return array('status'=>'0','message'=>'failed');
		}
	}


	/*return order */
	function get_store_return_purchase_order($id){

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
				$row['barcode'] = isset($barcode['barcode'])?$barcode['barcode']:'';
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