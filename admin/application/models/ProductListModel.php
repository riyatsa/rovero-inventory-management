
<?php
/**
 * 
 */
class ProductListModel extends CI_Model
{

	function getProductCategory($id=''){
			if ($id !='') {
			$result  = $this->db->where('category_id',$id)
					->order_by('category_id','DESC')
					->get('product_category')
					->row_array();		
			}else{
			$result  = $this->db->order_by('category_id','DESC')
					->get('product_category')
					->result_array();			 
			}

			return $result;
	}	
   
	function get_warehouse_product_details($warehouse_Id=''){
		  
		if($warehouse_Id != ''){
			$this->db->where('warehouseId',$warehouse_Id);
		}
		$result = $this->db->select("*")
				->from('warehouse_products')
				->join('product_category','product_category.category_id = warehouse_products.category_id','left')
				->join('unit_category','unit_category.unit_id = warehouse_products.unit_id','left') 
				->order_by('product_id','DESC')
				->get()
				->result_array();
		return $result;
	}


	function getWareouses($id=''){
		$this->db->select("warehouseId,warehouseName");
		if ($id !='') {
			$this->db->where('warehouseId',$id);
		}else{
			$this->db->order_by('warehouseId','DESC');
		}
		$r=$this->db->get('warehousedetails');
		if ($id !='') {
			return $r->row_array();
		}else{ 
		return $r->result_array();
		}  
	}

}