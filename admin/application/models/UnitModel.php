<?php
/**
 * Created Date 10/01/2020 
 * Created By Yash
 */
class UnitModel extends CI_Model
{
	function insertUnit()
	{
		$unitData = array(
			'unit_name'=>$this->input->post('unit_name'),
			'unit_short_name'=>$this->input->post('unit_short_name'),
			'unit_status'=>1
		);
		if ($this->db->insert('unit_category',$unitData)) {
			 $unitLogData = array(
			 	'unit_id'=>$this->db->insert_id(),
				'unit_name'=>$this->input->post('unit_name'),
				'unit_short_name'=>$this->input->post('unit_short_name'),
				'unit_status'=>1 
			);
			$this->db->insert('unit_category_log',$unitLogData);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}	

	function updateUnit($id)
	{
		$this->db->where('unit_id',$id);
		$storeData = array(
			'unit_name'=>$this->input->post('unit_name'),
			'unit_short_name'=>$this->input->post('unit_short_name') 
		);
		
		if ($this->db->update('unit_category',$storeData)) {
			 $storeLogData = array(
			 	'unit_id'=>$id, 
			 	'unit_name'=>$this->input->post('unit_name'),
				'unit_short_name'=>$this->input->post('unit_short_name'),
				'unit_status'=>1 
				 
			);
			$this->db->insert('unit_category_log',$storeLogData);
			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Updation Failed.');
		}
	}	


	function viewUnit($id=''){
		if ($id !='') {
			$this->db->where('unit_id',$id);
		}else{
			$this->db->order_by('unit_id','DESC');
		}
		$r=$this->db->get('unit_category');
		if ($id !='') {
			return $r->row_array();
		}else{ 
			return $r->result_array();
		}

	}

	function updateUnitStatus($id){
		$this->db->where('unit_id',$id);
		$userdata = array(
			'unit_status'=>$this->input->post('unit_status'),
		);
		 
		if ($this->db->update('unit_category',$userdata)) {
			return array('status'=>'1','message'=>'Successfully updated status.');
		}else{
			return array('status'=>'0','message'=>'status Failed update.');
		}	
	}




	/**************************
	*UnitSubCategory Operation*
	**************************/
	

	function insertUnitSubCategory()
	{
		$unitData = array(
			'unit_id'=>$this->input->post('unit_id'),
			'unit_name'=>$this->input->post('unit_name'),
			'unit_short_name'=>$this->input->post('unit_short_name'),
			'unit_status'=>1
		);
		if ($this->db->insert('unit_sub_category',$unitData)) {
			 $unitLogData = array(
			 	'unit_sub_id'=>$this->db->insert_id(),
			 	'unit_id'=>$this->input->post('unit_id'),
				'unit_name'=>$this->input->post('unit_name'),
				'unit_short_name'=>$this->input->post('unit_short_name'),
				'unit_status'=>1 
			);
			$this->db->insert('unit_sub_category_log',$unitLogData);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}	

	function updateUnitSubCategory($id)
	{
		$this->db->where('unit_sub_id',$id);
		$storeData = array(
			'unit_id'=>$this->input->post('unit_id'),
			'unit_name'=>$this->input->post('unit_name'),
			'unit_short_name'=>$this->input->post('unit_short_name') 
		);
		
		if ($this->db->update('unit_sub_category',$storeData)) {
			 $storeLogData = array(
			 	'unit_sub_id'=>$id, 
			 	'unit_id'=>$this->input->post('unit_id'),
			 	'unit_name'=>$this->input->post('unit_name'),
				'unit_short_name'=>$this->input->post('unit_short_name'),
				'unit_status'=>1 
				 
			);
			$this->db->insert('unit_sub_category_log',$storeLogData);
			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Updation Failed.');
		}
	}	


	function viewUnitSubCategory($id=''){
		if ($id !='') {
			$this->db->where('unit_sub_id',$id);
		}else{
			$this->db->order_by('unit_sub_id','DESC');
		}
		$r=$this->db->get('unit_sub_category');
		if ($id !='') {
			return $r->row_array();
		}else{ 
			return $r->result_array();
		}

	}

	function updateUnitStatusSubCategory($id){
		$this->db->where('unit_sub_id',$id);
		$userdata = array(
			'unit_status'=>$this->input->post('unit_status'),
		);
		 
		if ($this->db->update('unit_sub_category',$userdata)) {
			return array('status'=>'1','message'=>'Successfully updated status.');
		}else{
			return array('status'=>'0','message'=>'status Failed update.');
		}	
	}



}