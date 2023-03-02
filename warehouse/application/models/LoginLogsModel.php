<?php
/**
 * Created Date 10/01/2020 
 * 
 */
class LoginLogsModel extends CI_Model
{
	 
	function loginLogView($id=''){
			$wid = $this->session->userdata('logged_in_warehouse');
			$this->db->where('log_id',$wid['log_id']);
		if ($id !='') {
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