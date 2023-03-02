<?php
/**
 * 
 */
class StoreBilling extends CI_Controller
{

	function __construct()  
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	  // $this->load->model('OrderModel');  
	  $this->load->model('SmsModal');  
	  $this->load->model('ProductListModel');  
	  $this->load->model('UnitModel');  
	  $this->load->model('GstModel'); 
	  $this->load->model('StoreOrderModel'); 
	  $this->load->model('StoreBillingModel');   
	  $this->load->model('customerModel');   
	}


	function edit_sales_bill($id){
				if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_store');
		// print_r($user);
		 $storeId = $user['storeId'];
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$data['title']="Purchase Order"; 
		$data['order'] = $this->StoreBillingModel->get_single_sales_bill($id);
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/edit-billing-order',$data);
		$this->load->view('store-common/store-footer');	
	}


	function hold_sales_bill($id){
				if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_store');
		// print_r($user);
		 $storeId = $user['storeId'];
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$data['title']="Purchase Order"; 
		$data['order'] = $this->StoreBillingModel->get_single_sales_bill($id);
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/hold-billing-order',$data);
		$this->load->view('store-common/store-footer');	
	}

	
	function index(){ 
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$user = $this->session->userdata('logged_in_store');
		// print_r($user);
		 $storeId = $user['storeId'];
		$data['warehouse']=$this->ProductListModel->getWareouses();
		$data['unit'] = $this->UnitModel->viewUnit();
		$data['category'] = $this->ProductListModel->getProductCategory();
		$data['gst'] = $this->GstModel->viewGst();
		$data['threshold'] = $this->db->where('store_id',$storeId)->limit(1)->get('threshold')->row_array();
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		// $this->load->view('store/order/add-billing-order',$data); 
		$this->load->view('store/order/new-ui-add-billing-order',$data);
		$this->load->view('store-common/store-footer');	
	} 

	function print_invoice($param){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$number = base64_decode(urldecode($param));
		$data['bill'] = $this->ProductListModel->get_generated_bill($number); 
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/print-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}

	function edit_print_invoice($param){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$number = base64_decode(urldecode($param));
		$data['bill'] = $this->ProductListModel->get_generated_sales_bill($number); 
		$data['title'] = "";
		$this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/print-invoice',$data);
		$this->load->view('store-common/store-footer');	
	}

	
	function details(){ 
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/sales-order-list');
		$this->load->view('store-common/store-footer');	
	} 

	function hold_bills(){ 
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		$data['title']="Purchase Order"; 
        $this->load->view('store-common/store-header'); 
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/order/hold-order-list');
		$this->load->view('store-common/store-footer');	
	} 

	function add_store_sales_billing(){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreBillingModel->insert_order();
		echo json_encode($data);
	}



	function get_current_store_sales_order_data($id=''){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreBillingModel->get_current_store_sales_order_data($id);
		echo json_encode($data);
	}

	function get_current_store_sales_order_bill($id,$role){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreBillingModel->get_current_store_sales_order_bill($id,$role);
		echo json_encode($data);
	}

	function get_current_hold_bill($id=''){
			$data = $this->StoreBillingModel->get_current_hold_bill($id);
		echo json_encode($data);
	}

	function customerData($phoneNumber){

		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->customerModel->viewCustomer($phoneNumber);
	 	
		if($data > 0){
			echo json_encode(array('status'=>'1','customer' => $data));
		}else{
			echo json_encode(array('status'=>'0','message'=>'New Customer'));
		}
	}


	function change_store_bill_order_status($id){
		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreBillingModel->change_store_bill_order_status($id);
		echo json_encode($data);
	}

	function check_valid_referal_code(){

		if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->customerModel->check_valid_referal_code();
		echo json_encode($data);
	}

	function edit_store_sales_billing(){
				if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$data = $this->StoreBillingModel->edit_store_sales_billing();
		echo json_encode($data);
	}

	function get_all_item_list(){
		$data = $this->ProductListModel->get_store_product_details();
		echo json_encode($data);
	}

	function add_new_item_for_billing() {
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		echo json_encode($this->StoreBillingModel->add_new_item_for_billing());
	}

	function add_new_item_for_warehouse_billing(){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		echo json_encode($this->StoreBillingModel->add_new_item_for_warehouse_billing());
	}


	function get_credit_history($num){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		echo json_encode($this->StoreBillingModel->get_credit_history($num));
	}

	function update_credited_bill($id){
		if(!$this->session->userdata('logged_in_store')){
			redirect(base_url());
			exit();
		}
		echo json_encode($this->StoreBillingModel->update_credited_bill($id));
	}





	function daily_sale_report($number=''){
	 	if(!$this->session->userdata('logged_in_store')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));
			exit();
		}
		$user = $this->session->userdata('logged_in_store'); 
		$storeId = $user['storeId']; 
		$customer='';
		if ($number !='all' && $number !='') {
			$customer = " AND customer_mobile_number=".$number;
		}

	    $where ='';
	    if ($this->input->post('duration') == 'today') {
	      $where=" where date(created_date) = CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'week'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'month'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 MONTH AND CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'year'){
	      $where=" where date(created_date) BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else if($this->input->post('duration') == 'between'){
	      $where=" where date(created_date) BETWEEN  '".$_POST['from']."' AND '".$_POST['to']."' AND purchased_by = ".$storeId." AND role='store'".$customer;
	    }else{
	    	$where=" where purchased_by = ".$storeId." AND role='store'".$customer;
	    }
	    
	    if ($where !='') { 
	      // $this->db->where($where);
	    } 
			 
			$result = $this->db->query('SELECT * FROM store_sales_order '.$where.' AND order_status=1')->result_array();
			// var_dump($result);
			/*var_dump($result);
			exit();*/


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
								$storeproduct = $this->db->where('store_product_id',$prId)->select('barcode,mrp_price,sale_price,wholesale_price,purchase_price,tax_rate')->from('store_products')->get()->row_array();
							$row['product_id'] = $prId;
							$row['product_name'] = isset($product_name[$key])?$product_name[$key]:'';
							$row['barcode'] = isset($storeproduct['barcode'])?$storeproduct['barcode']:'-';
							$row['product_mrp'] = isset($storeproduct['mrp_price'])?$storeproduct['mrp_price']:'-';
							$row['retail_price'] = isset($storeproduct['sale_price'])?$storeproduct['sale_price']:'-';
							$row['wholesale_price'] = isset($storeproduct['wholesale_price'])?$storeproduct['wholesale_price']:'-';
							$row['purchase_price'] = isset($storeproduct['purchase_price'])?$storeproduct['purchase_price']:'-';
							$row['tax_rate'] = isset($storeproduct['tax_rate'])?$storeproduct['tax_rate']:'-';
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