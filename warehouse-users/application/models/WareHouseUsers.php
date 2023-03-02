<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class WareHouseUsers extends CI_Model
{
	
	function get_warehouse_users($id=''){
		$wid = $this->session->userdata('logged_in_warehouse_user');
		if ($id !='') {
		$result  = $this->db->where('usersId',$id)
							->order_by('usersId','DESC')
							->get('warehouseusers')
							->row_array();		
		}else{
				$result  = $this->db->where('warehouseId',$wid['warehouseId'])
							->order_by('usersId','DESC')
							->get('warehouseusers')
							->result_array();			 
		}

		return $result;
	}

	function insert_warehouse_user(){ 
		$user = $this->session->userdata('logged_in_warehouse_user');
		$userdata = array(
			'warehouseId' => $user['warehouseId'],
			'userName' => $this->input->post('userName'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'password' => MD5($this->input->post('password')),
		);
		if ($this->db->insert('warehouseusers',$userdata)) {
		$userdatalog = array(
			'usersId'=>$this->db->insert_id(),
			'warehouseId' => $user['warehouseId'],
			'userName' => $this->input->post('userName'),
			'email' => $this->input->post('email'),
			'role' => $this->input->post('role'),
			'password' => MD5($this->input->post('password')),
		);
		$this->db->insert('warehouseuserslog',$userdatalog);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Failed .');
		}
	}

		function update_warehouse_user($id){ 
				$this->db->where('usersId',$id);
			$user = $this->session->userdata('logged_in_warehouse_user');
			$userdata = array(
				'warehouseId' => $user['warehouseId'],
				'userName' => $this->input->post('userName'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'password' => MD5($this->input->post('password')),
			);
			if ($this->db->update('warehouseusers',$userdata)) {
			$userdatalog = array(
				'usersId'=>$id,
				'warehouseId' => $user['warehouseId'],
				'userName' => $this->input->post('userName'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'password' => MD5($this->input->post('password')),
			);
			$this->db->insert('warehouseuserslog',$userdatalog);
				return array('status'=>'1','message'=>'Successfully Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed .');
			}
	}

	function update_warehouse_users_status($id){
						$this->db->where('usersId',$id);
			$user = $this->session->userdata('logged_in_warehouse_user');
			$userdata = array(
				'users_status' =>$this->input->post('users_status'),
				'updatedDate' =>date('Y-m-d H:i:s')
			);
			$status = 1;
			if ($this->input->post('users_status') != 1) {
					$status = 2;
			}
			if ($this->db->update('warehouseusers',$userdata)) {
				$result = $this->db->where('usersId',$id)->get('warehouseusers')->row_array();
			$userdatalog = array(
				'usersId'=>$id,
				'warehouseId' => $user['warehouseId'],
				'userName' =>$result['userName'],
				'email' => $result['email'],
				'role' => $result['role'],
				'users_status'=>$status,
				'password' => MD5($result['password']),
			);
			$this->db->insert('warehouseuserslog',$userdatalog);
				return array('status'=>'1','message'=>'Successfully Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed .');
			}
	}
}