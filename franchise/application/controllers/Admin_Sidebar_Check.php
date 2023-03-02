<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Sidebar_Check extends CI_Controller
{

	function __construct() {
	  parent::__construct();
	  $this->load->database();
	  $this->load->helper('url');
	}	

	function index() {
		$sidebar_expand_or_collapse = '';
		if ($this->input->post('body_sidebar_class') == 'sidebar-collapse') {
			$sidebar_expand_or_collapse = 'sidebar-collapse';
		}
		$this->session->set_userdata('sidebar_expand_or_collapse', $sidebar_expand_or_collapse);
	}	
}