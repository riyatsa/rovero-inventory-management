<?php
/**
 * Created Date 9/30/2020 
 * Created By Yash
 */
class VendorModel extends CI_Model
{
	function insertVendor()
	{
		$user = $this->session->userdata('logged_in');

		$VendorData = array(
			'vendor_name'=>$this->input->post('vendor_name'),
			'phone_number'=>$this->input->post('phone_number'),
			'gst_type'=>$this->input->post('gst_type'),
			'gstin_number'=>$this->input->post('gstin_number'),
			'email'=>$this->input->post('email'), 
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			'opening_balance'=>$this->input->post('opening_balance'),
			'role'=>'admin',
			'add_by'=>$user['adminId']
			 
		);
		if ($this->db->insert('vendor_details',$VendorData)) {
			 $VendorLogData = array(
			 	'vendor_Id'=>$this->db->insert_id(),
				'vendor_name'=>$this->input->post('vendor_name'),
				'phone_number'=>$this->input->post('phone_number'),
				'gst_type'=>$this->input->post('gst_type'),
				'gstin_number'=>$this->input->post('gstin_number'),
				'email'=>$this->input->post('email'), 
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'opening_balance'=>$this->input->post('opening_balance'),
				'role'=>'admin',
				'add_by'=>$user['adminId'] 
			 
				 
			);
			$this->db->insert('vendor_details_log',$VendorLogData);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}	

	function updateVendor($id)
	{
		$user = $this->session->userdata('logged_in');
		$this->db->where('vendor_Id',$id);
		$VendorData = array(
			'vendor_name'=>$this->input->post('vendor_name'),
			'phone_number'=>$this->input->post('phone_number'),
			'gst_type'=>$this->input->post('gst_type'),
			'gstin_number'=>$this->input->post('gstin_number'),
			'email'=>$this->input->post('email'), 
			'address'=>$this->input->post('address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			'opening_balance'=>$this->input->post('opening_balance'),
			'role'=>'admin',
			'add_by'=>$user['adminId']
			 
		);
		
		if ($this->db->update('vendor_details',$VendorData)) {
			 $VendorLogData = array(
			 	'vendor_Id'=>$id,
				'vendor_name'=>$this->input->post('vendor_name'),
				'phone_number'=>$this->input->post('phone_number'),
				'gst_type'=>$this->input->post('gst_type'),
				'gstin_number'=>$this->input->post('gstin_number'),
				'email'=>$this->input->post('email'), 
				'address'=>$this->input->post('address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'opening_balance'=>$this->input->post('opening_balance'),
				'role'=>'admin',
				'add_by'=>$user['adminId']
				 
			);
			$this->db->insert('vendor_details_log',$VendorLogData);
			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Updation Failed.');
		}
	}	


	function VendorView($id=''){
		if ($id !='') {
			$this->db->where('vendor_Id',$id);
		}else{
			$this->db->order_by('vendor_Id','DESC');
		}
		$r=$this->db->get('vendor_details');
		if ($id !='') {
			return $r->row_array();
		}else{ 
		return $r->result_array();
		}

	}

	function updateVendorStatus($id){
		$this->db->where('vendor_Id',$id);
		$userdata = array(
			'vendor_status'=>$this->input->post('vendor_status'),
		);
		 
		if ($this->db->update('vendor_details',$userdata)) {
			return array('status'=>'1','message'=>'Successfully updated status.');
		}else{
			return array('status'=>'0','message'=>'status Failed update.');
		}	
	}

}