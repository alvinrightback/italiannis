<?php

class Jobs_model extends CI_Model{

	public function add_job($barangay_ID){
		$data = array(
			'Job_Employment_Type_ID' => $this->input->post('Job_Employment_Type_ID', TRUE),
			'Job_Name' => $this->input->post('Job_Name', TRUE),
			'Job_Description' => $this->input->post('Job_Description', TRUE),
			'Job_Qualification' => $this->input->post('Job_Qualification', TRUE),
			'Job_Benefits' => $this->input->post('Job_Benefits', TRUE),
			'Job_Working_Hours' => $this->input->post('Job_Working_Hours', TRUE),
			'Job_Date_Posted' => date('Y-m-d'),
			'Job_Date_Closed' => $this->input->post('Job_Date_Closed', TRUE),
			'Job_Dress_Code' => $this->input->post('Job_Dress_Code', TRUE),
			'Job_Minimum_Year_Exp' => $this->input->post('Job_Minimum_Year_Exp', TRUE),
			'Job_Salary_Rate_Range' => $this->input->post('Job_Salary_Rate_Range', TRUE),
			'Job_Barangay_ID' => $this->input->post('Job_Barangay_ID', TRUE),
			'Job_Location' => $this->input->post('Job_Location', TRUE),
			'Barangay_ID' => $barangay_ID,
			'CreatedBy' => $this->session->userdata('user_id'),
			'DateCreated' => date('Y-m-d h:i:s')
			);

		$insert = $this->db->insert('tbl_job_listing', $data);

		if($insert){
			return TRUE;
		}
	}


	public function get_jobs(){
		$this->db->select('tbl_job_listing.Job_Name, tbl_job_listing.Job_Date_Posted, tbl_job_listing.Job_ID, ref_auxillary.Aux_Value, tbl_barangay.Barangay_Name');
		$this->db->from('tbl_job_listing');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_job_listing.Job_Barangay_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_job_listing.Job_Employment_Type_ID');
		$this->db->order_by('tbl_job_listing.Job_Date_Posted', 'desc');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_job($id){
		$this->db->select('tbl_job_listing.*, ref_auxillary.Aux_Value, tbl_barangay.Barangay_Name');
		$this->db->from('tbl_job_listing');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_job_listing.Job_Barangay_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_job_listing.Job_Employment_Type_ID');
		$this->db->where('Job_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


	public function edit_job($barangay_ID){
		$data = array(
			'Job_Employment_Type_ID' => $this->input->post('Job_Employment_Type_ID', TRUE),
			'Job_Name' => $this->input->post('Job_Name', TRUE),
			'Job_Description' => $this->input->post('Job_Description', TRUE),
			'Job_Qualification' => $this->input->post('Job_Qualification', TRUE),
			'Job_Benefits' => $this->input->post('Job_Benefits', TRUE),
			'Job_Working_Hours' => $this->input->post('Job_Working_Hours', TRUE),
			'Job_Date_Posted' => date('Y-m-d'),
			'Job_Date_Closed' => $this->input->post('Job_Date_Closed', TRUE),
			'Job_Dress_Code' => $this->input->post('Job_Dress_Code', TRUE),
			'Job_Minimum_Year_Exp' => $this->input->post('Job_Minimum_Year_Exp', TRUE),
			'Job_Salary_Rate_Range' => $this->input->post('Job_Salary_Rate_Range', TRUE),
			'Job_Barangay_ID' => $this->input->post('Job_Barangay_ID', TRUE),
			'Job_Location' => $this->input->post('Job_Location', TRUE),
			'Barangay_ID' => $barangay_ID,
			'UpdatedBy' => $this->session->userdata('user_id')
			);

		$id = $this->input->post('Job_ID', TRUE);
		$update = $this->db->update('tbl_job_listing', $data, "Job_ID = '$id'");
		if($update){
			return $id;
		}	

		if($insert){
			return TRUE;
		}
	}
}