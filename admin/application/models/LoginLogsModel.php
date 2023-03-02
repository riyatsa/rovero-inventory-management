<?php
/**
 * Created Date 9/30/2020 
 * Created By Yash
 */
class LoginLogsModel extends CI_Model
{
	 
	function loginLogView($id=''){
		if ($id !='') {
			$this->db->where('log_id',$id);
		}else{
			$this->db->order_by('log_id','DESC');
		}
		$r=$this->db->get('loginlogs');
		if ($id !='') {
			return $r->row_array();
		}else{ 
		return $r->result_array();
		}

	}
 

}