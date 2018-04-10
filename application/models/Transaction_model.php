<?php

class Transaction_model extends CI_Model{


	public function get_transaction_details(){
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('trans_id', $this->input->post('id'));
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $key1=>$row1){
				$data[] = $row1;
				$payment = $this->db->get_where('transaction_payment', array('trans_id' => $this->input->post('id')));

				if($payment->num_rows() > 0){
						$data[$key1]->payment = $payment->result();
				}
				$this->db->select('*, (product.price*transaction_details.quantity) AS total');
				$this->db->from('transaction_details');
				$this->db->join('product', 'product.product_id = transaction_details.product_id');
				$this->db->where('trans_id', $row1->trans_id);
				$query = $this->db->get();

				if($query->num_rows() >0){
					foreach($query->result() as $key2=>$row2){
						$temp[] = $row2;
					}
					$data[$key1]->orders = $temp;
					$temp = array();
				}
			}
			return $data;
		}
	}


	public function edit_orders(){
		$this->db->trans_start();
		foreach($this->input->post('trans_details_id', TRUE) as $key=>$row){
			$data = array('quantity'=>$this->input->post('order_quantity', TRUE)[$key],
						  'order_status' =>$this->input->post('order_status', TRUE)[$key]
			);
			if($this->input->post('order_delete')){
				if(in_array($row, $this->input->post('order_delete'))){
					//Delete record
					$this->db->delete('transaction_details', array('trans_details_id' => $row)); 
				}
				else{
					//Update record
					$this->addQuantity($row, $this->input->post('order_quantity', TRUE)[$key]);
					$this->db->update('transaction_details', $data, array('trans_details_id' => $row));
				}
			}
			else{
				//Update record
				$this->addQuantity($row, $this->input->post('order_quantity', TRUE)[$key]);
				$this->db->update('transaction_details', $data, array('trans_details_id' => $row));
			}
			

		}
		$query = $this->db->trans_complete();
		if($query){
			return TRUE;
		}
	}

	public function addQuantity($id, $quantityFromForm){
		$check = $this->db->get_where('transaction_details', array('trans_details_id'=>$id), 1);
		$currentQuantity = $check->result()[0]->quantity;
		$addition = 0;
		if($currentQuantity !== $quantityFromForm){
			$addition = $currentQuantity - $quantityFromForm;
			
		}
		$this->db->select('product.inventory_id');
		$this->db->from('product');
		$this->db->where('product_id', $check->result()[0]->product_id);
		$this->db->limit(1);
		$query1 = $this->db->get();

		$this->db->select('inventory.inventory_id, inventory.quantity');
		$this->db->from('inventory');
		$this->db->where_in('inventory.inventory_id', explode(",", $query1->result()[0]->inventory_id));
		$query2 = $this->db->get();

		if($query2->num_rows() >0){
			foreach($query2->result() as $row1){
				$newQuantity = array('quantity' => (int)$row1->quantity + (int)$addition);
				$this->db->update('inventory',$newQuantity, array('inventory_id'=> $row1->inventory_id));
			}
			
		}
	}


	public function payment_complete($id){
		$data = array('status' => 2);
		$query = $this->db->update('transaction',$data, array('trans_id'=> $id));
		if($query){
			return TRUE;
		}
	}

}