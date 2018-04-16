<?php

class Rewards_model extends CI_Model{


	public function change_discount_percentage(){
		$newDiscount = $this->input->post('inputDiscountPercentage', TRUE);
		$query = $this->db->update('auxillary', array('aux_value'=>$newDiscount), array('aux_group'=>'reward_discount'));

		if($query){
			return TRUE;
		}
	}
	
	public function add(){

		$this->db->trans_start();

		$data = array(
			'card_string' => $this->input->post('Card_String', TRUE),
			'points' => $this->input->post('Initial_Value', TRUE),
			'created_by' => $this->session->userdata('user_id'),
			'date_created' => date('Y-m-d h:i:s')
			);

		$insert = $this->db->insert('card', $data);
		if($insert){
			$data = array(
				'card_id' => $this->db->insert_id(),
				'points' => $this->input->post('Initial_Value', TRUE),
				'created_by' => $this->session->userdata('user_id'),
			    'date_created' => date('Y-m-d h:i:s')
			);
			$query = $this->db->insert('card_history', $data);
		}
		$this->db->trans_complete();
		
		if($query){
			return TRUE;
		}
	}

	public function edit(){
		$this->db->trans_start();

		$data = array(
			'inventory_id' => $this->input->post('Item_Details_Inventory_ID', TRUE),
			'quantity' => $this->input->post('Item_Details_Quantity', TRUE),
			'created_by' => $this->session->userdata('user_id'),
			'date_created' => date('Y-m-d h:i:s'),
			'updated_by' => $this->session->userdata('user_id'),
			'date_updated' => date('Y-m-d h:i:s')	
		);

		$this->db->insert('inventory_history', $data);

		$data = array(
			'name' => $this->input->post('Item_Details_Name', TRUE),
			'quantity' => $this->input->post('Item_Details_Quantity', TRUE),
			'updated_by' => $this->session->userdata('user_id'),
			'date_updated' => date('Y-m-d h:i:s')	
		);

		$query = $this->db->update('inventory', $data, array('inventory_id' => $this->input->post('Item_Details_Inventory_ID', TRUE)));
		$this->db->trans_complete();

		if($query){
			return TRUE;
		}

	}

	public function get_saleable(){
		$this->db->select('product.product_id, product.name, product.inventory_id, product.product_category_id, product.description, product.price, product.date_created');
		$this->db->from('product');
		$this->db->order_by('date_created', 'desc');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function edit_product_quantity($inventory_id){
		$add = $this->input->post('Add_Quantity', TRUE);
		$query = $this->db->query('UPDATE inventory SET quantity=quantity+'.$add.' WHERE inventory_id IN('.$inventory_id.')');

		if($query){
			return TRUE;
		}
	}

	public function get_all_product_inventory($inventory_id){
		$this->db->select('inventory.*');
		$this->db->from('inventory');
		$this->db->where_in('inventory_id', explode(",", $inventory_id));
		$this->db->order_by('quantity', 'asc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

}