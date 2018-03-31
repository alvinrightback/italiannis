<?php

class Accounts_model extends CI_Model{

	public function add($password, $username){

		$data = array(
			'User_Name' => $username,
			'User_Password' => $password,
			'User_FirstName' => $this->input->post('User_FirstName', TRUE),
			'User_LastName' => $this->input->post('User_LastName', TRUE),
			'User_MiddleName' => $this->input->post('User_MiddleName', TRUE),
			'User_Email' => $this->input->post('User_Email', TRUE),
			'User_Role_ID' => $this->input->post('User_Role_ID', TRUE),
			'Barangay_ID' => $this->input->post('Barangay_ID', TRUE),
			'CreatedBy' => $this->session->userdata('user_id')
			);

		$insert = $this->db->insert('tbl_users', $data);

		if($insert){
			return TRUE;
		}
	}

	public function edit($id){
		$data = array(
			'User_Name' => $this->input->post('User_Name', TRUE),
			'User_FirstName' => $this->input->post('User_FirstName', TRUE),
			'User_LastName' => $this->input->post('User_LastName', TRUE),
			'User_MiddleName' => $this->input->post('User_MiddleName', TRUE),
			'User_Email' => $this->input->post('User_Email', TRUE),
			'User_Role_ID' => $this->input->post('User_Role_ID', TRUE),
			'Barangay_ID' => $this->input->post('Barangay_ID', TRUE),
			'CreatedBy' => $this->session->userdata('user_id')
			);
		
		$update = $this->db->update('tbl_users', $data, "User_ID = '$id'");
		if($update){
			return TRUE;
		}
	}

	public function get_users(){
		$this->db->select('tbl_users.User_Name, tbl_users.User_ID, ref_user_roles.User_Role_Name, tbl_barangay.Barangay_Name');
		$this->db->from('tbl_users');
		$this->db->join('ref_user_roles', 'tbl_users.User_Role_ID = ref_user_roles.User_Role_ID');
		$this->db->join('tbl_barangay', 'tbl_users.Barangay_ID = tbl_barangay.Barangay_ID'); 
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function get_user($id){
		$this->db->select('tbl_users.*, ref_user_roles.User_Role_Name, tbl_barangay.Barangay_Name');
		$this->db->from('tbl_users');
		$this->db->join('ref_user_roles', 'tbl_users.User_Role_ID = ref_user_roles.User_Role_ID');
		$this->db->join('tbl_barangay', 'tbl_users.Barangay_ID = tbl_barangay.Barangay_ID'); 
		$this->db->where('User_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function reset_password($default_pass, $id){
		$update = $this->db->update('tbl_users', array('User_Password'=>$default_pass, 'Password_Change'=>'1'), "User_ID = '$id'");
		if($update){
			return $id;
		}
	}

	public function change_status($current, $id){
		$current = $current == 1 ? '0':'1';
		$update = $this->db->update('tbl_users', array('User_Status'=>$current), "User_ID = '$id'");
		if($update){
			return $id;
		}	
	}

	public function update_password($id){
		$update = $this->db->update('users', array('password'=>sha1($this->input->post('newPassword', TRUE))), "user_id = '$id'");
		if($update){
			return TRUE;
		}
	}


}