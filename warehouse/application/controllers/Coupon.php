<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Created By Riyatsa and created date: 13-05-2020
	 */
	class Coupon extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->model('couponModel');
		}

		public function index(){
		if(!$this->session->userdata('logged_in_warehouse')){
			redirect(base_url()); 	
		}
			$data['title']="Coupon Code";
			$this->load->view('warehouse-common/warehouse-header');
			$this->load->view('warehouse-common/warehouse-sidebar');
			$this->load->view('warehouse/coupon/coupon');
			$this->load->view('warehouse-common/warehouse-footer');
		}

		function getCoupens($minDate='',$maxDate='',$minVal='',$maxVal=''){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
			$data['result']=$this->couponModel->getCoupon($minDate,$maxDate,$minVal,$maxVal);
			echo json_encode($data['result']);
		}

		public function addCoupon(){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
			$couponName = $this->input->post('couponName');
			$couponCode = $this->input->post('couponCode');
			$couponDiscount = $this->input->post('couponDiscount');
			$couponExpiryDate = $this->input->post('couponExpiryDate');
			$status = $this->couponModel->addCouponCode($couponName,$couponCode,$couponDiscount,$couponExpiryDate);
			if($status['status'] == '1'){
				echo json_encode(array('status'=>'success'));
			}else{
				echo json_encode(array('status'=>'fail'));
			}
		}

		function get_edit_coupon_details() {
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
			$data = $this->couponModel->get_edit_coupon_details();
			echo json_encode($data);
		}

		public function editCoupon($couponId){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
			$couponName = $this->input->post('couponName');
			$couponCode = $this->input->post('couponCode');
			$couponDiscount = $this->input->post('couponDiscount');
			$couponExpiryDate = $this->input->post('couponExpiryDate');

			$status = $this->couponModel->editCouponCode($couponId,$couponName,$couponCode,$couponDiscount,$couponExpiryDate);
			if($status['status'] == '1'){
				echo json_encode(array('status'=>'success'));
			}else{
				echo json_encode(array('status'=>'fail'));
			}
		}

		public function statusCoupon($couponId){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
			$couponStatus = $this->input->post('couponStatus');
			  
			$status = $this->couponModel->changeStatusCouponCode($couponId,$couponStatus);
			if($status['status'] == '1'){
				echo json_encode(array('status'=>'success'));
			}else{
				echo json_encode(array('status'=>'fail'));
			}
		}

		/* check valid coupon */
		function get_valid_coupon($coupon){
		if(!$this->session->userdata('logged_in_warehouse')){
			echo json_encode(array('status'=>'3','msg'=>'invalid user, please login.'));	
			exit();
		}
			$data = $this->couponModel->get_valid_coupon($coupon);
			echo json_encode($data);
		}
	}
?>