<?php

class Rewards_model extends CI_Model{


	public function change_discount_percentage(){
		$newDiscount = $this->input->post('inputDiscountPercentage', TRUE);
		$query = $this->db->update('auxillary', array('aux_value'=>$newDiscount), array('aux_group'=>'reward_discount_percentage'));

		if($query){
			return TRUE;
		}
	}

	public function change_reward_ratio(){
		$temp = array($this->input->post('Amount', TRUE), $this->input->post('Points', TRUE));
		$newRatio = implode(':', $temp);
		$query = $this->db->update('auxillary', array('aux_value'=>$newRatio), array('aux_group'=>'reward_ratio'));

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

	public function get_card_details($id){
		$this->db->select('*');
		$this->db->from('card');
		$this->db->join('card_details', 'card_details.card_id = card.card_id');
		$this->db->where('card.card_id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}
	}
}