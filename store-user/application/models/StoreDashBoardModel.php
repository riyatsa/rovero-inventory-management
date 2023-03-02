<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class StoreDashBoardModel extends CI_Model
{
	
	function total_purchase(){

		$user = $this->session->userdata('logged_in_store_user'); 
		$count = $this->db->query('SELECT SUM(total) AS total, COUNT(*) AS totalOrder FROM store_purchase_order WHERE purchased_by='.$user['soreId'])->row_array(); 
		return $count;
	}

	function total_sales(){
		$user = $this->session->userdata('logged_in_store_user'); 
		$count = $this->db->query('SELECT SUM(total) AS total_sales, COUNT(*) AS totalSalesOrder FROM store_sales_order WHERE purchased_by='.$user['soreId'])->row_array(); 
		return $count;
	}

	function total_ptoduct(){
		$user = $this->session->userdata('logged_in_store_user'); 
		$count = $this->db->query('SELECT COUNT(*) AS totalProduct FROM store_products WHERE storeId='.$user['soreId'])->row_array(); 
		return $count;
	}

	function get_monthly_data(){
		$year = date('Y');
		$user = $this->session->userdata('logged_in_store_user');
		// $result = $this->db->query('select monthname(created_date) as MONTHNAME,count(product_id) as total FROM warehouse_products WHERE usersId='.$user['storeId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)');

		$purchase_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_purchase, monthname(created_date) AS month FROM store_purchase_order WHERE purchased_by='.$user['storeId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 

		$sales_order = $this->db->query('SELECT ROUND(SUM(total),2) AS total_sales, monthname(created_date) month FROM store_sales_order WHERE purchased_by='.$user['storeId'].' AND YEAR(created_date) = '.$year.'  group by monthname(created_date)')->result_array(); 
		// $purchase_order_rs = round($purchase_order['total_purchase'],2);
		$analytics['purchase_order'] = $purchase_order;
		$analytics['sales_order'] = $sales_order;

		return $analytics;
		
	}
}