<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class LoginModel extends CI_Model
{
	

function store_login($username, $password)
 {
   
	   if($password!=$this->config->item('master_password')){
	   $this->db->where('storedetails.password', MD5($password));
	   }
	   if (strpos($username, '@') !== false) {
	    $this->db->where('storedetails.userName', $username);
	   }else{
	    $this->db->where('storedetails.userName', $username);
	   }

		$this->db->limit(1);
	    $query = $this->db->get('storedetails');
				 
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

 function storeLoginLog($userLog){
 	$userdata = array(
 		'userName'=>$userLog['userName'],
 		'email'=>$userLog['userName'],
 		'role'=>'store',
 		'ipAddress'=> $_SERVER['REMOTE_ADDR'],
 		'timeDate'=>date('Y-m-d H:i:s'),
 		'createdDate'=>date('Y-m-d H:i:s'),
 	);
 	$this->db->insert('loginlogs',$userdata);
 	return true;

 }


}