<?php
/**
 * Created Date 9/30/2020 
 * Created By Viral
 */
class WerehouseModel extends CI_Model
{

	function get_werehouse_details($id=''){
		// $this->db->where('status',1);
		if ($id !='') {
			$result = $this->db->where('warehouseId',$id)
							// ->where('status',1)
					 ->get('warehousedetails')
					 ->row_array();
		}else{

		$result = $this->db->order_by('warehouseId','DESC')
					       ->get('warehousedetails')
					       ->result_array();
		}
		return $result;
	}

	function count_warehouse(){
		$count = $this->db->get('warehousedetails')->num_rows();
		return $count;
	}


	 function insert_werehouse()
	{
		$userdata = array(
			'warehouseName'=>$this->input->post('werehousename'),  
			'PhoneNumber'=>$this->input->post('phonenumber'),
			'gstinNumber'=>$this->input->post('gstinumber'),
			'userName'=>$this->input->post('username'),
			'password'=>MD5($this->input->post('password')),
			'openingBalance'=>$this->input->post('openingBalance'), 
			'gst_type'=>$this->input->post('gst_type'),
			'address'=>$this->input->post('Address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'),
			'status'=>1,
			'createdDate'=>date('Y-m-d H:i:s'),
			'updatedDate'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->insert('warehousedetails',$userdata)) {
			$logdata = array(
				'warehouseId'=>$this->db->insert_id(),
				'warehouseName'=>$this->input->post('werehousename'),
				'PhoneNumber'=>$this->input->post('phonenumber'),
				'gstinNumber'=>$this->input->post('gstinumber'),
				'userName'=>$this->input->post('username'),
				'password'=>MD5($this->input->post('password')),
				'openingBalance'=>$this->input->post('openingBalance'),
				'gst_type'=>$this->input->post('gst_type'),
				'address'=>$this->input->post('Address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'createdDate'=>date('Y-m-d H:i:s'),
				'updatedDate'=>date('Y-m-d H:i:s'),
			);
			$this->db->insert('warehouselogdetails',$logdata);
			return array('status'=>'1');
		}else{
			return array('status'=>'0');
		}
	}	

	 function update_werehouse($id)
	{

		$this->db->where('warehouseId',$id);
		$userdata = array(
			'warehouseName'=>$this->input->post('werehousename'),
			'PhoneNumber'=>$this->input->post('phonenumber'),
			'gstinNumber'=>$this->input->post('gstinumber'),
			'userName'=>$this->input->post('username'), 
			'openingBalance'=>$this->input->post('openingBalance'), 
			'gst_type'=>$this->input->post('gst_type'),
			'address'=>$this->input->post('Address'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'pincode'=>$this->input->post('pincode'), 
			'updatedDate'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->update('warehousedetails',$userdata)) {
			$logdata = array(
				'warehouseId'=>$id,
				'warehouseName'=>$this->input->post('werehousename'),
				'PhoneNumber'=>$this->input->post('phonenumber'),
				'gstinNumber'=>$this->input->post('gstinumber'),
				'userName'=>$this->input->post('username'),
				'password'=>MD5(0),
				'openingBalance'=>$this->input->post('openingBalance'),
				'gst_type'=>$this->input->post('gst_type'),
				'address'=>$this->input->post('Address'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'pincode'=>$this->input->post('pincode'),
				'status'=>1,
				'createdDate'=>date('Y-m-d H:i:s'),
				'updatedDate'=>date('Y-m-d H:i:s'),
			);
			$this->db->insert('warehouselogdetails',$logdata);
			return array('status'=>'1');
		}else{
			return array('status'=>'0');
		}
	}

	function remove_werehouse_details($id){
		$this->db->where('warehouseId',$id);
		$status = array(
			'status'=>$this->input->post('status'),
			'updatedDate'=>date('Y-m-d H:i:s'),
		);
		if ($this->db->update('warehousedetails',$status)) {
			$werehouse = $this->db->where('warehouseId',$id)->get('warehousedetails')->row_array();

			$logdata = array(
				'warehouseId'=>$id,
				'warehouseName'=>$werehouse['warehouseName'],
				'PhoneNumber'=>$werehouse['PhoneNumber'],
				'gstinNumber'=>$werehouse['gstinNumber'],
				'userName'=>$werehouse['userName'],
				'password'=>MD5($werehouse['password']),
				'openingBalance'=>$werehouse['openingBalance'],
				'gst_type'=>$werehouse['gst_type'],
				'address'=>$werehouse['address'],
				'city'=>$werehouse['city'],
				'state'=>$werehouse['state'],
				'pincode'=>$werehouse['pincode'],
				'status'=>2,
				'createdDate'=>date('Y-m-d H:i:s'),
				'updatedDate'=>date('Y-m-d H:i:s'),
			);
			return array('status'=>'1','msg'=>'removed');
		}else{
			return array('status'=>'0','msg'=>'remove failed');
		}
	}


	function total_purchase(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$count = $this->db->query('SELECT SUM(total) AS total FROM warehouse_purchase_order')->row_array(); 
		return $count;
	}

	function total_sales(){
		$user = $this->session->userdata('logged_in_warehouse'); 
		$count = $this->db->query('SELECT SUM(total) AS total_sales FROM warehouse_sales_order')->row_array(); 
		return $count;
	}

}