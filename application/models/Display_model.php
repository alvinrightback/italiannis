<?php

class Display_model extends CI_Model{

	public function get_orders(){
		$this->db->select('*');
		$this->db->from('transaction');
		$this->db->where('status', 0);
		$this->db->like('date_created', date('Y-m-d'));
		$this->db->order_by('date_created', 'asc');
		$this->db->limit(4);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $key1=>$row1){
				$data[] = $row1;

				$this->db->select('*');
				$this->db->from('transaction_details');
				$this->db->join('product', 'product.product_id = transaction_details.product_id');
				$this->db->where('trans_id', $row1->trans_id);
				$this->db->where('order_status', 'Not yet served');
				$query = $this->db->get();

				if($query->num_rows() >0){
					foreach($query->result() as $key2=>$row2){
						$temp[] = $row2;
					}
					$data[$key1]->orders = $temp;
					$temp = array();
				}
			}
			//echo '<pre>',print_r($data,1),'</pre>';
			//die();
			return $data;
		}
	}

	public function get_order(){
		$this->db->select('*');
		$this->db->from('transaction_details');
		$this->db->join('product', 'product.product_id = transaction_details.product_id');
		$this->db->where('trans_id', $this->input->post('id', TRUE));
		$this->db->where('order_status', 'Not yet served');
		$query = $this->db->get();

		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function finish_orders(){
		$data = array('order_status'=>'Served');
		$this->db->trans_start();
		foreach($this->input->post('trans_details_id') as $row){
			$this->db->update('transaction_details', $data, array('trans_details_id'=>$row));
		}
		$query = $this->db->trans_complete();
		if($query){
			return TRUE;
		}
	}
}