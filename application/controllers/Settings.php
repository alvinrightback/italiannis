<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('settings_model');
	}

	public function password(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$this->render('settings/password/main', $data);
	}

	public function password_update(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('oldPassword', 'Old Password', 'trim|required|callback_checkOldPassword');
		$this->form_validation->set_rules('newPassword', 'New Password', 'trim|required|matches[newPasswordConfirm]');
		$this->form_validation->set_rules('newPasswordConfirm', 'Confirm Password', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->password();
		}
		else{	
			$query = $this->settings_model->update_password();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('settings/password');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('settings/password');
			}
		}
	}

	public function checkOldPassword(){
		$PassFromDB = $this->get_data->get_value('Default_Value','tbl_defaults', array('Default_Name'=> 'Password'));
		$PassFromForm = $this->input->post('oldPassword', TRUE);
		if(sha1($PassFromForm) == $PassFromDB){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('checkOldPassword', 'Incorrect password');
			return FALSE;
		}
	}

	public function module(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['modules'] = $this->get_data->get_all_value('ref_modules');
		$this->render('settings/modules/main', $data);
	}
	

	public function module_add(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Module_Name', 'Module Name', 'trim|required|is_unique[ref_modules.Module_Name]');
		if($this->form_validation->run() == FALSE){
			$this->module();
		}
		else{	
			$query = $this->settings_model->add_module();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('settings/module');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('settings/module');
			}
		}
	}


	public function module_edit(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['module_data'] = $this->get_data->get_value_where('ref_modules', array('Module_ID' => $this->uri->segment(3)));
		$this->render('settings/modules/edit', $data);
	}

	public function module_edit_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Module_Name', 'Module Name', 'trim|required');
		$this->form_validation->set_rules('Module_ID', 'Module ID', 'trim|required');
		$this->form_validation->set_rules('Class_Name', 'Class Name', 'trim|required');
		if($this->form_validation->run() == FALSE){
			$this->module();
		}
		else{	
			$query = $this->settings_model->edit_module();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('settings/module');
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('settings/module');
			}
		}
	}


	public function role(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['roles'] = $this->get_data->get_value_where('ref_user_roles', array('User_Role_ID !=' => 1));
		$this->render('settings/roles/main', $data);
	}

	public function role_add_name(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['modules'] = $this->get_data->get_all_value('ref_modules');
 		$this->render('settings/roles/add_name', $data);
	}

	public function role_add_name_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('User_Role_Name', 'User Role Name', 'trim|required|is_unique[ref_user_roles.User_Role_Name]');
		$this->form_validation->set_rules('User_Role_Affix', 'User Role Affix', 'trim|required|strip_tags');
		if($this->form_validation->run() == FALSE){
			$this->role_add_name();
		}
		else{	
			$query = $this->settings_model->add_role_name();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('settings/role_add_module/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('settings/role_add_name');
			}
		}
	}

	public function role_add_module(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['user_role'] = $this->get_data->get_value_where('ref_user_roles', array('User_Role_ID'=> $this->uri->segment(3)));
		$data['modules'] = $this->get_data->get_all_value('ref_modules');
		$data['user_modules'] = $this->settings_model->get_user_modules($this->uri->segment(3));
		if(isset($data['user_modules'])){
			foreach ($data['user_modules'] as $value) {
	    		$data['existingModules'][] = $value->Module_ID;
			}
		}
 		$this->render('settings/roles/add_module', $data);
	}

	public function role_edit_privilege(){
		$data['title'] = "Settings";
		$data['success'] = $this->session->flashdata('success');
		$data['failed'] = $this->session->flashdata('failed');
		$data['module_privilege'] = $this->settings_model->get_module_privilege($this->uri->segment(3));
 		$this->render('settings/roles/edit_privilege', $data);
	}

	public function role_edit_privilege_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Module_ID', 'Module ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Transaction_Insert', 'Insert', 'trim|strip_tags');
		$this->form_validation->set_rules('Transaction_Update', 'Updated', 'trim|strip_tags');
		$this->form_validation->set_rules('Transaction_Delete', 'Delete', 'trim|strip_tags');
		$this->form_validation->set_rules('Transaction_ID', 'Transaction ID', 'trim|required|strip_tags');
		if($this->form_validation->run() == FALSE){
				redirect('settings/role_edit_privilege/'.$this->input->post('Transaction_ID', TRUE));
		}
		else{	
			$query = $this->settings_model->edit_role_privilege();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('settings/role_add_module/'.$this->input->post('User_Role_ID', TRUE));
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('settings/role_add_module'.$this->input->post('User_Role_ID', TRUE));
			}
		}
	}

	public function role_add_module_now(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Module_ID', 'Module ID', 'trim|required|strip_tags');
		$this->form_validation->set_rules('Transaction_Insert', 'Insert', 'trim|strip_tags');
		$this->form_validation->set_rules('Transaction_Update', 'Updated', 'trim|strip_tags');
		$this->form_validation->set_rules('Transaction_Delete', 'Delete', 'trim|strip_tags');
		$this->form_validation->set_rules('User_Role_ID', 'User Role ID', 'trim|required|strip_tags');
		if($this->form_validation->run() == FALSE){
			$this->role_add_name();
		}
		else{	
			$query = $this->settings_model->add_role_privilege();
			if($query){
				$this->session->set_flashdata('success', 'Successful!');
				redirect('settings/role_add_module/'.$query);
			}
			else{
				$this->session->set_flashdata('failed', 'Failed!');
				redirect('settings/role');
			}
		}
	}


}
