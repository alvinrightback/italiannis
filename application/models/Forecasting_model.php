<?php

class Forecasting_model extends CI_Model{

    public function get_yearly_sales(){

        $this->db->select('MONTH(date_created) as month, SUM(transaction_payment.total) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_payment', 'transaction_payment.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->WHERE('YEAR(date_created)', $this->input->post('year'));
        $this->db->order_by('date_created', 'asc');
        $this->db->group_by('MONTH(date_created)');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
                $data[] = $row;
			}
			return $data;
        }
    }

    public function get_yearly_sales_forecast(){

        $this->db->select('MONTH(date_created) as month, SUM(transaction_payment.total) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_payment', 'transaction_payment.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->WHERE('YEAR(date_created)', '2016');
        $this->db->order_by('date_created', 'asc');
        $this->db->group_by('MONTH(date_created)');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
                $data2016[$row->month-1] = $row->total;
            }
            for($i=0; $i<12; $i++){
                if(empty($data2016[$i])){
                  $data2016[$i] = 0;
                }
            }  
        }

        $this->db->select('MONTH(date_created) as month, SUM(transaction_payment.total) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_payment', 'transaction_payment.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->WHERE('YEAR(date_created)', '2017');
        $this->db->order_by('date_created', 'asc');
        $this->db->group_by('MONTH(date_created)');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
                $data2017[$row->month-1] = $row->total;
            }
            for($i=0; $i<12; $i++){
                if(empty($data2017[$i])){
                  $data2017[$i] = 0;
                }
            }
        }

        for($i=0; $i<12; $i++){
            $data2018[$i] = (int)($data2017[$i]+((($data2017[$i]-$data2016[$i])/$data2016[$i])*100));
        }

        return $data2018;
    }




    public function get_product_sales(){

        $this->db->select('*');
		$this->db->from('transaction');
		$this->db->like('date_created', $this->input->post('year'), 'after');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $key1=>$row1){
				$data[] = $row1;
				$payment = $this->db->get_where('transaction_payment', array('trans_id' => $row1->trans_id));

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


}