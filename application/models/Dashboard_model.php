<?php

class Dashboard_model extends CI_Model{

	public function get_citizen_per_barangay(){
		$this->db->select('tbl_barangay.Barangay_Name, count(tbl_citizens.Barangay_ID) AS `citizen_count`');
		$this->db->from('tbl_citizens');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_citizens.Barangay_ID');
		$this->db->group_by('tbl_citizens.Barangay_ID');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


	public function get_trm_per_barangay(){
		$this->db->select('tbl_barangay.Barangay_Name, count(tbl_citizens.Barangay_ID) AS `citizen_count`');
		$this->db->from('tbl_citizens');
		$this->db->join('tbl_barangay', 'tbl_barangay.Barangay_ID = tbl_citizens.Barangay_ID');
		$this->db->join('tbl_trm', 'tbl_trm.Citizen_ID = tbl_citizens.Citizen_ID');
		$this->db->group_by('tbl_citizens.Barangay_ID');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_job_per_type(){
		$this->db->select('ref_auxillary.Aux_Value AS `employment_type`, count(tbl_job_listing.Job_Employment_Type_ID) AS `job_count`');
		$this->db->from('tbl_job_listing');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_job_listing.Job_Employment_Type_ID');
		$this->db->group_by('ref_auxillary.Aux_Group');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}
}