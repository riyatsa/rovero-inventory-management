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
		if(!$this->session->userdata('logged_in')){
			redirect('?/adminLogin'); 	
		}
			$data['title']="Coupon Code";
			$this->load->view('admin-common/admin-header');
			$this->load->view('admin-common/admin-sidebar');
			$this->load->view('admin/coupon/coupon');
			$this->load->view('admin-common/admin-footer');
		}

		function getCoupens($minDate='',$maxDate='',$minVal='',$maxVal=''){
			$data['result']=$this->couponModel->getCoupon($minDate,$maxDate,$minVal,$maxVal);
			echo json_encode($data['result']);
		}

		public function addCoupon(){
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
			$data = $this->couponModel->get_edit_coupon_details();
			echo json_encode($data);
		}

		public function editCoupon($couponId){
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
			$data = $this->couponModel->get_valid_coupon($coupon);
			echo json_encode($data);
		}
	}
?>