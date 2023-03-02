<?php
/**
 * Created Date 10/01/2020 
 * Created By Yash
 */
class GstModel extends CI_Model
{
	function insertGst()
	{
		$gstData = array(
			'gst_name'=>$this->input->post('gst_name'),
			'gst_value'=>$this->input->post('gst_value')
		);
		if ($this->db->insert('gst_details',$gstData)) {
			 $gstLogData = array(
			 	'gst_id'=>$this->db->insert_id(),
				'gst_name'=>$this->input->post('gst_name'),
				'gst_value'=>$this->input->post('gst_value')
			);
			$this->db->insert('gst_details_log',$gstLogData);
			return array('status'=>'1','message'=>'Successfully Inserted.');
		}else{
			return array('status'=>'0','message'=>'Insert Failed.');
		}
	}	

	function updateGst($id)
	{
		$this->db->where('gst_id',$id);
		$gstData = array(
			'gst_name'=>$this->input->post('gst_name'),
			'gst_value'=>$this->input->post('gst_value')
		);
		
		if ($this->db->update('gst_details',$gstData)) {
			 $gstLogData = array(
			 	'gst_id'=>$id,  
				'gst_name'=>$this->input->post('gst_name'),
				'gst_value'=>$this->input->post('gst_value')
				 
			);
			$this->db->insert('gst_details_log',$gstLogData);
			return array('status'=>'1','message'=>'Successfully Updated.');
		}else{
			return array('status'=>'0','message'=>'Updation Failed.');
		}
	}	


	function viewGst($id=''){
		if ($id !='') {
			$this->db->where('gst_id',$id);
		}else{
			$this->db->order_by('gst_id','DESC');
		}
		$r=$this->db->get('gst_details');
		if ($id !='') {
			return $r->row_array();
		}else{ 
			return $r->result_array();
		}

	}

	function updateGstStatus($id){
		$this->db->where('gst_id',$id);
		$gstdata = array(
			'status'=>$this->input->post('gst_status'),
		);
		 
		if ($this->db->update('gst_details',$gstdata)) {
			return array('status'=>'1','message'=>'Successfully updated status.');
		}else{
			return array('status'=>'0','message'=>'status Failed update.');
		}	
	}


 

}