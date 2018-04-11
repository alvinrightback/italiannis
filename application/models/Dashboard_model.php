<?php

class Dashboard_model extends CI_Model{

	public function get_today_sales(){

        $this->db->select('SUM(transaction_payment.total) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_payment', 'transaction_payment.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->where('DATE(date_created)', date('Y-m-d'));
		$query = $this->db->get();
		if($query->num_rows() >0){
			return $query->result()[0]->total;
        }
	}
	
	public function get_today_occupied_tables(){

        $this->db->select('COUNT(trans_id) AS total');
        $this->db->from('transaction');
        $this->db->where('status', 0);
        $this->db->where('DATE(date_created)', date('Y-m-d'));
		$query = $this->db->get();
		if($query->num_rows() >0){
			return $query->result()[0]->total;
        }
	}
	
	public function get_pending_orders(){

		$this->db->select('SUM(transaction_details.quantity) AS total');
		$this->db->from('transaction');
		$this->db->join('transaction_details', 'transaction_details.trans_id = transaction.trans_id');
			$this->db->where('transaction.status', 0);
			$this->db->where('transaction_details.order_status', 'Not yet served');
		$this->db->where('DATE(date_created)', date('Y-m-d'));
			$query = $this->db->get();
			if($query->num_rows() >0){
				return $query->result()[0]->total;
		}
	}

	public function get_best_sellers(){
		$this->db->select('product.name, SUM(transaction_details.quantity) AS total_quantity');
		$this->db->from('transaction');
		$this->db->join('transaction_details', 'transaction_details.trans_id = transaction.trans_id');
		$this->db->join('product', 'product.product_id = transaction_details.product_id');
		$this->db->where('transaction.status', 2);
		$this->db->where('YEAR(transaction.date_created)', date('Y'));
		$this->db->order_by('total_quantity', 'desc');
		$this->db->group_by('transaction_details.product_id');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
                	$data[] = $row;
			}
			return $data;
       		 }	
	}
}