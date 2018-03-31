<?php

class Settings_model extends CI_Model{


	public function get_users(){
		$this->db->select('tbl_users.User_Name, tbl_users.User_ID, ref_user_roles.User_Role_Name');
		$this->db->from('tbl_users');
		$this->db->join('ref_user_roles', 'tbl_users.User_Role_ID = ref_user_roles.User_Role_ID');
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}


	public function update_password(){
		$update = $this->db->update('tbl_defaults', array('Default_Value'=>sha1($this->input->post('newPassword', TRUE))), "Default_Name = 'Password'");

		if($update){
			return TRUE;
		}
	}

	public function add_module(){
		$data = array(
			'Module_Name' => $this->input->post('Module_Name', TRUE),
			'Class_Name' => strtolower($this->input->post('Module_Name', TRUE)),
			'DateCreated' => date('Y-m-d'),
			'CreatedBy' => $this->session->userdata('user_id')
			);

		$insert = $this->db->insert('ref_modules', $data);

		if($insert){
			return TRUE;
		}
	}

	public function add_role_name(){
		$data = array(
			'User_Role_Name' => $this->input->post('User_Role_Name', TRUE),
			'DateCreated' => date('Y-m-d h:i:s'),
			'CreatedBy' => $this->session->userdata('user_id')
			);

		$insert = $this->db->insert('ref_user_roles', $data);

		if($insert){
			return $this->db->insert_id();
		}
	}

	public function add_role_privilege(){
		$data = array(
			'Module_ID' => $this->input->post('Module_ID', TRUE),
			'User_Role_ID' => $this->input->post('User_Role_ID', TRUE),
			'DateCreated' => date('Y-m-d h:i:s'),
			'CreatedBy' => $this->session->userdata('user_id')
			);
		if($this->input->post('Transaction_Insert', TRUE)){
			$data = array_merge($data, array('Transaction_Insert' => 'Y'));
		}
		if($this->input->post('Transaction_Update', TRUE)){
			$data = array_merge($data, array('Transaction_Update' => 'Y'));
		}
		if($this->input->post('Transaction_Delete', TRUE)){
			$data = array_merge($data, array('Transaction_Delete' => 'Y'));
		}
		$insert = $this->db->insert('ref_module_access', $data);
		if($insert){
			return $this->input->post('User_Role_ID', TRUE);
		}
	}

	public function get_user_modules($id){
		$this->db->select('ref_modules.Module_Name, ref_module_access.*');
		$this->db->from('ref_modules');
		$this->db->join('ref_module_access', 'ref_module_access.Module_ID = ref_modules.Module_ID');
		$this->db->where('ref_module_access.User_Role_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}

	public function edit_module(){
		$id = $this->input->post('Module_ID', TRUE);
		$update = $this->db->update('ref_modules', array('Module_Name'=>$this->input->post('Module_Name', TRUE), 
														'Class_Name'=> $this->input->post('Class_Name', TRUE),
														'UpdatedBy'=>$this->session->userdata('user_id')), "Module_ID = '$id'");
		if($update){
			return TRUE;
		}
	}


	public function get_module_privilege($id){
		$this->db->select('ref_modules.Module_Name, ref_module_access.*, tbl_users.User_Name');
		$this->db->from('ref_modules');
		$this->db->join('ref_module_access', 'ref_module_access.Module_ID = ref_modules.Module_ID');
		$this->db->join('tbl_users', 'tbl_users.User_ID = ref_module_access.CreatedBy');
		$this->db->where('ref_module_access.Transaction_ID', $id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}

	}

	public function edit_role_privilege(){
		$data = array(
			'DateUpdated' => date('Y-m-d h:i:s'),
			'UpdatedBy' => $this->session->userdata('user_id')
			);
		if($this->input->post('Transaction_Insert', TRUE)){
			$data = array_merge($data, array('Transaction_Insert' => 'Y'));
		}
		else{
			$data = array_merge($data, array('Transaction_Insert' => 'N'));
		}
		if($this->input->post('Transaction_Update', TRUE)){
			$data = array_merge($data, array('Transaction_Update' => 'Y'));
		}
		else{
			$data = array_merge($data, array('Transaction_Update' => 'N'));
		}
		if($this->input->post('Transaction_Delete', TRUE)){
			$data = array_merge($data, array('Transaction_Delete' => 'Y'));
		}
		else{
			$data = array_merge($data, array('Transaction_Delete' => 'N'));	
		}

		$id = $this->input->post('Transaction_ID', TRUE);
		$update = $this->db->update('ref_module_access',$data, "Transaction_ID = '$id'");
		if($update){
			return TRUE;
		}
	}
}