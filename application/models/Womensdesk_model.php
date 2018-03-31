<?php

class Womensdesk_model extends CI_Model{

	public function add(){
		$data = array(
			'Apprehension_ID' => uniqid(),
			'Citizen_ID' => $this->input->post('Citizen_ID', TRUE),
			'Apprehension_DateTime' => $this->input->post('Apprehension_DateTime', TRUE),
			'Apprehension_Location' => $this->input->post('Apprehension_Location', TRUE),
			'Apprehension_Narrative' => $this->input->post('Apprehension_Narrative', TRUE),
			'Apprehension_Remarks' => $this->input->post('Apprehension_Remarks', TRUE),
			'Guardian_Type_ID' =>  $this->input->post('Guardian_Type_ID', TRUE),
			'Guardian_Citizen_ID' =>  $this->input->post('Guardian_Citizen_ID', TRUE),
			'OIC_FullName' =>  $this->input->post('OIC_FullName', TRUE),
			'CreatedBy' => $this->session->userdata('user_id'),
			'DateCreated' => date('Y-m-d h:i:s')
			);

		$insert = $this->db->insert('tbl_womensdesk', $data);

		if($insert){
			return $this->db->insert_id();
		}
	}

	public function get_apprehensions(){
		$this->db->select('tbl_womensdesk.*, tbl_citizens.Citizen_FirstName, tbl_citizens.Citizen_LastName, tbl_citizens.Citizen_MiddleName, tbl_citizens.Citizen_Title, tbl_citizens.Citizen_Suffix');
		$this->db->from('tbl_womensdesk');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_womensdesk.Citizen_ID');
		$this->db->order_by('tbl_womensdesk.DateCreated', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_apprehension($id){
		$this->db->select('tbl_womensdesk.*, tbl_citizens.Citizen_FirstName, tbl_citizens.Citizen_LastName, tbl_citizens.Citizen_MiddleName, tbl_citizens.Citizen_Title, tbl_citizens.Citizen_Suffix');
		$this->db->from('tbl_womensdesk');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_womensdesk.Citizen_ID');
		$this->db->where('tbl_womensdesk.WD_ID', $id);
		$this->db->order_by('tbl_womensdesk.DateCreated', 'DESC');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_guardian($id){
		$this->db->select('tbl_womensdesk.*, tbl_citizens.Citizen_FirstName, tbl_citizens.Citizen_LastName, tbl_citizens.Citizen_MiddleName, tbl_citizens.Citizen_Title, tbl_citizens.Citizen_Suffix, ref_auxillary.Aux_Value');
		$this->db->from('tbl_womensdesk');
		$this->db->join('tbl_citizens', 'tbl_citizens.Citizen_ID = tbl_womensdesk.Guardian_Citizen_ID');
		$this->db->join('ref_auxillary', 'ref_auxillary.Aux_ID = tbl_womensdesk.Guardian_Type_ID');
		$this->db->where('tbl_womensdesk.WD_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

}