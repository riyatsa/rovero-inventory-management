<?php
/**
 * Created Date 10/01/2020 
 * Created By Yash
 */
class ThresholdModel extends CI_Model
{
	function getThresholdData($id='')
	{
		return $this->db->where('store_id',$id)
							->order_by('th_id','DESC')
							->get('threshold')
							->row_array();
		 
	}


	function updateThresholdData($id){
		$user = $this->session->userdata('logged_in_store');
		$thresholdData = $this->getThresholdData($user['storeId']);

		if(($thresholdData != null ) ? $thresholdData : 0 > 0 ){

			$threshold_data = array(

			'threshold_balance' =>$this->input->post('threshold_point'),
			'threshold_bill_amount' =>$this->input->post('threshold_bill_amount'),
			'percent' =>$this->input->post('percentage'),  
			'store_id'=>$user['storeId'],

			);
			$this->db->where('store_id',$user['storeId']);
			if ($this->db->update('threshold',$threshold_data)) {
				return array('status'=>'1','message'=>'Successfully Detail Updated.');
			}else{
				return array('status'=>'0','message'=>'Failed Detail Update.');
			}
		}else{
			$threshold_data = array(

			'threshold_balance' =>$this->input->post('threshold_point'),
			'threshold_bill_amount' =>$this->input->post('threshold_bill_amount'),
			'percent' =>$this->input->post('percentage'),  
			'store_id'=>$user['storeId'],

			); 
			if ($this->db->insert('threshold',$threshold_data)) {
				return array('status'=>'1','message'=>'Successfully Detail Inserted.');
			}else{
				return array('status'=>'0','message'=>'Failed Detail Insert.');
			}
		}
		
	}
}	