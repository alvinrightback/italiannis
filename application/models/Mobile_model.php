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
		foreach(json_decode($this->input->post('orders', TRUE)) as $key=>$row){
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where('product_id', $row->id);
			$query = $this->db->get();
			if($query->num_rows() >0){
					$data[] = $query->result()[0];
					$data[$key]->quantity = $row->quantity;
					$data[$key]->total = (int)($row->quantity*$query->result()[0]->price); 				
			}
		}
		return $data;
	}
	function generateRandomString($length = 10) {
		return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
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
				$this->db->select('CONCAT( "I-", LPAD(trans_id,7,"0") ) as invoice_id');
				$query1 = $this->db->get_where('transaction', array('trans_id'=>$trans_id));
				$this->db->update('transaction', array('invoice_id' => $query1->result()[0]->invoice_id), array('trans_id'=>$trans_id));
				
				foreach(json_decode($this->input->post('orders', TRUE)) as $row){
					$orders = array('trans_id' => $trans_id,
									'product_id' => $row->id,
									'quantity' => $row->quantity);
					$this->db->insert('transaction_details', $orders);

					$this->deduct_inventory($row->id, $row->quantity);
				}
			}
		}
		else{
			$trans_id = $query->result()[0]->trans_id;
			foreach(json_decode($this->input->post('orders', TRUE)) as $row){
				
				//insert or update transaction_details(orders)
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
				
				$this->deduct_inventory($row->id, $row->quantity);
			}
		}

		$complete = $this->db->trans_complete();
		if($complete){
			return TRUE;
		}

	}

	public function deduct_inventory($id, $quantity){
			$this->db->select('product.inventory_id');
			$this->db->from('product');
			$this->db->where('product_id', $id);
			$this->db->limit(1);
			$query1 = $this->db->get();

			$this->db->select('inventory.inventory_id, inventory.quantity');
			$this->db->from('inventory');
			$this->db->where_in('inventory.inventory_id', explode(",", $query1->result()[0]->inventory_id));
			$query2 = $this->db->get();

			if($query2->num_rows() >0){
				foreach($query2->result() as $row1){
					$newQuantity = array('quantity' => (int)$row1->quantity- (int)$quantity);
					$this->db->update('inventory',$newQuantity, array('inventory_id'=> $row1->inventory_id));
				}
				
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


	public function bill_out(){

		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('table_number', $this->input->post('table_number', TRUE));
		$this->db->where('status', 0);
		$this->db->where('DATE(date_created)', date('Y-m-d'));
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$this->db->trans_start();
			if($this->input->post('discount', TRUE) != 0){
				$discount = 1;
				$total = $this->input->post('discount', TRUE);
			}
			else{
				$discount = 0;
				$total = $this->input->post('total', TRUE);
			}
			$data = array('trans_id' => $query->result()[0]->trans_id,
						  'payment_type' => $this->input->post('payment_type', TRUE),
						  'discount' => $discount,
						  'total' => $total
			);
			$this->db->insert('transaction_payment', $data);
			$this->db->update('transaction', array('status' => 1), array('trans_id'=> $query->result()[0]->trans_id));

			$query = $this->db->trans_complete();
			if($query){
				return TRUE;
			}
		}
		
	}


	public function get_current_quantity(){
		$this->db->select('trans_id');
		$this->db->from('transaction');
		$this->db->where('table_number', $this->input->post('table_number', TRUE));
		$this->db->where('status', 0);
		$this->db->where('DATE(date_created)', date('Y-m-d'));
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1){
			$this->db->select('quantity');
			$this->db->from('transaction_details');
			$this->db->where('trans_id', $query->result()[0]->trans_id);
			$this->db->where('product_id', $this->input->post('product_id', TRUE));
			$this->db->limit(1);
			$query1 = $this->db->get();
			if($query1->num_rows() == 1){
				return $query1->result()[0]->quantity;
			}
		}
	}
}