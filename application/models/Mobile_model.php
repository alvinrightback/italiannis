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

	public function display_orders(){
		foreach(json_decode($this->input->post('orders', TRUE)) as $row){
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where('product_id', $row->id);
			$query = $this->db->get();
			if($query->num_rows() >0){
				foreach($query->result() as $key1 => $row1){
					$data[] = $row1;
					$data[$key1]->total = (int)($row->quantity*$row1->price); 
				}
				
			}
		}
		return $data;
	}

	public function submit_orders(){

		$this->db->trans_start();

		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('table_number', $this->input->post('table_number', TRUE));
		$this->db->where('status', 0);
		$this->db->where('DATE(date_created)', date('Y-m-d'));
		$query = $this->db->get();
		$pending = 0;
		if($query->num_rows() >0){
			$pending = 1;
		}
		
		if($pending == 0){
			$data = array('table_number' => $this->input->post('table_number', TRUE),
						'date_created' => date('Y-m-d h:i:s'),
						'remark' => $this->input->post('remark', TRUE),
						'created_by' => 1);
			$query = $this->db->insert('transaction', $data);
			$trans_id = $this->db->insert_id();
			if($query){
				foreach(json_decode($this->input->post('orders', TRUE)) as $row){
					$orders = array('trans_id' => $trans_id,
									'product_id' => $row->id,
									'quantity' => $row->quantity);
					$this->db->insert('transaction_details', $orders);
				}
			}
		}
		else{
			$trans_id = $query->result()[0]->trans_id;
			foreach(json_decode($this->input->post('orders', TRUE)) as $row){
				
				$query = $this->db->get_where('transaction_details', array('trans_id'=>$trans_id, 'product_id'=>$row->id));
				if($query->result() > 0){
					$orders = array('trans_id' => $trans_id,
								'product_id' => $row->id,
								'quantity' => (int)($row->quantity+$query->result()[0]->quantity));
					$this->db->update('transaction_details',$orders, array('trans_details_id'=> $query->result()[0]->trans_details_id));
				}
				else{
					$orders = array('trans_id' => $trans_id,
					'product_id' => $row->id,
					'quantity' => $row->quantity);
					$this->db->insert('transaction_details', $orders);
				}
			}
		}

		$query = $this->db->trans_complete();
		if($query){
			return TRUE;
		}

	}


	public function check_availability(){

		$this->db->select('product.inventory_id');
		$this->db->from('product');
		$this->db->where('product_id', $this->input->post('product_id'));
		$query = $this->db->get();

		if($query->num_rows() >0){
			$this->db->select('MIN(quantity) as quantity');
			$this->db->from('inventory');
			$this->db->where_in('inventory_id', explode(",", $query->result()[0]->inventory_id));
			$query = $this->db->get();
			if($query->num_rows() >0){
				return $query->result()[0]->quantity;
			}
		}
	}

}