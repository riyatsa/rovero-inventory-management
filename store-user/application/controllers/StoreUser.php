<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StoreUser extends CI_Controller {

	function add_store_users(){

	if(!$this->session->userdata('logged_in_store_user')){
			redirect(base_url());
			exit();
		}
		$data['title']="WareHouse Add User";
		$this->load->view('store-common/store-header');
		$this->load->view('store-common/store-sidebar');
		$this->load->view('store/users/add-store-users');
		$this->load->view('store-common/store-footer');
	}

}
