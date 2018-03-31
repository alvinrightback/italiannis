<?php

class Property_model extends CI_Model{

	public function add_property($data){
		$property_address = array();
		if($this->input->post('Address_ID', TRUE)){
			$property_address = array('Address_ID' => $this->input->post('Address_ID', TRUE));
		}
		else{
			$property_address = array('Address_ID' => $data['property_address']);
		}

		$property_info = array(
			'REP_Name' => $this->input->post('REP_Name', TRUE),
			'Citizen_ID' => $this->input->post('Citizen_ID', TRUE),
			'REP_No_Of_Units' => $this->input->post('REP_No_Of_Units', TRUE),
			'REP_Unit_Type' => $this->input->post('REP_Unit_Type', TRUE),
			'REP_Submission_Date' => $this->input->post('REP_Submission_Date', TRUE),
			'DateCreated'=> date('Y-m-d h:i:s'),
			'CreatedBy' => $this->session->userdata('user_id')
			);
		$data = array_merge($property_info, $property_address);
		$insert = $this->db->insert('tbl_real_estate_property', $data);

		if($insert){
			return $this->db->insert_id();
		}	
	}


	public function get_properties(){
		$this->db->select('*');
		$this->db->from('tbl_real_estate_property');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_real_estate_property.Citizen_ID');
		$this->db->join('tbl_address', 'tbl_address.Address_ID = tbl_real_estate_property.Address_ID');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_address.Barangay_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_real_estate_property.REP_Unit_Type');
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_property($id){
		$this->db->select('*');
		$this->db->from('tbl_real_estate_property');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_real_estate_property.Citizen_ID');
		$this->db->join('tbl_address', 'tbl_address.Address_ID = tbl_real_estate_property.Address_ID');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_address.Barangay_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_real_estate_property.REP_Unit_Type');
		$this->db->where('REP_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_citizen_property($id){
		$this->db->select('*');
		$this->db->from('tbl_real_estate_property');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_real_estate_property.Citizen_ID');
		$this->db->join('tbl_address', 'tbl_address.Address_ID = tbl_real_estate_property.Address_ID');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_address.Barangay_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_real_estate_property.REP_Unit_Type');
		$this->db->where('tbl_citizens.Citizen_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function edit_property($data){
		$property_address = array();
		if($this->input->post('Address_ID', TRUE)){
			$property_address = array('Address_ID' => $this->input->post('Address_ID', TRUE));
		}
		else{
			$property_address = array('Address_ID' => $data['property_address']);
		}

		$property_info = array(
			'REP_Name' => $this->input->post('REP_Name', TRUE),
			'Citizen_ID' => $this->input->post('Citizen_ID', TRUE),
			'REP_No_Of_Units' => $this->input->post('REP_No_Of_Units', TRUE),
			'REP_Unit_Type' => $this->input->post('REP_Unit_Type', TRUE),
			'REP_Submission_Date' => $this->input->post('REP_Submission_Date', TRUE),
			'DateUpdated'=> date('Y-m-d h:i:s'),
			'UpdatedBy' => $this->session->userdata('user_id')
			);
		$data = array_merge($property_info, $property_address);
		$id = $this->input->post('REP_ID', TRUE);
		$update = $this->db->update('tbl_real_estate_property', $data, "REP_ID = '$id'");

		if($update){
			return $this->db->insert_id();
		}	
	}

	public function add_renter(){

		$data = array(
			'Citizen_ID' => $this->input->post('Citizen_ID', TRUE),
			'REP_ID' => $this->input->post('REP_ID', TRUE),
			'Renter_Type_ID' => $this->input->post('Renter_Type_ID', TRUE),
			'Arrival_Date' => $this->input->post('Arrival_Date', TRUE),
			'CreatedBy' => $this->session->userdata('user_id'),
			'DateCreated' => Date('Y-m-d h:i:s')
			);
		$insert = $this->db->insert('tbl_real_estate_property_renter', $data);

		if($insert){
			$citizen_id = $this->input->post('Citizen_ID');
			$update = $this->db->update('tbl_citizens', array('Citizen_CurrentAddress' => $this->input->post('Address_ID', TRUE)), "Citizen_ID = '$citizen_id'");		
			if($update){

				$data = array('Stay_To_Date' => $this->input->post('Arrival_Date', TRUE),
					'UpdatedBy' => $this->session->userdata('user_id'));
				$update = $this->db->update('tbl_address_history', $data, "Citizen_ID = '$citizen_id' && Stay_To_Date = 'Present'");

				$data = array('Citizen_ID' => $this->input->post('Citizen_ID', TRUE),
					'Address_ID' => $this->input->post('Address_ID', TRUE),
					'Stay_From_Date' => $this->input->post('Arrival_Date', TRUE),
					'Stay_To_Date' => 'Present',
					'CreatedBy' => $this->session->userdata('user_id'),
					'DateCreated' => Date('Y-m-d h:i:s')
					);
				$insert = $this->db->insert('tbl_address_history', $data);
				if($insert){
					return TRUE;
				}
				
			}
		}	
	}

	public function get_renters($id){
		$this->db->select('*');
		$this->db->from('tbl_real_estate_property_renter');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_real_estate_property_renter.Citizen_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_real_estate_property_renter.Renter_Type_ID');
		$this->db->where('tbl_real_estate_property_renter.REP_ID', $id);
		$this->db->where('tbl_real_estate_property_renter.Departure_Date', NULL);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_renter_history($id){
		$this->db->select('*');
		$this->db->from('tbl_real_estate_property_renter');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_real_estate_property_renter.Citizen_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_real_estate_property_renter.Renter_Type_ID');
		$this->db->where('tbl_real_estate_property_renter.REP_ID', $id);
		$this->db->where('tbl_real_estate_property_renter.Departure_Date !=', NULL);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function leave_renter(){
		$data = array(
			'Departure_Date' => $this->input->post('Departure_Date', TRUE),
			'UpdatedBy' => $this->session->userdata('user_id')
			);
		$renter_id = $this->input->post('REP_Renter_ID', TRUE);
		$update = $this->db->update('tbl_real_estate_property_renter', $data, "REP_Renter_ID = '$renter_id'");
		if($update){
			return TRUE;
		}
	}

	public function edit_renter(){
		$data = array(
			'Arrival_Date' => $this->input->post('Arrival_Date', TRUE),
			'UpdatedBy' => $this->session->userdata('user_id')
			);
		$renter_id = $this->input->post('REP_Renter_ID', TRUE);
		$update = $this->db->update('tbl_real_estate_property_renter', $data, "REP_Renter_ID = '$renter_id'");
		if($update){
			return TRUE;
		}
	}

}