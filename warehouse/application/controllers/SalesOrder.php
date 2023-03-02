<?php

/**
 * 
 */
class SalesOrder extends CI_Controller
{
	
	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  $this->load->model('OrderModel');  
	  $this->load->model('vendorModel');  
	  $this->load->model('ProductModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	  $this->load->model('SalesOrderModel');   
	  $this->load->model('customerModel');   
	}

	function get_sales_orders_approve(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->get_sales_order_details_approve();
		echo json_encode($data);
	}

	function re_edit_sales_bill($sales_id){
			if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}

		$where = array('sales_id'=>$sales_id);
		$result = $this->db->where($where)
				->select('*')
				->from('warehouse_sales_order') 
				->limit(1)
				->order_by('sales_id','DESC')
				->get()
				->row_array();

		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Purchase Order List"; 
		$data['gst'] = $this->GstModel->viewGst();
		$data['order'] = $result;
		$data['purchase_id'] = $sales_id;
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		$this->load->view('warehouse/sales/manage-order-product',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}


	function index(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['threshold'] = $this->db->get('threshold')->row_array();
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['title']="Purchase Order"; 
		$data['store'] = $this->SalesOrderModel->get_store_details();
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar',$user);
		// $this->load->view('warehouse/sales/add-sales-order',$data);
		$this->load->view('warehouse/sales/new-ui-add-sales-order',$data);
		$this->load->view('warehouse-common/warehouse-footer',$data);	
	}

		function get_credit_history($num){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		echo json_encode($this->SalesOrderModel->get_credit_history($num));
	}

	function customerData($phoneNumber){
		
			$data = $this->SalesOrderModel->viewCustomer($phoneNumber);
	 	
		if($data > 0){
			echo json_encode(array('status'=>'1','customer' => $data));
		}else{
			echo json_encode(array('status'=>'0','message'=>'New Customer'));
		}
	}

	function sales_details(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Sales Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/sales/sales-list',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	} 


		function get_current_store_sales_order_bill($id,$role){
			$data = $this->SalesOrderModel->get_current_store_sales_order_bill($id,$role);
		echo json_encode($data);
	}


	function check_valid_referal_code(){

		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->customerModel->check_valid_referal_code();
		echo json_encode($data);
	}



	function re_approve_details(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user['sessionData'] = $this->session->userdata('logged_in_warehouse'); 
		$data['title']="Sales Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/sales/sales-list-approve',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	} 

	function sales_invoice($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$ids = base64_decode(urldecode($id));
		$data['bill'] = $this->SalesOrderModel->get_warehouse_sales_order($ids);
		$data['title']="Sales Order List"; 
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/sales/sales-invoice',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}

	function get_sales_orders(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->get_sales_order_details();
		echo json_encode($data);
	}

	function change_warehouse_accept_order_status($sales_id){
		$data = $this->ProductModel->change_warehouse_accept_order_status($sales_id);
		echo json_encode($data);
	}

	function get_sales_order_veiw($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->ProductModel->sales_order_get_by_id($id); 
		// $product_id = explode(',', $data[0]['product_id']); 
		// echo json_encode($product_id);
		// exit();
		// $productDetail = [];
		// for ($i=0; $i < count($product_id); $i++) { 
			// $productData = $this->ProductModel->get_warehouse_product_details($product_id);
			// array_push($productDetail, $productData);
			
		// } 
		echo json_encode($data);
	}

	function get_store_details(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->get_store_details();
		echo json_encode($data);
	} 

	function insertStore(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3'));	
			exit();
		}
		$data = $this->SalesOrderModel->insertStore();
		echo json_encode($data);
	}

	function insert_sales_order(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
		$data = $this->SalesOrderModel->insert_sales_order();
		echo json_encode($data);	
	}

	
	function update_credited_bill($id){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		echo json_encode($this->SalesOrderModel->update_credited_bill($id));
	}




	function daily_sale_report($number){
	 	if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_warehouse'); 
		$warehouseId = $user['warehouseId']; 

	    $where ='';
	    $store = '';
	    $customer='';
		if ($number !='all' && $number !='') {
			$customer = " AND mobile_number=".$number;
		}


	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$warehouseId."";
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$warehouseId."";
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$warehouseId."";
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$warehouseId."";
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$warehouseId."";
	    }else{
	    	$where=" where purchased_by = ".$warehouseId."";
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
			$result = $this->db->query('SELECT * FROM warehouse_sales_order '.$where.$customer)->result_array();
			// var_dump($result);

				$new_array = array();
			foreach ($result as $key => $value) {
				$product_id = explode(',', $value['product_id']);
				$product_name = explode(',', $value['product']);
				$product_qty = explode(',', $value['quntity']);
				$product_price = explode(',', $value['price']);
				$amount = explode(',', $value['amount']);
						// $productId = array();
					foreach ($product_id as $key => $prId) { 
						if ($prId !='' && $prId !='0') { 
							$warehouseproduct = $this->db->where('product_id',$prId)->select('barcode,product_mrp,retail_price,wholesale_price,purchase_price,tax_rate')->from('warehouse_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = $product_name[$key]; 
							$row['barcode'] = isset($warehouseproduct['barcode'])?$warehouseproduct['barcode']:'-';
							$row['product_mrp'] = isset($warehouseproduct['product_mrp'])?$warehouseproduct['product_mrp']:'-';
							$row['retail_price'] = isset($warehouseproduct['retail_price'])?$warehouseproduct['retail_price']:'-';
							$row['wholesale_price'] = isset($warehouseproduct['wholesale_price'])?$warehouseproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($warehouseproduct['purchase_price'])?$warehouseproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($warehouseproduct['tax_rate'])?$warehouseproduct['tax_rate']:'-'; 
							$row['product_qty'] = isset($product_qty[$key])?$product_qty[$key]:'';
							$row['product_price'] = isset($product_price[$key])?$product_price[$key]:'';
							$row['product_amount'] = $amount[$key];
							$row['bill_number'] = $value['bill_number'];
							$row['bill_date'] = $value['bill_date'];
							$row['customer_name'] = ($value['customer_name']!='')?$value['customer_name']:'-';
							array_push($new_array, $row);

						}

					}

			} 

 

			echo json_encode($new_array);
}


}