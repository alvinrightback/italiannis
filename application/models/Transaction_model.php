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
				$payment = $this->db->get_where('transaction_payment', array('trans_id', $this->input->post('id')));
				if($payment->num_rows() > 0){
						$data[$key1]->payment = $payment->result();
				}
				$this->db->select('*');
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


}