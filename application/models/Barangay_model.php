<?php

class Barangay_model extends CI_Model{


	public function add(){
		$data = array(
			'Barangay_Name' => $this->input->post('Barangay_Name', TRUE),
			'Barangay_Chairman' => $this->input->post('Barangay_Chairman', TRUE),
			'Barangay_Telephone' => $this->input->post('Barangay_Telephone', TRUE),
			'Barangay_Zipcode' => $this->input->post('Barangay_Zipcode', TRUE)
			);

		$insert = $this->db->insert('tbl_barangay', $data);

		if($insert){
			return TRUE;
		}
	}

	public function edit($id){
		$data = array(
			'Barangay_Name' => $this->input->post('Barangay_Name', TRUE),
			'Barangay_Chairman' => $this->input->post('Barangay_Chairman', TRUE),
			'Barangay_Telephone' => $this->input->post('Barangay_Telephone', TRUE),
			'Barangay_Zipcode' => $this->input->post('Barangay_Zipcode', TRUE)
			);

		$update = $this->db->update('tbl_barangay', $data, "Barangay_ID = '$id'");

		if($update){
			return TRUE;
		}
	}

}