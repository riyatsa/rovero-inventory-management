<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created By Yash 10/23/2020
 */
class NotificationModel extends CI_Model
{
	
			// return $result->result_array();

 	public function notification(){
 		$user = $this->session->userdata('logged_in_warehouse');
		$this->db->where('wareshouse_id',$user['warehouseId']); 
		$this->db->where('notification','1'); 
		$this->db->select('purchase_id,bill_number,purchased_by');
		$this->db->from('store_purchase_order');
		$result=$this->db->get(); 
	 	// $result = $result->result_array();
	 	return $result->result_array();
		// $productDetail = [];
	 // 	// print_r($result['purchased_by']);
	 // 	array_push($productDetail, $result); 
	 // 	for ($i=0; $i < count($result); $i++) { 
	 		
	 // 		$this->db->where('storeId',$result[$i]['purchased_by']); 
		// 	$this->db->select('storeName');
		// 	$this->db->from('storedetails');
		// 	$storeName=$this->db->get(); 
		// 	$storeName= $storeName->row_array();
		// 	array_push($productDetail, $storeName); 
	 // 	}

	 // 	print_r($productDetail);
	 // 	exit();
		
		// array_push($data['result'], $storeName); 
	 
	}

	public function updateNotification($id){
			 
		$this->db->where('purchase_id',$id);
		$dataUpdate = array(
			'notification'=>0
		);
		if($this->db->update('store_purchase_order',$dataUpdate)){
			return array('status'=>'1');
		}else{
			return array('status'=>'0');
		}
			 
	}



 
 	public function notification_1(){
 		$user = $this->session->userdata('logged_in_warehouse');
		$this->db->where('purchased_by',$user['warehouseId']); 
		$this->db->where('notification_1',1); 
		$this->db->where('qty_status',1); 
		$this->db->select('sales_id,bill_number,purchased_by');
		$this->db->from('warehouse_sales_order');
		$result=$this->db->get(); 
	 	// $result = $result->result_array();
	 	return $result->result_array();
		// $productDetail = [];
	 // 	// print_r($result['purchased_by']);
	 // 	array_push($productDetail, $result); 
	 // 	for ($i=0; $i < count($result); $i++) { 
	 		
	 // 		$this->db->where('storeId',$result[$i]['purchased_by']); 
		// 	$this->db->select('storeName');
		// 	$this->db->from('storedetails');
		// 	$storeName=$this->db->get(); 
		// 	$storeName= $storeName->row_array();
		// 	array_push($productDetail, $storeName); 
	 // 	}

	 // 	print_r($productDetail);
	 // 	exit();
		
		// array_push($data['result'], $storeName); 
	 
	}

	public function updateNotification_1($id){
			 
		$this->db->where('sales_id',$id);
		$dataUpdate = array(
			'notification_1'=>0
		);
		if($this->db->update('warehouse_sales_order',$dataUpdate)){
			return array('status'=>'1');
		}else{
			return array('status'=>'0');
		}
			 
	}

}