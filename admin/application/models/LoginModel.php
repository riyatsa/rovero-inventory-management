<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class LoginModel extends CI_Model
{
	
	
	function admin_login($username, $password)
 {
   
	   if($password!=$this->config->item('master_password')){
	   $this->db->where('admin_info.password', MD5($password));
	   }
	   if (strpos($username, '@') !== false) {
	    $this->db->where('admin_info.email', $username);
	   }else{
	    $this->db->where('admin_info.email', $username);
	   }

		$this->db->limit(1);
	    $query = $this ->db-> get('admin_info');
				 
	   if($query -> num_rows() == 1)
	   {
	   $user=$query->row_array();
	   return array('status'=>'1','user'=>$user);
	   }
	   else
	   {
	     return array('status'=>'0','message'=>'invalid_login');
	   }
 }

 function loginLogs($userLog){
 	$userdata = array(
 		'userName'=>$userLog['userName'],
 		'email'=>$userLog['email'],
 		'role'=>$userLog['role'],
 		'ipAddress'=> $_SERVER['REMOTE_ADDR'],
 		'timeDate'=>date('Y-m-d H:i:s'),
 		'createdDate'=>date('Y-m-d H:i:s'),
 	);
 	$this->db->insert('loginlogs',$userdata);
 	return true;
 }


}