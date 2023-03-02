<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class StoreUserModel extends CI_Model
{
	
	function get_store_users($id=''){
		$wid = $this->session->userdata('logged_in_store');
		if ($id !='') {
		$result  = $this->db->where('usersId',$id)
							->order_by('usersId','DESC')
							->get('store_users')
							->row_array();		
		}else{
				$result  = $this->db->where('soreId',$wid['storeId'])
							->order_by('usersId','DESC')
							->get('store_users')
							->result_array();			 
		}

		return $result;
	}

	function getSalesPurchase(){
		$year = date('Y');
		$user = $this->session->userdata('logged_in_store');
	 
		$purchase_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_purchase, monthname(created_date) AS month FROM warehouse_purchase_order WHERE purchased_by='.$user['warehouseId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 

		$sales_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_sales, monthname(created_date) month FROM warehouse_sales_order WHERE purchased_by='.$user['warehouseId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 
		// $purchase_order_rs = round($purchase_order['total_purchase'],2);
		$analytics['purchase_order'] = $purchase_order;
		$analytics['sales_order'] = $sales_order;

		return $analytics;
		
	}

	function count_warehouse(){
		$user = $this->session->userdata('logged_in_store');
		$count = $this->db->where('warehouseId',$user['warehouseId'])->get('warehousedetails')->num_rows();
		return $count;
	}

		function count_product(){
		$user = $this->session->userdata('logged_in_store');
		$count = $this->db->where('warehouseId',$user['warehouseId'])->get('warehouse_products')->num_rows();
		return $count;
	}

	function insert_store_user(){ 
		$user = $this->session->userdata('logged_in_store');
		$userdata = array(
			'soreId' => $user['storeId'],
			'userName' => $this->input->post('userName'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'password' => MD5($this->input->post('password')),
		);
		if ($this->db->insert('store_users',$userdata)) {
		$userdatalog = array(
			'usersId'=>$this->db->insert_id(),
			'soreId' => $user['storeId'],
			'userName' => $this->input->post('userName'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'password' => MD5($this->input->post('password')),
		);
		$this->db->insert('store_users_log',$userdatalog);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed .');
		}
	}

		function update_store_user($id){ 
				$this->db->where('usersId',$id);
			$user = $this->session->userdata('logged_in_store');
			$userdata = array(
				'soreId' => $user['storeId'],
				'userName' => $this->input->post('userName'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'password' => MD5($this->input->post('password')),
			);
			if ($this->db->update('store_users',$userdata)) {
			$userdatalog = array(
				'usersId'=>$id,
				'soreId' => $user['storeId'],
				'userName' => $this->input->post('userName'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'password' => MD5($this->input->post('password')),
			);
			$this->db->insert('store_users_log',$userdatalog);
				return array('status'=>'1','message'=>'Successfully Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed .');
			}
	}

function update_store_users_status($id){
			// return true;
			$this->db->where('usersId',$id);
			$user = $this->session->userdata('logged_in_store');
			$userdata = array(
				'users_status' =>$this->input->post('users_status'),
				'updatedDate' =>date('Y-m-d H:i:s')
			);
			$status = 1;
			if ($this->input->post('users_status') != 1) {
					$status = 2;
			}
			if ($this->db->update('store_users',$userdata)) {
				$result = $this->db->where('usersId',$id)->get('store_users')->row_array();
			$userdatalog = array(
				'usersId'=>$id,
				'soreId' => $user['storeId'],
				'userName' =>$result['userName'],
				'email' => $result['email'],
				'role' => $result['role'],
				'users_status'=>$status,
				'password' => MD5($result['password']),
			);
			$this->db->insert('store_users_log',$userdatalog);
				return array('status'=>'1','message'=>'Successfully Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed .');
			}
	}

	function total_purchase(){
		$user = $this->session->userdata('logged_in_store'); 
		$count = $this->db->query('SELECT SUM(total) AS total FROM warehouse_purchase_order WHERE purchased_by='.$user['warehouseId'])->row_array(); 
		return $count;
	}

	function total_sales(){
		$user = $this->session->userdata('logged_in_store'); 
		$count = $this->db->query('SELECT SUM(total) AS total_sales FROM warehouse_sales_order WHERE purchased_by='.$user['storeId'])->row_array(); 
		return $count;
	}
}