<?php
/**
 * Created Date 10/10/2020 
 * Created By Yash
 */
class CustomerModel extends CI_Model
{
	function insertCustomer()
	{	
		// store_id
		$user = $this->session->userdata('logged_in_store');

		// print_r($user['storeId']);
		// exit();
		$storeData = array(
			'name'=>$this->input->post('customername'),
			'mobile_number'=>$this->input->post('phonenumber'),
			'refral_code'=>$this->input->post('refral_code'),
			'store_id'=>$user['storeId'],
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			'customer_status'=>'1'
			 
		);
		if ($this->db->insert('store_customer',$storeData)) {
			 $storeLogData = array(
			 	'customer_id'=>$this->db->insert_id(),
				'name'=>$this->input->post('customername'),
				'mobile_number'=>$this->input->post('phonenumber'),
				'refral_code'=>$this->input->post('refral_code'),
				'store_id'=>$user['storeId'],
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'customer_status'=>'1'

			);
			$this->db->insert('store_customer_log',$storeLogData);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}	

	function updateCustomer($id)
	{
		$user = $this->session->userdata('logged_in_store');
		$this->db->where('customer_id',$id);
		$storeData = array(
			'name'=>$this->input->post('customername'),
			'mobile_number'=>$this->input->post('phonenumber'), 
			'store_id'=>$user['storeId'],
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			'customer_status'=>'1'
			 
		);
		
		if ($this->db->update('store_customer',$storeData)) {
			$get_customer_data = $this->viewCustomer($id);
			// echo "Data : ";
			// print_r($get_customer_data['refral_code']);
			
			$storeLogData = array(
			 	'customer_id'=>$id,
				'name'=>$this->input->post('customername'),
				'mobile_number'=>$this->input->post('phonenumber'), 
				'store_id'=>$user['storeId'],
				'refral_code'=>$get_customer_data['refral_code'],
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'customer_status'=>'1'
				 
			);
			$this->db->insert('store_customer_log',$storeLogData);
			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Updation Failed.');
		}
	}	


	public function viewCustomer($id=''){ 
		
		if ($id !='') {
			if(strlen($id) >= '10'){
				$this->db->where('mobile_number',$id);
			}else{
				$this->db->where('customer_id',$id);
			}
			 
		}else{
			$this->db->order_by('customer_id','DESC');
		}
		$r=$this->db->get('store_customer');
		if ($id !='') {
			return $r->row_array();
		}else{ 
		return $r->result_array();
		}

	}

	function updateCustomerStatus($id){
		$this->db->where('customer_id',$id);
		$userdata = array(
			'customer_status'=>$this->input->post('customer_status'),
		);
		 
		if ($this->db->update('store_customer',$userdata)) {
			return array('status'=>'1','message'=>'Successfully updated status.');
		}else{
			return array('status'=>'0','message'=>'status Failed update.');
		}	
	}

	function check_valid_referal_code(){
		$where = "mobile_number !=".$this->input->post('contact_no')." AND ( refral_code = ".$this->input->post('referral')." OR mobile_number =".$this->input->post('referral').")";
		$result = $this->db->query('SELECT * FROM store_customer WHERE '.$where);
		if ($result->num_rows() > 0) {
			$data = $result->row_array();
		$where1 = "mobile_number =".$this->input->post('contact_no');
		// $result1 = $this->db->where($where1)->get('store_customer1')->num_rows();
		$result1 = $this->db->query('SELECT * FROM store_customer WHERE '.$where1)->row_array();
			if ($result1['refral_code'] == $data['reffered_by']) {
				return array('status'=>'0','msg'=>'not valid');
			}else if($result1['mobile_number'] == $data['reffered_by']){
				return array('status'=>'0','msg'=>'not valid');
			}
				return array('status'=>'1','msg'=>'valid');
			 
			
		}else{
			return array('status'=>'0','msg'=>'not valid');
		}
	}

}