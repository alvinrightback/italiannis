<?php

class Mobile_model extends CI_Model{


	public function get_menu(){
		$this->db->select('*');
		$this->db->from('auxillary');
		$this->db->where('aux_group', 'product_category');
		$this->db->order_by('aux_value', 'desc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $key1=>$row1){
				$data[] = $row1;

				$this->db->select('*');
				$this->db->from('product');
				$this->db->where('product_category_id', $row1->aux_id);
				$this->db->order_by('name', 'desc');
				$query = $this->db->get();

				if($query->num_rows() >0){

					foreach($query->result() as $key2=>$row2){
						$temp[] = $row2;
						$temp[$key2]->availability = $this->get_minimum_inventory($row2->inventory_id);
					}
					$data[$key1]->menu = $temp;
				}
			}
			return $data;
		}
	}


	public function get_minimum_inventory($inventory_id){
		$this->db->select('MIN(quantity) as quantity');
		$this->db->from('inventory');
		$this->db->where_in('inventory_id', explode(",", $inventory_id));
		$query = $this->db->get();
		if($query->num_rows() >0){
			return $query->result()[0]->quantity;
		}
	}

}