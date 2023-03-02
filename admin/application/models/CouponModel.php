<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Created By Riyatsa and created date: 13-05-2020
	 */
	class CouponModel extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
		}

		function getCoupon($minDate='',$maxDate='',$minVal='',$maxVal=''){
			$qry='';
			$qry1='';
			$qry2='';
			if ($minDate !='' && $minDate !='0') {
				 // $qry=" WHERE ( date(ET.week_from_date) BETWEEN '".$fromTime."' AND '".$toTime."')";
				$qry1 = 'WHERE (date(coupon_created_date) BETWEEN "'.$minDate.'" AND "'.$maxDate.'" OR date(coupon_expiry_date) BETWEEN "'.$minDate.'" AND "'.$maxDate.'")';
				 // $this->db->where('coupon_created_date >=',$minDate);
				 // $this->db->where('coupon_created_date <=', $maxDate); 
			}
			if ($minVal !='' && $minVal !='0') {
				$qry2 = ' AND coupon_discount BETWEEN '.$minVal.' AND '.$maxVal;
				 // $this->db->where('coupon_created_date >=',$minVal);
				 // $this->db->where('coupon_created_date <=', $maxVal); 
			}
			$qry=$qry1.$qry2;
			$result = $this->db->query('SELECT * FROM coupons '.$qry);
			// $this->db->get('coupons');
			return $result->result_array();
			
		}

		function getCoupons($id=''){
			if ($id !='') {
				$this->db->where('coupon_id',$id); 	
			}
			$result=$this->db->where('coupon_status',1);
			$result=$this->db->get('coupons');
			if ($id !='') {
				return $result->row_array();
			}else{	
				return $result->result_array();
			}
		}


		public function addCouponCode($couponName,$couponCode,$couponDiscount,$couponExpiryDate){
			 
			$createdDate = date('Y-m-d H:i:s');
				$couponData = array(
					'coupon_category_name'=>$this->input->post('coupon_category_type'),
					'coupon_name'=>$couponName,
					'coupon_code'=>$couponCode,
					'coupon_discount '=>$couponDiscount,
					'coupon_minimum_purchase_amount'=>$this->input->post('coupon_min_purchase_price'),
					'coupon_expiry_date'=>$couponExpiryDate,
					'coupon_created_date'=>$createdDate
				);

				if ($this->db->insert('coupons',$couponData)) {
					$insert_id = $this->db->insert_id();
					$logger = array(
					'coupon_id'=>$insert_id,
					'coupon_category_name'=>$this->input->post('coupon_category_type'),
					'coupon_name'=>$couponName,
					'coupon_code'=>$couponCode,
					'coupon_discount '=>$couponDiscount,
					'coupon_minimum_purchase_amount'=>$this->input->post('coupon_min_purchase_price'),
					'coupon_expiry_date'=>$couponExpiryDate,
					'coupon_created_date'=>$createdDate
					);
					$this->db->insert('coupons_log',$logger);
					return array('status'=>'1');
				}else{
					return array('status'=>'0');
				} 
		}

		function get_edit_coupon_details() {
			$this->db->where('coupon_id',$this->input->post('id'));
			$result=$this->db->get('coupons');
			return $result->row_array();
		}

		public function editCouponCode($couponId,$couponName,$couponCode,$couponDiscount,$couponExpiryDate){

			$this->db->where('coupon_id',$couponId); 
			$updatedDate = date('d-m-yy');
				$couponData = array(
					'coupon_name'=>$couponName,
					'coupon_code'=>$couponCode,
					'coupon_discount '=>$couponDiscount,
					'coupon_expiry_date'=>$couponExpiryDate,
					'coupon_category_name'=>$this->input->post('coupon_category_type'),
					'coupon_minimum_purchase_amount'=>$this->input->post('edit_coupon_min_purchase_price'),
					'coupon_updated_date'=>$updatedDate
				);

				if ($this->db->update('coupons',$couponData)) {
					$logger = array(
					'coupon_id'=>$couponId,
					'coupon_category_name'=>$this->input->post('coupon_category_type'),
					'coupon_name'=>$couponName,
					'coupon_code'=>$couponCode,
					'coupon_discount '=>$couponDiscount,
					'coupon_minimum_purchase_amount'=>$this->input->post('coupon_min_purchase_price'),
					'coupon_expiry_date'=>$couponExpiryDate,
					'coupon_created_date'=>$updatedDate,
					'coupon_updated_date'=>$updatedDate
					);
					$this->db->insert('coupons_log',$logger);
					return array('status'=>'1');
				}else{
					return array('status'=>'0');
				}
			 
		}


		public function changeStatusCouponCode($couponId,$couponStatus){
			
			$this->db->where('coupon_id',$couponId); 
			$updatedDate = date('d-m-yy');
				$couponData = array(
					 'coupon_status' => $couponStatus,
					 'coupon_updated_date'=>date('Y-m-d H:i:s')
				);

				if ($this->db->update('coupons',$couponData)) {
					return array('status'=>'1');
				}else{
					return array('status'=>'0');
				}
			 
		}

		/*apply coupon code */
		function get_valid_coupon($coupon){
			$this->db->where('coupon_code',$coupon);
			$r= $this->db->get('coupons');
			$rows=$r->num_rows();
			if ($rows > 0) {
				$valid_coupon = $this->db->query('SELECT * FROM `coupons` WHERE CURDATE() <= date(coupon_expiry_date) AND `coupon_status` = "1" AND `coupon_code` = "'.$coupon.'"');
				if ($valid_coupon->num_rows() > 0) {	
				$coupon = $valid_coupon->row_array();
				return array('status'=>'1','coupon_data'=>$coupon);
				}else{
					return array('status'=>'0','msg'=>'Coupon Expired');	
				}
			}else{
				return array('status'=>'0','msg'=>'Coupon Not Valid');
			}

		}
	}
?>