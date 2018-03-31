<?php

class Blotter_model extends CI_Model{


	public function add($barangay_ID){
		$data = array(
			'Complained_Date' => date('Y-m-d h:i:s'),
			'Incident_Date_From' => $this->input->post('Incident_Date_From', TRUE),
			'Incident_Date_To' => $this->input->post('Incident_Date_To', TRUE),
			'Nature_Of_Complaint' => $this->input->post('Nature_Of_Complaint', TRUE),
			'Complaint_Status_ID' => $this->input->post('Complaint_Status_ID', TRUE),
			'Remarks' => $this->input->post('Remarks', TRUE),
			'Barangay_ID' => $barangay_ID,
			'CreatedBy' => $this->session->userdata('user_id'),
			'DateCreated' => date('Y-m-d h:i:s')
			);

		$insert = $this->db->insert('tbl_blotter', $data);

		if($insert){
			return $this->db->insert_id();
		}
	}

	public function add_people(){
		$type = $this->input->post('Type', TRUE);
		$id = $this->input->post('Blotter_ID', TRUE);

		$data = array(
			$type.'Last_Name' => $this->input->post('Last_Name', TRUE),
			$type.'First_Name' => $this->input->post('First_Name', TRUE),
			$type.'Middle_Name' => $this->input->post('Middle_Name', TRUE),
			$type.'Nationality_ID' => $this->input->post('Nationality_ID', TRUE),
			$type.'Complete_Address' => $this->input->post('Complete_Address', TRUE),
			$type.'Contact_Number' => $this->input->post('Contact_Number', TRUE),
			$type.'ID' => $this->input->post('ID', TRUE),
			'Blotter_ID' => $id,
			'CreatedBy' => $this->session->userdata('user_id'),
			'DateCreated' => date('Y-m-d h:i:s')
			);

		if($type == 'Com_'){
			$insert = $this->db->insert('tbl_blotter_complainant', $data);
		}
		if($type == 'Res_'){
			$insert = $this->db->insert('tbl_blotter_respondent', $data);
		}

		if($insert){
			return $id;
		}
	}

	public function get_blotters(){
		$this->db->select('tbl_blotter.*, ref_auxillary.Aux_Value, tbl_barangay.Barangay_Name, tbl_blotter_complainant.Com_Last_Name, tbl_blotter_complainant.Com_First_Name, tbl_blotter_complainant.Com_Middle_Name, tbl_blotter_complainant.Blotter_Complainant_ID ');
		$this->db->from('tbl_blotter');
		$this->db->join('tbl_blotter_complainant', 'tbl_blotter_complainant.Blotter_ID = tbl_blotter.Blotter_ID', 'left');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_blotter.Complaint_Status_ID');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_blotter.Barangay_ID');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_blotter($id){
		$this->db->select('tbl_blotter.*, ref_auxillary.Aux_Value');
		$this->db->from('tbl_blotter');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_blotter.Complaint_Status_ID');
		$this->db->where('tbl_blotter.Blotter_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_people($blotter_ID, $table){
		$this->db->select("tbl_blotter.*, ref_auxillary.Aux_Value, tbl_barangay.Barangay_Name, $table.*");
		$this->db->from('tbl_blotter');
		$this->db->join($table, "$table.Blotter_ID = tbl_blotter.Blotter_ID", 'left');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_blotter.Complaint_Status_ID');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_blotter.Barangay_ID');
		$this->db->where('tbl_blotter.Blotter_ID', $blotter_ID);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function delete_people($table, $field, $id){
		$this->db->delete($table, array($field => $id)); 

		if($this->db->affected_rows()){
			return TRUE;
		}
	}

		public function get_person_info($table, $field, $prefix, $id){
		$cond = $table.'.'.$prefix.'Nationality_ID';

		$this->db->select("$table.*, tbl_nationality.Nationality_Name");
		$this->db->from($table);
		$this->db->join('tbl_nationality', "tbl_nationality.Nationality_ID = $cond");
		$this->db->where("$table.$field", $id);

		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

}