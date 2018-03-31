<?php

class Citizen_model extends CI_Model {

	public function add($data){
		$address1 = array();
		if($this->input->post('Citizen_CurrentAddress', TRUE)){
			$address1 = array(
				'Barangay_ID' => $this->input->post('Barangay_ID', TRUE),
				'Citizen_CurrentAddress' => $this->input->post('Citizen_CurrentAddress', TRUE));
		}
		else{
			$address1 = array(
				'Barangay_ID' => $this->input->post('Barangay_ID', TRUE),
				'Citizen_CurrentAddress' => $data['address1']);
		}
		

		$address2 = array('Barangay_ID_Permanent' => $address1['Barangay_ID'],
						  'Citizen_PermanentAddress' => $address1['Citizen_CurrentAddress']
			);
		// if($this->input->post('Citizen_PermanentAddress', TRUE)){
		// 	$address2 = array(
		// 		'Barangay_ID_Permanent' => $this->input->post('Barangay_ID_Permanent', TRUE),
		// 		'Citizen_PermanentAddress' => $this->input->post('Citizen_PermanentAddress', TRUE));
		// }
		// else{
		// 	$address2 = array(
		// 		'Barangay_ID_Permanent' => $this->input->post('Barangay_ID_Permanent', TRUE),
		// 		'Citizen_PermanentAddress' => $data['address2']);
		// }
		$personal_info = array(
			'Citizen_Title' => $this->input->post('Citizen_Title', TRUE),
			'Citizen_NickName' => $this->input->post('Citizen_NickName', TRUE),
			'Citizen_LastName' => $this->input->post('Citizen_LastName', TRUE),
			'Citizen_FirstName' => $this->input->post('Citizen_FirstName', TRUE),
			'Citizen_MiddleName' => $this->input->post('Citizen_MiddleName', TRUE),
			'Citizen_Suffix' => $this->input->post('Citizen_Suffix', TRUE),
			'Citizen_Gender' => $this->input->post('Citizen_Gender', TRUE),
			'Citizen_BirthDate' => $this->input->post('Citizen_BirthDate', TRUE),
			'Citizen_BirthPlace' => $this->input->post('Citizen_BirthPlace', TRUE),
			'Nationality_ID' => $this->input->post('Nationality_ID', TRUE),
			'Citizen_CivilStatus' => $this->input->post('Citizen_CivilStatus', TRUE),
			'Citizen_Mobile' => $this->input->post('Citizen_Mobile', TRUE),
			'Citizen_Telephone' => $this->input->post('Citizen_Telephone', TRUE),
			'Citizen_Email' => $this->input->post('Citizen_Email', TRUE),
			'Citizen_HighestEducationAttainment' => $this->input->post('Citizen_HighestEducationAttainment', TRUE),
			'Citizen_NameOfMother' => $this->input->post('Citizen_NameOfMother', TRUE),
			'Citizen_NameOfFather' => $this->input->post('Citizen_NameOfFather', TRUE),
			'Citizen_NameOfSpouse' => $this->input->post('Citizen_NameOfSpouse', TRUE),
			'DateCreated'=> date('Y-m-d'),
			'CreatedBy' => $this->session->userdata('user_id')
			);
		$data = array_merge($personal_info, $address1, $address2);

		$insert = $this->db->insert('tbl_citizens', $data);
		$citizen_id = $this->db->insert_id();
		$cAddOns ="";
		if($this->input->post('currentAddressTo', TRUE) != 'Present'){
			$cAddOns = '-1';
		}
		if($insert){
			if($data['Citizen_CurrentAddress'] == $data['Citizen_PermanentAddress']){
				$data = array('Citizen_ID' => $citizen_id,
							  'Stay_From_Date' => $this->input->post('currentAddressFrom', TRUE).'-1',
							  'Stay_To_Date' => $this->input->post('currentAddressTo', TRUE).$cAddOns,
							  'Address_ID' => $data['Citizen_CurrentAddress'],
							  'DateCreated'=> date('Y-m-d'),
						      'CreatedBy' => $this->session->userdata('user_id'));
				$insert = $this->db->insert('tbl_address_history', $data);
			}
			else{
				$data = array(
					array('Citizen_ID' => $citizen_id,
						'Address_ID' => $data['Citizen_CurrentAddress'],
						'Stay_From_Date' => $this->input->post('currentAddressFrom', TRUE).'-1',
						'Stay_To_Date' => $this->input->post('currentAddressTo', TRUE).$cAddOns,
						'DateCreated'=> date('Y-m-d'),
						'CreatedBy' => $this->session->userdata('user_id')),
					array('Citizen_ID' => $citizen_id,
						'Address_ID' => $data['Citizen_PermanentAddress'],
						'Stay_From_Date' => $this->input->post('permanentAddressFrom', TRUE).'-1',
						'Stay_To_Date' => $this->input->post('permanentAddressTo', TRUE).$pAddOns,
						'DateCreated'=> date('Y-m-d'),
						'CreatedBy' => $this->session->userdata('user_id')
						));
				$insert = $this->db->insert_batch('tbl_address_history', $data);
			}
			if($insert){
				return $citizen_id;
			}
		}
	}

	public function edit($id){
		$data = array(
			'Citizen_Title' => $this->input->post('Citizen_Title', TRUE),
			'Citizen_NickName' => $this->input->post('Citizen_NickName', TRUE),
			'Citizen_LastName' => $this->input->post('Citizen_LastName', TRUE),
			'Citizen_FirstName' => $this->input->post('Citizen_FirstName', TRUE),
			'Citizen_MiddleName' => $this->input->post('Citizen_MiddleName', TRUE),
			'Citizen_Suffix' => $this->input->post('Citizen_Suffix', TRUE),
			'Citizen_Gender' => $this->input->post('Citizen_Gender', TRUE),
			'Citizen_BirthDate' => $this->input->post('Citizen_BirthDate', TRUE),
			'Citizen_BirthPlace' => $this->input->post('Citizen_BirthPlace', TRUE),
			'Barangay_ID' => $this->input->post('Barangay_ID', TRUE),
			'Nationality_ID' => $this->input->post('Nationality_ID', TRUE),
			'Citizen_CivilStatus' => $this->input->post('Citizen_CivilStatus', TRUE),
			'Citizen_Mobile' => $this->input->post('Citizen_Mobile', TRUE),
			'Citizen_Telephone' => $this->input->post('Citizen_Telephone', TRUE),
			'Citizen_Email' => $this->input->post('Citizen_Email', TRUE),
			'Citizen_NameOfMother' => $this->input->post('Citizen_NameOfMother', TRUE),
			'Citizen_NameOfFather' => $this->input->post('Citizen_NameOfFather', TRUE),
			'Citizen_NameOfSpouse' => $this->input->post('Citizen_NameOfSpouse', TRUE),
			'UpdatedBy' => $this->session->userdata('user_id')
			);

		$update = $this->db->update('tbl_citizens', $data, "Citizen_ID = '$id'");

		if($update){
			return TRUE;
		}
	}

	public function get_citizens_with_barangay(){
		$this->db->select('tbl_citizens.*, tbl_barangay.*');
		$this->db->from('tbl_barangay');
		$this->db->join('tbl_citizens', 'tbl_citizens.Barangay_ID = tbl_barangay.Barangay_ID');

		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_citizen_info($id){
		$this->db->select('tbl_citizens.*, tbl_barangay.*, tbl_nationality.*');
		$this->db->from('tbl_barangay');
		$this->db->join('tbl_citizens', 'tbl_citizens.Barangay_ID = tbl_barangay.Barangay_ID');
		$this->db->join('tbl_nationality', 'tbl_nationality.Nationality_ID = tbl_citizens.Nationality_ID');
		$this->db->where('tbl_citizens.Citizen_ID', $id);

		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


	public function add_photo(){
		define('UPLOAD_DIR', 'resources/images/citizen_photo/');
		$img = $this->input->post('imageURL');
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $this->input->post('Citizen_ID') . '.jpeg';
		$success = file_put_contents($file, $data);

		if($success){
			return TRUE;
		}
	}

}