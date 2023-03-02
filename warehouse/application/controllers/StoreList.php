<?php
/**
 * 
 */
class StoreList extends CI_Controller
{
	
	function __construct()
	{
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');  
	}

	function index(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url());
			exit();
		}
		$data['title'] = '';
        $this->load->view('warehouse-common/warehouse-header');
		$this->load->view('warehouse-common/warehouse-sidebar');
		$this->load->view('warehouse/store/store-list',$data);
		$this->load->view('warehouse-common/warehouse-footer');	
	}
}