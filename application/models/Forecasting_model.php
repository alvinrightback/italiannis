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
        $data2016 = array(0,0,0,0,0,0,0,0,0,0,0,0);
		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
                $data2016[$row->month-1] = $row->total;
            }
        }

        $this->db->select('MONTH(date_created) as month, SUM(transaction_payment.total) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_payment', 'transaction_payment.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->where('YEAR(date_created)', '2017');
        $this->db->order_by('date_created', 'asc');
        $this->db->group_by('MONTH(date_created)');
        $query = $this->db->get();
        $data2017 = array(0,0,0,0,0,0,0,0,0,0,0,0);
		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
                $data2017[$row->month-1] = $row->total;
            }
        }

        for($i=0; $i<12; $i++){
            $data2018[$i] = (int)($data2017[$i]+((($data2017[$i]-$data2016[$i])/$data2016[$i])*100));
        }

        return $data2018;


    }


    public function get_product_yearly_sales(){

        $this->db->select('MONTH(transaction.date_created) AS month, SUM(transaction_details.quantity) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_details', 'transaction_details.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->where('YEAR(transaction.date_created)', $this->input->post('year'));
        $this->db->where('transaction_details.product_id', $this->input->post('id'));
        $this->db->order_by('MONTH(transaction.date_created)', 'asc');
        $this->db->group_by('MONTH(transaction.date_created)');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
                $data[] = $row;
			}
			return $data;
        }
    }



    public function get_product_yearly_sales_forecast(){

        $this->db->select('MONTH(transaction.date_created) AS month, SUM(transaction_details.quantity) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_details', 'transaction_details.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->where('YEAR(transaction.date_created)', '2016');
        $this->db->where('transaction_details.product_id', $this->input->post('id'));
        $this->db->order_by('MONTH(transaction.date_created)', 'asc');
        $this->db->group_by('MONTH(transaction.date_created)');
        $query = $this->db->get();
        $data2016 = array(0,0,0,0,0,0,0,0,0,0,0,0);
		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
                $data2016[$row->month-1] = $row->total;
            }
        }

        $this->db->select('MONTH(transaction.date_created) AS month, SUM(transaction_details.quantity) AS total');
        $this->db->from('transaction');
        $this->db->join('transaction_details', 'transaction_details.trans_id = transaction.trans_id');
        $this->db->where('transaction.status', 2);
        $this->db->where('YEAR(transaction.date_created)', '2017');
        $this->db->where('transaction_details.product_id', $this->input->post('id'));
        $this->db->order_by('MONTH(transaction.date_created)', 'asc');
        $this->db->group_by('MONTH(transaction.date_created)');
        $query = $this->db->get();
        $data2017 = array(0,0,0,0,0,0,0,0,0,0,0,0);
		if($query->num_rows() >0){
			foreach($query->result() as $key=>$row){
                $data2017[$row->month-1] = $row->total;
            } 
        }
        
        for($i=0; $i<12; $i++){
            if($data2016[$i] == 0){
                $data2018[$i] = (int)($data2017[$i]);    
            }
            else{  
             $data2018[$i] = (int)($data2017[$i]+( ( ($data2017[$i]-$data2016[$i]) / $data2016[$i] )*100));
            }
        }
        //echo '<pre>'.print_r($data2017,1).'</pre>';
        //die();
        return $data2018;


    }
    
}