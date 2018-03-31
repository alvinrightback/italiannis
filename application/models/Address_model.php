<?php

class Address_model extends CI_Model{


	public function add_address($address, $Barangay_ID){
		if($Barangay_ID == NULL){
			$Barangay_ID = 'N';
		}
		$query = $this->db->get_where('tbl_address', array('Address_Name' => $address, 'Barangay_ID' => $Barangay_ID));
		if($query->num_rows() == 0){
			$insert = $this->db->insert('tbl_address', array('Address_Name'=>$address, 
				'Barangay_ID'=> $Barangay_ID, 
				'DateCreated'=> date('Y-m-d'), 
				'CreatedBy' => $this->session->userdata('user_id')));
			if($insert){
				return $this->db->insert_id();
			}
		}
	}

	public function edit_address($id, $data){
		$new_history = array();
		$cAddOns ="";
		$pAddOns ="";
		if($this->input->post('currentAddressTo', TRUE) != 'Present'){
			$cAddOns = '-1';
		}
		if($this->input->post('permanentAddressTo', TRUE) != 'Present'){
			$pAddOns = '-1';
		}

		$address1 = array();
		if (!array_key_exists("address1",$data)) {
			$address1 = array(
				'Citizen_CurrentAddress' => $this->input->post('Citizen_CurrentAddress', TRUE));
			array_push($new_history, array('Citizen_ID' => $id,
				'Address_ID' => $this->input->post('Citizen_CurrentAddress', TRUE),
				'Stay_From_Date' => $this->input->post('currentAddressFrom', TRUE).'-1',
				'Stay_To_Date' => $this->input->post('currentAddressTo', TRUE).$cAddOns,
				'CreatedBy' => $this->session->userdata('user_id')));
		}
		else{
			if(isset($data['address1'])){
				$address1 = array(
					'Citizen_CurrentAddress' => $data['address1']);
				array_push($new_history, array('Citizen_ID' => $id,
					'Address_ID' => $data['address1'],
					'Stay_From_Date' => $this->input->post('currentAddressFrom', TRUE).'-1',
					'Stay_To_Date' => $this->input->post('currentAddressTo', TRUE).$cAddOns,
					'CreatedBy' => $this->session->userdata('user_id')));
			}
			$current_new_date = array('Stay_From_Date' => $this->input->post('currentAddressFrom', TRUE).'-1',
					'Stay_To_Date' => $this->input->post('currentAddressTo', TRUE).$cAddOns,
					'UpdatedBy' => $this->session->userdata('user_id')
					);
		}

		$address2 = array();
		if (!array_key_exists("address2",$data)) {
			$address2 = array(
				'Citizen_PermanentAddress' => $this->input->post('Citizen_PermanentAddress', TRUE));
			if($this->input->post('Citizen_CurrentAddress', TRUE) != $this->input->post('Citizen_PermanentAddress', TRUE)){
				array_push($new_history, array('Citizen_ID' => $id,
					'Address_ID' => $this->input->post('Citizen_PermanentAddress', TRUE),
					'Stay_From_Date' => $this->input->post('permanentAddressFrom', TRUE).'-1',
					'Stay_To_Date' => $this->input->post('permanentAddressTo', TRUE).$pAddOns,
					'CreatedBy' => $this->session->userdata('user_id')));
			}
		}
		else{
			if(isset($data['address2'])){
				$address1 = array(
					'Citizen_PermanentAddress' => $data['address2']);
				array_push($new_history, array('Citizen_ID' => $id,
					'Address_ID' => $data['address2'],
					'Stay_From_Date' => $this->input->post('permanentAddressFrom', TRUE).'-1',
					'Stay_To_Date' => $this->input->post('permanentAddressTo', TRUE).$pAddOns,
					'CreatedBy' => $this->session->userdata('user_id')));
			}
			$permanent_new_date = array('Stay_From_Date' => $this->input->post('permanentAddressFrom', TRUE).'-1',
					'Stay_To_Date' => $this->input->post('permanentAddressTo', TRUE).$pAddOns,
					'UpdatedBy' => $this->session->userdata('user_id')
					);
		}

		$data = array_merge($address1, $address2);
		if($data){
			$update = $this->db->update('tbl_citizens', $data, "Citizen_ID = '$id'");	
			if($update && $new_history){
				$insert = $this->db->insert_batch('tbl_address_history', $new_history);
				if($insert){
					return TRUE;
				}
			}	
		}
		else{
			$historyID1 = $this->input->post('History_ID1');
			if(isset($current_new_date)){
				$update1 = $this->db->update('tbl_address_history', $current_new_date, "History_ID = '$historyID1'");	
			}
			$historyID2 = $this->input->post('History_ID2');
			if(isset($permanent_new_date)){
				$update2 = $this->db->update('tbl_address_history', $permanent_new_date, "History_ID = '$historyID2'");	
			}

			if($update1 || $update2){
				return TRUE;
			}
			else{
				$this->session->set_flashdata('failed', 'No Change has been made!');
			}
		}

	}

	public function get_address($id){
		$this->db->select('Address_Name, Barangay_Name, tbl_address.Barangay_ID, tbl_address_history.Stay_From_Date, tbl_address_history.Stay_To_Date, tbl_address_history.History_ID');
		$this->db->from('tbl_address');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_address.Barangay_ID');
		$this->db->join('tbl_address_history', 'tbl_address_history.Address_ID = tbl_address.Address_ID');
		$this->db->where('tbl_address.Address_ID', $id);
		$this->db->where('tbl_address_history.Citizen_ID', $this->uri->segment(3));
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		else{
			$this->db->select('Address_Name');
			$this->db->from('tbl_address');
			$this->db->where('tbl_address.Address_ID', $id);
			$query = $this->db->get();
			if($query->num_rows() >0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
	}


	public function get_address_history($id){
		$this->db->select('*');
		$this->db->from('tbl_address_history');
		$this->db->join('tbl_address', 'tbl_address.Address_ID = tbl_address_history.Address_ID');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_address.Barangay_ID');
		$this->db->where('tbl_address_history.Citizen_ID', $id);
		$this->db->order_by('tbl_address_history.DateCreated', 'desc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row; 
			}
			return $data;	
		}
	}

	public function get_address_with_barangay(){
		$this->db->select('*');
		$this->db->from('tbl_address');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_address.Barangay_ID');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}
}